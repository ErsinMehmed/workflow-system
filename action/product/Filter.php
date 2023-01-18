<?php

include '../dbconn.php';

date_default_timezone_set('Europe/Sofia');

$text = $_POST['text'];
$kind = $_POST['kind'];

if ($kind == 'Всички') {
    $query = "SELECT * FROM stock WHERE name LIKE '$text%' OR id LIKE '$text%'";
} else {
    $query = "SELECT * FROM stock WHERE (name LIKE '$text%' OR id LIKE '$text%') AND kind='$kind'";
}
$query_run = mysqli_query($con, $query);
?>
<thead>
    <tr>
        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            номер
        </th>
        <th class="pr-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            продукт
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            наличност
        </th>
        <th class="px-4 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">
            вид
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
                    <div class="h-8 w-8 mx-auto bg-blue-100 text-blue-800 text-xs font-semibold rounded-md flex items-center justify-center"><?= $rows["quantity"] ?></div>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <?= $rows["kind"] ?>
                </td>
                <td class="px-4 py-5 border-b border-gray-200 bg-white flex justify-center items-center space-x-2">
                    <button value="<?= $rows["id"] ?>" type="button" class="bg-blue-500 hover:bg-blue-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 edit-product">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 text-white">
                            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                        </svg>
                    </button>
                    <button type="button" value="<?= $rows["id"] ?>" class="bg-red-500 hover:bg-red-600 p-2 rounded-md transition-all focus:outline-none active:scale-90 delete-product">
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