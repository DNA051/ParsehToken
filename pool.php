<?php
include('func.php');

if (isset($_GET['miner'])) {
    setcookie("miner", "", time() - 3600);
    setcookie("pool", "", time() - 3600);

    $miner_info = explode('.', $_GET['miner']); //?miner = wxy123.P-MSH-123456
    $cookie_value = $miner_info[1];
    setcookie('miner', $miner_info[0], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('pool', $miner_info[1], time() + (86400 * 30), "/"); // 86400 = 1 day

    $rich = mt_rand(11, 99); // the number that must be Multiplication to unknow number and answer must be equal to hash
    $find_num = mt_rand(11, 99);
    $answer = sha1(($rich * $find_num), false);
    setcookie('hash', $answer, time() + (86400 * 30), "/"); // 86400 = 1 day
    echo $answer . "<br/>";
    echo $rich . "<br/>";
    echo $find_num . "<br/>";
} elseif (isset($_GET['extract'])) {
    $n1 = $_GET['extract'];
    $n = explode('.', $n1);
    $n2 = sha1((number_format($n[0]) * number_format($n[1])), false);

    echo $n2 . "<br/>";
    echo $_COOKIE['hash'] . "<br/>";

    if ($n2 == $_COOKIE['hash']) {
        get_pool_info($_COOKIE['pool']);
        $x = json_decode($pool_info, true);
        
        $total_arz = number_format($x['remain']) - number_format($x['prize']);
        $wall = $_COOKIE['miner'];
        $pool = $_COOKIE['pool'];
        upd_db_pool("$pool", $total_arz, "$wall");
        echo $priz_pos;
    } else {
        echo 'NO!!!';
    }
}
