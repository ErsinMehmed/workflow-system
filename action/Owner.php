<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

// Login
if (isset($_POST['owner_login'])) {

    $email = $_POST['email'];

    $query = "SELECT * FROM owners WHERE email='$email'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {

            if (password_verify($_POST['password'], $rows['password'])) {
                $_SESSION['admin'] = $email;

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
        $query = "SELECT * FROM admins WHERE email = '$email'";
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
    $password = password_hash($_POST['adminPassword'], PASSWORD_DEFAULT);
    $createPermission = $_POST['Добавяне'] ?: 0;
    $editPermission = $_POST['Редактиране'] ?: 0;
    $allPermission = $_POST['Всички'] ?: 0;
    $userView = $_POST['Персонал'] ?: 0;
    $nomenclatureView = $_POST['Номенклатури'] ?: 0;

    if (!$name) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        if (!$password) {
            $query = "UPDATE admins SET name='$name', phone='$phone', create_role='$createPermission', edit_role='$editPermission', full_role='$allPermission', personal_view='$userView', status='$status', nomenclature_view='$nomenclatureView' WHERE id='$id'";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Данните на ' . $name . ' са обновени', 'Данните не са обновени');
        } else {
            $query = "UPDATE admins SET name='$name', password='$password', phone='$phone', create_role='$createPermission', edit_role='$editPermission', full_role='$allPermission', personal_view='$userView', status='$status', nomenclature_view='$nomenclatureView' WHERE id='$id'";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Данните на ' . $name . ' са обновени', 'Данните не са обновени');
        }
    }
}

// Get orders offers data by period
if (isset($_POST['period'])) {

    $period = $_POST['period'];

    $query = "SELECT SUM(CASE WHEN offer = 'Основна' THEN 1 ELSE 0 END) AS first, SUM(CASE WHEN offer = 'Премиум' THEN 1 ELSE 0 END) AS second,
    SUM(CASE WHEN offer = 'Вип' THEN 1 ELSE 0 END) AS third FROM orders WHERE date ";

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

    $res = [
        'first' => $first,
        'second' => $second,
        'third' => $third,
    ];

    echo json_encode($res);
    return;
}

// Get admin data
if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM admins WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    $order = mysqli_fetch_array($query_run);

    $res = [
        'status' => 200,
        'data' => $order
    ];
    echo json_encode($res);
    return;
}
