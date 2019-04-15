<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query =  "SELECT a.ID, EVENTO, b.NOMBRE AS NOM_EVENTO, a.ESCENARIO,c.NOMBRE As NOM_ESCENARIO,UBICACION, COSTO_UNITARIO, COSTO_SERVICIO, ESPACIOS FROM entrada a join evento b on a.EVENTO=b.ID join escenario c on a.ESCENARIO=c.ID WHERE a.EVENTO = ".$valueToSearch."";    
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT a.ID, EVENTO, b.NOMBRE AS NOM_EVENTO, a.ESCENARIO,c.NOMBRE As NOM_ESCENARIO,UBICACION, COSTO_UNITARIO, COSTO_SERVICIO, ESPACIOS FROM entrada a join evento b on a.EVENTO=b.ID join escenario c on a.ESCENARIO=c.ID";
    $search_result = filterTable($query);
}
// function to connect and execute the query
function filterTable($query)
{
    require_once "../config/config.php";
    $filter_Result = mysqli_query($link, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Reporte de Empleados</title>
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
                        <h2>Listado Entradas x Evento</h2>
                    </div>
        <form action="rep_entradas_evento.php" method="post">
                   
        <label>Evento</label>
            <select name="valueToSearch" id="eventos" class="form-control">
            <?php
                $mysqli = new mysqli('localhost', 'root', '', 'examen2');
                $query = $mysqli -> query ("SELECT * FROM evento");
                while ($valores = mysqli_fetch_array($query)) {
                    echo '<option value="'.$valores[ID].'">'.$valores[NOMBRE].'</option>';
                }
                ?>
            </select>      
            <input type="submit" name="search" value="Buscar"><br><br>
            
            <table class='table table-bordered table-striped'>
                <tr>
                    <th>Id</th>
                    <th>Evento</th>
                    <th>Escenario</th>
                    <th>Ubicación</th>
                    <th>Costo Unitario</th>
                    <th>Costo Servicios</th>
                    <th>Espacios</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['ID'];?></td>
                    <td><?php echo $row['NOM_EVENTO'];?></td>
                    <td><?php echo $row['NOM_ESCENARIO'];?></td>
                    <td><?php echo $row['UBICACION'];?></td>
                    <td><?php echo $row['COSTO_UNITARIO'];?></td>
                    <td><?php echo $row['COSTO_SERVICIO'];?></td>
                    <td><?php echo $row['ESPACIOS'];?></td>                    
                </tr>
                <?php endwhile;?>
            </table><br>
            <a href='index.php' class='btn btn-warning pull-right'>Volver</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>