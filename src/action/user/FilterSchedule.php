<?php
include '../dbconn.php';

$text = mysqli_real_escape_string($con, $_POST['text']);
$position = mysqli_real_escape_string($con, $_POST['position']);

if ($position == 'Всички') {
    $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND status != 0";
} else {
    $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND position = '$position' AND status != 0";
}

$execute = mysqli_query($con, $query);

if (mysqli_num_rows($execute) > 0) {
    while ($rows = mysqli_fetch_array($execute)) {
        $id = $rows["id"];

        $query = "SELECT * FROM user_schedules WHERE user_id = '$id'";
        $queryRun = mysqli_query($con, $query);

        while ($row = mysqli_fetch_array($queryRun)) { ?>
            <button id="set-user-id-work" value="<?= $rows["id"] . " " . $rows["name"] ?>" class="flex items-center w-full p-3.5 border-b border-slate-200 hover:bg-slate-50 transition-all user-box">
                <img src="uploaded-files/user-images/<?= $rows["image"] ?>" alt="<?= $rows["image"] ?>" class="w-[60px] h-[60px] rounded-full shadow-lg border object-cover" />
                <div class="ml-7 w-full">
                    <div class="text-slate-700 font-semibold text-left mb-[3px]"><?= $rows["name"] ?></div>
                    <div class="flex items-center text-sm text-gray-500 w-full">
                        <div class="flex items-center pr-3.5 border-r border-slate-200 w-1/4">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[18px] h-[18px] mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>Пид - <?= $rows["pid"] ?></div>
                        </div>
                        <div class="flex items-center pl-3.5 border-r border-slate-200 w-1/5">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[18px] h-[18px] mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                            </svg>
                            <div><?= $rows["position"] ?></div>
                        </div>
                        <div class="flex items-center pl-3.5 border-r border-slate-200 w-1/4">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-[18px] h-[18px] mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <div>Работни дни <?= (isset($row["days_count"]) && !is_null($row["days_count"])) ? $row["days_count"] : "0" ?></div>
                        </div>
                        <div class="flex items-center pl-3.5 w-2/6">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[18px] h-[18px] mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            <div>Дължима сума <?= ($rows["hourly_rate"] * 8) * $row["days_count"]  ?>лв.</div>
                        </div>
                    </div>
                </div>
            </button>
    <?php }
    }
} else { ?>
    <div class="w-full text-center py-8 font-semibold text-slate-700">Не са намерни данни</div>
<?php } ?>