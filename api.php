<?php
include('config.php');

if (isset($_GET['fees'])) {
    $qq = "SELECT * FROM `fees` WHERE 1 ORDER BY `id` ASC";
    $jj = mysqli_query($cn,$qq);
    if ($jj) {
        $num = mysqli_num_rows($jj);

        $arzz = array();
        for ($i = 0; $i < $num; $i++) {
            $rows = mysqli_fetch_array($jj);
            $arz_id = $rows['id'];
            $nerkh = $rows['nerkh'] + 0;
            $zaman = $row['zaman'];

            $arzz[$rows['name_en']] = $nerkh;
        }
        $arzz['time_upd'] = time();
        print_r(json_encode($arzz));
    }
} elseif ($_POST['transfer']) {
    $tx = $_POST['tx'];
    $qq = "SELECT * FROM `blocks` WHERE `tx`='" . $tx . "' ORDER BY `id` ASC";
    $tt = mysqli_query($cn,$qq);
    if ($tt) {
        $rows = mysqli_fetch_array($tt);
        $block_id = $rows['id'];
        $block_from = $rows['add_from'];
        $block_to = $rows['add_to'];
        $block_cost = $rows['cost'];
        $block_time = $rows['time'];
        $block_size = $rows['size'];
    }
}
