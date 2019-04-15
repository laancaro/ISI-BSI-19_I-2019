<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query =  "SELECT A.*,b.NOMBRE AS NOM_ESCENARIO FROM evento a join escenario b on a.ESCENARIO=b.ID WHERE MONTH(a.FECHA) = ".$valueToSearch."";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT A.*,b.NOMBRE AS NOM_ESCENARIO FROM evento a join escenario b on a.ESCENARIO=b.ID";
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
                        <h2>Listado Eventos por Mes</h2>
                    </div>
        <form action="rep_eventos_mes.php" method="post">
                   
            <label>Mes</label>
                <select name="valueToSearch" class="form-control" >
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>     
                <option value="4">Abril</option>     
                <option value="5">Mayo</option>     
                <option value="6">Junio</option>     
                <option value="7">Julio</option>     
                <option value="8">Agosto</option>     
                <option value="9">Septiembre</option>     
                <option value="10">Octubre</option>                                                     
                <option value="11">Noviembre</option>     
                <option value="12">Diciembre</option>     
        </select>
            <input type="submit" name="search" value="Buscar"><br><br>
            
            <table class='table table-bordered table-striped'>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Escenario</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Condiciones</th>
                    <th>Limite Edad</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['ID'];?></td>
                    <td><?php echo $row['NOMBRE'];?></td>
                    <td><?php echo $row['NOM_ESCENARIO'];?></td>
                    <td><?php echo $row['FECHA'];?></td>
                    <td><?php echo $row['HORA'];?></td>
                    <td><?php echo $row['CONDICIONES'];?></td>
                    <td><?php echo $row['EDAD'];?></td>                    
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