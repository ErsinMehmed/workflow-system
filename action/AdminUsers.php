<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

//Create user
if (isset($_POST['admin_user'])) {

    $name = $_POST['userName'];
    $egn = $_POST['userEgn'];
    $pid = $_POST['userPid'];
    $phone = $_POST['userPhone'];
    $position = $_POST['userPosition'];
    $dob = $_POST['user-dob'];
    $date = $_POST['userPickDate'];
    $address = $_POST['userAddress'];
    $filename = $_FILES['userImg']['name'];
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png");
    move_uploaded_file($_FILES["userImg"]["tmp_name"], '../uploaded-files/user-images/' . $filename);


    if ($name == NULL || $egn == NULL || $pid == NULL || $phone == NULL || $filename == NULL || $address == NULL) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        if (is_numeric($egn)) {
            $query = "INSERT INTO users (image,name,pid,address,date_in,status,position,egn,phone,dob) VALUES ('$filename','$name','$pid','$address','$date','1','$position','$egn','$phone','$dob')";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Успешно добавихте потребителя', 'Неуспешно добавяне на потребителя');
        } else {
            jsonResponse(500, 'Полето ЕГН трябва да съдържа само цифри');
        }
    }
}

//Get user data
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM users WHERE id='$id'";
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
