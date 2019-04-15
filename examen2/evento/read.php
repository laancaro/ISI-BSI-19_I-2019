<?php
// Check existence of id parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    // Include config file
    require_once "../config/config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM evento WHERE ID = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["ID"]);
        
        $sql=  mysqli_real_escape_string($link, stripslashes($sql));
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
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
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Algo falló. Intentalo de nuevo";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                        <h1>Ver</h1>
                    </div>
                    <div class="form-group">
                        <label>CODIGO</label>
                        <p class="form-control-static"><?php echo $row["CODIGO"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>NOMBRE</label>
                        <p class="form-control-static"><?php echo $row["NOMBRE"]; ?></p>
                    </div>       
                    <div class="form-group">
                        <label>DESCRIPCION</label>
                        <p class="form-control-static"><?php echo $row["DESCRIPCION"]; ?></p>
                    </div>       
                    <div class="form-group">
                        <label>ESCENARIO</label>
                        <p class="form-control-static"><?php echo $row["ESCENARIO"]; ?></p>
                    </div>       
                    <div class="form-group">
                        <label>FECHA</label>
                        <p class="form-control-static"><?php echo $row["FECHA"]; ?></p>
                    </div>       
                    <div class="form-group">
                        <label>HORA</label>
                        <p class="form-control-static"><?php echo $row["HORA"]; ?></p>
                    </div> 
                    <div class="form-group">
                        <label>TIPO</label>
                        <p class="form-control-static"><?php echo $row["TIPO"]; ?></p>
                    </div> 
                    <div class="form-group">
                        <label>CONDICIONES</label>
                        <p class="form-control-static"><?php echo $row["CONDICIONES"]; ?></p>
                    </div> 
                    <div class="form-group">
                        <label>EDAD</label>
                        <p class="form-control-static"><?php echo $row["EDAD"]; ?></p>
                    </div>                    
                    <p><a href="index.php" class="btn btn-primary">Atrás</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>