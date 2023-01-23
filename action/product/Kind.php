<?php
require '../dbconn.php';

if (isset($_POST['kind'])) {
    $kind =  ($_POST['kind']);

    $query = "SELECT * FROM stock WHERE kind = '$kind'";
    $query_run = mysqli_query($con, $query);

    while ($rows = mysqli_fetch_array($query_run)) {
?>
        <option value="<?= $rows["name"] ?>"><?= $rows["name"] ?></option>
<?php
    }
}

?>