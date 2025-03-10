<?php
class Auth {

    public function __construct() {
    }

    // Register a new user
    public function register($image, $username, $password, $email, $phone, $address) {
        global $db;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $data = [
            'image' => $image,
            'username' => $username,
            'password' => $hashedPassword,
            'email' => $email,
            'phone' => $phone,
            'address' => $address
        ];
        try {
            if (!$db->create("users", $data))
                die("Error creating user: " . $db->error);
            return true;
        }catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Login a user
    public function login($username, $password) : bool
    {
        global $db;
        $user = $db->read("users", "*", "username = '$username'");
        if ($user && password_verify($password, $user['password'])) {
            // Start session and store user information
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['is_log_in'] = "login";
            // Update last activity timestamp
            $_SESSION['last_activity'] = time();
            return true;
        }
        return false;

    }

    // Remember Me functionality
    public function rememberMe($userId)
    {
        global $db;
        $token = bin2hex(random_bytes(16)); // Generate a random token
        $expiry = date('Y-m-d H:i:s', strtotime('+60 seconds'));

        if (!$db->create("users", ["remember_token" => $token, "remember_expiry" => $expiry, "user_id" => $userId]))
            die("Error creating user: " . $db->error);

        // Set cookie
//        setcookie("remember_me", $token, time() + (86400 * 30), "/"); // 30 days
        setcookie("remember_me", $token, time() + 60 , "/");
    }

    // Check if the user is remembered
    public function checkRememberMe(): bool
    {
        global $db;
        if (isset($_COOKIE['remember_me'])) {
            $token = $_COOKIE['remember_me'];
//            $result = $this->db->query("SELECT * FROM user_token WHERE token = '$token' AND expiry > NOW()");
            $tokenData = $db->read("user_token", "*", "token = '$token' AND expiry > NOW()");

            if ($tokenData) {
                // Log the user in automatically
                $_SESSION['user_id'] = $tokenData['user_id'];
                $_SESSION['remember_token'] = 'remember';
                return true;
            }
        }
        return false;
    }

//    public function duration()
//    {
//        // Set a timeout duration (in seconds)
//        $timeoutDuration = 30; // 5 minutes
//
//        // Check if the user is logged in
//        if (isset($_SESSION['last_activity'])) {
//            // Calculate the session's lifetime
//            $sessionLifetime = time() - $_SESSION['last_activity'];
//
//            // If the session has been inactive for too long, log the user out
//            if ($sessionLifetime > $timeoutDuration) {
//                session_unset(); // Unset session variables
//                session_destroy(); // Destroy the session
//                header("Location: logout.php"); // Redirect to logout page
//                exit();
//            }
//        }
//    }

    // Logout function
    public function logout() : bool
    {
        session_start();
        session_destroy();
        setcookie("remember_me", "", time() - 3600, "/"); // Expire the cookie
        return true;
    }
}
?>