<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

if (isset($_POST['save_customer'])) {

    $firstName = $_POST['firstName'];
    $familyName = $_POST['familyName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $passwordRep = $_POST['passwordRep'];
    $fullName = $firstName . " " . $familyName;

    if ($firstName == NULL || $familyName == NULL || $email == NULL || $phone == NULL || $password == NULL || $passwordRep == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
        return;
    }

    $selQuery = "SELECT * FROM customer WHERE email = '$email'";
    $query = mysqli_query($con, $selQuery);

    if (mysqli_num_rows($query) == 0) {
        if ($password == $passwordRep) {
            $query = "INSERT INTO customer (name,email,password,phone) VALUES ('$fullName','$email','$password','$phone')";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Успешна регистрация', 'Неуспешна регистрация');
        } else {
            jsonResponse(430, 'Въведените пароли не съвпадат');
        }
    } else {
        jsonResponse(400, 'Въведеният имейл вече съществува');
    }
}

if (isset($_POST['login_info'])) {
    $email =  ($_POST['email']);
    $password = ($_POST['passowrdLogin']);

    $query = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $res = [
            'status' => 200,
            'userEmail' => $email,
        ];
        echo json_encode($res);
        return;
    } else {
        jsonResponse(500, 'Грешен имейл или парола');
    }
}

if (isset($_GET['email'])) {
    $email = mysqli_real_escape_string($con, $_GET['email']);

    echo $query = "SELECT * FROM customer WHERE email='$email'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Клиента е намерен',
            'data' => $order
        ];
        echo json_encode($res);
        return;
    }
}
