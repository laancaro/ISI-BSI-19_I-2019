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
                    
                        <h2 class="pull-left">Catálogo de Vendedores x Eventos</h2>
                        <br>
                        <?php     
                         $evento= $_GET["ID"];                         
                        ?>
                        <a href="create.php?ID=<?php echo $evento; ?>" class="btn btn-success pull-right">Agregar</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "../../config/config.php";
                   

                    if(isset($_GET["ID"]) && !empty($_GET["ID"])){
                    $sql = "SELECT a.EVENTO, b.NOMBRE as NOM_EVENTO, a.VENDEDOR,c.NOMBRE as NOM_VENDEDOR FROM evento_vendedor a join evento b on a.EVENTO=b.ID join vendedor c on a.VENDEDOR=c.ID where EVENTO=".$evento;
                    }else{
                        header("location: ../");
                        exit();
                    }
                
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID_Evento</th>";
                                        echo "<th>Evento</th>";
                                        echo "<th>ID_Vendedor</th>";
                                        echo "<th>Vendedor</th>";                                        
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['EVENTO'] . "</td>";
                                        echo "<td>" . $row['NOM_EVENTO'] . "</td>";
                                        echo "<td>" . $row['VENDEDOR'] . "</td>"; 
                                        echo "<td>" . $row['NOM_VENDEDOR'] . "</td>";                                         
                                        echo "<td>";                                            
                                            echo "<a href='delete.php?EVENTO=". $evento ."&VENDEDOR=". $row['VENDEDOR'] ."' title='Eliminar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
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
                    echo "<a href='../' class='btn btn-warning pull-right'>Volver</a>";
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>