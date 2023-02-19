<?php
session_start();
date_default_timezone_set('Europe/Sofia');
error_reporting(E_ERROR | E_PARSE);

include '../dbconn.php';
include '../function.php';

$pid = $_SESSION['pid'];

if (isset($_POST['text'])) {

    $text = mysqli_real_escape_string($con, $_POST['text']);
    $sort = mysqli_real_escape_string($con, $_POST['orderBy']);
    $date_now = date("Y-m-d");

    $query = "SELECT pid, team_id FROM users WHERE pid = '$pid'";
    $query_run = mysqli_query($con, $query);


    while ($rows = mysqli_fetch_array($query_run)) {
        $teamID = $rows['team_id'];

        $query = "SELECT * FROM orders WHERE team_id = '$teamID' AND status IN ('Приключена', 'Отказана') AND $sort LIKE '$text%' AND date = '$date_now'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) { ?>
                <button class="w-full focus:outline-none mt-4 get-order-data" type="button" value="<?= $rows['id'] ?>">
                    <div class="flex items-center justify-between w-full rounded border border-slate-100 shadow-lg p-3 cursor-pointer active:scale-95 transition-all">
                        <div class="flex items-center w-full">
                            <div class="h-10 w-10 bg-blue-300 shadow-lg rounded-full flex items-center justify-center">
                                <?php if ($rows['room'] == 'Къща') { ?>
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-100">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                <?php } else if ($rows['room'] == 'Офис') { ?>
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-100">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                                    </svg>
                                <?php } else if ($rows['room'] == 'Салон') { ?>
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-100">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                    </svg>
                                <?php } ?>
                            </div>
                            <div class="text-slate-700 space-y-[1px] w-3/12 ml-5">
                                <div class="text-left uppercase font-bold text-sm">Почистване на: <?= $rows['room'] ?></div>
                                <div class="flex items-center text-sm">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Клиент: <span class="font-semibold"><?= $rows['customer_name'] ?></span></span>
                                </div>
                            </div>
                            <div class="text-slate-700 space-y-[1px] w-3/12">
                                <div class="flex items-center text-sm">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                    </svg>
                                    <span>Заявка номер: <span class="font-semibold"><?= $rows['id'] ?></span></span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Час: <span class="font-semibold"><?= $rows['time'] ?></span></span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                    <span>Дата: <span class="font-semibold"><?= date("d.m.Y", strtotime($rows['date'])) ?></span></span>
                                </div>
                            </div>
                            <div class="text-slate-700 space-y-[1px] w-1/5">
                                <div class="text-sm text-center">Начин на плащане</div>
                                <div class="text-sm text-center"><b><?= $rows['pay'] ?></b></div>
                            </div>
                            <div class="w-3/12 flex justify-center mr-5">
                                <div class="text-<?= $rows['status'] == "Приключена" ? "green-400" : "red-400" ?> border border-<?= $rows['status'] == "Приключена" ? "green-400" : "red-400" ?> py-1.5 px-3.5 text-sm font-semibold rounded-full ml-20 w-fit"><?= $rows['status'] ?></div>
                            </div>
                        </div>
                        <div>
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-10 h-10 text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    </div>
                </button>
            <?php }
        } else { ?>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-lg font-semibold text-slate-700">Няма приключени задачи</div>
<?php
        }
    }
}
