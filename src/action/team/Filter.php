<?php
include '../dbconn.php';

session_start();
date_default_timezone_set('Europe/Sofia');

$adminEmail = $_SESSION['adminEmail'];
$text = mysqli_real_escape_string($con, $_POST['text']);
$date = date("Y-m-d");

$query = "SELECT * FROM teams WHERE (id LIKE '$text%' OR name LIKE '$text%') AND delete_team != 'yes'";
$query_run = mysqli_query($con, $query); ?>
<thead>
    <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
        <th class="px-4 py-3">номер</th>
        <th class="px-4 py-3">име на екип</th>
        <th class="px-4 py-3">статус</th>
        <th class="px-4 py-3">служител 1</th>
        <th class="px-4 py-3">служител 2</th>
        <th class="px-4 py-3">назначени задачи</th>
        <th class="px-4 py-3">средна оценка</th>
        <th class="px-4 py-3">действия</th>
    </tr>
</thead>
<?php if (mysqli_num_rows($query_run) > 0) {
    while ($rows = mysqli_fetch_array($query_run)) { ?>
        <tbody>
            <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                <td class="pr-4 py-5 text-center"><?= $rows["id"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["name"] ?></td>
                <td class="px-4 py-5">
                    <span class="w-8 h-8 rounded-full bg-<?= $rows['status'] === 'Yes' ? 'green' : 'red' ?>-200 flex items-center justify-center mx-auto">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-<?= $rows['status'] === 'Yes' ? 'green' : 'red' ?>-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="<?= $rows['status'] === 'Yes' ? 'M4.5 12.75l6 6 9-13.5' : 'M6 18L18 6M6 6l12 12' ?>" />
                        </svg>
                    </span>
                </td>
                <td class="px-4 py-5 text-center"><?= $rows["user1_name"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["user2_name"] ?></td>
                <td class="px-4 py-5 text-center">
                    <button type="button" value="<?= $rows['id']; ?>" class="h-8 w-8 bg-blue-100 text-blue-800 focus:outline-none text-xs font-semibold rounded-md <?= mysqli_num_rows(mysqli_query($con, "SELECT * FROM orders WHERE team_id = '{$rows['id']}' AND date >= '$date'")) > 0 ? 'hover:bg-blue-200 active:scale-90 prevOrd' : 'cursor-default'; ?> transition-all">
                        <?= mysqli_num_rows(mysqli_query($con, "SELECT * FROM orders WHERE team_id = '{$rows['id']}' AND date >= '$date'")) ?: 0; ?>
                    </button>
                </td>
                <td class="px-4 py-5 flex justify-center">
                    <div class="h-8 w-8 bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center">
                        <?php $id = $rows['id'];
                        $row = mysqli_fetch_array($con->query("SELECT CAST(AVG(rating) AS DECIMAL(10,1)) AS rating FROM team_ratings WHERE team_id = '$id'"));
                        echo $row['rating'] ?: "0.0"; ?>
                    </div>
                </td>
                <td class="px-4 py-5 text-center">
                    <?php
                    $query = "SELECT * FROM admins WHERE email = '$adminEmail'";
                    $execute = mysqli_query($con, $query);

                    while ($roles = mysqli_fetch_array($execute)) {
                        if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) { ?>
                            <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-team">
                                <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>
                            </button>
                    <?php }
                    } ?>
                </td>
            </tr>
        <?php }
} else { ?>
        <tr>
            <td colspan="8" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
        </tr>
    <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">
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