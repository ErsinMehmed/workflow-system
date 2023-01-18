<?php
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

//Create product
if (isset($_POST['admin_product_order'])) {

    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $kind = $_POST['kind'];
    $supplier = $_POST['supplier'];
    $manufacturer = $_POST['manufacturer'];
    $onePrice = $_POST['onePrice'];
    $price = $_POST['price'];
    $date = date('Y-m-d H:i:s');


    if ($name == NULL || $quantity == NULL || $supplier == NULL || $manufacturer == NULL || $onePrice == NULL) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT * FROM stock WHERE name = '$name'";
        $query_go = mysqli_query($con, $query);

        if (mysqli_num_rows($query_go) == 1) {
            while ($rows = mysqli_fetch_array($query_go)) {
                $quantityStock = $rows['quantity'];
                $quantityResult = $quantityStock + $quantity;

                $queryy = "UPDATE stock SET quantity = '$quantityResult' WHERE name = '$name'";
                $query_run = mysqli_query($con, $queryy);

                $queryyy = "INSERT INTO product_order (name,quantity,kind,supplier,manufacturer,price_per_one,total_price,date) VALUES ('$name','$quantity','$kind','$supplier','$manufacturer','$onePrice','$price','$date')";
                $query_runn = mysqli_query($con, $queryyy);

                jsonResponseMain($query_runn, 'Успешно добавена поръчка', 'Неуспешно добавяне на поръчка');
            }
        } else {
            jsonResponse(500, 'Продукт с име ' . $name . ' не съществува');
        }
    }
}
