<?php
require '../dbconn.php';

if (isset($_POST['supplier'])) {
    $name =  mysqli_real_escape_string($con, $_POST['supplier']);

    if ($name != "") {
        $query = "SELECT * FROM suppliers WHERE name like '$name%'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($rows = mysqli_fetch_array($query_run)) { ?>
                <div class="w-full text-sm text-slate-700 border-t border-gray-300 p-2.5 hover:bg-gray-100 rounded-b-lg transition-all cursor-pointer get-order-supplier"><?= $rows['name'] ?></div>
<?php
            }
        }
    }
}
?>