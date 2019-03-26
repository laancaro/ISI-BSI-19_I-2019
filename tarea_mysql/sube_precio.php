<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$editorial = $aumento = "";
$editorial_err = $aumento_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    

    $input_editorial = trim($_POST["editorial"]);
    if(empty($input_editorial)){
        $editorial_err = "Please enter an editorial.";     
    } else{
        $editorial = $input_editorial;
    }

    $input_aumento = trim($_POST["aumento"]);
    if(empty($input_aumento)){
        $aumento_err = "Please enter the aumento.";     
    } elseif(!ctype_digit($input_aumento)){
        $aumento_err = "Please enter a positive integer value.";
    } else{
        $aumento = $input_aumento;
    }
    
    // Check input errors before inserting in database
    if(empty($editorial_err) && empty($aumento_err)){
        // Prepare an insert statement
        $sql = "CALL proc_aumenta_precio (?, ?);";
        
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_editorial,$param_aumento);
            
            // Set parameters
            $param_editorial = $editorial;
            $param_aumento = $aumento;
            
           
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Aumento de Precio</title>
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
                        <h2>Aumento Precio</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   
                        <div class="form-group <?php echo (!empty($editorial_err)) ? 'has-error' : ''; ?>">
                            <label>editorial</label>
                            <input type="text" name="editorial" class="form-control" value="<?php echo $editorial; ?>">
                            <span class="help-block"><?php echo $editorial_err;?></span>
                        </div>                        
                        <div class="form-group <?php echo (!empty($aumento_err)) ? 'has-error' : ''; ?>">
                            <label>aumento</label>
                            <input type="number" name="aumento" class="form-control" value="<?php echo $aumento; ?>">
                            <span class="help-block"><?php echo $aumento_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>                       
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>