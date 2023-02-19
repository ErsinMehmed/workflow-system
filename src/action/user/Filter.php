<?php
include '../dbconn.php';

session_start();

$adminEmail = $_SESSION['adminEmail'];
$text = mysqli_real_escape_string($con, $_POST['text']);
$position = mysqli_real_escape_string($con, $_POST['position']);
$status = mysqli_real_escape_string($con, $_POST['status']);
$order = isset($_POST["order"]) ? $_POST["order"] : "desc";
$column = isset($_POST["columnName"]) ? $_POST["columnName"] : "name";
$record = isset($_POST['record']) ? $_POST['record'] : 10;

if (isset($_POST['pagination'])) {
    $pagination = max(0, ($_POST['pagination'] - 1) * $record);
} else {
    $pagination = 0;
}

if ($order == 'desc') {
    $order = 'asc';
} else {
    $order = 'desc';
};

if ($position == 'Всички' && $status != 3) {
    $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND status = '$status' ORDER BY $column $order LIMIT $pagination, $record";
} else if ($status == 3 && $position != 'Всички') {
    $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND position = '$position' ORDER BY $column $order LIMIT $pagination, $record";
} else if ($status != 3 && $position != 'Всички') {
    $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND position = '$position' AND status = '$status' ORDER BY $column $order LIMIT $pagination, $record";
} else {
    $query = "SELECT * FROM users WHERE name LIKE '$text%' OR pid LIKE '$text%' ORDER BY $column $order LIMIT $pagination, $record";
}

$query_run = mysqli_query($con, $query); ?>
<thead>
    <tr class="border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
        <th class="px-4 py-3 cursor-default">снимка</th>
        <th class="px-4 py-3 cursor-pointer user_column_sort" id="user-name-sort" name="name" data-order="<?= $order ?>">
            <div class="flex items-center justify-center">
                <div>име</div>
                <div id="user-name-sort1">
                    <svg class="w-3.5 h-3.5 text-red-700" stroke="currentColor" viewBox="0 0 1900 1900">
                        <path d="M994.034 694.296c-18.796-27.296-49.269-27.3-68.067 0l-351.074 509.836c-18.797 27.296-7.18 49.424 25.959 49.424h718.297c33.133 0 44.757-22.125 25.959-49.424L994.034 694.296Z" fill-rule="evenodd" />
                    </svg>
                    <svg class="w-3.5 h-3.5 text-red-700 -mt-2" stroke="currentColor" viewBox="0 0 1900 1900">
                        <path d="M994.034 1226.26c-18.796 27.296-49.269 27.3-68.067 0L574.893 716.424C556.096 689.128 567.713 667 600.852 667h718.297c33.133 0 44.757 22.125 25.959 49.424L994.034 1226.26Z" fill-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </th>
        <th class="px-4 py-3 cursor-pointer user_column_sort" id="user-pid-sort" name="pid" data-order="<?= $order ?>">
            <div class="flex items-center justify-center">
                <div>пид</div>
                <div id="user-pid-sort1">
                    <svg class="w-3.5 h-3.5 text-red-700" stroke="currentColor" viewBox="0 0 1900 1900">
                        <path d="M994.034 694.296c-18.796-27.296-49.269-27.3-68.067 0l-351.074 509.836c-18.797 27.296-7.18 49.424 25.959 49.424h718.297c33.133 0 44.757-22.125 25.959-49.424L994.034 694.296Z" fill-rule="evenodd" />
                    </svg>
                    <svg class="w-3.5 h-3.5 text-red-700 -mt-2" stroke="currentColor" viewBox="0 0 1900 1900">
                        <path d="M994.034 1226.26c-18.796 27.296-49.269 27.3-68.067 0L574.893 716.424C556.096 689.128 567.713 667 600.852 667h718.297c33.133 0 44.757 22.125 25.959 49.424L994.034 1226.26Z" fill-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </th>
        <th class="px-4 py-3 cursor-default">длъжност</th>
        <th class="px-4 py-3 cursor-default">статус</th>
        <th class="px-4 py-3 cursor-pointer user_column_sort" id="user-team-sort" name="team_name" data-order="<?= $order ?>">
            <div class="flex items-center justify-center">
                <div>екип</div>
                <div id="user-team-sort1">
                    <svg class="w-3.5 h-3.5 text-red-700" stroke="currentColor" viewBox="0 0 1900 1900">
                        <path d="M994.034 694.296c-18.796-27.296-49.269-27.3-68.067 0l-351.074 509.836c-18.797 27.296-7.18 49.424 25.959 49.424h718.297c33.133 0 44.757-22.125 25.959-49.424L994.034 694.296Z" fill-rule="evenodd" />
                    </svg>
                    <svg class="w-3.5 h-3.5 text-red-700 -mt-2" stroke="currentColor" viewBox="0 0 1900 1900">
                        <path d="M994.034 1226.26c-18.796 27.296-49.269 27.3-68.067 0L574.893 716.424C556.096 689.128 567.713 667 600.852 667h718.297c33.133 0 44.757 22.125 25.959 49.424L994.034 1226.26Z" fill-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </th>
        <th class="px-4 py-3 cursor-pointer user_column_sort" id="user-in-date-sort" name="in_date" data-order="<?= $order ?>">
            <div class="flex items-center justify-center">
                <div>назначен</div>
                <div id="user-in-date-sort1">
                    <svg class="w-3.5 h-3.5 text-red-700" stroke="currentColor" viewBox="0 0 1900 1900">
                        <path d="M994.034 694.296c-18.796-27.296-49.269-27.3-68.067 0l-351.074 509.836c-18.797 27.296-7.18 49.424 25.959 49.424h718.297c33.133 0 44.757-22.125 25.959-49.424L994.034 694.296Z" fill-rule="evenodd" />
                    </svg>
                    <svg class="w-3.5 h-3.5 text-red-700 -mt-2" stroke="currentColor" viewBox="0 0 1900 1900">
                        <path d="M994.034 1226.26c-18.796 27.296-49.269 27.3-68.067 0L574.893 716.424C556.096 689.128 567.713 667 600.852 667h718.297c33.133 0 44.757 22.125 25.959 49.424L994.034 1226.26Z" fill-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </th>
        <th class="px-4 py-3 cursor-default">действия</th>
    </tr>
