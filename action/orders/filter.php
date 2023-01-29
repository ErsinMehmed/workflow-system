<?php
include '../dbconn.php';

session_start();
date_default_timezone_set('Europe/Sofia');

$adminEmail = $_SESSION['adminEmail'];
$curDate = date("Y-m-d");
$date = $_POST['date'];
$text = $_POST['text'];

$query = "SELECT * FROM orders WHERE date = '$date' AND (customer_name LIKE '$text%' OR id LIKE '$text%')";
$query_run = mysqli_query($con, $query); ?>
<thead>
    <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
        <th class="px-4 py-3">номер</th>
        <th class="px-4 py-3">име на клиент</th>
        <th class="px-4 py-3">помещение</th>
        <th class="px-4 py-3">оферта</th>
        <th class="px-4 py-3">статус</th>
        <th class="px-4 py-3">квадратура</th>
        <th class="px-4 py-3">цена</th>
        <th class="px-4 py-3">фактура</th>
        <th class="px-4 py-3">дата</th>
        <th class="px-4 py-3">действия</th>
    </tr>
</thead>
<?php
if (mysqli_num_rows($query_run) > 0) {
    while ($rows = mysqli_fetch_array($query_run)) { ?>
        <tbody class="animate__animated animate__slideInUp animate__faster">
            <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                <td class="px-4 py-5 text-center"><?= $rows["id"] ?></td>
                <td class="px-4 py-5 text-center">
                    <button type="button" value="<?= $rows["email"] ?>" class="text-gray-900 whitespace-no-wrap hover:underline cursor-pointer transition-all show-customer">
                        <?= $rows["customer_name"] ?>
                    </button>
                </td>
                <td class="px-4 py-5 text-center"><?= $rows["room"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["offer"] ?></td>
                <td class="px-4 py-5 text-center">
                    <?php if ($rows["status"] == 'Назначи') { ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php } else if ($rows["status"] == 'Назначена') { ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-indigo-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-indigo-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php } else if ($rows["status"] == 'В процес') { ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php } else if ($rows["status"] == 'Приключена') { ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php } else if ($rows["status"] == 'Отказана') { ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php } else if ($rows["status"] == 'Изтекла') { ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-gray-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-gray-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php } ?>
                </td>
                <td class="px-4 py-5 text-center"><?= $rows["m2"] . " m2" ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["price"] . " лв." ?></td>
                <td class="px-4 py-5 text-center">
                    <?php if ($rows["invoice"] == "Да") { ?>
                        <span class="w-8 h-8 rounded-full bg-green-200 flex items-center justify-center mx-auto">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </span>
                    <?php
                    } else { ?>
                        <span class="w-8 h-8 rounded-full bg-red-200 flex items-center justify-center mx-auto">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    <?php } ?>
                </td>
                <td class="px-4 py-5 text-center"><?= date("d.m.Y", strtotime($rows['date'])) ?></td>
                <td class="px-4 py-5 flex items-center justify-center space-x-2">
                    <?php
                    $query = "SELECT * FROM admins WHERE email = '$adminEmail'";
                    $execute = mysqli_query($con, $query);

                    while ($roles = mysqli_fetch_array($execute)) {
                        if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) {
                            if ($curDate <= $rows['date'] && $rows["status"] == "Назначи") { ?>
                                <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-order">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                </button>
                            <?php } ?>
                            <button value="<?= $rows["id"] ?>" type="button" class="bg-green-500 hover:bg-green-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 set-order">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                    <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                                </svg>
                            </button>
                            <?php if ($rows["status"] == "Приключена" && $rows["invoice_document"] == "") { ?>
                                <button value="<?= $rows["id"] ?>" type="button" class="bg-amber-500 hover:bg-amber-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 send-invoice">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path d="M7.5 3.375c0-1.036.84-1.875 1.875-1.875h.375a3.75 3.75 0 013.75 3.75v1.875C13.5 8.161 14.34 9 15.375 9h1.875A3.75 3.75 0 0121 12.75v3.375C21 17.16 20.16 18 19.125 18h-9.75A1.875 1.875 0 017.5 16.125V3.375z" />
                                        <path d="M15 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0017.25 7.5h-1.875A.375.375 0 0115 7.125V5.25zM4.875 6H6v10.125A3.375 3.375 0 009.375 19.5H16.5v1.125c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V7.875C3 6.839 3.84 6 4.875 6z" />
                                    </svg>
                                </button>
                            <?php }
                            if ($rows["status"] == "Приключена" && $rows["customer_opinion"] != "") { ?>
                                <button value="<?= $rows["id"] ?>" type="button" class="bg-indigo-500 hover:bg-indigo-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 view-customer-opinion">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                    <?php }
                        }
                    } ?>
                </td>
            </tr>
        <?php }
} else { ?>
        <tr>
            <td colspan="10" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold animate__animated animate__slideInUp animate__faster">Не са намерени данни</td>
        </tr>
    <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="10">
                    <div class="flex justify-end py-2.5 px-4 w-full">
                        <ul class="inline-flex items-center -space-x-px">
                            <li>
                                <a href="#" class="block px-2 pt-[9px] pb-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-all">1</a>
                            </li>
                            <li>
                                <a href="#" class="block px-2 pt-[9px] pb-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tfoot>