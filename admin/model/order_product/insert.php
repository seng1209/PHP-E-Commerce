<?php
global $db;

$order_product_id = $order_id = $product_id = $quantity = $amount = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["create"])) {
        $order_id = $_POST["order_id"];
        $product_id = $_POST["product_id"];
        $quantity = $_POST["quantity"];

        $row = $db->read("products", "*", "product_id = $product_id");

        $product_price = 0;

        if ($row && count($row) > 0) {
            $product_price = $row['price'];
        }

        $amount = $quantity * $product_price;


        if (!Validator::notEmpty($order_id))
            die("Order id is required");

        if (!Validator::notEmpty($product_id))
            die("Product id is required");

        $data = [
            "order_id" => $order_id,
            "product_id" => $product_id,
            "quantity" => $quantity,
            "amount" => $amount
        ];

        try {
            if (!$db->create("order_products", $data))
                die("Failed to create order product");
            $total_amount = $db->total_amount("order_products", "amount", "order_id = $order_id");
            if (!$db->update("orders" , ["total_amount" => $total_amount], "order_id = $order_id"))
                die("Failed to update total amount");
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}

?>


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Order Product</h5>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?p=order-product" method="post">
                        <div class="mb-3">
                            <select class="form-select" name="order_id" aria-label="Default select example">
                                <option selected disabled>Order</option>
                                <?php
                                $orders = $db->read("orders");
                                foreach ($orders as $order) {
                                    ?>
                                    <option value="<?=$order['order_id']?>"><?=$order['order_id']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="product_id" aria-label="Default select example">
                                <option selected disabled>Product</option>
                                <?php
                                $products = $db->read("products");
                                foreach ($products as $product) {
                                    ?>
                                    <option value="<?=$product['product_id']?>"><?=$product['product_id']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Quantity</label
                            >
                            <input
                                type="number"
                                name="quantity"
                                class="form-control"
                                id=""
                                aria-describedby="emailHelp"
                            />
                        </div>
<!--                        <div class="mb-3">-->
<!--                            <label for="" class="form-label">Amount</label-->
<!--                            >-->
<!--                            <input-->
<!--                                type="number"-->
<!--                                name="amount"-->
<!--                                class="form-control"-->
<!--                                id=""-->
<!--                            />-->
<!--                        </div>-->
                        <button type="submit" name="create" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>