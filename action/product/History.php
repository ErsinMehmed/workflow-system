<?php
session_start();
date_default_timezone_set('Europe/Sofia');

include '../dbconn.php';

$productName = $_POST['productName'];
$searchKind = $_POST['searchKind'];
$date = $_POST['date'];

if ($productName != "") {
    if ($searchKind == 0) {
        $query = "SELECT * FROM seted_product_histories WHERE product_name LIKE '$productName%' AND date = '$date' AND status = 'go'";
    } else {
        $query = "SELECT * FROM seted_product_histories WHERE product_name LIKE '$productName%' AND date = '$date' AND status= 'back'";
    }

    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) {
?>
            <div class="w-full sm:w-[196px] h-[134px] rounded-md shadow-lg p-3 border border-slate-100 text-slate-700 space-y-1.5 animate__animated animate__fadeIn">
                <span class="text-lg font-bold">Екип <?= $rows["team_name"] ?></span>
                <div class="flex items-center">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                    </svg>
                    <span class="text-sm text-slate-500"><?= $rows["quantity"] ?> бр.</span>
                </div>
                <div class="flex items-center">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm text-slate-500"><?= date("d.m.Y", strtotime($rows['date'])) ?></span>
                </div>
                <div class="flex items-center">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5 text-slate-500 mr-1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                    <span class="text-sm text-slate-500"><?= $rows["product_name"] ?></span>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="w-full text-center font-semibold py-8 text-slate-700">Няма намерени данни</div>
<?php }
}
