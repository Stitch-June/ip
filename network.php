<?php

function getNetwork($ip1, $ip2)
{
    $mask = 0;
    // ipv4
    $ip1 = explode('.', $ip1);
    $ip2 = explode('.', $ip2);
    for ($i = 0; $i < 3; $i++) {
        if ($ip1[$i] !== $ip2[$i]) {
            break;
        }
        $mask = $mask + 8;
    }

    for ($j = 7; $j > 0; $j--) {
        if (($ip1[$i] >> $j & 0xff) != ($ip2[$i] >> $j & 0xff)) {
            break;
        }
        $mask++;
    }

    $network = $ip1;


    $ipIndex = floor($mask / 8);
    $diff = $mask - ($ipIndex * 8);
    $network[$ipIndex] = $ip1[$ipIndex] & 255 << 8 - $diff;

    return implode('.', $network) . '/' . $mask;
}
