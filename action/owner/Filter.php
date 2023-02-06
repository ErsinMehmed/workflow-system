<?php
include '../dbconn.php';

$text = mysqli_real_escape_string($con, $_POST['text']);
$status = mysqli_real_escape_string($con, $_POST['status']);

if ($status == 0) {
    $query = "SELECT * FROM admins WHERE name LIKE '$text%' AND status = '$status'";
} else if ($status == 1) {
    $query = "SELECT * FROM admins WHERE name LIKE '$text%' AND status = '$status'";
} else {
    $query = "SELECT * FROM admins WHERE name LIKE '$text%'";
}

$query_run = mysqli_query($con, $query); ?>
<thead>
    <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
        <th class="px-4 py-3">снимка</th>
        <th class="px-4 py-3">име</th>
        <th class="px-4 py-3">права</th>
        <th class="px-4 py-3">изгледи</th>
        <th class="px-4 py-3">статус</th>
        <th class="px-4 py-3">действия</th>
    </tr>
</thead>
<tbody>
    <?php
    if (mysqli_num_rows($query_run) > 0) {
        while ($rows = mysqli_fetch_array($query_run)) { ?>
            <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                <td class="px-2 py-5"><img src="uploaded-files/admin-images/<?= $rows["image"] ?>" alt="<?= $rows["image"] ?>" class="w-10 h-10 rounded-full object-cover mx-auto" /></td>
                <td class="pr-4 py-5 text-center"><?= $rows["name"] ?></td>
                <td class="px-4 py-5 text-center">
                    <?php if ($rows["create_role"] == 0 && $rows["edit_role"] == 0 && $rows["full_role"] == 0) { ?>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Четене</span>
                    <?php }
                    if ($rows["create_role"] == 1 && $rows["full_role"] == 0) { ?>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Добавяне</span>
                    <?php }
                    if ($rows["edit_role"] == 1 && $rows["full_role"] == 0) { ?>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Редактиране</span>
                    <?php }
                    if ($rows["full_role"] == 1) { ?>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Всички</span>
                    <?php } ?>
                </td>
                <td class="px-4 py-5 text-center">
                    <?php if ($rows["personal_view"] == 0 && $rows["nomenclature_view"] == 0) { ?>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Заявки</span>
                    <?php }
                    if ($rows["personal_view"] == 1 && $rows["nomenclature_view"] == 0) { ?>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Персонал</span>
                    <?php }
                    if ($rows["nomenclature_view"] == 1 && $rows["personal_view"] == 0) { ?>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Номанклатури</span>
                    <?php }
                    if ($rows["personal_view"] == 1 && $rows["nomenclature_view"] == 1) { ?>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full">Всички</span>
                    <?php } ?>
                </td>
                <td class="px-4 py-5">
                    <span class="w-8 h-8 rounded-full bg-<?= ($rows["status"] == 1) ? 'green-200' : 'red-200' ?> flex items-center justify-center mx-auto">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-<?= ($rows["status"] == 1) ? 'green-500' : 'red-500' ?>">
                            <path stroke-linecap="round" stroke-linejoin="round" d="<?= ($rows["status"] == 1) ? 'M4.5 12.75l6 6 9-13.5' : 'M6 18L18 6M6 6l12 12' ?>" />
                        </svg>
                    </span>
                </td>
                <td class="px-4 py-5 flex justify-center items-center space-x-2">
                    <?php if ($rows["status"] != 0) { ?>
                        <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-admin">
                            <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                            </svg>
                        </button>
                    <?php } ?>
                </td>
            </tr>
        <?php }
    } else { ?>
        <tr>
            <td colspan="6" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
        </tr>
    <?php } ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="9">
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