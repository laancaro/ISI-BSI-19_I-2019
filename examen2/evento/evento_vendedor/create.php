<?php
// Include config file
require_once "../../config/config.php";
require_once "../../config/roles.php";
// Define variables and initialize with empty values
$ID= $evento = $vendedor= "";
$ID= $evento_err = $vendedor_err= "";

 
// Processing form data when form is submitted
if(isset($_GET["ID"]) && !empty($_GET["ID"])){
    // Get hIDden input value
    $ID = $_GET["ID"];
    $evento = $_GET["ID"];
    
    $input_vendedor= trim($_POST["vendedor"]);
    if(empty($input_vendedor)){
        $vendedor_err = "Por favor ingrese vendedor.";     
    } else{
        $vendedor = $input_vendedor;
    }


    
    // Check input errors before inserting in database
    if(empty($vendedor_err)){
        // Prepare an update statement
        $sql = "insert into evento_vendedor values(?,?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_evento, $param_vendedor);
            
            // Set parameters
            $param_evento = $evento;
            $param_vendedor = $vendedor;           
            
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
        $sql = "SELECT * FROM evento_vendedor WHERE evento = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_ID);
            
            // Set parameters
            $param_ID = $ID;
            $sql=  mysqli_real_escape_string($link, stripslashes($sql));
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve indivIDual field value
                    $evento = $row["EVENTO"];
                    $vendedor = $row["VENDEDOR"];
                   
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
                            <input type="text" name="Evento" readonly class="form-control" value="<?php echo $evento; ?>">
                            <span class="help-block"><?php echo $evento_err;?></span>
                        </div>                           
    
                        <div class="form-group <?php echo (!empty($vendedor_err)) ? 'has-error' : ''; ?>">
                            <label>Vendedor</label>
                            <select name="vendedor" id="vendedores" class="form-control" >
                            <?php
                                $mysqli = new mysqli('localhost', 'root', '', 'examen2');
                                $query = $mysqli -> query ("SELECT * FROM vendedor");
                                while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores[ID].'">'.$valores[NOMBRE].'</option>';
                                }
                                ?>
                            </select>                            
                            <span class="help-block"><?php echo $escenario_err;?></span>
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