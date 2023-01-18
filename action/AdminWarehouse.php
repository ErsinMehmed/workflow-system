<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

//Create product
if (isset($_POST['admin_product'])) {

    $name = $_POST['name'];
    $kind = $_POST['kind'];

    if ($name == NULL) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT name FROM stock WHERE name = '$name'";
        $query_go = mysqli_query($con, $query);

        if (mysqli_num_rows($query_go) == 0) {
            $query = "INSERT INTO stock (name,quantity,kind) VALUES ('$name','0','$kind')";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Успешно добавяне на продукта', 'Неуспешно добавяне на продукта');
        } else {
            jsonResponse(500, 'Този продукт вече съществува');
        }
    }
}

// Get product data
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM stock WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'data' => $order
        ];
        echo json_encode($res);
        return;
    } else {
        jsonResponse(404, 'Клиента не е намерен');
    }
}

// Update product information
if (isset($_POST['admin_edit_product'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $kind = $_POST['kind'];


    if ($name == NULL) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT name FROM stock WHERE name = '$name'";
        $query_go = mysqli_query($con, $query);

        if (mysqli_num_rows($query_go) == 0) {
            $query = "UPDATE stock SET name='$name', kind='$kind' WHERE id='$id'";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Продукта е обновен', 'Продукта не е обновен');
        } else {
            jsonResponse(500, 'Този продукт вече съществува');
        }
    }
}

// Update product information
if (isset($_POST['admin_delete_product'])) {

    $id = $_POST['id'];

    $query = "DELETE FROM stock WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    jsonResponseMain($query_run, 'Продукта е изтрит успешно', 'Продукта не е изтрит');
}

// Set product to team
if (isset($_POST['admin_set_product'])) {

    $teamId = $_POST['team'];
    $product = $_POST['name'];
    $quantity = $_POST['quantity'];
    $date = date('Y-m-d');


    if ($product == NULL || $quantity == NULL) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT * FROM stock WHERE name = '$product'";
        $query_go = mysqli_query($con, $query);

        if (mysqli_num_rows($query_go) == 1) {
            while ($rows = mysqli_fetch_array($query_go)) {
                $kind = $rows['kind'];
                $quantityStock = $rows['quantity'];
                $quantityResult = $quantityStock - $quantity;

                $queryq = "SELECT * FROM teams WHERE id = '$teamId'";
                $query_goo = mysqli_query($con, $queryq);

                while ($rows = mysqli_fetch_array($query_goo)) {
                    $teamName = $rows['name'];

                    $queryy = "UPDATE stock SET quantity = '$quantityResult' WHERE name = '$product'";
                    $query_run = mysqli_query($con, $queryy);

                    $queryyyy = "INSERT INTO seted_product_history (product_name,quantity,team_id,team_name,date) VALUES ('$product','$quantity','$teamId','$teamName','$date')";
                    $query_runnn = mysqli_query($con, $queryyyy);

                    $queryyy = "INSERT INTO set_product (product_name,kind,quantity,team_id,date,view) VALUES ('$product','$kind','$quantity','$teamId','$date','0')";
                    $query_runn = mysqli_query($con, $queryyy);

                    jsonResponseMain($query_runn, 'Продукта успешно е назначен', 'Неуспешно назначаване');
                }
            }
        } else {
            jsonResponse(500, 'Продукт с име ' . $product . ' не съществува');
        }
    }
}
