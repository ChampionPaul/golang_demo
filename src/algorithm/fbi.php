<?php

/*
n=0 f(n) = 0
n=1 f(n) = 1
n>1 f(n) = f(n-1) + f(n-2)
 */

function fbi($n) {
    if ($n == 0){
        return 0;
    }
    if ($n == 1){
        return 1;
    }
    return fbi($n-1) + fbi($n-2);
}

echo fbi(11);

//斐波那契数列引发的动态规划问题：高度为n的台阶，从下往上走，一次只能走一步或者两步，有多少种走法
//从n-1 到 n 台阶的走法有两种情况, 迈一步:从n-1直接上，迈两步:从n-2直接上,所以
//  f(n) = f(n-1) + f (n-2)
//  f(1) = 1   f(2) = 2
// 解决方法: 1.递归 2.动态规划

function step($n) {
    if ($n == 1) {
        return 1;
    }
    if ($n == 2) {
        return 2;
    }
    $a = 1;
    $b = 2;
    for($i=3;$i<=$n;$i++){
        $res = $a + $b;
        $a = $b;
        $b = $res;
    }
    return $res;
}





