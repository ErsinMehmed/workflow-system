<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

//Create profile
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

//Login
if (isset($_POST['login_info'])) {
    $email =  ($_POST['email']);
    $password = ($_POST['passowrdLogin']);

    $query = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $_SESSION['email'] = $email;

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

//Update customer information
if (isset($_POST['update_customer'])) {
    $userEmail = $_POST['userEmail'];
    $username = $_POST['username'];
    $phone = $_POST['phoneAccount'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    if ($username == NULL || $phone == NULL || $address == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
    } else {
        $query = "UPDATE customer SET username='$username', phone='$phone', city='$city', address='$address' WHERE email='$userEmail'";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Данните са обновени', 'Данните не са обновени');
    }
}

//Upload photo
if (isset($_POST['update_customer_image'])) {
    $userEmail = $_POST['customerEmail'];
    $filename = $_FILES['customerImage']['name'];
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png");
    move_uploaded_file($_FILES["customerImage"]["tmp_name"], 'customer-images/' . $filename);


    if ($filename == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Не сте избрали снимка'
        ];
        echo json_encode($res);
    } else {
        $query = "UPDATE customer SET image='$filename' WHERE email='$userEmail'";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Снимката е добавена', 'Снимката не е добавена');
    }
}

//Update password
if (isset($_POST['update_customer_password'])) {
    $userEmail = $_POST['customerEmail'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $newPasswordRep = $_POST['newPasswordRep'];

    if ($oldPassword == NULL || $newPassword == NULL || $newPasswordRep == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Попълнете всички полета'
        ];
        echo json_encode($res);
    } else {

        $query = "SELECT * FROM customer WHERE email='$userEmail' AND password='$oldPassword'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) == 1) {
            if ($newPassword == $newPasswordRep) {
                $queryy = "UPDATE customer SET password='$newPassword' WHERE email='$userEmail'";
                $query_runn = mysqli_query($con, $queryy);

                jsonResponseMain($query_runn, 'Паролата е обновена', 'Паролата не е обновена');
            } else {
                jsonResponse(430, 'Паролите не съвпадат');
            }
        } else {
            jsonResponse(510, 'Паролата е грешна');
        }
    }
}

//Log out
if (isset($_POST['action'])) {
    unset($_SESSION['email']);
    jsonResponse(200, 'Успешно излизане');
}
