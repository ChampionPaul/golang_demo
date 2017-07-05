<?php

/*
先求next数组，next[j] 代表的是，j之前的元素有先后缀相同的最长长度
*/

function GetNext($str){
    $len = strlen($str);
    $j = 0;
    $k = -1; 
    $next[0] = -1;//代表第一个字符
    //递推，取出$str[$next[$j]]，相当于拿出j之前的字符的最长前后缀的字符的下一位与当前字符比较，如果是相等的，相当于在前一个字符的最长前后缀的基础上，还能再加一位，即$next[j+1] = $next[j] + 1
    while ($j < $len - 1){
        if ($k == -1 || $str[$j] == $str[$k]) {
            ++$k;
            ++$j;
            $next[$j] = $k;
        }else{
            $k = $next[$k];
        }
    }
    return $next;
}
$str = "abcdad";
$res = GetNext($str);
print_r($res);

function KMPMatch($src, $par, $next){
    $len1 = strlen($src);
    $len2 = strlen($par);
    $i = 0;
    $j = 0;
    while ($i < $len1 && $j < $len2) {
        if ($j == -1 || $src[i] == $par[$j]) {
            $k++;
            $j++;
        } else {
            $j = $next[$j];
        }
    }

    if ($j == $len2) {
        return $i - $j;
    } else {
        return -1;
    }
}

