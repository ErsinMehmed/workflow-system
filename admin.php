<?php
session_start();
error_reporting(0);
date_default_timezone_set('Europe/Sofia');

include 'action/dbconn.php';

$admin = $_SESSION['admin'];
$date = date("Y-m-d"); ?>
<!DOCTYPE html>
<html lang="bg" class="overflow-x-hidden">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="images/title.png" />
    <link rel="stylesheet" href="css/app.css" />
    <link rel="stylesheet" href="css/alert.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Администраторски панел</title>
</head>

<body>
    <div id="load-dashboard" class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-slate-800 flex flex-col items-center justify-center">
        <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 md:w-10 md:h-10 2xl:w-14 2xl:h-14 mb-2 md:mr-1 text-gray-100 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
            </svg>
        </div>
        <h2 class="text-center text-gray-100 text-xl xl:text-2xl 2xl:text-3xl font-semibold">Зареждане...</h2>
    </div>

    <div id="app">
        <?php if ($admin) { ?>
            <div class="flex overflow-hidden">
                <Transition name="slide-fade">
                    <aside v-show="toggleSidebar" class="fixed z-20 h-full top-0 left-0 flex lg:flex flex-shrink-0 flex-col w-14 lg:w-64 transition-width duration-75" aria-label="Sidebar">
                        <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-[#222e3c] pt-0">
                            <div class="flex flex-col pt-5 pb-4 overflow-y-auto">
                                <div class="bg-[#222e3c]">
                                    <div class="lg:w-[66px] lg:h-[66px] text-center flex items-center justify-center rounded-full mb-2 lg:bg-blue-700 text-white font-bold text-3xl mx-auto">
                                        CS
                                    </div>
                                    <div class="hidden lg:block text-xl text-center font-bold text-white mb-5">
                                        Carpet Services
                                    </div>
                                    <ul class="pb-2 text-gray-400">
                                        <div class="hidden lg:block mb-1.5 ml-5 text-xs text-gray-100">
                                            Действия
                                        </div>
                                        <li @click="dashOwnerStatistic = true; dashOwnerAdmin = false; dashSectionOwner = 'Статистика'" :class="dashOwnerStatistic ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b] bg-opacity-50' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                            </svg>
                                            <span class="ml-2.5 hidden lg:block">Статистика</span>
                                        </li>
                                        <li @click="dashOwnerAdmin = true; dashOwnerStatistic = false; dashSectionOwner = 'Админи'" :class="dashOwnerAdmin ? 'text-white border-l-4 border-[#3b7ddd] bg-gradient-to-r from-[#3a4b5e] via-[#2f3c4b] to-[#2f3c4b]' : 'hover:text-gray-300'" class="text-base w-full flex items-center py-2.5 px-4 transition-all cursor-pointer mb-1">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                            <span class="ml-2.5 hidden lg:block">Админи</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>
                </Transition>
                <Transition name="fade">
                    <div id="main-section" :class="toggleSidebar ? 'ml-14 lg:ml-64' : 'ml-0'" class="h-screen w-full bg-gray-100 relative overflow-y-auto">
                        <nav class="bg-white border-b border-gray-200 w-full z-30 w-full">
                            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center justify-start">
                                        <button id="hamburger-btn" @click="toggleSidebar = !toggleSidebar" aria-expanded="true" aria-controls="sidebar" class="mr-2 text-gray-600 hover:text-gray-900 p-1.5 hover:bg-gray-100 rounded-md transition-all active:scale-90">
                                            <svg fill="none" viewBox="0 0 24 24" stroke-width="2.1" stroke="currentColor" class="w-7 h-7">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                            </svg>
                                        </button>
                                        <div class="text-slate-700 font-semibold text-xl">
                                            {{ dashSectionOwner }}
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="pl-4 pr-2 text-right text-xs font-semibold">
                                            <?php
                                            $query = "SELECT * FROM owners WHERE email = '$admin'";
                                            $execute = mysqli_query($con, $query);

                                            while ($roles = mysqli_fetch_array($execute)) { ?>
                                                <div class="text-slate-700"><?= $roles["name"] ?></div>
                                                <div class="text-slate-500"><?= $roles["position"] ?></div>
                                            <?php } ?>
                                        </div>
                                        <div>
                                            <span data-dropdown-toggle="profile-dropdown" data-dropdown-toggle="profile-dropdown" class="inline-flex mt-1.5 relative items-center active:scale-90 hover:opacity-75 transition-all cursor-pointer ">
                                                <img src="images/user.png" alt="user" class="w-8 h-8 rounded-full object-cover mr-4 shadow" />
                                            </span>
                                            <div id="profile-dropdown" class="hidden z-10 w-44 bg-white rounded shadow-xl border border-slate-100">
                                                <ul class="text-sm text-gray-700" aria-labelledby="dropdownDefault">
                                                    <li class="flex items-center py-2 px-4 hover:bg-gray-100 cursor-pointer active:scale-90 transition-all">
                                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-700 mr-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                                        </svg>
                                                        <span>Помощ</span>
                                                    </li>
                                                    <hr class="bg-gray-400 w-full" />
                                                    <li id="owner-logout" class="flex items-center py-2 px-4 hover:bg-gray-100 cursor-pointer active:scale-90 transition-all">
                                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-slate-700 mr-1">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                                        </svg>
                                                        <span>Изход</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>

                        <section v-show="dashOwnerStatistic">
                            <div class="py-5 px-4 space-y-5">
                                <div class="bg-white py-4 rounded-md shadow-lg border border-slate-100">
                                    <div class="w-full sm:flex items-center justify-end space-y-4 sm:space-y-0 sm:space-x-3 px-4 mb-3.5">
                                        <div class="flex space-x-4">
                                            <input type="date" id="filter-date-from" value="<?php echo date("Y-m-d", strtotime("-30 days")); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 w-48" />
                                            <input type="date" id="filter-date-to" value="<?php echo date("Y-m-d"); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-0 focus:border-gray-400 focus:outline-none block w-full p-2.5 w-48" />
                                        </div>
                                    </div>
                                    <div id="income-section" class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 px-4">
                                        <div class="bg-white shadow-md border border-slate-100 rounded-lg p-3 sm:p-4 xl:p-5">
                                            <?php
                                            $currOrdersQuery = "SELECT SUM(price) as current_sum_of_prices FROM orders WHERE date >= CURDATE() - INTERVAL 30 DAY AND status NOT IN ('Отказана', 'Изтекла')";
                                            $currOrdersResult = mysqli_query($con, $currOrdersQuery);
                                            $currOrders = mysqli_fetch_array($currOrdersResult);
                                            $currSumOfPrices = $currOrders['current_sum_of_prices'];

                                            $prevOrdersQuery = "SELECT SUM(price) as previous_sum_of_prices FROM orders WHERE date BETWEEN CURDATE() - INTERVAL 60 DAY AND CURDATE() - INTERVAL 30 DAY AND status NOT IN ('Отказана', 'Изтекла')";
                                            $prevOrdersResult = mysqli_query($con, $prevOrdersQuery);
                                            $prevOrders = mysqli_fetch_array($prevOrdersResult);
                                            $prevSumOfPrices = $prevOrders['previous_sum_of_prices'];

                                            $percentageChange = 0;
                                            if ($currSumOfPrices === 0) {
                                                $percentageChange = round((($prevSumOfPrices * 100)), 1);
                                            } else {
                                                $percentageChange = round((($currSumOfPrices - $prevSumOfPrices) / $currSumOfPrices * 100), 1);
                                            } ?>
                                            <div class="w-full flex items-center justify-between">
                                                <div class="flex-shrink-0">
                                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"><?= $currSumOfPrices ?>лв.</span>
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
                                                    <div data-tooltip-target="tooltip-money" data-tooltip-placement="bottom" class="text-emerald-500 font-semibold mt-0.5 flex items-center cursor-default">
                                                        <svg viewBox="0 0 24 24" fill="currentColor" class="mt-[3px] w-4 h-4 rotate-[-90deg] mr-0.5">
                                                            <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
                                                        </svg>
                                                        <?= $percentageChange ?>%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-white shadow-md border border-slate-100 rounded-lg p-3 sm:p-4 xl:p-5">
                                            <?php
                                            $currOrdersQuery = "SELECT SUM(total_price) as current_sum_of_prices FROM product_orders WHERE date >= (CURDATE() - INTERVAL 30 DAY)";
                                            $currOrdersResult = mysqli_query($con, $currOrdersQuery);
                                            $currOrders = mysqli_fetch_array($currOrdersResult);
                                            $currSumOfPrices = $currOrders['current_sum_of_prices'];

                                            $prevOrdersQuery = "SELECT SUM(total_price) as previous_sum_of_prices FROM product_orders WHERE date BETWEEN (CURDATE() - INTERVAL 60 DAY) AND (CURDATE() - INTERVAL 30 DAY)";
                                            $prevOrdersResult = mysqli_query($con, $prevOrdersQuery);
                                            $prevOrders = mysqli_fetch_array($prevOrdersResult);
                                            $prevSumOfPrices = $prevOrders['previous_sum_of_prices'];

                                            $percentageChange = 0;
                                            if ($currSumOfPrices === 0) {
                                                $percentageChange = round((($prevSumOfPrices * 100)), 1);
                                            } else {
                                                $percentageChange = round((($currSumOfPrices - $prevSumOfPrices) / $currSumOfPrices * 100), 1);
                                            } ?>
                                            <div class="w-full flex items-center justify-between">
                                                <div class="flex-shrink-0">
                                                    <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"><?= $currSumOfPrices ?>лв.</span>
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
                                                    <div class="text-emerald-500 font-semibold mt-0.5 flex items-center cursor-default" data-tooltip-target="tooltip-money" data-tooltip-placement="bottom">
                                                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mt-[3px] rotate-[-90deg] mr-0.5">
                                                            <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
                                                        </svg>
                                                        <?= $percentageChange ?>%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tooltip-money" role="tooltip" class="absolute z-10 w-[264px] text-center invisible inline-block px-3 py-2 text-sm text-slate-700 font-semibold bg-white border border-slate-100 rounded-lg shadow-md opacity-0 tooltip">
                                            Процентно увеличение или намаление спрямо миналия месец
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $query = "SELECT offer, COUNT(*) as count FROM orders WHERE date = CURDATE() AND status NOT IN ('Отказана', 'Изтекла') GROUP BY offer";
                                $execute = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_array($execute)) {
                                    if ($row["offer"] === 'Основна') {
                                        echo '<input type="hidden" id="first-offer" value="' . $row["count"] . '">';
                                    } else if ($row["offer"] === 'Премиум') {
                                        echo '<input type="hidden" id="second-offer" value="' . $row["count"] . '">';
                                    } else if ($row["offer"] === 'Вип') {
                                        echo '<input type="hidden" id="third-offer" value="' . $row["count"] . '">';
                                    }
                                } ?>

                                <div class="flex space-x-5">
                                    <div class="w-[340px] bg-white shadow-lg border border-slate-100 rounded-lg">
                                        <div class="p-3 border-b border-slate-200 text-slate-700 font-semibold text-[17px]">
                                            Поръчки по вид на оферта
                                        </div>
                                        <div class="w-[340px] h-64 py-7">
                                            <canvas id="offer-chart"></canvas>
                                        </div>
                                        <div class="p-4 border-t border-slate-200 text-slate-500 flex items-center justify-between">
                                            <div class="flex items-center text-slate-700 text-sm">
                                                <select id="select-period" class="bg-white border border-[#e1e5eb] text-[#495057] text-xs rounded focus:border-gray-300 block w-full p-1.5 px-2 w-36 cursor-pointer">
                                                    <option value="CURDATE()">Днес</option>
                                                    <option value="CURDATE() - INTERVAL 7 DAY">Последната седмица</option>
                                                    <option value="CURDATE() - INTERVAL 30 DAY">Последният месец</option>
                                                    <option value="CURDATE() - INTERVAL 365 DAY">Последната година</option>
                                                </select>
                                            </div>
                                            <div class="flex items-center text-slate-700 text-sm cursor-pointer group active:scale-95 transition-all">
                                                <span class="group-hover:text-slate-500 transition-all">Виж повече</span>
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-0.5 w-4 h-4 mt-0.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $query = "SELECT offer, COUNT(*) as total FROM orders WHERE date >= CURDATE() - INTERVAL 365 DAY AND status NOT IN ('Отказана', 'Изтекла') GROUP BY offer";
                                    $execute = mysqli_query($con, $query);
                                    $result = array();
                                    while ($row = mysqli_fetch_assoc($execute)) {
                                        $result[$row['offer']] = $row['total'];
                                    } ?>
                                    <input type="hidden" id="first-offer1" value="<?= isset($result['Основна']) ? $result['Основна'] : 0 ?>">
                                    <input type="hidden" id="second-offer1" value="<?= isset($result['Премиум']) ? $result['Премиум'] : 0 ?>">
                                    <input type="hidden" id="third-offer1" value="<?= isset($result['Вип']) ? $result['Вип'] : 0 ?>">

                                    <div class="w-full bg-white shadow-lg border border-slate-100 rounded-lg">
                                        <div class="p-3 border-b border-slate-200 text-slate-700 font-semibold text-[17px]">
                                            Разходи и приходи по месеци за тази година
                                        </div>
                                        <div class="flex items-center w-full h-[318px]">
                                            <div class="w-4/5 h-[300px] pl-2.5 pt-2">
                                                <canvas id="income-chart"></canvas>
                                            </div>
                                            <div data-tooltip-target="tooltip-profit" data-tooltip-placement="left" class="w-1/5 border-l h-full py-7 text-slate-700">
                                                <div class="text-center py-1.5 text-lg font-semibold">Печалба</div>
                                                <div class="w-28 h-28 rounded-full mx-auto border border-slate-100 shadow-lg flex items-center justify-center text-lg font-semibold">
                                                    <?php
                                                    $query = "SELECT SUM(price) as price_sum FROM orders WHERE date >= CURDATE() - INTERVAL 365 DAY AND status <> 'Отказана' AND status <> 'Изтекла'";
                                                    $execute = mysqli_query($con, $query);

                                                    while ($rows = mysqli_fetch_array($execute)) {
                                                        $income = $rows['price_sum'];
                                                        $query = "SELECT SUM(total_price) as price_summ FROM product_orders WHERE date >= CURDATE() - INTERVAL 365 DAY";
                                                        $execute = mysqli_query($con, $query);

                                                        while ($row = mysqli_fetch_array($execute)) {
                                                            $expenses = $row['price_summ'];
                                                            echo $income - $expenses . 'лв.';
                                                        }
                                                    }  ?>
                                                </div>
                                                <div class="flex justify-center mt-1.5">
                                                    <div>
                                                        <div class="flex items-center text-sm font-semibold px-1 space-x-1.5 py-1.5">
                                                            <div class="w-3.5 h-3.5 bg-blue-200 rounded-full shadow-md "></div>
                                                            <div class="w-[54%]">Основна</div>
                                                            <div id="starter-offer-percentage" class="w-[20%]"></div>
                                                        </div>
                                                        <div class="flex items-center text-sm font-semibold px-1 space-x-1.5 py-1.5">
                                                            <div class="w-3.5 h-3.5 bg-blue-300 rounded-full shadow-md "></div>
                                                            <div class="w-[54%]">Премиум</div>
                                                            <div id="medium-offer-percentage" class="w-[20%]"></div>
                                                        </div>
                                                        <div class="flex items-center text-sm font-semibold px-1 space-x-1.5 py-1.5">
                                                            <div class="w-3.5 h-3.5 bg-blue-400 rounded-full shadow-md"></div>
                                                            <div class="w-[54%]">Вип</div>
                                                            <div id="vip-offer-percentage" class="w-[20%]"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tooltip-profit" role="tooltip" class="absolute z-10 w-48 text-center invisible inline-block px-3 py-2 text-sm text-slate-700 font-semibold bg-white border border-slate-100 rounded-lg shadow-md opacity-0 tooltip">
                                                Печалба за изминалата година и процентна печалба по вид оферти
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </Transition>
            </div>
        <?php  } else { ?>
            <div class="fixed inset-0">
                <div class="h-full w-full flex justify-center items-center">
                    <div class="w-[30rem] relative h-auto">
                        <form id="owner-login-form" class="mt-6 mb-0 space-y-4 rounded-lg p-8 shadow-2xl text-slate-700">
                            <p class="text-xl text-center font-bold">Carpet Services</p>
                            <div>
                                <label for="email" class="ml-1 text-sm font-semibold">Имейл</label>
                                <div class="relative mt-1">
                                    <input id="email" type="email" name="email" class="w-full rounded-lg border border-slate-50 p-2.5 pr-12 text-sm shadow-sm focus:border-slate-100 focus:outline-none" placeholder="Въведи имейл" />
                                    <span class="absolute inset-y-0 right-4 inline-flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label for="password" class="ml-1 text-sm font-semibold">Парола</label>
                                <div class="relative mt-1">
                                    <input type="password" id="password" name="password" class="w-full rounded-lg border border-slate-50 p-2.5 pr-12 text-sm shadow-sm focus:border-slate-100 focus:outline-none" placeholder="Въведи парола" />
                                    <span class="absolute inset-y-0 right-4 inline-flex items-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="block w-full rounded-lg bg-blue-500 px-5 py-2.5 hover:bg-blue-600 transition-all text-sm font-semibold text-white active:scale-90">
                                Вход
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php
    $query = "SELECT 
    SUM(IF(MONTH(date) = 1, price, 0)) as jan_sum,
    SUM(IF(MONTH(date) = 2, price, 0)) as feb_sum, SUM(IF(MONTH(date) = 3, price, 0)) as mar_sum,
    SUM(IF(MONTH(date) = 4, price, 0)) as apr_sum, SUM(IF(MONTH(date) = 5, price, 0)) as may_sum,
    SUM(IF(MONTH(date) = 6, price, 0)) as jun_sum, SUM(IF(MONTH(date) = 7, price, 0)) as jul_sum,
    SUM(IF(MONTH(date) = 8, price, 0)) as aug_sum, SUM(IF(MONTH(date) = 9, price, 0)) as sep_sum,
    SUM(IF(MONTH(date) = 10, price, 0)) as oct_sum, SUM(IF(MONTH(date) = 11, price, 0)) as nov_sum,
    SUM(IF(MONTH(date) = 12, price, 0)) as dec_sum FROM orders WHERE YEAR(date) = 2023 AND status <> 'Отказана' AND status <> 'Изтекла'";

    $execute = mysqli_query($con, $query);
    $rows = mysqli_fetch_array($execute);

    $months = ['яну', 'фев', 'мар', 'апр', 'май', 'юни', 'юли', 'авг', 'сеп', 'окт', 'ное', 'дек'];
    $englishMonths = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];

    foreach ($months as $key => $month) {
        echo '<input type="hidden" id="' . strtolower($month) . '"  value="' . $rows[$englishMonths[$key] . '_sum'] . '">';
    }

    $query = "SELECT 
    SUM(IF(MONTH(date) = 1, total_price, 0)) as 1jan_sum,
    SUM(IF(MONTH(date) = 2, total_price, 0)) as 1feb_sum, SUM(IF(MONTH(date) = 3, total_price, 0)) as 1mar_sum,
    SUM(IF(MONTH(date) = 4, total_price, 0)) as 1apr_sum,SUM(IF(MONTH(date) = 5, total_price, 0)) as 1may_sum,
    SUM(IF(MONTH(date) = 6, total_price, 0)) as 1jun_sum, SUM(IF(MONTH(date) = 7, total_price, 0)) as 1jul_sum,
    SUM(IF(MONTH(date) = 8, total_price, 0)) as 1aug_sum, SUM(IF(MONTH(date) = 9, total_price, 0)) as 1sep_sum,
    SUM(IF(MONTH(date) = 10, total_price, 0)) as 1oct_sum, SUM(IF(MONTH(date) = 11, total_price, 0)) as 1nov_sum,
    SUM(IF(MONTH(date) = 12, total_price, 0)) as 1dec_sum FROM product_orders WHERE YEAR(date) = 2023";

    $execute = mysqli_query($con, $query);
    $rows = mysqli_fetch_array($execute);

    foreach ($months as $key => $month) {
        echo '<input type="hidden" id="1' . strtolower($month) . '"  value="' . $rows['1' . $englishMonths[$key] . '_sum'] . '">';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="js/main-vue.js"></script>
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/ownerChart.js"></script>
    <script src="loader/dashLoader.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
</body>

</html>