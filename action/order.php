<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

if (isset($_POST['guest_order'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $building = $_POST['building'];
    $offer = $_POST['offer'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $payment = $_POST['payment'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $information = $_POST['information'];
    $price = $_POST['price'];
    $m2 = $_POST['m2'];
    $curDT = date('Y-m-d H:i:s');

    if ($building == NULL || $offer == NULL || $time == NULL || $payment == NULL || $city == NULL || $address == NULL || $m2 == NULL || $price == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO orders (customer_name,address,room,m2,status,pay,price,date,offer,add_date,phone,view,time,city,customer_kind,information) VALUES ('$name','$address','$building','$m2','Назначи','$payment','$price','$date','$offer','$curDT','$phone','1','$time','$city','Гост','$information')";
    $query_run = mysqli_query($con, $query);

    jsonResponseMain($query_run, 'Успешно направена заявка', 'Неуспешно направена заявка');
}
