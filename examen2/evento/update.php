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
    
    $input_codigo= trim($_POST["codigo"]);
    if(empty($input_codigo)){
        $codigo_err = "Por favor ingrese codigo.";     
    } else{
        $codigo = $input_codigo;
    }

    // Validate nombre
    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese nombre.";     
    } else{
        $nombre = $input_nombre;
    }
        
    // Validate nombre
    $input_descripcion = trim($_POST["descripcion"]);
    if(empty($input_descripcion)){
        $descripcion_err = "Por favor ingrese descripcion.";     
    } else{
        $descripcion = $input_descripcion;
    }
          
    // Validate nombre
    $input_escenario = trim($_POST["escenario"]);
    if(empty($input_escenario)){
        $escenario_err = "Por favor ingrese escenario.";     
    } else{
        $escenario = $input_escenario;
    }
      
    // Validate nombre
    $input_fecha = trim($_POST["fecha"]);
    if(empty($input_fecha)){
        $fecha_err = "Por favor ingrese fecha.";     
    } else{
        $fecha = $input_fecha;
    }

    // Validate nombre
    $input_hora = trim($_POST["hora"]);
    if(empty($input_hora)){
        $hora_err = "Por favor ingrese hora.";     
    } else{
        $hora = $input_hora;
    }
      
    // Validate nombre
    $input_tipo = trim($_POST["tipo"]);
    if(empty($input_tipo)){
        $tipo_err = "Por favor ingrese tipo.";     
    } else{
        $tipo = $input_tipo;
    }

       
    // Validate nombre
    $input_condiciones = trim($_POST["condiciones"]);
    if(empty($input_condiciones)){
        $condiciones_err = "Por favor ingrese condiciones.";     
    } else{
        $condiciones = $input_condiciones;
    }
      
       
    // Validate nombre
    $input_edad = trim($_POST["edad"]);
    if(empty($input_edad)){
        $edad_err = "Por favor ingrese edad.";     
    } else{
        $edad = $input_edad;
    }
    
    
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($direccion_err)){
        // Prepare an update statement
        $sql = "UPDATE evento set CODIGO=?, NOMBRE=?, DESCRIPCION=?, ESCENARIO=?, FECHA=?, HORA=?, TIPO=?, CONDICIONES=?, EDAD=? WHERE ID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssissisii", $param_codigo, $param_nombre, $param_descripcion, $param_escenario, $param_fecha, $param_hora, $param_tipo, $param_condiciones, $param_edad,$param_ID);
            
            // Set parameters
            $param_codigo = $codigo;
            $param_nombre = $nombre;
            $param_descripcion = $descripcion;
            $param_escenario = $escenario;
            $param_fecha = $fecha;
            $param_hora = $hora;
            $param_tipo = $tipo;
            $param_condiciones = $condiciones;
            $param_edad = $edad;
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
        $sql = "SELECT * FROM evento WHERE ID = ?";
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
                    $codigo = $row["CODIGO"];
                    $nombre = $row["NOMBRE"];
                    $descripcion = $row["DESCRIPCION"];
                    $escenario = $row["ESCENARIO"];
                    $fecha = $row["FECHA"];
                    $hora = $row["HORA"];
                    $tipo = $row["TIPO"];
                    $condiciones = $row["CONDICIONES"];
                    $edad = $row["EDAD"];
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
                    <div class="form-group <?php echo (!empty($codigo_err)) ? 'has-error' : ''; ?>">
                            <label>Codigo</label>
                            <input type="text" maxlength="5" name="codigo" class="form-control" value="<?php echo $codigo; ?>">
                            <span class="help-block"><?php echo $codigo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="nombre"  maxlength="200" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($descripcion_err)) ? 'has-error' : ''; ?>">
                        <label>Descripcion</label>
                        <textarea id="editor" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                        <?php echo $descripcion; ?>
                        </textarea>
                        <span class="help-block"><?php echo $descripcion_err;?></span>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                $("#editor").editor({
                                    uiLibrary: 'bootstrap4'
                                });
                            });
                        </script>

                        <div class="form-group <?php echo (!empty($escenario_err)) ? 'has-error' : ''; ?>">
                            <label>Escenario</label>
                            <select name="escenario" id="escenarios" class="form-control" >
                            <?php
                                $mysqli = new mysqli('localhost', 'root', '', 'examen2');
                                $query = $mysqli -> query ("SELECT * FROM escenario");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores[ID].'">'.$valores[NOMBRE].'</option>';
                                }
                                ?>
                            </select>
                            <script> $("#escenarios").val(<?php echo $escenario; ?>); </script>
                            <span class="help-block"><?php echo $escenario_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($fecha_err)) ? 'has-error' : ''; ?>">
                            <label>Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="<?php echo $fecha; ?>">
                            <span class="help-block"><?php echo $fecha_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($hora_err)) ? 'has-error' : ''; ?>">
                            <label>Hora</label>
                            <input type="time" name="hora" class="form-control" value="<?php echo $hora; ?>">
                            <span class="help-block"><?php echo $hora_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo</label>
                            <select name="tipo" id="tipos" class="form-control" >
                            <option value="1" >Musical</option>
                            <option value="2">Futbol</option>
                            <option value="3">Relgioso</option> 
                            <option value="4">Gobierno</option>                                                     
                        </select>
                        <script> $("#tipos").val(<?php echo $tipo; ?>); </script>
                            <span class="help-block"><?php echo $tipo_err;?></span>
                        </div>      

                        <div class="form-group <?php echo (!empty($condiciones_err)) ? 'has-error' : ''; ?>">
                            <label>Condiciones</label>
                            <input type="text" name="condiciones" class="form-control" value="<?php echo $condiciones; ?>">
                            <span class="help-block"><?php echo $condiciones_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($edad_err)) ? 'has-error' : ''; ?>">
                            <label>Limite Edad</label>
                            <input type="number" name="edad" class="form-control" value="<?php echo $edad; ?>">
                            <span class="help-block"><?php echo $edad_err;?></span>
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