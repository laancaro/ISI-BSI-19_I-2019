<?php
// Include config file
require_once "../config/config.php";
require_once "../config/roles.php";
 
// Define variables and initialize with empty values
$id= $cedula = $nombre = $direccion = $email = $telefono = $horario = "";
$id_err= $cedula_err= $nombre_err=$direccion_err=$email_err= $telefono_err=$horario_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate cedula
    $input_cedula = trim($_POST["cedula"]);
    if(empty($input_cedula)){
        $cedula_err = "Por favor ingrese cedula.";     
    } else{
        $cedula = $input_cedula;
    }

    // Validate nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese nombre.";     
    } else{
        $nombre = $input_nombre;
    }
        
    // Validate direccion
    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Por favor ingrese direccion.";     
    } else{
        $direccion = $input_direccion;
    }

     // Validate email
     $input_email = trim($_POST["email"]);
     if(empty($input_email)){
         $email_err = "Por favor ingrese email.";     
     } else{
         $email = $input_email;
     }

     // Validate telefono
     $input_telefono = trim($_POST["telefono"]);
     if(empty($input_telefono)){
         $telefono_err = "Por favor ingrese telefono.";     
     } else{
         $telefono = $input_telefono;
     }
     
      // Validate horario
      $input_horario = trim($_POST["horario"]);
      if(empty($input_horario)){
          $horario_err = "Por favor ingrese horario.";     
      } else{
          $horario = $input_horario;
      }
    
    
    
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($identificacion_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO vendedor (cedula, nombre, direccion, email, telefono, horario) VALUES (?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssss", $param_cedula, $param_nombre, $param_direccion, $param_email, $param_telefono, $param_horario );
            
            // Set parameters
            $param_cedula = $cedula;
            $param_nombre = $nombre;
            $param_direccion = $direccion;
            $param_email = $email;
            $param_telefono = $telefono;
            $param_horario = $horario;

            $sql=  mysqli_real_escape_string($link, stripslashes($sql));
                              
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Hubo un problema. Vuelva a intentar.";
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
    <title>Crear un registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Crear un registro</h2>
                    </div>
                    <p>Por favor complete el formulario con los campos solicitados.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($cedula_err)) ? 'has-error' : ''; ?>">
                            <label>Cedula Juridica</label>
                            <input type="number" name="cedula" minlength=10 maxlength=10 class="form-control" value="<?php echo $cedula; ?>">
                            <span class="help-block"><?php echo $cedula_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" maxlength=100  name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion</label>
                            <input type="text" maxlength=300  name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="email" maxlength=255  name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono</label>
                            <input type="number"  maxlength=8  minlength=8 name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>
                                            
                        <div class="form-group <?php echo (!empty($horario_err)) ? 'has-error' : ''; ?>">
                            <label>Horario</label>
                            <select name="horario" class="form-control" >
                            <option value="1" >Mañana</option>
                            <option value="2">Tarde</option>
                            <option value="3">Noche</option>                                                     
                        </select>
                            <span class="help-block"><?php echo $horario_err;?></span>
                        </div>                                                            
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>