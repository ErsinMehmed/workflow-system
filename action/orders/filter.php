<?php
include '../dbconn.php';

date_default_timezone_set('Europe/Sofia');
$curDate = date("Y-m-d");

$date = $_POST['date'];
$text = $_POST['text'];

$query = "SELECT * FROM orders WHERE date = '$date' AND (customer_name LIKE '$text%' OR id LIKE '$text%')";
$query_run = mysqli_query($con, $query);
?>
<thead>
    <tr>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            номер
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            име на клиент
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            помещение
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            оферта
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            статус
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            квадратура
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            цена
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            фактура
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            дата
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            действия
        </th>
    </tr>
</thead>
<?php
if (mysqli_num_rows($query_run) > 0) {
    while ($rows = mysqli_fetch_array($query_run)) {
?>
        <tbody>
            <tr>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center"><?= $rows["id"] ?></td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <button type="button" value="<?= $rows["email"] ?>" class="text-gray-900 whitespace-no-wrap hover:underline cursor-pointer transition-all show-customer">
                        <?= $rows["customer_name"] ?>
                    </button>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <p class="text-gray-900 whitespace-no-wrap">
                        <?= $rows["room"] ?>
                    </p>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <p class="text-gray-900 whitespace-no-wrap">
                        <?= $rows["offer"] ?>
                    </p>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?php if ($rows["status"] == 'Назначи') {
                    ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php
                    } else if ($rows["status"] == 'Назначена') {
                    ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-indigo-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-indigo-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php
                    } else if ($rows["status"] == 'В процес') {
                    ?>
                        <span class="relative inline-block px-3 py-1 font-semibold text-orange-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"></span>
                            <span class="relative"><?= $rows["status"] ?></span>
                        </span>
                    <?php
                    } else if ($rows["status"] == 'Приключена') {
                    ?>
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
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= $rows["m2"] . " m2" ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= $rows["price"] . " лв." ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
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
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= date("d.m.Y", strtotime($rows['date'])) ?>
                </td>
                <td class="px-4 py-5 flex items-center justify-center border-b border-gray-200 bg-white text-sm space-x-1.5">
                    <?php if ($curDate <= $rows['date']) { ?>
                        <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-order">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                            </svg>
                        </button>
                    <?php } ?>
                    <button type="button" class="bg-green-500 hover:bg-green-600 p-2 rounded-md transition-all focus:outline-none active:scale-90">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                            <path d="M4.5 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM14.25 8.625a3.375 3.375 0 116.75 0 3.375 3.375 0 01-6.75 0zM1.5 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM17.25 19.128l-.001.144a2.25 2.25 0 01-.233.96 10.088 10.088 0 005.06-1.01.75.75 0 00.42-.643 4.875 4.875 0 00-6.957-4.611 8.586 8.586 0 011.71 5.157v.003z" />
                        </svg>
                    </button>
                </td>
            </tr>
        <?php
    }
} else {
        ?>
        <tr>
            <td colspan="10" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
        </tr>
    <?php } ?>
        </tbody>