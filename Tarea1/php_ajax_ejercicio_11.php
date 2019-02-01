<html>
<head>
<script>
function carga_parametros(ope) {

    var op1 = document.getElementById("Operador1").value;
    var op2 = document.getElementById("Operador2").value;
   

    if (isNaN(op1) && isNaN(op2)) { 
        document.getElementById("id_resultado").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("id_resultado").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "php_ajax_ejercicio_11_ajax.php?a=" + op1+"&b="+op2+"&c="+ope, true);

        xmlhttp.send();
    }
}
</script>
</head>
<body>

<p><b>Calculadora:</b></p>
<form> 
Operador1: <input type="text" id="Operador1">
<br><br>
Operador2: <input type="text" id="Operador2">
<br><br>
<input type="button" value="suma" id="Boton_calculo" onclick="carga_parametros(this.value)"/>
<input type="button" value="resta" id="Boton_calculo" onclick="carga_parametros(this.value)"/>
<input type="button" value="multi" id="Boton_calculo" onclick="carga_parametros(this.value)"/>
<input type="button" value="division" id="Boton_calculo" onclick="carga_parametros(this.value)"/>
</form>
<p>Respuesta: <span id="id_resultado"></span></p>
</body>
</html>