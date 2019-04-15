<?php
// Include config file
require_once "../config/config.php";
require_once "../config/roles.php";
// Define variables and initialize with empty values
$id= $cedula = $nombre = $direccion = $email = $telefono = $horario = "";
$id_err= $cedula_err= $nombre_err=$direccion_err=$email_err= $telefono_err=$horario_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    // Get hIDden input value
    $ID = $_POST["ID"];
    
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
    if(empty($nombre_err) && empty($direccion_err)){
        // Prepare an update statement
        $sql = "UPDATE vendedor SET cedula=?, nombre=?, direccion=?, email=?, telefono=?, horario=? WHERE ID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssssi", $param_cedula, $param_nombre, $param_direccion, $param_email, $param_telefono, $param_horario,$param_ID );
            
            // Set parameters
            $param_cedula = $cedula;
            $param_nombre = $nombre;
            $param_direccion = $direccion;
            $param_email = $email;
            $param_telefono = $telefono;
            $param_horario = $horario;
            $param_ID = $ID;
            
            $sql=  mysqli_real_escape_string($link, stripslashes($sql));
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){                
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Algo falló. Intenta de nuevo.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of ID parameter before processing further
    if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
        // Get URL parameter
        $ID =  trim($_GET["ID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM vendedor WHERE ID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_ID);
            
            // Set parameters
            $param_ID = $ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve indivIDual field value
                    $cedula = $row["CEDULA"];
                    $nombre = $row["NOMBRE"];
                    $direccion = $row["DIRECCION"];
                    $email = $row["EMAIL"];
                    $telefono = $row["TELEFONO"];
                    $horario = $row["HORARIO"];
                } else{
                    // URL doesn't contain valID ID. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Algo falló. Intenta de nuevo.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain ID parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            wIDth: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluID">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Actualizar Registro</h2>
                    </div>
                    <p>Actualice los campos deseados</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($cedula_err)) ? 'has-error' : ''; ?>">
                            <label>Cedula</label>
                            <input type="number" name="cedula" minlength="10" maxlength="10" class="form-control" value="<?php echo $cedula; ?>">
                            <span class="help-block"><?php echo $cedula_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" maxlength="100"  name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Direccion</label>
                            <input type="text" maxlength="300"  name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono</label>
                            <input type="number" maxlength="8"  minlength="8"  name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                            <span class="help-block"><?php echo $telefono_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($horario_err)) ? 'has-error' : ''; ?>">
                            <label>Horario</label>
                            <select name="horario" class="form-control" >
                            <option <?php if ($horario == "1" ) echo 'selected ' ; ?> value="1" >Mañana</option>
                            <option <?php if ($horario == "2" ) echo 'selected ' ; ?> value="2">Tarde</option>
                            <option <?php if ($horario == "3" ) echo 'selected ' ; ?> value="3">Noche</option>                            
                        </select>     
                            <span class="help-block"><?php echo $tipo_err;?></span>
                        </div>                        
                            <span class="help-block"><?php echo $horario_err;?></span>
                        </div>                   
                        <input type="hIdden" name="ID" value="<?php echo $ID; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>