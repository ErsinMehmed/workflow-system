<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

// Login
if (isset($_POST['mobile_login'])) {

    $pid = $_POST['pid'];

    $query = "SELECT * FROM users WHERE pid='$pid'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {
            $userId = $rows['id'];

            if (password_verify($_POST['password'], $rows['password'])) {
                $_SESSION['pid'] = $pid;

                $queryy = "UPDATE teams SET status='Yes' WHERE (user1_id='$userId' OR user2_id='$userId') AND delete_team <> 'yes'";
                $query_runn = mysqli_query($con, $queryy);

                $res = [
                    'status' => 200,
                ];
                echo json_encode($res);
                return;
            } else {
                jsonResponse(500, 'Грешена парола');
            }
        }
    } else {
        jsonResponse(500, 'Грешен ПИД');
    }
}

// Logout
if (isset($_POST['action'])) {
    $pid = $_SESSION['pid'];
    $query = "SELECT * FROM users WHERE pid='$pid'";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
        $userId = $rows['id'];

        $queryy = "UPDATE teams SET status='No' WHERE (user1_id='$userId' OR user2_id='$userId') AND delete_team <> 'yes'";
        $query_runn = mysqli_query($con, $queryy);
    }
    unset($_SESSION['pid']);
    jsonResponse(200, 'Успешно излизане');
}

// Update password
if (isset($_POST['mobile_password_update'])) {

    $pid = $_SESSION['pid'];
    $newPassword = $_POST['newPassword'];
    $newPasswordRep = $_POST['passwordRep'];

    if (!$newPassword || !$newPasswordRep) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT * FROM users WHERE pid='$pid'";
        $query_run = mysqli_query($con, $query);

        while ($rows = mysqli_fetch_array($query_run)) {

            if (password_verify($_POST['oldPassword'], $rows['password'])) {
                if ($newPassword == $newPasswordRep) {
                    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

                    $queryy = "UPDATE users SET password='$newPassword' WHERE pid='$pid'";
                    $query_runn = mysqli_query($con, $queryy);

                    jsonResponseMain($query_runn, 'Паролата е обновена', 'Паролата не е обновена');
                } else {
                    jsonResponse(500, 'Паролите не съвпадат');
                }
            } else {
                jsonResponse(500, 'Старата паролата е грешна');
            }
        }
    }
}

$time = date('H:i:s');

// Update order status
if (isset($_POST['orderId'])) {

    $id = $_POST['orderId'];
    $ids = explode(" ", $id);

    $query = "SELECT * FROM orders WHERE team_id='$ids[1]' AND status = 'В процес'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) < 1) {
        $query = "UPDATE orders SET status = 'В процес', start_time='$time' WHERE id='$ids[0]'";
        $query_run = mysqli_query($con, $query);
        jsonResponseMain($query_run, 'Задачата е стартирана', 'Задачата не е стартирана');
    } else {
        jsonResponse(500, 'Можете да стартирате само 1 задача');
    }
}

// Cancel order
if (isset($_POST['mobile_cancel_order'])) {

    $id = $_POST['id'];
    $text = $_POST['text'];

    if (!$text) {
        jsonResponse(500, 'Попълнете полето');
    } else {
        $query = "UPDATE orders SET status = 'Отказана', cancel_reason = '$text' WHERE id='$id'";
        $query_run = mysqli_query($con, $query);
        jsonResponseMain($query_run, 'Задачата е отказана', 'Задачата не е отказана');
    }
}

// Order step update
if (isset($_POST['step'])) {

    $id = $_POST['id'];
    $step = $_POST['step'];

    $query = "UPDATE orders SET step = '$step' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);
    jsonResponseMain($query_run, 'Задачата е актуализиране', 'Задачата не е актуализиране');
}

// End order
if (isset($_POST['orderEndId'])) {

    $id = $_POST['orderEndId'];

    $query = "UPDATE orders SET status = 'Приключена', end_time = '$time' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);
    jsonResponseMain($query_run, 'Задачата е стартирана', 'Задачата не е стартирана');
}

// Remove product from warehouse
if (isset($_POST['productName'])) {
    $name = ($_POST['productName']);
    $teamId = ($_POST['teamId']);

    $query = "SELECT * FROM set_product WHERE quantity <> 0 AND product_name = '$name' AND team_id = '$teamId' GROUP BY product_name";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
        $quantity = $rows['quantity'];
        $id = $rows['id'];
        $finalQuantity = $quantity - 1;

        $query = "UPDATE set_product SET quantity = '$finalQuantity' WHERE id = '$id'";
        mysqli_query($con, $query);

        $queryy = "DELETE FROM set_product WHERE quantity = '0'";
        mysqli_query($con, $queryy);
    }
}

// Return all product from warehouse
if (isset($_POST['productNameReturn'])) {
    $name = ($_POST['productNameReturn']);
    $teamId = ($_POST['teamId']);
    $date = date('Y-m-d');

    $query = "SELECT sum(quantity) as quantity_sum FROM set_product WHERE product_name = '$name' AND team_id = '$teamId'";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
        $quantity = $rows['quantity_sum'];

        $query3 = "SELECT * FROM stock WHERE name = '$name'";
        $query_fulfill = mysqli_query($con, $query3);

        while ($rowss = mysqli_fetch_array($query_fulfill)) {
            $quantityStock = $rowss['quantity'];
            $finalSum = $quantity + $quantityStock;

            $query4 = "UPDATE stock SET quantity = '$finalSum' WHERE name = '$name'";
            $query_go = mysqli_query($con, $query4);

            $query5 = "DELETE FROM set_product WHERE product_name = '$name' AND team_id = '$teamId'";
            $query_goo = mysqli_query($con, $query5);

            $query = "SELECT * FROM teams WHERE id = '$teamId' AND delete_team <> 'yes'";
            $query_run = mysqli_query($con, $query);

            while ($row = mysqli_fetch_array($query_run)) {
                $teamName = $row['name'];

                $query6 = "INSERT INTO seted_product_history (product_name,quantity,team_id,team_name,date,status) VALUES ('$name','$quantity','$teamId','$teamName','$date','back')";
                $query_runn = mysqli_query($con, $query6);
            }
        }
    }
}

// Product request
if (isset($_POST['mobile_product_request'])) {

    $name = $_POST['product'];
    $quantity = $_POST['quantity'];
    $teamId = $_POST['teamId'];
    $date = date('Y-m-d H:i:s');


    if (!$name || !$quantity) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {

        $query = "INSERT INTO product_request (product_name,quantity,view,date,team_id) VALUES ('$name','$quantity','0','$date','$teamId')";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Успешно направена заявка', 'Неуспешно направена заявка');
    }
}
