<?php
session_start(); // Iniciando sesion
$error=''; // Variable para almacenar el mensaje de error
if (isset($_POST['submit'])) {
if (empty($_POST['nick']) || empty($_POST['pass'])) {
$error = "nick or pass is invalid";
}
else
{
// Estableciendo la conexion a la base de datos
include("config/db.php");//Contienen las variables, el servidor, usuario, contraseña y nombre  de la base de datos
include("config/conexion.php");//Contiene de conexion a la base de datos
include("criptarca.php");//Contiene el archivo para encriptar/desencripta
// Define $nick y $pass
$nick=$_POST['nick'];
$pass=$_POST['pass'];


// Para proteger de Inyecciones SQL 
$nick    = mysqli_real_escape_string($con,(strip_tags($nick,ENT_QUOTES)));
$pass =   encrypt_decrypt('encrypt',$pass);
 
$sql = "SELECT usuario, password FROM usuarios WHERE usuario = '" . $nick . "' and password='".$pass."';";
$query=mysqli_query($con,$sql);
$counter=mysqli_num_rows($query);
if ($counter==1){
		$_SESSION['login_user_sys']=$nick; // Iniciando la sesion
		header("location: profile.php"); // Redireccionando a la pagina profile.php
	 
	
} else {
$error = "El usuario o la contraseña es inválida.";	
}
}
}
?>