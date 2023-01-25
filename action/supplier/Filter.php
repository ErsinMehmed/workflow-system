<?php
include '../dbconn.php';
session_start();
date_default_timezone_set('Europe/Sofia');

$adminEmail = $_SESSION['adminEmail'];
$text = $_POST['text'];

$query = "SELECT * FROM supplier WHERE name LIKE '$text%'";
$query_run = mysqli_query($con, $query); ?>
<thead>
    <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase text-center tracking-wider">
        <th class="pr-4 py-3">номер</th>
        <th class="pr-4 py-3">име</th>
        <th class="px-4 py-3">телефон</th>
        <th class="px-4 py-3">адрес</th>
        <th class="px-4 py-3">банкова сметка</th>
        <th class="px-4 py-3">доставки</th>
        <th class="px-4 py-3">действия</th>
    </tr>
</thead>
<?php
if (mysqli_num_rows($query_run) > 0) {
    while ($rows = mysqli_fetch_array($query_run)) { ?>
        <tbody class="animate__animated animate__slideInUp animate__faster">
            <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                <td class="pr-4 py-5 text-center"><?= $rows["id"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["name"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["phone"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["address"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["iban"] ?></td>
                <td class="px-4 py-5">
                    <?php
                    $supplier = $rows["name"];

                    $queryy = "SELECT * FROM product_order WHERE supplier = '$supplier'";
                    $query_runn = mysqli_query($con, $queryy);
                    if (mysqli_num_rows($query_runn) >= 1) { ?>
                        <button value="<?= $rows["name"] ?>" class="h-8 w-8 mx-auto bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center focus:outline-none active:scale-90 transition-all supplier-order-view">
                            <?php echo mysqli_num_rows($query_runn); ?>
                        </button>
                    <?php } else { ?>
                        <div class="h-8 w-8 mx-auto bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center">
                            0
                        </div>
                    <?php } ?>
                </td>
                <td class="px-4 py-5 flex justify-center space-x-2">
                    <?php $query = "SELECT * FROM admin WHERE email = '$adminEmail'";
                    $execute = mysqli_query($con, $query);

                    while ($roles = mysqli_fetch_array($execute)) {
                        if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) { ?>
                            <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-supplier">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                </svg>
                            </button>
                            <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-supplier">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>
                            </button>
                    <?php }
                    } ?>
                </td>
            </tr>
        <?php
    }
} else { ?>
        <tr>
            <td colspan="7" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold animate__animated animate__slideInUp animate__faster">Не са намерени данни</td>
        </tr>
    <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">
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