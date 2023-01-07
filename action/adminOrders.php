<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

//Create order
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
    $curDT = date('Y-m-d H:i:s');

    if ($name == NULL || $phone == NULL || $address == NULL || $m2 == NULL || $email == NULL) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        if (is_numeric($m2)) {
            $selQuery = "SELECT * FROM customer WHERE email = '$email'";
            $query = mysqli_query($con, $selQuery);

            if (mysqli_num_rows($query) == 0) {
                $query = "INSERT INTO orders (customer_name,address,room,m2,status,pay,price,date,offer,add_date,phone,view,time,customer_kind,information,email) VALUES ('$name','$address','$room','$m2','Назначи','$payment','$price','$date','$offer','$curDT','$phone','1','$time','Админ','$information','$email')";
                $query_run = mysqli_query($con, $query);

                jsonResponseMain($query_run, 'Успешно направена заявка', 'Неуспешно направена заявка');
            } else {
                jsonResponse(500, 'Въведеният имейл вече съществува');
            }
        } else {
            jsonResponse(500, 'Полето квадратура приема само числа');
        }
    }
}

//Get order data
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

//Update order data
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

    if ($phone == NULL || $address == NULL || $price == NULL || $m2 == NULL) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "UPDATE orders SET phone='$phone', room='$room', offer='$offer', date='$date', time='$time', pay='$payment', address='$address', information='$information', price='$price', m2='$m2' WHERE id='$id'";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Данните са обновени', 'Данните не са обновени');
    }
}

//Get customer information
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
