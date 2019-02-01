<?php


// get the q parameter from URL
$a = $_REQUEST["a"];
$b = $_REQUEST["b"];
$c = $_REQUEST["c"];


$hint = 0;


switch ($c) {
    case "suma":
    $hint = $a+$b;
      break;
    case "resta":
    $hint = $a-$b;
      break;
    case "multi":
    $hint = $a*$b;
      break;
    case "division":
    $hint = $a/$b;
      break;
}
 
echo $hint === "" ? "No es un operador válido" : $hint;
?>