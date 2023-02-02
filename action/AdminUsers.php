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
    uploadPhoto($filename, "userImg", '../uploaded-files/user-images/');

    if (!$name || !$egn || !$pid || !$phone || !$filename || !$address) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT * FROM users WHERE pid = '$pid'";
        $query_run = mysqli_query($con, $query);

        if (is_numeric($egn)) {
            if (preg_match('/^[0-9+\(\)\s-]+$/', $phone)) {
                if (mysqli_num_rows($query_run) == 0) {
                    $query = "INSERT INTO users (image,name,pid,address,in_date,status,team_id,position,egn,phone,dob,username) VALUES ('$filename','$name','$pid','$address','$date','1','0','$position','$egn','$phone','$dob','$pid')";
                    $query_run = mysqli_query($con, $query);

                    jsonResponseMain($query_run, 'Успешно добавихте потребителя', 'Неуспешно добавяне на потребителя');
                } else {
                    jsonResponse(500, 'Въведения ПИД вече съществува');
                }
            } else {
                jsonResponse(500, 'Телефонният номер може да съдържа само цифри, +, - и ()');
            }
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

//Update user information
if (isset($_POST['admin_update_user'])) {

    $id = $_POST['id'];
    $name = $_POST['userName'];
    $egn = $_POST['userEgn'];
    $dob = $_POST['userDob'];
    $phone = $_POST['userPhone'];
    $position = $_POST['userPosition'];
    $status = $_POST['userStatus'];
    $outDate = $_POST['userOutDate'];
    $address = $_POST['userAddress'];
    $filename = $_FILES['userImg']['name'];
    $date = date('Y-m-d');

    if ($status == 0) {
        $query = "SELECT * FROM set_orders WHERE (user1_id = '$id' OR user2_id = '$id') AND order_date >= '$date'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) == 0) {
            $queryy = "UPDATE teams SET delete_team='yes' WHERE user1_id = '$id' OR user2_id = '$id'";
            $query_runn = mysqli_query($con, $queryy);

            $query = "UPDATE users SET name='$name', egn='$egn', phone='$phone', address='$address', position='$position', status='$status', dob='$dob', out_date='$outDate' WHERE id='$id'";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Данните на ' . $name . ' са обновени', 'Данните не са обновени');
        } else {
            jsonResponse(500, 'Служителя има назначени задачи към текущия момент');
        }
    } else {
        if (!$name || !$egn || !$dob || !$phone || !$position || $status != NULL || !$address) {

            jsonResponse(500, 'Попълнете всички полета');
        } else {
            if (!$filename) {
                $query = "UPDATE users SET name='$name', egn='$egn', phone='$phone', address='$address', position='$position', status='$status', dob='$dob', out_date='$outDate' WHERE id='$id'";
            } else {
                uploadPhoto($filename, "userImg", '../uploaded-files/user-images/');
                $query = "UPDATE users SET image='$filename', name='$name', egn='$egn', phone='$phone', address='$address', position='$position', status='$status', dob='$dob' WHERE id='$id'";
            }

            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Данните на ' . $name . ' са обновени', 'Данните не са обновени');
        }
    }
}

//Update password
if (isset($_POST['admin_set_user_password'])) {

    $id = $_POST['userID'];
    $password = $_POST['userPassword'];
    $passwordRep = $_POST['userPassowrdRep'];

    if (!$password || !$passwordRep) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        if ($password == $passwordRep) {
            $password = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);

            $queryy = "UPDATE users SET password='$password' WHERE id='$id'";
            $query_runn = mysqli_query($con, $queryy);

            jsonResponseMain($query_runn, 'Паролата е обновена', 'Паролата не е обновена');
        } else {
            jsonResponse(500, 'Паролите не съвпадат');
        }
    }
}
