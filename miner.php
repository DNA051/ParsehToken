<?php
function adad($word)
{
    global $adadi;
    $wordi_1 = substr($word, 0, 1);
    $wordi_2 = substr($word, 1, 2);
    $result = false;
    if (is_string($wordi_1)) {
        while ($result == true) {
            switch ($wordi_1) {
                case 'a':
                    $adadi .= 1;
                    $result = true;
                    break;
                case 'b':
                    $adadi .= 2;
                    $result = true;
                    break;
                case 'c':
                    $adadi .= 3;
                    $result = true;
                    break;
                case 'd':
                    $adadi .= 4;
                    $result = true;
                    break;
                case 'e':
                    $adadi .= 5;
                    $result = true;
                    break;
                case 'f':
                    $adadi .= 6;
                    $result = true;
                    break;
            }
        }
    }
    if (is_string($wordi_2)) {
        while ($result == true) {
            switch ($wordi_2) {
                case 'a':
                    $adadi .= 1;
                    $result = true;
                    break;
                case 'b':
                    $adadi .= 2;
                    $result = true;
                    break;
                case 'c':
                    $adadi .= 3;
                    $result = true;
                    break;
                case 'd':
                    $adadi .= 4;
                    $result = true;
                    break;
                case 'e':
                    $adadi .= 5;
                    $result = true;
                    break;
                case 'f':
                    $adadi .= 6;
                    $result = true;
                    break;
            }
        }
    }
    if (is_numeric($wordi_1)) {
        $adadi .= $wordi_1;
    }
    if (is_numeric($wordi_2)) {
        $adadi .= $wordi_2;
    }
}

$xx = "0000000000000000057fcc708cf0130d95e27c5819203e9f967ac56e4df598ee";
for ($i = 0; $i < 63; $i++) {
    $yy = substr($xx, $i, 1);
    adad($yy);
}

$xx = explode(':', strtolower($_GET['mac']));
for ($i = 0; $i < 6; $i++) {
    adad($xx[$i]);
}


 /* problem */ 
$min = 1;
$max = 9999;
$y = mt_rand($min, $max);
$z = round(sqrt($adadi * $y), 99);
$t = round(log($adadi * $y), 99);
$hash_code =  sha1(sqrt(sin($z / $t)));
echo '$y: ' . $y . '<br/>hash: ' . $hash_code . '<br/>';

/* solve */
/* $hc = '';
$pos = false;
while ($pos == false) {
    $zz = round(sqrt($min * $y), 99);
    $tt = round(log($min * $y), 99);
    $hc = sha1(sqrt(sin($zz / $tt)));
    if ($hc == $hash_code) {
        $pos = true;
        break;
    } else {
        echo $min . '<br/>';
        $min += 1;
    }
}

echo '$y_find: ' . $min . '<br/>hash_find: ' . $hc; */
