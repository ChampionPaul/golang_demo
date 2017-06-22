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
