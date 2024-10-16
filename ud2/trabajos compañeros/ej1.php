<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con varios elementos</title>
</head>

<body>
    <h2>Formulario con varios elementos</h2>

    <form id="miFormulario" action="" method="post">
        <!-- Campo de texto -->

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br><br>
    <?php

function nombre(){
    $nom = $_REQUEST["nombre"];

if (empty($nom) || strlen($nom) <= 2) {
    echo "<p style=\"color:#ff0000\">Error a la hora de introducir el nombre</p>";
} else {
    echo "<p>nombre: " . $nom . "</p>";
}
}

    ?>


        <!-- Radio buttons -->
        <label>Género:</label><br>
        <input type="radio" id="generoM" name="genero" value="masculino">
        <label for="generoM">Masculino</label><br>
        <input type="radio" id="generoF" name="genero" value="femenino">
        <label for="generoF">Femenino</label><br><br>

        <?php
            function genero()
            {
                $gen = isset($_REQUEST["genero"]) ? $_REQUEST["genero"] : [];

                if (empty($gen) || !strcmp($gen, "masculino")) {
                    $gen = "masculino";
                    echo "<p>Genero: " . $gen . "</p>";
                } else {
                    $gen = "femenino";
                    echo "<p>Genero: " . $gen . "</p>";
                }
            }

        ?>

        <!-- Checkbox -->
        <label>Preferencias:</label><br>
        <input type="checkbox" id="opcion1" name="preferencia[]" value="opcion1">
        <label for="opcion1">Opción 1</label><br>
        <input type="checkbox" id="opcion2" name="preferencia[]" value="opcion2">
        <label for="opcion2">Opción 2</label><br><br>

        <?php

function preferencias(){
    $preferencia = isset($_REQUEST["preferencia"]) ? $_REQUEST["preferencia"] : [];

    if(empty ($preferencia)){
        echo "<p style=\"color:#ff0000\">No has marcado ninguna opcion</p>";
    }else{
        $opciones="";
        foreach ($preferencia as $key => $value) {
            $opciones .= $value . " ";
        }
        echo "<p>Preferencias: $opciones</p>";
        
    }
}

        ?>

        <!-- Lista de selección múltiple (select) -->
        <label for="colores">Selecciona tus colores favoritos:</label><br>
        <select id="colores" name="colores[]" multiple size="3">
            <option value="rojo">Rojo</option>
            <option value="verde">Verde</option>
            <option value="azul">Azul</option>
            <option value="amarillo">Amarillo</option>
            <option value="negro">Negro</option>
        </select><br><br>

        <?php
            function colores (){
                $color = isset ($_REQUEST["colores"]) ? $_REQUEST["colores"] : [];
                if(empty ($color)){
                    echo "<p style=\"color:#ff0000\">No has escogido un color</p>";
                }else{
                    foreach ($color as $key => $value) {
                        echo "El color escogido es el $value";
                    }
                }
            }
        ?>
        <!-- Operaciones matematicas -->
            <label for="num1"></label>
            <input type="text" name="num1" id="num1">
            <label for="num2"></label>
            <input type="text" name="num2" id="num2">
            <select name="operacion" id="operacion">
                <option value="suma">suma</option>
                <option value="resta">resta</option>
                <option value="multiplicacion">multiplicacion</option>
                <option value="division">divison</option>
                <option value="modulo">modulo</option>
            </select>
   
    <br>
    <?php

    function calcular(){

        if(!empty($_REQUEST["num1"]) && is_numeric($_REQUEST["num1"]) ){
            //asi obteines el valor
            $operando1=$_REQUEST["num1"];
        }else{
            echo "<p style=\"color:#ff0000\">Error al introducir el numero</p>";
            //para salir de la condicion
            return;
        }
        if(!empty($_REQUEST["num2"]) && is_numeric($_REQUEST["num2"]) ){
            $operando2=isset($_REQUEST["num2"]);
        }else{
            echo "<p style=\"color:#ff0000\">Error al introducir el numero</p>";
            //para salir de la condicion
            retrun;
        }

        //asi obtienes la operacion que elige.
        $operacion=$_REQUEST["operacion"];
        //Condicion tiene que ser falsa(0) para que se ejecute
        if(!strcmp("suma",$operacion)){
            echo "<p>El resultado es: " . ($operando1+$operando2) . "</p>";

        }
        else if(!strcmp("resta",$operacion)){
            echo "<p>El resultado es: " . ($operando1-$operando2) . "</p>";
;

        }
        else if(!strcmp("multiplicacion",$operacion)){
            echo "<p>El resultado es: " . ($operando1 * $operando2) . "</p>";
;

        }
        else if(!strcmp("division",$operacion)){
            echo "<p>El resultado es: " . ($operando1 / $operando2) . "</p>";
;

        }
        else if(!strcmp("modulo",$operacion)){
            echo "<p>El resultado es: " . ($operando1 % $operando2) . "</p>";
;
        }else{
            echo "<p>Operación no válida</p>";
        }
        
    }


    ?>

        <!-- Botones -->
        <button type="submit" name="bEnviar">Enviar</button>
        <button type="reset">Borrar</button> <!-- Botón para limpiar el formulario -->

        <?php
        $flag=true;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            nombre();
            genero();
            preferencias();
            colores();
            calcular();

        }

        ?>
    </form>
    <p style="color:#ff0000">HOLA</p>
</body>

</html>