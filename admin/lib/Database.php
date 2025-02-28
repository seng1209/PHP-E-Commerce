<?php
class Database {
    private static $servername = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $db_name = "e_commerce_db";
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                return false;
            }
        }
        return self::$conn;
    }

    public function closeConnection() {
        self::$conn = null;
    }

    public function read($tb_name, $column = "*", $criteria = "", $clause = "")
    {
        if (empty($tb_name)){
            die("Table name not found.");
        }
        $sql = "SELECT " . $column . " FROM " . $tb_name;
        if (!empty($criteria)) {
            $sql .= " WHERE " . $criteria;
        }
        if (!empty($clause)) {
            $sql .= " " . $clause;
        }
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $this->closeConnection();
            if (empty($criteria))
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            else
                return $stmt->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }

    public function readBy($tb_name, $column = "*", $criteria = "", $clause = "")
    {
        if (empty($tb_name)){
            die("Table name not found.");
        }
        $sql = "SELECT " . $column . " FROM " . $tb_name;
        if (!empty($criteria)) {
            $sql .= " WHERE " . $criteria;
        }
        if (!empty($clause)) {
            $sql .= " " . $clause;
        }
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $this->closeConnection();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }

    public function create($tb_name, $data=array())
    {
        if (empty($tb_name)){
            die("Table name not found.");
        }
        $conn = self::getConnection();
        $fields = implode(",", array_keys($data));
        $values = implode("','", array_values($data));
        $sql = "INSERT INTO " . $tb_name . " (" . $fields . ") VALUES ('" . $values . "')";
        $result = $conn->query($sql);
        if (!$result) {
            return false;
        }
        $this->closeConnection();
        return true;
    }

    public function update($tb_name, $data=array(), $criteria="")
    {
        if(empty($tb_name) || empty($data) || empty($criteria))
        {
            return false;
        }

        $fv = "";
        $conn = self::getConnection();
        foreach($data as $field=>$value)
        {
            $fv .= " ". $field . "='" .  $value . "',";
        }
        $fv = substr($fv, 0, strlen($fv)-1);
        $sql = "UPDATE " . $tb_name ." SET " . $fv .  " WHERE " . $criteria;

        $result = $conn->query($sql);
        if (!$result) {
            return false;
        }
        $this->closeConnection();
        return true;
    }

    public function delete($tb_name, $criteria = ""){
        if(empty($tb_name) || empty($criteria)){
            return false;
        }
        $sql = "DELETE FROM ". $tb_name . " WHERE " . $criteria;
        $conn = self::getConnection();
        $result = $conn->query($sql);

        if (!$result) {
            return false;
        }
        $this->closeConnection();
        return true;
    }

}
?>
