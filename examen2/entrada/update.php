<?php
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with empty values
$id= $evento = $escenario = $ubicacion = $costo_unitario = $costo_servicio = $espacios = "";
$id_err= $evento_err = $escenario_err = $ubicacion_err = $costo_unitario_err = $costo_servicio_err = $espacios_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    // Get hIDden input value
    $ID = $_POST["ID"];
    
    $input_evento = trim($_POST["evento"]);
    if(empty($input_evento)){
        $evento_err = "Por favor ingrese evento.";     
    } else{
        $evento = $input_evento;
    }

    // Validate ubicacion
    $input_ubicacion = trim($_POST["ubicacion"]);
    if(empty($input_ubicacion)){
        $ubicacion_err = "Por favor ingrese ubicacion.";     
    } else{
        $ubicacion = $input_ubicacion;
    }

     // Validate costo_unitario
     $input_costo_unitario = trim($_POST["costo_unitario"]);
     if(empty($input_costo_unitario)){
         $costo_unitario_err = "Por favor ingrese costo_unitario.";     
     } else{
         $costo_unitario = $input_costo_unitario;
     }

      // Validate espacios
      $input_espacios = trim($_POST["espacios"]);
      if(empty($input_espacios)){
          $espacios_err = "Por favor ingrese espacios.";     
      } else{
          $espacios = $input_espacios;
      }
    
    
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($direccion_err)){
        // Prepare an update statement
        $sql = "CALL proc_edita_entrada (?,?,?,?,?);";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
           // Bind variables to the prepared statement as parameters
           mysqli_stmt_bind_param($stmt, "isiii", $param_evento, $param_ubicacion, $param_costo_unitario,  $param_espacios, $param_ID );
            
           // Set parameters
           $param_evento = $evento;          
           $param_ubicacion = $ubicacion;
           $param_costo_unitario = $costo_unitario;
           $param_espacios = $espacios;
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
        $sql = "SELECT * FROM entrada  WHERE ID = ?";
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
                    $evento = $row["EVENTO"];
                    $escenario = $row["ESCENARIO"];
                    $ubicacion = $row["UBICACION"];
                    $costo_unitario = $row["COSTO_UNITARIO"];
                    $costo_servicio = $row["COSTO_SERVICIO"];
                    $espacios = $row["ESPACIOS"];
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
<script src="https://code.jquery.com/jquery-3.4.0.js"></script>

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
                    <div class="form-group <?php echo (!empty($evento_err)) ? 'has-error' : ''; ?>">
                            <label>Evento</label>
                            <select name="evento" id="eventos" class="form-control">
                            <?php
                                $mysqli = new mysqli('localhost', 'root', '', 'examen2');
                                $query = $mysqli -> query ("SELECT * FROM evento");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores[ID].'">'.$valores[NOMBRE].'</option>';
                                }
                                ?>
                            </select>   
                            <script> $("#eventos").val(<?php echo $evento; ?>);  $('#eventos').prop('disabled', 'disabled');</script>                         
                            <span class="help-block"><?php echo $evento_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($ubicacion_err)) ? 'has-error' : ''; ?>">
                            <label>Ubicacion</label>
                            <input type="text"  maxlength="50"  name="ubicacion" class="form-control" value="<?php echo $ubicacion; ?>">
                            <span class="help-block"><?php echo $ubicacion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($costo_unitario_err)) ? 'has-error' : ''; ?>">
                            <label>Costo Unitario</label>
                            <input type="number" min="0" name="costo_unitario" class="form-control" value="<?php echo $costo_unitario; ?>">
                            <span class="help-block"><?php echo $costo_unitario_err;?></span>
                        </div>
                     
                        <div class="form-group <?php echo (!empty($espacios_err)) ? 'has-error' : ''; ?>">
                            <label>Espacios</label>
                            <input type="number" min="0"   name="espacios" class="form-control" value="<?php echo $espacios; ?>">
                            <span class="help-block"><?php echo $espacios_err;?></span>
                        </div>                          
                        <input type="hidden" name="ID" value="<?php echo $ID; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>