<?php

include('config.php');
include('func.php');

//get fees from tgju
if (isset($_GET['ons_gold'])) {
    $ons_gold = str_replace(',', '', $_GET['ons_gold']);
    $usd = str_replace(',', '', $_GET['usd']);
    $silver = $_GET['silver'];
    $copper = $_GET['copper'];
    $dinar = $_GET['dinar'];

    $darik = round((($ons_gold * $usd * 8.42) / 283.5), 0);
    $sigel = round((($silver * $usd * 5.6) / 283.5), 0);
    $qeroon = round((100 * $dinar), 0);
    $parseh = round((10 * $copper * $usd / 10000), 0);
    $papasi = round($ons_gold * $usd * 0.0108055 / 283.5, 0);

    $zaman = date('Ymd - H:i:s');
    $PRS = "UPDATE `fees` SET `nerkh`=" . $parseh . ",`zaman`='" . $zaman . "' WHERE `name_en`='PRS'";
    $DRK = "UPDATE `fees` SET `nerkh`=" . $darik . ",`zaman`='" . $zaman . "' WHERE `name_en`='DRK'";
    $SYG = "UPDATE `fees` SET `nerkh`=" . $sigel . ",`zaman`='" . $zaman . "' WHERE `name_en`='SYG'";
    $QIR = "UPDATE `fees` SET `nerkh`=" . $qeroon . ",`zaman`='" . $zaman . "' WHERE `name_en`='QIR'";
    $PPC = "UPDATE `fees` SET `nerkh`=" . $papasi . ",`zaman`='" . $zaman . "' WHERE `name_en`='PPC'";
    $r = mysqli_query($cn, $PRS);
    $w = mysqli_query($cn, $DRK);
    $e = mysqli_query($cn, $SYG);
    $t = mysqli_query($cn, $QIR);
    $y = mysqli_query($cn, $PPC);

    $zamani = time();
    $xx_drk = "INSERT INTO `history`(`id`,`arz_name`,`cost`,`zaman`) VALUES(NULL,'DRK',$darik,$zamani)";
    $xx_prs = "INSERT INTO `history`(`id`,`arz_name`,`cost`,`zaman`) VALUES(NULL,'PRS',$parseh,$zamani)";
    $xx_syg = "INSERT INTO `history`(`id`,`arz_name`,`cost`,`zaman`) VALUES(NULL,'SYG',$sigel,$zamani)";
    $xx_qir = "INSERT INTO `history`(`id`,`arz_name`,`cost`,`zaman`) VALUES(NULL,'QIR',$qeroon,$zamani)";
    $xx_ppc = "INSERT INTO `history`(`id`,`arz_name`,`cost`,`zaman`) VALUES(NULL,'PPC',$papasi,$zamani)";
    /*$ta = mysqli_query($cn, $xx_drk);
    $tb = mysqli_query($cn, $xx_ppc);
    $tc = mysqli_query($cn, $xx_prs);
    $td = mysqli_query($cn, $xx_qir);
    $td = mysqli_query($cn, $xx_syg);*/
}
//transfer money
elseif (isset($_GET['transfer'])) {
    $addr_from = $_GET['addr_from'];
    $addr_to = $_GET['addr_to'];
    $type = $_GET['type'];
    prev_block($addr_from,$type);
    $cost = $_GET['cost'] - round($_GET['cost'] * $tax_fees,2);
    $time = time();
    $pb = $GLOBALS['prev_block'];
    $block_pack = $addr_from . $addr_to . $cost . $time . $pb;
    $size = strlen($block_pack);
    $hash = md5($block_pack);
    insert_db('blocks', "`id`,`addr_from`,`addr_to`,`hash`,`cost`,`time`,`size`,`prev_block`,`validate`, `type`", "null,
    '" . $addr_from . "','" . $addr_to . "','" . $hash . "','" . $cost . "','" . $time . "','" . $size . "','" . $pb . "',null,'" . $type . "'");
    echo json_encode(array('from' => $addr_from, 'to' => $addr_to, 'cost' => $cost, 'type' => $type, 'prev_block' => $pb, 'time' => $time, 'tx' => $hash));
}
//deposit money
elseif (isset($_GET['deposit'])) {
}
//withdraw money
elseif (isset($_GET['withdraw'])) {
}
