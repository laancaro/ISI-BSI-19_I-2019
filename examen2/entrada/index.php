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
                    
                        <h2 class="pull-left">Catálogo de Entradas</h2>
                        <br>
                        
                        <a href="create.php" class="btn btn-success pull-right">Agregar</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../config/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT a.ID, EVENTO, b.NOMBRE AS NOM_EVENTO, a.ESCENARIO,c.NOMBRE As NOM_ESCENARIO,UBICACION, COSTO_UNITARIO, COSTO_SERVICIO, ESPACIOS FROM entrada a join evento b on a.EVENTO=b.ID join escenario c on a.ESCENARIO=c.ID";
                    $sql=  mysqli_real_escape_string($link, stripslashes($sql));
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";                                                                               
                                        echo "<th>EVENTO</th>";                                        
                                        echo "<th>ESCENARIO</th>";                                        
                                        echo "<th>UBICACION</th>";                                        
                                        echo "<th>COSTO UNITARIO</th>";                                        
                                        echo "<th>COSTO SERVICIO</th>";                                        
                                        echo "<th>ESPACIOS</th>";                                        
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID'] . "</td>";                                        
                                        echo "<td>" . $row['NOM_EVENTO'] . "</td>";                                            
                                        echo "<td>" . $row['NOM_ESCENARIO'] . "</td>";    
                                        echo "<td>" . $row['UBICACION'] . "</td>";    
                                        echo "<td>" . $row['COSTO_UNITARIO'] . "</td>";    
                                        echo "<td>" . $row['COSTO_SERVICIO'] . "</td>";    
                                        echo "<td>" . $row['ESPACIOS'] . "</td>";                                        
                                        echo "<td>";
                                            echo "<a href='read.php?ID=". $row['ID'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?ID=". $row['ID'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?ID=". $row['ID'] ."' title='Eliminar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
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
                    echo "<a href='../welcome.php' class='btn btn-warning pull-right'>Volver</a>";
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>