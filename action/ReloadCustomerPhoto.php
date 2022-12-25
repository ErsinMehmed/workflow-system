<?php
include 'dbconn.php';

if (isset($_POST['userEmail'])) {
    $email =  ($_POST['userEmail']);

    $selQuery = "SELECT * FROM customer WHERE email = '$email'";
    $query_run = mysqli_query($con, $selQuery);

    while ($rows = mysqli_fetch_array($query_run)) {
        die("../action/customer-images/" . $rows['image']);
    }
}
