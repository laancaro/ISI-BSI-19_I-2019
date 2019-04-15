<?php
// Include config file
require_once "../examen2/config/config.php";
require_once "criptarca.php";
// Define variables and initialize with empty values
$nombre =$email =$telefono =$nick = $password = $confirm_password = "";
$nombre_err =$email_err =$telefono_err =$nick_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate nick
    if(empty(trim($_POST["nick"]))){
        $nick_err = "Por favor ingrese el usuario.";
    } else{
        // Prepare a select statement
        $sql = "SELECT ID FROM usuario WHERE nick = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_nick);
            
            // Set parameters
            $param_nick = trim($_POST["nick"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $nick_err = "Este usuario ya existe.";
                } else{
                    $nick = trim($_POST["nick"]);
                }
            } else{
                echo "Oops! Ha ocurrido un error.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate nombre
    if(empty(trim($_POST["nombre"]))){
        $nombre_err = "Ingresa el nombre.";     
    } else{
        $nombre = trim($_POST["nombre"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Ingresa el email.";     
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Validate telefono
    if(empty(trim($_POST["telefono"]))){
        $telefono_err = "Ingresa el telefono.";     
    } else{
        $telefono = trim($_POST["telefono"]);
    }

    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña debe tener al menos 6 carácteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Ingresa una contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "La contraseña no es la misma.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($nick_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO usuario (nombre, email, telefono, nick, password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiss",$param_nombre,$param_email,$param_telefono, $param_nick, $param_password);
            
            // Set parameters
            $param_nombre = $nombre;           
            $param_email = $email;
            $param_telefono = $telefono;        
            $param_nick = $nick;
            $param_password = cifrar($password); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Ha ocurrido un error.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Registro</h2>
        <p>Llena los datos para crear tu cuenta.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                <label>Nombre Completo</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                <span class="help-block"><?php echo $nombre_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                <label>Telefono</label>
                <input type="number" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                <span class="help-block"><?php echo $telefono_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($nick_err)) ? 'has-error' : ''; ?>">
                <label>Nick</label>
                <input type="text" name="nick" class="form-control" value="<?php echo $nick; ?>">
                <span class="help-block"><?php echo $nick_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Repite tu contraseña</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Crear">                   
                <a class="btn" href="..\examen2\login.php">Volver</a>                                                                        
            </div>
            <p>Ya tienes una cuenta? <a href="login.php">Ingresa acá</a>.</p>
        </form>
    </div>    
</body>
</html>