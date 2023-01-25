<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

// Create supplier
if (isset($_POST['admin_supplier'])) {

    $name = $_POST['supplierName'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $iban = $_POST['iban'];

    if (!$name || !$phone || !$address || !$iban) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "SELECT name FROM supplier WHERE name = '$name'";
        $query_go = mysqli_query($con, $query);

        if (mysqli_num_rows($query_go) == 0) {
            $query = "INSERT INTO supplier (name,phone,address,iban) VALUES ('$name','$phone','$address','$iban')";
            $query_run = mysqli_query($con, $query);

            jsonResponseMain($query_run, 'Успешно добавихте доставчика', 'Неуспешно добавяне доставчика');
        } else {
            jsonResponse(500, 'Този доставчик вече съществува');
        }
    }
}

// Update supplier data
if (isset($_POST['admin_edit_supplier'])) {

    $id = $_POST['id'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $iban = $_POST['iban'];

    if (!$phone || !$address || !$iban) {
        jsonResponse(500, 'Попълнете всички полета');
    } else {
        $query = "UPDATE supplier SET phone = '$phone', address = '$address', iban = '$iban' WHERE id = '$id'";
        $query_run = mysqli_query($con, $query);

        jsonResponseMain($query_run, 'Успешно редактирахте доставчика', 'Неуспешно редактирахте доставчика');
    }
}

// Get supplier data by id
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

// Get supplier data by name
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM supplier WHERE id='$id'";
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

// Delete supplier 
if (isset($_POST['admin_delete_supplier'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM supplier WHERE id = '$id'";
    $query_run = mysqli_query($con, $query);

    jsonResponseMain($query_run, 'Успешно изтриване', 'Неуспешно изтриване');
}
