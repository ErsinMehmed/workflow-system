<?php
require '../dbconn.php';

if (isset($_POST['kind'])) {
    $kind =  mysqli_real_escape_string($con, $_POST['kind']);

    $query = "SELECT name FROM stocks WHERE kind = '$kind'";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) { ?>
        <option value="<?= $rows["name"] ?>"><?= $rows["name"] ?></option>
<?php }
} ?>