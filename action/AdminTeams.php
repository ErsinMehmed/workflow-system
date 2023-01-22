<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

// Create team
if (isset($_POST['admin_team'])) {

    $name = $_POST['teamName'];
    $user1 = $_POST['teamUser1'];
    $user2 = $_POST['teamUser2'];
    $pid1 = $_POST['teamUser1Pid'];
    $pid2 = $_POST['teamUser2Pid'];
    $id1 = $_POST['teamUser1Id'];
    $id2 = $_POST['teamUser2Id'];

    if (!$name || !$user1 || !$user2) {

        jsonResponse(500, 'Попълнете всички полета');
    } else {
        if ($pid1 != $pid2) {
            $selQuery = "SELECT * FROM teams WHERE name = '$name' AND delete_team <> 'yes'";
            $query = mysqli_query($con, $selQuery);

            if (mysqli_num_rows($query) == 0) {
                $query = "INSERT INTO teams (name,status,user1_name,user2_name,user1_id,user2_id,delete_team) VALUES ('$name','No','$user1','$user2','$id1','$id2','')";
                $query_run = mysqli_query($con, $query);

                jsonResponseMain($query_run, 'Успешно добавихте екип ' . $name . '', 'Неуспешно добавяне на екип');

                $query = "SELECT id FROM teams WHERE user1_name = '$user1' AND user2_name = '$user2' AND user1_id = '$id1' AND user2_id = '$id2'";
                $query_go = mysqli_query($con, $query);

                while ($rows = mysqli_fetch_array($query_go)) {
                    $teamID = $rows['id'];

                    $query = "UPDATE users SET team_id = '$teamID', team_name = '$name' WHERE id = '$id1' AND pid = '$pid1'";
                    $query_run = mysqli_query($con, $query);

                    $queryy = "UPDATE users SET team_id = '$teamID', team_name = '$name' WHERE id = '$id2' AND pid = '$pid2'";
                    $query_runn = mysqli_query($con, $queryy);
                }
            } else {
                jsonResponse(500, 'Въведеното име съществува');
            }
        } else {
            jsonResponse(500, 'Избрали сте един и същ потребител');
        }
    }
}

// Get team data
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM teams WHERE id='$id'";
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

// Delete team 
if (isset($_POST['admin_delete_team'])) {

    $id = $_POST['teamId'];
    $date = date('Y-m-d');

    $query = "SELECT * FROM orders WHERE team_id = '$id' AND date >= '$date'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 0) {
        $query = "UPDATE users SET team_id = '0', team_name = '' WHERE team_id = '$id'";
        $query_run = mysqli_query($con, $query);

        $queryy = "UPDATE teams SET delete_team = 'yes' WHERE id = '$id'";
        $query_runn = mysqli_query($con, $queryy);

        jsonResponseMain($query_run, 'Успешно изтриване', 'Неуспешно изтриване');
    } else {
        jsonResponse(500, 'Има настоящи назначени задачи на този екип');
    }
}
