<?php

function jsonResponse($number, $message)
{
    $res = [
        'status' => $number,
        'message' => $message
    ];
    echo json_encode($res);
    return;
}

function jsonResponseMain($query, $successMessage, $errorMessage)
{
    $res = [
        'status' => $query ? 200 : 500,
        'message' => $query ? $successMessage : $errorMessage
    ];
    echo json_encode($res);
    return;
}

function jsonResponseMain2($query, $query2, $successMessage, $errorMessage)
{
    $res = [
        'status' => ($query && $query2) ? 200 : 500,
        'message' => ($query && $query2) ? $successMessage : $errorMessage
    ];
    echo json_encode($res);
    return;
}

function uploadPhoto($filename, $imgName, $path)
{
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png");
    move_uploaded_file($_FILES[$imgName]["tmp_name"], $path . $filename);
}

function sendVerificationEmail($mail, $email, $fullName, $title, $body)
{
    $mail->setFrom("carpetserv@gmail.com", "Carpet Services");
    $mail->addAddress($email, $fullName);

    $mail->Subject = $title;
    $mail->Body = $body;

    $mail->send();
}

function generatePassword()
{
    $length = rand(8, 14);
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr(str_shuffle($chars), 0, $length);
    return $password;
}
