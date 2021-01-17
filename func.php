<?php
include('config.php');

function insert_db($db, $string, $values)
{
    $q = "INSERT INTO `" . $db . "`(" . $string . ") VALUES(" . $values . ")";
    $r = mysqli_query($GLOBALS['cn'], $q);
}

function upd_db($db, $string, $where)
{
    $q = "UPDATE `" . $db . "` SET " . $string . " WHERE " . $where;
    $r = mysqli_query($GLOBALS['cn'], $q);
}

function upd_db_pool($addr, $remain, $wall)
{
    global $priz_pos,$tax;
    $q = "SELECT * FROM `pool` WHERE `addr` = '" . $addr . "' ORDER BY `id` DESC";
    $r = mysqli_query($GLOBALS['cn'], $q);
    $row = mysqli_fetch_array($r);
    $id = $row['id'];
    $wall = $row['wall'] . ',' . $wall;
    $type = $row['type'];

    $qq = "UPDATE `pool` SET `remain` = $remain,`wall` = '".$wall."' WHERE `id`=" . $id;
    $rr = mysqli_query($GLOBALS['cn'], $qq);
    if ($rr) {
        $priz_pos = 1;
    }
}

function get_pool_info($addr)
{
    $q = "SELECT * FROM `pool` WHERE `addr` = '" . $addr . "' ORDER BY `id` DESC";
    $r = mysqli_query($GLOBALS['cn'], $q);
    $row = mysqli_fetch_array($r);
    global $pool_info;
    $pool_info = array();
    $pool_info = json_encode(array(
        'addr' => $row['addr'], 'total' => $row['total'], 'remain' => $row['remain'],
        'type' => $row['type'], 'wall' => $row['wall'], 'prize' => $row['prize']
    ));
}
function prev_block($addr_from,$type){
    $q = "SELECT * FROM `fees` WHERE `name_en` ='".$type."'";
    $r = mysqli_query($GLOBALS['cn'],$q);
    $row = mysqli_fetch_array($r);
    global $tax_fees, $prev_block;
    $tax_fees = $row['tax'] / 100;

    $q = "SELECT * FROM `blocks` WHERE `addr_to` = '" . $addr_from . "' ORDER BY `id` DESC LIMIT 0,1";
    $r = mysqli_query($GLOBALS['cn'], $q);
    $row = mysqli_fetch_array($r);
    $prev_block = $row['id'];
}