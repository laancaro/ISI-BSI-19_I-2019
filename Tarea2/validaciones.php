<?php 




if (preg_match("/^[A-Za-z]{1,25}\.[A-Za-z]{1,25}$/", $_POST['txtNombre'])) 
    {
    echo "Formato Correcto de usuario" ;
    } else 
    {
     echo "Formato incorrecto de usuario";
    }


    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $_POST['txtPass'])) 
    {
    echo "Formato Correcto de pass" ;
    } else 
    {
     echo "Formato incorrecto de pass";
    }



    if (filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL) == false) 
    {
    echo "Formato Correcto de correo" ;
    } else 
    {
     echo "Formato incorrecto de correo";
    }



  if (preg_match("/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/", $_POST['txtFecha'])) 
    {
    echo "Formato Correcto de fecha" ;
    } else 
    {
     echo "Formato incorrecto de fecha";
    }





 ?>
