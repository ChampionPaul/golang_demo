<?php

/*
给出n个物品的体积A[i]和其价值V[i]，将他们装入一个大小为m的背包，最多能装入的总价值有多大？
例如：对于物品体积[2, 3, 5, 7]和对应的价值[1, 5, 2, 4], 假设背包大小为10的话，最大能够装入的价值为9。
思路：当空间为v时，对于任意一个物品i，如果i可以放入（v大于等于weight[i]），则此时v空间的价值f(v)等于f(v-weight[i]) + values[i]，因此通过遍历全部物品可以找到在空间为v时所能得到的最大值。
 */
function bag($bag, $things, $value){
    $dp = array();
    for ($i=0;$i<=$bag;$i++){
        $dp[$i] = 0;
    }
    $num = count($things);
    for($j=0;$j<$num;$j++){
        for($w=$bag;$w>=$things[$j];$w--) {
            if($dp[$w] < $dp[$w - $things[$j]] + $value[$j]){
                $dp[$w] = $dp[$w - $things[$j]] + $value[$j];
            }
        }
    }
    return $dp[$bag];
}

$bag = 10;
$things = array(1,3,4,7,8);
$value  = array(10,3,6,2,1);
$res = bag($bag,$things,$value);
echo $res;
