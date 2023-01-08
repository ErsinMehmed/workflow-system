<?php

$con = mysqli_connect("localhost", "root", "", "system");

if (!$con) {
    die('Неуспешно свързване' . mysqli_connect_error());
}
