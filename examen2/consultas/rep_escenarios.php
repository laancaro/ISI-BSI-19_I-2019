<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Inicio</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<br><h4></h4>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                    
                        <h2 class="pull-left">Listado de Escenarios</h2>
                        <br>                        
                    </div>
                    <?php
                    // Include config file
                    require_once "../config/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM escenario";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Código</th>";
                                        echo "<th>Nombre</th>";    
                                        echo "<th>Dirección</th>";                                       
                                        echo "<th>Nombre Contacto</th>";
                                        echo "<th>Telefono</th>";
                                        echo "<th>Email</th>";                                        
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID'] . "</td>";
                                        echo "<td>" . $row['CODIGO'] . "</td>";
                                        echo "<td>" . $row['NOMBRE'] . "</td>";  
                                        echo "<td>" . $row['DIRECCION'] . "</td>";                                        
                                        echo "<td>" . $row['NOMBRE_CONTACTO'] . "</td>";                                                                          
                                        echo "<td>" . $row['TELEFONO_CONTACTO'] . "</td>";                                                                          
                                        echo "<td>" . $row['EMAIL_CONTACTO'] . "</td>";                                                                          
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No hay registros para mostrar.</em></p>";
                        }
                    } else{
                        echo "ERROR: No se puedo ejecutar la consulta a la BD $sql. " . mysqli_error($link);
                    }
                    echo "<a href='index.php' class='btn btn-warning pull-right'>Volver</a>";
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>