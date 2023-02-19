<?php
date_default_timezone_set('Europe/Sofia');

include '../dbconn.php';

$dateFrom = mysqli_real_escape_string($con, $_POST['dateFrom']);
$dateTo = mysqli_real_escape_string($con, $_POST['dateTo']); ?>

<div class="bg-white shadow-md border border-slate-100 rounded-lg p-3 sm:p-4 xl:p-5">
    <?php
    $query = "SELECT SUM(price) as price_sum FROM orders WHERE date BETWEEN '$dateFrom' AND '$dateTo' AND status NOT IN ('Отказана', 'Изтекла')";
    $execute = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($execute)) { ?>
        <div class="w-full flex items-center justify-between">
            <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                    <?= $rows['price_sum'] ?: 0 ?>лв.
                </span>
                <h3 class="text-base font-normal text-gray-500">
                    Приходи за посоченият период
                </h3>
            </div>
            <div>
                <div class="w-12 h-12 mx-auto rounded-full bg-[#10b981] shadow-md flex items-center justify-center">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>
                </div>
            </div>
        <?php } ?>
        </div>
</div>

<div class="bg-white shadow-md border border-slate-100 rounded-lg p-3 sm:p-4 xl:p-5">
    <?php
    $query = "SELECT SUM(total_price) as price_sum FROM product_orders WHERE date BETWEEN '$dateFrom' AND '$dateTo'";
    $execute = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($execute)) { ?>
        <div class="w-full flex items-center justify-between">
            <div class="flex-shrink-0">
                <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">
                    <?= $rows['price_sum'] ?: 0 ?>лв.
                </span>
                <h3 class="text-base font-normal text-gray-500">
                    Разходи за посоченият период
                </h3>
            </div>
            <div>
                <div class="w-12 h-12 mx-auto rounded-full bg-red-500 shadow-md flex items-center justify-center">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                </div>
            </div>
        </div>
    <?php } ?>
</div>