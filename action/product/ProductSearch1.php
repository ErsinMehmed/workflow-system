<?php
require '../dbconn.php';

if (isset($_POST['product'])) {
    $name =  ($_POST['product']);

    if ($name != "") {
        $query = "SELECT * FROM stocks WHERE name like '$name%'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) { ?>
                <div class="w-full text-sm text-slate-700 border-t border-gray-300 p-2.5 hover:bg-gray-100 rounded-b-lg transition-all cursor-pointer get-product-name1"><?= $rows['name'] ?></div>
            <?php
            }
        } else {
            ?>
            <div class="w-full font-semibold text-sm text-slate-700 border-t border-gray-300 p-2.5 text-center">Няма намерени данни</div>
<?php
        }
    }
}
?>