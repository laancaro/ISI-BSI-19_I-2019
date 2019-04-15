<?php
// Include config file
require_once "../config/config.php";
require_once "../config/roles.php";
// Define variables and initialize with empty values
$id= $codigo = $nombre = $tipo = $provincia = $canton = $distrito =$direccion =$nombre_contacto =$telefono_contacto =$email_contacto = "";
$id_err= $codigo_err = $nombre_err = $tipo_err = $provincia_err = $canton_err = $distrito_err =$direccion_err=$nombre_contacto_err =$telefono_contacto_err =$email_contacto_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    // Get hIDden input value
    $ID = $_POST["ID"];
    
    $input_codigo= trim($_POST["codigo"]);
    if(empty($input_codigo)){
        $codigo_err = "Por favor ingrese codigo.";     
    } else{
        $codigo = $input_codigo;
    }

    $input_nombre = trim($_POST["nombre"]);
    if(empty($input_nombre)){
        $nombre_err = "Por favor ingrese nombre.";     
    } else{
        $nombre = $input_nombre;
    }

    $input_tipo = trim($_POST["tipo"]);
    if(empty($input_tipo)){
        $tipo_err = "Por favor ingrese tipo.";     
    } else{
        $tipo = $input_tipo;
    }

    $input_provincia = trim($_POST["provincia"]);
    if(empty($input_provincia)){
        $provincia_err = "Por favor ingrese provincia.";     
    } else{
        $provincia = $input_provincia;
    }
    

    $input_canton = trim($_POST["canton"]);
    if(empty($input_canton)){
        $canton_err = "Por favor ingrese canton.";     
    } else{
        $canton = $input_canton;
    }

    $input_distrito = trim($_POST["distrito"]);
    if(empty($input_distrito)){
        $distrito_err = "Por favor ingrese distrito.";     
    } else{
        $distrito = $input_distrito;
    }


    $input_direccion = trim($_POST["direccion"]);
    if(empty($input_direccion)){
        $direccion_err = "Por favor ingrese direccion.";     
    } else{
        $direccion = $input_direccion;
    }

    $input_nombre_contacto = trim($_POST["nombre_contacto"]);
    if(empty($input_nombre_contacto)){
        $nombre_contacto_err = "Por favor ingrese nombre_contacto.";     
    } else{
        $nombre_contacto = $input_nombre_contacto;
    }

    $input_telefono_contacto = trim($_POST["telefono_contacto"]);
    if(empty($input_telefono_contacto)){
        $telefono_contacto_err = "Por favor ingrese telefono_contacto.";     
    } else{
        $telefono_contacto = $input_telefono_contacto;
    }

    $input_email_contacto = trim($_POST["email_contacto"]);
    if(empty($input_email_contacto)){
        $email_contacto_err = "Por favor ingrese email_contacto.";     
    } else{
        $email_contacto = $input_email_contacto;
    }
    
    
    
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($direccion_err)){
        $sql = "UPDATE escenario set CODIGO=?, NOMBRE=?, TIPO=?, PROVINCIA=?, CANTON=?, DISTRITO=?, DIRECCION=?, NOMBRE_CONTACTO=?, TELEFONO_CONTACTO=?, EMAIL_CONTACTO=? where ID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssisssssisi",$param_codigo, $param_nombre,$param_tipo,$param_provincia,$param_canton,$param_distrito,$param_direccion,$param_nombre_contacto,$param_telefono_contacto,$param_email_contacto,$param_ID );
            
            // Set parameters
            $param_codigo = $codigo;
            $param_nombre = $nombre;
            $param_tipo = $tipo;
            $param_provincia = $provincia;
            $param_canton = $canton;
            $param_distrito = $distrito;
            $param_direccion = $direccion;
            $param_nombre_contacto = $nombre_contacto;
            $param_telefono_contacto = $telefono_contacto;
            $param_email_contacto = $email_contacto;     
            $param_ID = $ID;
            
            $sql=  mysqli_real_escape_string($link, stripslashes($sql));
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
        $sql = "SELECT * FROM escenario WHERE ID = ?";
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
                    $codigo = $row["CODIGO"];
                    $nombre = $row["NOMBRE"];
                    $tipo = $row["TIPO"];
                    $provincia = $row["PROVINCIA"];
                    $canton = $row["CANTON"];
                    $distrito = $row["DISTRITO"];
                    $direccion = $row["DIRECCION"];
                    $nombre_contacto = $row["NOMBRE_CONTACTO"];
                    $telefono_contacto = $row["TELEFONO_CONTACTO"];
                    $email_contacto = $row["EMAIL_CONTACTO"];
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
 <script>
    $(document).ready(
        function carga_provincia () {
            $.ajax({
                dataType: "json",
                url: "https://ubicaciones.paginasweb.cr/provincias.json",
                data: {},
                success: function (data) {
                    $("#provincias").empty();
                    $("#cantones").empty();
                    $("#distritos").empty();
                    var html = "<select>";
                    for(key in data) {
                        if (key  != <?php echo $provincia; ?>) {
                        html += "<option value='"+key+"'>"+data[key]+"</option>";
                            } else {
                         html += "<option selected value='"+key+"' >"+data[key]+" </option>";
                            }
                        
                    }
                    html += "</select>";
                    $('#provincias').html(html);
                }
            });
        }
        );

