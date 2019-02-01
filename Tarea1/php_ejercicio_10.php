<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<form action ="php_ejercicio_10_post.php" method ="POST" >  

<div>
<input type="text"  name="texto"/>
</div>

<div>
<textarea rows="3" name="area_texto">
Area de texto de tres lineas
</textarea>
</div>
<div>
<select name="combo" >
  <option value="norte">norte</option>
  <option value="sur">sur</option>
  <option value="este">este</option>
  <option value="oeste">oeste</option>
</select>
</div>
<div>
<input type="radio" name="estado_civil" value="soltero" checked> soltero<br>
<input type="radio" name="estado_civil" value="casado"> casado<br>
<input type="radio" name="estado_civil" value="otro"> otro

</div>

<div>
  <input type="checkbox" name="terminos" value="SI" >Acepta Terminos y Condiciones<br>
</div>
<div>
<button type="button">Esto es un botón</button>
</div>
<div>
<input type="range" name="distancia" min="0" max="100">
</div>

<input type="submit" value="enviar_datos">

</form>



</body>
</html>