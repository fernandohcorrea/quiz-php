<?php
$numbers = array(1,2,3);
$letters = array("A","B","C");
foreach ($numbers as $num){
  foreach ($letters as $char){
    if ($char == "C") {
      break 1; 
    }
    echo $char;
  }
  echo $num;
}