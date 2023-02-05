<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

// Login
if (isset($_POST['dashboard_login'])) {

    $email = $_POST['email'];

    $query = "SELECT * FROM admins WHERE email='$email' AND status <> 0";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {

            if (password_verify($_POST['password'], $rows['password'])) {
                $_SESSION['adminEmail'] = $email;

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
        jsonResponse(500, 'Грешен имейл');
    }
}

// Logout
if (isset($_POST['action'])) {
    unset($_SESSION['adminEmail']);
    jsonResponse(200, 'Успешно излизане');
}

// Update password
if (isset($_POST['admin_update_data'])) {

    $email = $_SESSION['adminEmail'];
    $phone = $_POST['phone'];
    $newPassword = $_POST['newPassword'];
    $newPasswordRep = $_POST['passwordRep'];

    if (!$newPassword || !$newPasswordRep || !$phone) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT * FROM admins WHERE email='$email'";
        $query_run = mysqli_query($con, $query);

        while ($rows = mysqli_fetch_array($query_run)) {

            if (password_verify($_POST['oldPassword'], $rows['password'])) {
                if ($newPassword == $newPasswordRep) {
                    $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);

                    $queryy = "UPDATE admins SET password='$newPassword', phone = '$phone' WHERE email='$email'";
                    $query_runn = mysqli_query($con, $queryy);

                    jsonResponseMain($query_runn, 'Данните са обновени', 'Данните не са обновени');
                } else {
                    jsonResponse(500, 'Паролите не съвпадат');
                }
            } else {
                jsonResponse(500, 'Старата паролата е грешна');
            }
        }
    }
}

// Upload photo
if (isset($_POST['admin_photo'])) {

    $email = $_SESSION['adminEmail'];
    $filename = $_FILES['photo']['name'];
    uploadPhoto($filename, "photo", '../uploaded-files/admin-images/');
    $filesize = $_FILES['photo']['size'];
    $filesize = number_format($filesize / 1048576, 2);

    if ($filesize < 2) {
        $query = "UPDATE admins SET image='$filename' WHERE email='$email'";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Профилната снимка е обновена', 'Снимката не е обновена');
    } else {
        jsonResponse(500, 'Снимката, която се опитвате да добавите е по-голяма от 2MB');
    }
}
