<?php
/*
最长公共子序列问题：给定两个序列，找到两个序列中公共的最长子序列(非连续)
思路：长度为m的字符串a和长度为n的字符串b，他们的最长公共子序列longest[m][n]可通过m-1长度的a和n-1长度的b推得：当a[m]等于b[n]的时候，longest[m][n] = longest[m-1][n-1] + 1；当a[m]不等于b[n]时，longest[m][n]=max(longest[m-1][n], longest[m][n-1])。当字符串a或者b为空字符串时，它与另一个字符串的最长公共子序列必然是0。最后题目的解即为longest[strlen(a)][strlen(b)]。可画一个矩阵来辅助理解，a和b分别做行，列，字符串一致时值为1，否则为0，填好矩阵后，对角线为1的最长对角线即为子序列的长度，优化之处在于，当一行走完之后，下一行对角线之处也为1时，可以加一，替换成当前长度，减少空间复杂度
如果为连续，则$dp数组,对应字符相等，对角线＋1，不相等直接为0
*/
function Lcs($str1, $str2){
    $len1 = strlen($str1);
    $len2 = strlen($str2);
    //初始化边界条件
    for ($i=0;$i<=$len1;$i++){
        $dp[$i]['0'] = 0;
    }
    for ($j=0;$j<=$len2;$j++){
        $dp['0'][$j] = 0;
    }

    for ($i=1;$i<=$len1;$i++){
        for($j=1;$j<=$len2;$j++){
            if ($str1[$i-1] == $str2[$j-1]){
                $dp[$i][$j] = $dp[$i-1][$j-1] + 1;
            }else{
                $dp[$i][$j] = Max($dp[$i-1][$j], $dp[$i][$j-1]);
            }
        }
    }
    //print_r($dp);

    //输出lcs序列
    $i = $len1;
    $j = $len2;
    while ($i >0 & $j > 0){
        if ($str1[$i-1] == $str2[$j-1]){
            echo $str1[$i-1];
            $i--;
            $j--;
        }else if($dp[$i-1][$j] > $dp[$i][$j-1]){
            $i--;
        }else {
            $j--;
        }
    }
    //print_r($dp);
    //return $dp[$len1][$len2];
}



//lcs的结法相当于填充dp矩阵的过程，右下角的值即为最长公共子序列的长度，空间复杂度可以进行优化，迭代的过程，前一数据行用完就没有用了，可以更新一个一维数组来达到目的
function Lcs2($str1,$str2) {
    $len1 = strlen($str1);
    $len2 = strlen($str2);
    for ($i=0;$i<=$len2;$i++){
        $dp[$i] = 0;
    }
    for($i=1;$i<=$len1;$i++){
        for($j=1;$j<=$len2;$j++){
            if ($str1[$i-1] == $str2[$j-1]){
                $dp[$j] = $dp[$j-1] + 1;
            } else {
                $dp[$j] = Max($dp[$j], $dp[$j-1]);
            }
        }
    }
    return $dp[$len2];
}
$res = Lcs("31254","12345");
//echo $res;

/*
    求连续子数组的最大和
    思路:维护一个$dp数组，$dp[$i]表示的是以第$i个元素为结尾的子数组的最大之和，这样$dp数组中最大的就是和
    优化就是，$dp数组变成$dp变量
*/

function Sum($arr) {
    $max = 0;
    $dp = $arr["0"];
    $len = count($arr);
    for($i=1;$i<$len;$i++){
        if ($dp >= 0 ){
            $dp = $dp + $arr[$i];
        }else{
            $dp = $arr[$i];
        }
        if ($max < $dp){
            $max = $dp;
        }
    }
    return $max;
}
$arr = array(0,-1,2,3);
//echo Sum($arr);


/*
    求一个数组中的最长递增子序列的长度
    思路1:也是动态规划的思想，维护一个$dp数组，$dp[$i] 
    表示以$arr[$i]为结尾的最长递增子序列的长度
    思路2:可将目标数组进行大小排序，这样问题可以转换成lcs，即求原数组与排序后数组的最长公共子序列(lcs),其公共子序列即为lis本身
    思路3:动态规划 ＋ 二分查找的方法，其时间复杂度最优  O(NlgN)
 */

function Lis($arr) {
    $len = count($arr);
    $dp["0"] = 1;
    $pre["0"] = -1;
    $max = 1;
    for($i=1;$i<$len;$i++){
        $dp[$i] = 1;
        $pre[$i] = -1;
        for($j=0;$j<$i;$j++){
            if ($dp[$j] + 1 > $dp[$i] && $arr[$j] < $arr[$i]){
                $dp[$i] = $dp[$j] + 1;
                $pre[$i] = $j;
                if ($max < $dp[$i]){
                    $max = $dp[$i];
                }
            }
        }
    }
    print_r($dp);
    print_r($pre);
    echo $max;
}

$arr = array(3,1,2,5,4);
Lis($arr);