$(function(){ 
   $('#provincias').ready(function(){
     var data= $(this).val();
     $.ajax({
                dataType: "json",
                url: "https://ubicaciones.paginasweb.cr/provincia/"+<?php echo $provincia; ?>+"/cantones.json",
                data: {},
                success: function (data) {
                    $("#cantones").empty();
                    $("#distritos").empty();
                    var html = "<select>";
                    html += "<option value='0'>Seleccione una opción</option>";
                    for(key in data) {
                        if (key  != <?php echo $canton; ?>) {
                        html += "<option value='"+key+"'>"+data[key]+"</option>";
                            } else {
                         html += "<option selected value='"+key+"' >"+data[key]+" </option>";
                            }
                    }
                    html += "</select>";
                    $('#cantones').html(html);
                }
            });         
     });
 });

 $(function(){ 
   $('#cantones').ready(function(){
     var data= $(this).val();
     var data2= $('#provincias').val();
     $.ajax({
                dataType: "json",
                url: "https://ubicaciones.paginasweb.cr/provincia/"+<?php echo $provincia; ?>+"/canton/"+<?php echo $canton; ?>+"/distritos.json",
                data: {},
                success: function (data) {
                    $("#distritos").empty();
                    var html = "<select>";
                    html += "<option value='0'>Seleccione una opción</option>";
                    for(key in data) {
                        if (key  != <?php echo $distrito; ?>) {
                        html += "<option value='"+key+"'>"+data[key]+"</option>";
                            } else {
                         html += "<option selected value='"+key+"' >"+data[key]+" </option>";
                            }
                    }
                    html += "</select";
                    $('#distritos').html(html);
                }
            });         
     });
 });

 $(function(){ 
   $('#provincias').change(function(){
     var data= $(this).val();
     $.ajax({
                dataType: "json",
                url: "https://ubicaciones.paginasweb.cr/provincia/"+data+"/cantones.json",
                data: {},
                success: function (data) {
                    $("#cantones").empty();
                    $("#distritos").empty();
                    var html = "<select>";
                    html += "<option value='0'>Seleccione una opción</option>";
                    for(key in data) {
                        html += "<option value='"+key+"'>"+data[key]+"</option>";
                    }
                    html += "</select>";
                    $('#cantones').html(html);
                }
            });         
     });
 });

 $(function(){ 
   $('#cantones').change(function(){
     var data= $(this).val();
     var data2= $('#provincias').val();
     $.ajax({
                dataType: "json",
                url: "https://ubicaciones.paginasweb.cr/provincia/"+data2+"/canton/"+data+"/distritos.json",
                data: {},
                success: function (data) {
                    $("#distritos").empty();
                    var html = "<select>";
                    html += "<option value='0'>Seleccione una opción</option>";
                    for(key in data) {
                        html += "<option value='"+key+"'>"+data[key]+"</option>";
                    }
                    html += "</select";
                    $('#distritos').html(html);
                }
            });         
     });
 });


        
</script>

 
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
                    <div class="form-group <?php echo (!empty($codigo_err)) ? 'has-error' : ''; ?>">
                            <label>Codigo</label>
                            <input type="text" maxlength="5"  name="codigo" class="form-control" value="<?php echo $codigo; ?>">
                            <span class="help-block"><?php echo $codigo_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" maxlength="200"  name="nombre" class="form-control" value="<?php echo $nombre; ?>">
                            <span class="help-block"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tipo_err)) ? 'has-error' : ''; ?>">
                            <label>Tipo</label>
                            <select name="tipo" id="tipos" class="form-control" >
                            <option value="1">Salón de Eventos</option>
                            <option value="2">Estadio</option>
                            <option value="3">Anfiteatro</option>     
                            <option value="4">Campo Ferial</option>     
                            <option value="5">Gimnasio</option>     
                            <option value="6">Bar</option>     
                            <option value="7">Restaurante</option>     
                            <option value="8">Otros</option>                                 
                        </select>
                        <script> $("#tipos").val(<?php echo $tipo; ?>); </script>
                            <span class="help-block"><?php echo $tipo_err;?></span>
                        </div>        

                        <div class="form-group <?php echo (!empty($provincia_err)) ? 'has-error' : ''; ?>">
                     <label>Provincia</label>
                     <select name="provincia" id="provincias" class="form-control">
                     </select>                   
                    <span class="help-block"><?php echo $provincia_err;?></span>
                        </div> 

                    <div class="form-group <?php echo (!empty($canton_err)) ? 'has-error' : ''; ?>">
                     <label>Canton</label>
                     <select name="canton" id="cantones" class="form-control">
                         </select>
                    <span class="help-block"><?php echo $canton_err;?></span>
                        </div> 

                        <div class="form-group <?php echo (!empty($distrito_err)) ? 'has-error' : ''; ?>">
                     <label>Distrito</label>
                     <select name="distrito" id="distritos" class="form-control">
                         </select>
                    <span class="help-block"><?php echo $distrito_err;?></span>
                        </div>                       
                        
                        <div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                            <label>Dirección</label>
                            <input type="text" maxlength="300"  name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                            <span class="help-block"><?php echo $direccion_err;?></span>
                        </div>
                    
                        <div class="form-group <?php echo (!empty($nombre_contacto_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre Contacto</label>
                            <input type="text" maxlength="100"  name="nombre_contacto" class="form-control" value="<?php echo $nombre_contacto; ?>">
                            <span class="help-block"><?php echo $nombre_contacto_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($telefono_contacto_err)) ? 'has-error' : ''; ?>">
                            <label>Telefono Contacto</label>
                            <input type="number" maxlength="8"  minlength="8"  name="telefono_contacto" class="form-control" value="<?php echo $telefono_contacto; ?>">
                            <span class="help-block"><?php echo $telefono_contacto_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($email_contacto_err)) ? 'has-error' : ''; ?>">
                            <label>Email Contacto</label>
                            <input type="email" name="email_contacto" class="form-control" value="<?php echo $email_contacto; ?>">
                            <span class="help-block"><?php echo $email_contacto_err;?></span>
                        </div>   
                        <input type="hIdden" name="ID" value="<?php echo $ID; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>