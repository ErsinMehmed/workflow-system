<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

// Login
if (isset($_POST['owner_login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM owners WHERE email=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);

    if (!empty($row) && password_verify($password, $row['password'])) {
        $_SESSION['admin'] = $email;
        echo json_encode(['status' => 200]);
    } else {
        jsonResponse(500, 'Грешен имейл или парола');
    }
}

// Logout
if (isset($_POST['action'])) {
    unset($_SESSION['admin']);
    jsonResponse(200, 'Успешно излизане');
}

// Create admin
if (isset($_POST['owner_admin'])) {

    $name = $_POST['adminName'];
    $email = $_POST['adminEmail'];
    $phone = $_POST['adminPhone'];
    $password = password_hash($_POST['adminPassword'], PASSWORD_DEFAULT);
    $createPermission = $_POST['Добавяне'] ?: 0;
    $editPermission = $_POST['Редактиране'] ?: 0;
    $allPermission = $_POST['Всички'] ?: 0;
    $userView = $_POST['Персонал'] ?: 0;
    $nomenclatureView = $_POST['Номенклатури'] ?: 0;
    $filename = $_FILES['adminImg']['name'];
    uploadPhoto($filename, "adminImg", '../uploaded-files/admin-images/');

    if (!$name || !$email || !$password) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT email FROM admins WHERE email = '$email' AND status != 0";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) == 0) {
            $query = "INSERT INTO admins (name,email,password,phone,image,create_role,edit_role,full_role,personal_view,nomenclature_view,position,status) VALUES ('$name','$email','$password','$phone','$filename','$createPermission','$editPermission','$allPermission','$userView','$nomenclatureView','Админ','1')";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Успешно добавихте администратора', 'Неуспешно добавяне на администратора');
        } else {
            jsonResponse(500, 'Въведения имейл вече съществува');
        }
    }
}

// Update admin information
if (isset($_POST['owner_update_admin'])) {
    $id = $_POST['adminId'];
    $name = $_POST['adminName'];
    $phone = $_POST['adminPhone'];
    $status = $_POST['adminStatus'];
    $createPermission = $_POST['Добавяне'] ?: 0;
    $editPermission = $_POST['Редактиране'] ?: 0;
    $allPermission = $_POST['Всички'] ?: 0;
    $userView = $_POST['Персонал'] ?: 0;
    $nomenclatureView = $_POST['Номенклатури'] ?: 0;

    if (!$name) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $updateAdminQuery = "UPDATE admins SET name=?, phone=?, create_role=?, edit_role=?, full_role=?, personal_view=?, status=?, nomenclature_view=? WHERE id=?";
        $stmt = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stmt, $updateAdminQuery)) {
            mysqli_stmt_bind_param($stmt, 'ssiiiiisi', $name, $phone, $createPermission, $editPermission, $allPermission, $userView, $status, $nomenclatureView, $id);

            if (mysqli_stmt_execute($stmt)) {
                jsonResponse(200, 'Данните на ' . $name . ' са обновени');
            } else {
                jsonResponse(500, 'Данните не са обновени');
            }
        }
    }
}

// Update target value
if (isset($_POST['owner_change_target'])) {
    $email = $_POST['ownerEmail'];
    $target = $_POST['ownerTarget'];

    if (!$target) {
        jsonResponse(500, 'Попълнете пoлето за стойност');
    } else {
        $query = "UPDATE owners SET target_incomes = '$target' WHERE email = '$email'";
        $query_run = mysqli_query($con, $query);
        jsonResponseMain($query_run, '', '');
    }
}

// Get orders offers data by period
if (isset($_POST['period'])) {

    $period = $_POST['period'];

    $query = "SELECT SUM(CASE WHEN offer = 'Основна' THEN 1 ELSE 0 END) AS first, SUM(CASE WHEN offer = 'Премиум' THEN 1 ELSE 0 END) AS second,
    SUM(CASE WHEN offer = 'Вип' THEN 1 ELSE 0 END) AS third FROM orders WHERE date";

    if ($period == "CURDATE()") {
        $query .= "= $period AND status NOT IN ('Отказана', 'Изтекла')";
    } else {
        $query .= ">= $period AND status NOT IN ('Отказана', 'Изтекла')";
    }

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $first = $row['first'];
    $second = $row['second'];
    $third = $row['third'];

    echo json_encode(['first' => $first, 'second' => $second, 'third' => $third]);
    return;
}

// Get orders offers data by period
if (isset($_POST['payPeriod'])) {

    $period = $_POST['payPeriod'];

    $query = "SELECT SUM(CASE WHEN pay = 'В брой' THEN 1 ELSE 0 END) AS cash, SUM(CASE WHEN pay = 'С карта' THEN 1 ELSE 0 END) AS card FROM orders WHERE date";

    if ($period == "CURDATE()") {
        $query .= "= $period AND status NOT IN ('Отказана', 'Изтекла')";
    } else {
        $query .= ">= $period AND status NOT IN ('Отказана', 'Изтекла')";
    }

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $cash = $row['cash'];
    $card = $row['card'];

    echo json_encode(['cash' => $cash, 'card' => $card]);
    return;
}

// Get admin data
if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM admins WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    $order = mysqli_fetch_array($query_run);
    echo json_encode(['status' => 200, 'data' => $order]);
    return;
}

// Reject the question
if (isset($_POST['questionId'])) {

    $id = $_POST['questionId'];
    $state = $_POST['state'];

    $query = "UPDATE user_questions SET owner_approval='$state' WHERE id = '$id'";
    $query_run = mysqli_query($con, $query);

    jsonResponseMain($query_run, 'Успешно разгледахте въпроса', '');
}
