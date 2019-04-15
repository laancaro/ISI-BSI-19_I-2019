<?php
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with empty values
$id= $evento = $escenario = $ubicacion = $costo_unitario = $costo_servicio = $espacios = "";
$id_err= $evento_err = $escenario_err = $ubicacion_err = $costo_unitario_err = $costo_servicio_err = $espacios_err = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate evento
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
    if(empty($escenario_err) && empty($evento_err)){
        // Prepare an insert statement
        $sql = "CALL proc_inserta_entrada (?,?,?,?);";

        if($stmt = mysqli_prepare($link, $sql)){
           
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isii", $param_evento, $param_ubicacion, $param_costo_unitario,  $param_espacios );
            
            // Set parameters
            $param_evento = $evento;          
            $param_ubicacion = $ubicacion;
            $param_costo_unitario = $costo_unitario;
            $param_espacios = $espacios;

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
<script src="https://code.jquery.com/jquery-3.4.0.js"></script>

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
                    <div class="form-group <?php echo (!empty($evento_err)) ? 'has-error' : ''; ?>">
                            <label>Evento</label>
                            <select name="evento" id="eventos" class="form-control" onchange="fetch_select(this.value);">
                            <?php
                                $mysqli = new mysqli('localhost', 'root', '', 'examen2');
                                $query = $mysqli -> query ("SELECT * FROM evento");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores[ID].'">'.$valores[NOMBRE].'</option>';
                                }
                                ?>
                            </select>                            
                            <span class="help-block"><?php echo $evento_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($ubicacion_err)) ? 'has-error' : ''; ?>">
                            <label>Ubicacion</label>
                            <input type="text" maxlength="50"  name="ubicacion" class="form-control" value="<?php echo $ubicacion; ?>">
                            <span class="help-block"><?php echo $ubicacion_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($costo_unitario_err)) ? 'has-error' : ''; ?>">
                            <label>Costo Unitario</label>
                            <input type="number" min="0" name="costo_unitario" class="form-control" value="<?php echo $costo_unitario; ?>">
                            <span class="help-block"><?php echo $costo_unitario_err;?></span>
                        </div>
                     
                        <div class="form-group <?php echo (!empty($espacios_err)) ? 'has-error' : ''; ?>">
                            <label>Espacios</label>
                            <input type="number" min="0" name="espacios" class="form-control" value="<?php echo $espacios; ?>">
                            <span class="help-block"><?php echo $espacios_err;?></span>
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