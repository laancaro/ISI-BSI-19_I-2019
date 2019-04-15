<?php
// Initialize the session
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
  exit;
}
 
// Include config file
require_once "../examen2/config/config.php";
require_once "criptarca.php";
 
// Define variables and initialize with empty values
$nick = $password = "";
$nick_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if nick is empty
    if(empty(trim($_POST["nick"]))){
        $nick_err = "Ingresa tu nick.";
    } else{ 
        $nick = trim($_POST["nick"]);
        $nick=  mysqli_real_escape_string($link,(strip_tags($nick,ENT_QUOTES)));
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Ingresa tu password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($nick_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT ID, nick, password FROM usuario WHERE nick = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_nick);
            
            // Set parameters
            $param_nick = $nick;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if nick exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $nick, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){						
                        if(cifrar($password)== $hashed_password ){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nick"] = $nick;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "La contraseña ingresada no es correcta.";
                        }
                    }
                } else{
                    // Display an error message if nick doesn't exist
                    $nick_err = "No existe una cuenta con este nick. Crea una nueva cuenta.";
                }
            } else{
                echo "Oops! Ha ocurrido un error.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Por favor ingresa tus datos.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($nick_err)) ? 'has-error' : ''; ?>">
                <label>Nick</label>
                <input type="text" name="nick" class="form-control" value="<?php echo $nick; ?>">
                <span class="help-block"><?php echo $nick_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
            </div>
            <p>No tienes una cuenta? <a href="register.php">Crea una nueva</a>.</p>
        </form>
    </div>    
</body>
</html>