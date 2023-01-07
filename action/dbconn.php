<?php

$con = mysqli_connect("localhost", "root", "123", "ersin");

if (!$con) {
    die('Неуспешно свързване' . mysqli_connect_error());
}
