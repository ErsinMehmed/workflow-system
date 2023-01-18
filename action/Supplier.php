<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

// Get supplier data
if (isset($_GET['name'])) {
    $name = mysqli_real_escape_string($con, $_GET['name']);

    $query = "SELECT * FROM supplier WHERE name='$name'";
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
        jsonResponse(404, 'Доставчикът не е намерен');
    }
}
