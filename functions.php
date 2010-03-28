<?php

// Encode function -- converts ID to base62
function encode($val, $base=62, $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    // can't handle numbers larger than 2^31-1 = 2147483647
    $str = '';
    do {
        $i = $val % $base;
        $str = $chars[$i] . $str;
        $val = ($val - $i) / $base;
    } while($val > 0);
    return $str;
}

// Encode function -- converts base62 to id for Database lookup
function decode($str, $base=62, $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
    $len = strlen($str);
    $val = 0;
    $arr = array_flip(str_split($chars));
    for($i = 0; $i < $len; ++$i) {
        $val += $arr[$str[$i]] * pow($base, $len-$i-1);
    }
    return $val;
}

?>