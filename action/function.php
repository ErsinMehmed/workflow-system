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
