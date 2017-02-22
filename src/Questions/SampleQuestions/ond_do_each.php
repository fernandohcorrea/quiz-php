<?php
function 1DoEach($c){
    if($c > 0){
         1DoEach(--$c);
         echo '/';
    } else {
        return $c
    }
}

1DoEach(4);