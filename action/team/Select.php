<?php
require '../dbconn.php';

if (isset($_POST['actionOr'])) {

    $query = "SELECT * FROM teams WHERE delete_team <> 'yes'";
    $query_run = mysqli_query($con, $query);

?><option hidden disabled selected>Избери екип</option>
    <?php
    foreach ($query_run as $orders) {
    ?> <option value="<?= $orders['id'] ?>"><?= $orders['name'] ?></option>
<?php
    }
}
