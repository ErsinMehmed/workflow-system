<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include '../dbconn.php';

$teamId = $_POST['teamId'];
$date = date('Y-m-d');

$query = "SELECT * FROM orders WHERE team_id = '$teamId' AND date >= '$date'";
$query_run = mysqli_query($con, $query);

while ($rows = mysqli_fetch_array($query_run)) {
?>
    <div class="w-full sm:w-[228px] h-[132px] rounded-md shadow-lg p-3 border border-slate-100 text-slate-700 space-y-1.5">
        <span class="text-lg font-bold">Заявка номер <?= $rows["id"] ?></span>
        <div class="flex items-center">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
            </svg>
            <span class="text-sm text-slate-500"><?= $rows["status"] ?></span>
        </div>
        <div class="flex items-center">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            <span class="text-sm text-slate-500"><?= date("d.m.Y", strtotime($rows['date'])) ?></span>
        </div>
        <div class="flex items-center">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="text-sm text-slate-500"><?= $rows["customer_name"] ?></span>
        </div>
    </div>
<?php
}
