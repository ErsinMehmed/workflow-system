<?php
include 'dbconn.php';

date_default_timezone_set('Europe/Sofia');

if (isset($_POST['dates'])) {
    $workDays = $_POST['dates'];
    $daysCount = $_POST['daysCount'];
    $userId = $_POST['userId'];
    $currentMonth = $_POST['currentMonth'];

    $query = "SELECT * FROM user_schedules WHERE user_id='$userId'";
    $execute = mysqli_query($con, $query);

    if (mysqli_num_rows($execute) > 0) {
        $query = "UPDATE user_schedules SET work_days = '$workDays', days_count = '$daysCount', current_month = '$currentMonth' WHERE user_id = '$userId'";
    } else {
        $query = "INSERT INTO user_schedules (work_days, days_count, user_id, current_month) VALUES ('$workDays', '$daysCount', '$userId','$currentMonth')";
    }

    mysqli_query($con, $query);
}

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM user_schedules WHERE user_id='$id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $order = mysqli_fetch_array($query_run);
        echo json_encode(['data' => $order]);
    }
}


if (isset($_POST['state'])) {

    $id = $_POST['questionId'];
    $role = $_POST['role'];
    $state = $_POST['state'];
    $curDT = date('Y-m-d H:i:s');

    if ($role == "Admin") {
        $query = "UPDATE user_questions SET admin_approval = '$state', admin_approval_date = '$curDT' WHERE id = '$id'";
        mysqli_query($con, $query);
    }
}
