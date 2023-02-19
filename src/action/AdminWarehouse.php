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

    if (!$name) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT name FROM stocks WHERE name = '$name'";
        $query_go = mysqli_query($con, $query);

        if (mysqli_num_rows($query_go) == 0) {
            $query = "INSERT INTO stocks (name,quantity,kind) VALUES ('$name','0','$kind')";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Успешно добавяне на продукта', 'Неуспешно добавяне на продукта');
        } else {
            jsonResponse(500, 'Този продукт вече съществува');
        }
    }
}

// Get product data by id
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM stocks WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);
        echo json_encode(['status' => 200, 'data' => $order]);
    } else {
        jsonResponse(404, 'Продукта не е');
    }
}


// Update product information
if (isset($_POST['admin_edit_product'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $kind = $_POST['kind'];

    if (!$name) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT name FROM stocks WHERE name = '$name'";
        $query_go = mysqli_query($con, $query);

        if (mysqli_num_rows($query_go) == 0) {
            $query = "UPDATE stocks SET name='$name', kind='$kind' WHERE id='$id'";
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

    $query = "DELETE FROM stocks WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    jsonResponseMain($query_run, 'Продукта е изтрит успешно', 'Продукта не е изтрит');
}

// Set product to team
if (isset($_POST['admin_set_product'])) {

    $teamId = $_POST['team'];
    $product = $_POST['name'];
    $quantity = $_POST['quantity'];
    $date = date('Y-m-d');

    if (!$product || !$quantity || !$teamId) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {

        if ($quantity != 0 && is_numeric($quantity)) {
            $query = "SELECT * FROM stocks WHERE name = '$product'";
            $query_go = mysqli_query($con, $query);

            if (mysqli_num_rows($query_go) == 1) {
                while ($rows = mysqli_fetch_array($query_go)) {
                    $kind = $rows['kind'];
                    $quantityStock = $rows['quantity'];

                    if ($quantityStock >= $quantity && $quantityStock != 0) {

                        $quantityResult = $quantityStock - $quantity;

                        $queryq = "SELECT * FROM teams WHERE id = '$teamId'";
                        $query_goo = mysqli_query($con, $queryq);

                        while ($rowss = mysqli_fetch_array($query_goo)) {
                            $teamName = $rowss['name'];

                            $queryy = "UPDATE stocks SET quantity = '$quantityResult' WHERE name = '$product'";
                            $query_run = mysqli_query($con, $queryy);

                            $queryyyy = "INSERT INTO seted_product_histories (product_name,quantity,team_id,team_name,date,status) VALUES ('$product','$quantity','$teamId','$teamName','$date','go')";
                            $query_runnn = mysqli_query($con, $queryyyy);

                            $queryyy = "INSERT INTO set_products (product_name,kind,quantity,team_id,team_name,date,view) VALUES ('$product','$kind','$quantity','$teamId','$teamName','$date','0')";
                            $query_runn = mysqli_query($con, $queryyy);

                            jsonResponseMain($query_runn, 'Продукта успешно е назначен', 'Неуспешно назначаване');
                        }
                    } else {
                        jsonResponse(500, 'Няма достатъчна наличност');
                    }
                }
            } else {
                jsonResponse(500, 'Продукт с име ' . $product . ' не съществува');
            }
        } else {
            jsonResponse(500, 'Въведете по-голямо количество от 0');
        }
    }
}
