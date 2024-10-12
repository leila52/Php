<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gilmore Girls</title>
</head>
<body>
    <?php
        //mostrar información sobre el servidor y cabeceras
        echo " <h2>informacion del servidor:</h2>";
        echo"ip remota: ". $_SERVER['REMOTE_ADDR'] . "<br>";
        $cabeceras = apache_request_headers();
        echo "Cabeceras:". print_r($cabeceras, true);


        $errores = [];
        $nombre = "";
        $cafe = "";
        $primeravez = "";
        $preferencia = "";
        $personajes = [];
        $temporadas = [];
        $mostrarFormulario = true;
        function validarNombre($nombre){
            if (empty($nombre)) {
                return "El nombre es obligatorio.";
            } elseif (strlen($nombre) < 3) {
                return "El nombre debe tener más de 3 caracteres.";
            }
            return "";
        }
        function validarPrimeravez($primeravez) {
            if (empty($primeravez)) {
                return "Debes indicar cuándo viste la serie por primera vez.";
            }
            return ""; 
        }

        function validarCafe($cafe) {
            if (empty($cafe)) {
                return "Tienes que responder si te encanta el café.";
            } elseif ($cafe !== "si" && $cafe !== "no") {
                return "La respuesta sobre el café debe ser 'si' o 'no'.";
            }
            return ""; 
        }

        function validarPreferencia($preferencia) {
            if (empty($preferencia)) {
                return "Selecciona una preferencia entre Lorelai y Rory.";
            }
            return "";
        }

        function validarPersonajes($personajes) {
            if (empty($personajes)) {
                return "Selecciona al menos un personaje.";
            }
            return "";
        }

        function validarTemporadas($temporadas) {
            if (empty($temporadas)) {
                return "Selecciona al menos una temporada.";
            }
            return ""; 
        }




        //primero verificamos al enviar el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //validamos nombre
            
            if (isset($_POST["nombre"])) {
                $nombre = $_POST["nombre"];
                // funcion validar nombre 
                $errorNombre=validarNombre($nombre);
                if($errorNombre){
                    $errores['nombre']=$errorNombre;
                }
            }
            

            if (isset($_POST["primeravez"])) {
                $primeravez = $_POST["primeravez"];
                $errorPrimeravez = validarPrimeravez($primeravez);
                if ($errorPrimeravez) {
                    $errores['primeravez'] = $errorPrimeravez;
                }
            } 

            if (isset($_POST["cafe"])) {
                $cafe = $_POST["cafe"];
                $errorCafe = validarCafe($cafe);
                if ($errorCafe) {
                    $errores['cafe'] = $errorCafe;
                }
            } 

            //validación del radio
            if (isset($_POST["preferencia"])) {
                $preferencia = $_POST["preferencia"];
                $errorPreferencia = validarPreferencia($preferencia);
                if ($errorPreferencia) {
                    $errores['preferencia'] = $errorPreferencia;
                }
            } 

            //validamos los personajes favoritos
            if (isset($_POST["personajes"])) {
                $personajes = $_POST["personajes"];
                $errorPersonajes = validarPersonajes($personajes);
                if ($errorPersonajes) {
                    $errores['personajes'] = $errorPersonajes;
                }
            } 

            // validar temporadas
            if (isset($_POST["temporadas"])) {
                $temporadas = $_POST["temporadas"];
                $errorTemporadas = validarTemporadas($temporadas);
                if ($errorTemporadas) {
                    $errores['temporadas'] = $errorTemporadas;
                }
                
            }



            function muestraResumen($nombre, $primeravez, $cafe, $preferencia, $personajes, $temporadas) {
                echo "<h1>Resumen de tus datos sobre Gilmore Girls</h1>";
                echo "<p>Nombre de tu personaje favorito: " . $nombre . "</p>";
                echo "<p>Cuándo la viste por primera vez: " . $primeravez . "</p>";
                echo "<p>¿Te encanta el café?: " . $cafe . "</p>";
                echo "<p>Prefieres a: " . $preferencia . "</p>";
                echo "<p>Personajes favoritos: " . implode(", ", $personajes) . "</p>";
                echo "<p>Temporadas favoritas: " . implode(", ", $temporadas) . "</p>";
                echo '<form action="gilmoreGirls.php" method="post">';
                echo'<input type="submit" value="Enviarr">';
                echo '<input type="submit" value="Volver al formulario">';
                echo '</form>';
               
            }
            //si no hay errores, mostrar resumen
            if (empty($errores)) {
                $mostrarFormulario = false;
                muestraResumen($nombre, $primeravez, $cafe, $preferencia, $personajes, $temporadas);
                
                
            }
        }
        ?>

    <?php if ($mostrarFormulario) { ?>
    <form action="" method="post">
        <h1>Formulario sobre Gilmore Girls</h1>

        <!-- Nombre -->
        <label for="nombre">Nombre de tu personaje favorito</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
        <?php if (isset($errores['nombre'])) { ?>
            <div style="color: red;"><?php echo $errores['nombre']; ?></div>
        <?php } ?>
        <br><br>

        <!-- Primera vez -->
        <label for="primeravez">Cuándo la viste por primera vez</label>
        <input type="text" id="primeravez" name="primeravez" value="<?php echo $primeravez; ?>">
        <?php if (isset($errores['primeravez'])) { ?>
            <div style="color: red;"><?php echo $errores['primeravez']; ?></div>
        <?php } ?>
        <br><br>

        <!-- Café -->
        <label for="cafe">¿Te encanta el café? (responde con "si" o "no")</label>
        <input type="text" id="cafe" name="cafe" value="<?php echo $cafe; ?>">
        <?php if (isset($errores['cafe'])) { ?>
            <div style="color: red;"><?php echo $errores['cafe']; ?></div>
        <?php } ?>
        <br><br>

        <!-- Preferencia -->
        <label>¿A quién prefieres, Lorelai o Rory?</label><br>
        <input type="radio" id="lorelai" name="preferencia" value="Lorelai" <?php echo ($preferencia == "Lorelai") ? "checked" : ""; ?>> Lorelai
        <input type="radio" id="rory" name="preferencia" value="Rory" <?php echo ($preferencia == "Rory") ? "checked" : ""; ?>> Rory
        <?php if (isset($errores['preferencia'])) { ?>
            <div style="color: red;"><?php echo $errores['preferencia']; ?></div>
        <?php } ?>
        <br><br>

        <!-- Personajes -->
        <label>Tus personajes favoritos son: </label><br>
        <input type="checkbox" id="luke" name="personajes[]" value="Luke" <?php echo (in_array("Luke", $personajes)) ? "checked" : ""; ?>> Luke
        <input type="checkbox" id="sookie" name="personajes[]" value="Sookie" <?php echo (in_array("Sookie", $personajes)) ? "checked" : ""; ?>> Sookie
        <input type="checkbox" id="paris" name="personajes[]" value="Paris" <?php echo (in_array("Paris", $personajes)) ? "checked" : ""; ?>> Paris
        <input type="checkbox" id="deen" name="personajes[]" value="Deen" <?php echo (in_array("Deen", $personajes)) ? "checked" : ""; ?>> Deen
        <input type="checkbox" id="jess" name="personajes[]" value="Jess" <?php echo (in_array("Jess", $personajes)) ? "checked" : ""; ?>> Jess
        <?php if (isset($errores['personajes'])) { ?>
            <div style="color: red;"><?php echo $errores['personajes']; ?></div>
        <?php } ?>
        <br><br>

        <!-- Temporadas -->
        <label for="temporadas">Tus temporadas favoritas:</label><br>
        <select id="temporadas" name="temporadas[]" multiple>
            <option value="1" <?php if (in_array("1", $temporadas)) { echo "selected"; }?>>Temporada 1</option>
            <option value="2" <?php if (in_array("2", $temporadas)) { echo "selected"; }?>>Temporada 2</option>
            <option value="3" <?php if (in_array("3", $temporadas)) { echo "selected"; } ?>>Temporada 3</option>
            <option value="4" <?php if (in_array("4", $temporadas)) { echo "selected"; } ?>>Temporada 4</option>
            <option value="5" <?php if (in_array("5", $temporadas)) { echo "selected"; } ?>>Temporada 5</option>
            <option value="6" <?php if (in_array("6", $temporadas)) { echo "selected"; } ?>>Temporada 6</option>
            <option value="7" <?php if (in_array("7", $temporadas)) { echo "selected"; }?>>Temporada 7</option>
        </select>
        <?php if (isset($errores['temporadas'])) { ?>
            <div style="color: red;"><?php echo $errores['temporadas']; ?></div>
        <?php } ?>
        <br><br>

        <input type="submit" value="Enviar">
        <input type="reset" name="borrar" value="Borrar">
    </form>
    <?php } ?>
    <img src="gilmore.jpg" alt="Gilmore Girls">

</body>
</html>
