<?php

function jsonResponseMain($query, $successMessage, $errorMessage)
{
    if ($query) {
        $res = [
            'status' => 200,
            'message' => $successMessage
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => $errorMessage
        ];
        echo json_encode($res);
        return;
    }
}

function jsonResponse($number, $message)
{
    $res = [
        'status' => $number,
        'message' => $message
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