</thead>
<?php if (mysqli_num_rows($query_run) > 0) {
    while ($rows = mysqli_fetch_array($query_run)) { ?>
        <tbody>
            <tr class="bg-white hover:bg-slate-50 transition-all border-b border-gray-200 text-sm">
                <td class="px-2 py-5"><img src="uploaded-files/user-images/<?= $rows["image"] ?>" alt="<?= $rows["image"] ?>" class="w-10 h-10 rounded-full object-cover mx-auto" /></td>
                <td class="pr-4 py-5 text-center"><?= $rows["name"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["pid"] ?></td>
                <td class="px-4 py-5 text-center"><?= $rows["position"] ?></td>
                <td class="px-4 py-5">
                    <span class="w-8 h-8 rounded-full bg-<?= ($rows["status"] == 1) ? 'green-200' : 'red-200' ?> flex items-center justify-center mx-auto">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-<?= ($rows["status"] == 1) ? 'green-500' : 'red-500' ?>">
                            <path stroke-linecap="round" stroke-linejoin="round" d="<?= ($rows["status"] == 1) ? 'M4.5 12.75l6 6 9-13.5' : 'M6 18L18 6M6 6l12 12' ?>" />
                        </svg>
                    </span>
                </td>
                <td class="px-4 py-5 text-center">
                    <?= ($rows["team_name"] != '') ? $rows["team_name"] : 'Няма' ?>
                </td>
                <td class="px-4 py-5 text-center"><?= date("d.m.Y", strtotime($rows['in_date'])) ?></td>
                <td class="px-4 py-5 text-center space-x-2">
                    <?php
                    $query = "SELECT * FROM admins WHERE email = '$adminEmail'";
                    $execute = mysqli_query($con, $query);

                    while ($roles = mysqli_fetch_array($execute)) {
                        if ($roles["edit_role"] == 1 || $roles["full_role"] == 1) {
                            if ($rows["status"] != 0) { ?>
                                <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-user">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                    </svg>
                                </button>
                                <button value="<?= $rows["id"] ?>" type="button" class="bg-green-500 hover:bg-green-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-user-password">
                                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                                        <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd" />
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
            <td colspan="9" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
        </tr>
    <?php } ?>
        </tbody>
        <?php
        if ($position == 'Всички' && $status != 3) {
            $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND status = '$status'";
        } else if ($status == 3 && $position != 'Всички') {
            $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND position = '$position'";
        } else if ($status != 3 && $position != 'Всички') {
            $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND position = '$position'";
        } else {
            $query = "SELECT * FROM users WHERE name LIKE '$text%' OR pid LIKE '$text%'";
        }

        $query_run = mysqli_query($con, $query);
        $totealUser = ceil(mysqli_num_rows($query_run) / $record);

        if (mysqli_num_rows($query_run) > 0) { ?>
            <tfoot>
                <tr>
                    <td colspan="9">
                        <div class="flex justify-between py-2.5 px-4 w-full">
                            <div class="relative w-16">
                                <select id="select-records-count-user" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:border-gray-400 block w-full p-2 cursor-pointer">
                                    <option value="5" <?php if ($record == 5) { ?> selected <?php } ?>>5</option>
                                    <option value="10" <?php if ($record == 10 || $record == 0) { ?> selected <?php } ?>>10</option>
                                    <option value="15" <?php if ($record == 15) { ?> selected <?php } ?>>15</option>
                                    <option value="20" <?php if ($record == 20) { ?> selected <?php } ?>>20</option>
                                </select>
                            </div>
                            <ul class="inline-flex items-center -space-x-px">
                                <li>
                                    <div class="block px-2 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </li>

                                <?php
                                for ($i = 1; $i <= $totealUser; $i++) { ?>
                                    <li>
                                        <button type="button" value="<?= $i ?>" class="px-3 py-2 leading-tight text-gray-500 border border-gray-300 hover:bg-gray-100 hover:text-gray-700 transition-all user-pagination">
                                            <?= $i ?>
                                        </button>
                                    </li>
                                <?php } ?>
                                <li>
                                    <div class="block px-2 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 transition-all">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <input id="user-table-pagination" type="hidden" value="1" />
                    </td>
                </tr>
            </tfoot>
        <?php } ?>