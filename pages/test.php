<!DOCTYPE html>
<html lang="en">
<?php
include '../action/dbconn.php';

date_default_timezone_set('Europe/Sofia');
$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="bg" class="overflow-x-hidden">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="../images/title.png" />
    <link rel="stylesheet" href="../css/app.css" />

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Администраторски панел</title>
    <style>
        .calendar-row {
            justify-content: flex-end;
        }

        .calendar-row:last-child {
            justify-content: flex-start;
        }
    </style>
</head>

<body>
    <div id="calendar-head" class="w-[35.1rem] flex ">

    </div>
    <div id="date-selector" class="w-[35.1rem]"></div>
    <button type="button" id="save">Запази</button>
    <div id="result"></div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="../js/ajax.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>

</body>

</html>