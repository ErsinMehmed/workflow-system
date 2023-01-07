<?php
include '../dbconn.php';

$text = $_POST['text'];
$position = $_POST['position'];
$status = $_POST['status'];

if ($position == 'Всички' && $status != 3) {
    echo $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND status = '$status'";
} else if ($status == 3 && $position != 'Всички') {
    echo $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND position = '$position'";
} else if ($status != 3 && $position != 'Всички') {
    echo $query = "SELECT * FROM users WHERE (name LIKE '$text%' OR pid LIKE '$text%') AND position = '$position' AND status = '$status'";
} else {
    echo $query = "SELECT * FROM users WHERE name LIKE '$text%' OR pid LIKE '$text%'";
}
$query_run = mysqli_query($con, $query);

?>
<thead>
    <tr>
        <th class="border-b-2 border-gray-200 bg-gray-100 text-center"></th>
        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            име
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            пид
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            длъжност
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            статус
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            екип
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            назначен
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
                <td class="bg-white border-b border-gray-200 px-2 py-5"><img src="../uploaded-files/user-images/<?= $rows["image"] ?>" alt="" class="w-10 h-10 rounded-full object-cover mx-auto" /></td>
                <td class="pr-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= $rows["name"] ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <p class="text-gray-900 whitespace-no-wrap">
                        <?= $rows["pid"] ?>
                    </p>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= $rows["position"] ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm">
                    <?php if ($rows["status"] == 1) { ?>
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
                    <?php if ($rows["team"] != '') {
                        echo $rows["team_name"];
                    } else { ?>
                        Няма
                    <?php } ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= date("d.m.Y", strtotime($rows['date_in'])) ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center space-x-1.5">
                    <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-user">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                        </svg>
                    </button>
                </td>
            </tr>
        <?php }
} else { ?>
        <tr>
            <td colspan="9" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
        </tr>
    <?php } ?>
        </tbody>