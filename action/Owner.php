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
