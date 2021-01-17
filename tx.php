<?php
include('config.php');
include('func.php');

global $x, $pos;
$pos = false;

//user email
if (isset($_GET['email'])) {
    $x = $_GET['email'];

    do {

        //random number :: hakha rise year before Masih
        $y = mt_rand(330, 550);

        //unix time
        $z = time();

        //sha 1 encode
        $ramz = sha1($x . $y . $z);

        //convert json
        $bl = array('tx' => $ramz);

        //check tx in db
        $q = "SELECT * FROM `tx` WHERE `tx` = '" . $ramz . "'";
        $r = mysqli_query($cn, $q);
        if ($r) {
            $num = mysqli_num_rows($r);
            if ($num > 0) {
                $pos = false;
            } elseif ($num <= 0) {
                $pos = true;
                echo json_encode($bl);

                //save to db
                insert_db('tx','`id`,`tx`,`zaman`,`rand_num`,`email`,`cost`',"null,'" . $ramz . "',$z,$y,'" . $x . "',0");
            }
        }
    } while ($pos == false);
} else {
    echo 'bad method sent data';
}
