<?php
date_default_timezone_set('Europe/Sofia');

include '../dbconn.php';

$name = $_POST['supplierName'];

$query = "SELECT * FROM product_order WHERE supplier = '$name'";
$query_run = mysqli_query($con, $query);

while ($rows = mysqli_fetch_array($query_run)) {
?>
    <div class="w-full sm:w-[230px] h-[132px] rounded-md shadow-lg p-3 border border-slate-100 text-slate-700 space-y-1.5">
        <span class="text-lg font-bold">Заявка номер <?= $rows["id"] ?></span>
        <div class="flex items-center">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 21l5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 016-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 01-3.827-5.802" />
            </svg>
            <span class="text-sm text-slate-500"><?= $rows["name"] ?></span>
        </div>
        <div class="flex items-center">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
            <span class="text-sm text-slate-500"><?= $rows["quantity"] ?> бр.</span>
        </div>
        <div class="flex items-center">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
            </svg>
            <span class="text-sm text-slate-500"><?= date("d.m.Y", strtotime($rows['date'])) ?></span>
        </div>
    </div>
<?php
}
