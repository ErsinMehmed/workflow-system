<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';

$curDT = date('Y-m-d');

$query = "UPDATE orders SET status = 'Изтекла' WHERE date < '$curDT' AND status IN ('Назначи', 'Назначена', 'В процес')";
mysqli_query($con, $query);
