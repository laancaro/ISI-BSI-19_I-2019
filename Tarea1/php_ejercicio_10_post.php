<?php
$texto = $_POST['texto'];
echo("texto plano= $texto");
echo "<br>"; 
$area_texto = $_POST['area_texto'];
echo("Area de texto= $area_texto");
echo "<br>"; 
$combo = $_POST['combo'];
echo("Combo= $combo");
echo "<br>"; 
$estado_civil = $_POST['estado_civil'];
echo("Radio= $estado_civil");
echo "<br>"; 
if (isset($_POST['terminos'])) {
  $terminos = "SI";
} else {
  $terminos = "NO ";
}
echo("Checkbox=$terminos");
echo "<br>"; 
$distancia = $_POST['distancia'];
echo("Rango= $distancia");


?>