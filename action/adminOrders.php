<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);
$curDT = date('Y-m-d H:i:s');

// Create order
if (isset($_POST['admin_order'])) {

    $name = $_POST['customerName'];
    $phone = $_POST['customerPhone'];
    $email = $_POST['customerEmail'];
    $room = $_POST['room'];
    $offer = $_POST['offer'];
    $date = $_POST['pickDate'];
    $time = $_POST['time'];
    $payment = $_POST['payment'];
    $address = $_POST['address'];
    $information = $_POST['information'];
    $price = $_POST['customerPrice'];
    $m2 = $_POST['m2'];

    if (!$name || !$phone || !$address || !$m2 || !$email) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        if (is_numeric($m2)) {
            $selQuery = "SELECT * FROM customer WHERE email = '$email'";
            $query = mysqli_query($con, $selQuery);

            if (mysqli_num_rows($query) == 0) {
                $query = "INSERT INTO orders (customer_name,address,room,m2,status,pay,price,date,offer,add_date,phone,view,time,customer_kind,information,email,team_id) VALUES ('$name','$address','$room','$m2','Назначи','$payment','$price','$date','$offer','$curDT','$phone','1','$time','Админ','$information','$email','0')";
                $query_run = mysqli_query($con, $query);

                jsonResponseMain($query_run, 'Успешно направена заявка', 'Неуспешно направена заявка');
            } else {
                jsonResponse(500, 'Въведеният имейл вече свързан към профил');
            }
        } else {
            jsonResponse(500, 'Полето квадратура приема само числа');
        }
    }
}

// Get order data
if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM orders WHERE id='$id'";
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
        jsonResponse(404, 'Заявката не е намерена');
    }
}

// Update order data
if (isset($_POST['admin_order_update'])) {

    $id = $_POST['id'];
    $phone = $_POST['customerPhone'];
    $room = $_POST['room'];
    $offer = $_POST['offer'];
    $date = $_POST['pickDate'];
    $time = $_POST['time'];
    $payment = $_POST['payment'];
    $address = $_POST['address'];
    $information = $_POST['information'];
    $price = $_POST['customerPrice'];
    $m2 = $_POST['m2'];

    if (!$phone || !$address  || !$price || !$m2) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "UPDATE orders SET phone='$phone', room='$room', offer='$offer', date='$date', time='$time', pay='$payment', address='$address', information='$information', price='$price', m2='$m2' WHERE id='$id'";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Заявка номер ' . $id . ' е обновена', 'Заявката не е обновена');
    }
}

// Get customer information
if (isset($_GET['email'])) {

    $email = mysqli_real_escape_string($con, $_GET['email']);

    $query = "SELECT * FROM customer WHERE email='$email'";
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

// Set order of team
if (isset($_POST['admin_set_order'])) {

    $orderDate = $_POST['orderDate'];
    $teamID = ($_POST['teamId']);
    $orderID = ($_POST['orderId']);
    $user1 = ($_POST['userName1']);
    $user2 = ($_POST['userName2']);
    $userID1 = ($_POST['userID1']);
    $userID2 = ($_POST['userID2']);
    $teamName = ($_POST['teamName']);
    if (!$user1  || !$user2) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $queryy = "UPDATE orders SET team_id = '$teamID', status = 'Назначена' WHERE id='$orderID'";
        $query_runn = mysqli_query($con, $queryy);

        $query = "INSERT INTO set_order (team_id,order_id,user1,user2,user1_id,user2_id,team_name,date,view,order_date) VALUES ('$teamID','$orderID','$user1','$user2','$userID1','$userID2','$teamName','$curDT','1','$orderDate')";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Заявката е добавена на екип ' . $teamName, 'Заявката не е добавена на екип ' . $teamName);
    }
}

// Send invoice to customer
if (isset($_POST['orderIdInvoice'])) {

    $id = $_POST['orderIdInvoice'];

    $query = "UPDATE orders SET invoice_document = 'yes' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    jsonResponseMain($query_run, 'Фактурата е изпратена успешно', 'Фактурата не е изпратена');
}
