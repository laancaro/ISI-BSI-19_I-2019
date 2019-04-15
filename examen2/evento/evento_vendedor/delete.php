<?php
// Process delete operation after confirmation
if(isset($_POST["evento"]) && !empty($_POST["evento"])){
    // Include config file
    require_once "../../config/config.php";
    require_once "../../config/roles.php";
    
    // Prepare a delete statement
    $sql = "DELETE FROM evento_vendedor WHERE EVENTO = ? and VENDEDOR=?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ii", $param_evento,$param_vendedor);
        
        // Set parameters
        $param_evento = trim($_POST["evento"]);
        $param_vendedor = trim($_POST["vendedor"]);
        
        $sql=  mysqli_real_escape_string($link, stripslashes($sql));
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["EVENTO"]))){
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
                        <h1>Eliminación de Registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="evento" value="<?php echo trim($_GET["EVENTO"]); ?>"/>
                            <input type="hidden" name="vendedor" value="<?php echo trim($_GET["VENDEDOR"]); ?>"/>
                            <p>Está seguro de borrar el registro?</p><br>
                            <p>
                                <input type="submit" value="Sí" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>