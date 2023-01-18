<?php

include '../dbconn.php';

date_default_timezone_set('Europe/Sofia');

$text = $_POST['text'];
$date = date("Y-m-d");

$query = "SELECT * FROM teams WHERE (id LIKE '$text%' OR name LIKE '$text%') AND delete_team != 'yes'";
$query_run = mysqli_query($con, $query);
?>
<thead>
    <tr>
        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            номер
        </th>
        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            име на екип
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            статус
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            служител 1
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            служител 2
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            назначени задачи
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            средна оценка
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
                <td class="pr-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= $rows["id"] ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <p class="text-gray-900 whitespace-no-wrap">
                        <?= $rows["name"] ?>
                    </p>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm">
                    <?php if ($rows["status"] == "Yes") { ?>
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
                    <?= $rows["user1_name"] ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= $rows["user2_name"] ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?php
                    $id = $rows['id'];

                    $queryy = "SELECT * FROM orders WHERE team_id = '$id' AND date >= '$date'";
                    $query_runn = mysqli_query($con, $queryy);

                    if (mysqli_num_rows($query_runn) > 0) { ?>
                        <button type="button" value="<?= $rows['id']; ?>" class="h-8 w-8 bg-blue-100 hover:bg-blue-200 text-blue-800 focus:outline-none text-xs font-semibold rounded-md active:scale-90 transition-all prevOrd">
                            <?php echo mysqli_num_rows($query_runn); ?>
                        </button>
                    <?php } else { ?>
                        <button type="button" class="h-8 w-8 bg-blue-100 text-blue-800 focus:outline-none text-xs font-semibold rounded-md cursor-default">
                            0
                        </button>
                    <?php } ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm flex justify-center">
                    <div class="h-8 w-8 bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center">
                        <?php
                        $id = $rows['id'];

                        $sql_run = "SELECT CAST(AVG(rating) AS DECIMAL(10,1)) AS rating FROM team_rating WHERE team_id = '$id'";
                        $result = $con->query($sql_run);
                        while ($row = mysqli_fetch_array($result)) {
                            if ($row['rating'] == "") {
                                echo "0.0";
                            } else {
                                echo $row['rating'];
                            }
                        }
                        ?>
                    </div>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center space-x-2">
                    <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-team">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </td>
            </tr>
        <?php
    }
} else {
        ?>
        <tr>
            <td colspan="8" class="px-4 py-6 border-b border-gray-200 bg-white text-sm text-center font-semibold">Не са намерени данни</td>
        </tr>
    <?php } ?>
        </tbody>