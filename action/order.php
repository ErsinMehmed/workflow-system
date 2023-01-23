<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

if (isset($_POST['guest_order'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
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

    if (!$building || !$offer || !$time || !$payment || !$city || !$address || !$m2 || !$price || !$email) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $selQuery = "SELECT * FROM customer WHERE email = '$email'";
        $query = mysqli_query($con, $selQuery);

        if (mysqli_num_rows($query) == 0) {
            $query = "INSERT INTO orders (customer_name,address,room,m2,status,pay,price,date,offer,add_date,phone,view,time,city,customer_kind,information,email) VALUES ('$name','$address','$building','$m2','Назначи','$payment','$price','$date','$offer','$curDT','$phone','1','$time','$city','Гост','$information','$email')";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Успешно направена заявка', 'Неуспешно направена заявка');
        } else {
            jsonResponse(500, 'Въведеният имейл вече съществува');
        }
    }
}
