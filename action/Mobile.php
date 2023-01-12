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

            if (password_verify($_POST['password'], $rows['password'])) {
                $_SESSION['pid'] = $pid;

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
    unset($_SESSION['pid']);
    jsonResponse(200, 'Успешно излизане');
}

// Update password
if (isset($_POST['mobile_password_update'])) {

    $pid = $_SESSION['pid'];
    $newPassword = $_POST['newPassword'];
    $newPasswordRep = $_POST['passwordRep'];

    if ($newPassword == NULL || $newPasswordRep == NULL) {
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

    if ($text == NULL) {
        jsonResponse(500, 'Попълнете полето');
    } else {
        $query = "UPDATE orders SET status = 'Отказана', cancel_reason = '$text' WHERE id='$id'";
        $query_run = mysqli_query($con, $query);
        jsonResponseMain($query_run, 'Задачата е отказана', 'Задачата не е отказана');
    }
}

// End order
if (isset($_POST['orderEndId'])) {

    $id = $_POST['orderEndId'];

    $query = "UPDATE orders SET status = 'Приключена', end_time = '$time' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);
    jsonResponseMain($query_run, 'Задачата е стартирана', 'Задачата не е стартирана');
}
