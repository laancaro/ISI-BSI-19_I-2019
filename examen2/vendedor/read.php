<?php
// Check existence of id parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    // Include config file
    require_once "../config/config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM vendedor WHERE ID = ?";
    
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
                $cedula = $row["CEDULA"];
                $nombre = $row["NOMBRE"];
                $direccion = $row["DIRECCION"];
                $email = $row["EMAIL"];
                $telefono = $row["TELEFONO"];
                $telefono = $row["HORARIO"];
                
                               
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
                        <label>CEDULA</label>
                        <p class="form-control-static"><?php echo $row["CEDULA"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>NOMBRE</label>
                        <p class="form-control-static"><?php echo $row["NOMBRE"]; ?></p>
                    </div>       
                    <div class="form-group">
                        <label>DIRECCION</label>
                        <p class="form-control-static"><?php echo $row["DIRECCION"]; ?></p>
                    </div>       
                    <div class="form-group">
                        <label>EMAIL</label>
                        <p class="form-control-static"><?php echo $row["EMAIL"]; ?></p>
                    </div>       
                    <div class="form-group">
                        <label>TELEFONO</label>
                        <p class="form-control-static"><?php echo $row["TELEFONO"]; ?></p>
                    </div>       
                    <div class="form-group">
                        <label>HORARIO</label>
                        <p class="form-control-static"><?php echo $row["HORARIO"]; ?></p>
                    </div>                    
                    <p><a href="index.php" class="btn btn-primary">Atrás</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>