<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gilmore Girls</title>
</head>
<body>
    <?php
        $errores = [];
        $nombre = "";
        $cafe = "";
        $primeravez = "";
        $preferencia = "";
        $personajes = [];
        $temporadas = [];
        $ciudad = "";
        $comida = "";
        $cita = "";
        $episodio = "";
        $calificacion = "";
        $comentarios = "";
        $mostrarFormulario = true;
        $confirmacion=false;

        //primero verificamos al enviar el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //validamos nombre
            if (isset($_POST["nombre"])) {
                $nombre = $_POST["nombre"];
                if (empty($nombre)) {
                    $errores['nombre'] = "El nombre es obligatorio.";
                } elseif (strlen($nombre) < 3) {
                    $errores['nombre'] = "El nombre debe tener más de 3 caracteres.";
                }
            } else {
                $errores['nombre'] = "El nombre es obligatorio.";
            }

            if (isset($_POST["primeravez"])) {
                $primeravez = $_POST["primeravez"];
                if (empty($primeravez)) {
                    $errores['primeravez'] = "Debes indicar cuándo viste la serie por primera vez.";
                }
            } else {
                $errores['primeravez'] = "Debes indicar cuándo viste la serie por primera vez.";
            }

            if (isset($_POST["cafe"])) {
                $cafe = $_POST["cafe"];
                if (empty($cafe)) {
                    $errores['cafe'] = "Tienes que responder si te encanta el café.";
                } elseif ($cafe !== "si" && $cafe !== "no") {
                    $errores['cafe'] = "La respuesta sobre el café debe ser 'si' o 'no'.";
                }
            } else {
                $errores['cafe'] = "Tienes que responder si te encanta el café.";
            }

            //validación del radio
            if (isset($_POST["preferencia"])) {
                $preferencia = $_POST["preferencia"];
            } else {
                $errores['preferencia'] = "Selecciona una preferencia entre Lorelai y Rory.";
            }

            //validamos los personajes favoritos
            if (isset($_POST["personajes"])) {
                $personajes = $_POST["personajes"];
                if (empty($personajes)) {
                    $errores['personajes'] = "Selecciona al menos un personaje.";
                }
            } else {
                $errores['personajes'] = "Selecciona al menos un personaje.";
            }

            // validar temporadas
            if (isset($_POST["temporadas"])) {
                $temporadas = $_POST["temporadas"];
                if (empty($temporadas)) {
                    $errores['temporadas'] = "Selecciona al menos una temporada";
                }
            } else {
                $errores['temporadas'] = "Selecciona al menos una temporada";
            }

            //validar de ciudad favorita 
            if (isset($_POST["ciudad"])) {
                $ciudad = $_POST["ciudad"];
                if (empty($ciudad)) {
                    $errores['ciudad'] = "Selecciona una ciudad favorita porfavorrrrr";
                }
            } else {
                $errores['ciudad'] = "Selecciona una ciudad favorita porfavorrrrr";
            }

            //validar comida favorita
            if (isset($_POST["comida"])) {
                $comida = $_POST["comida"];
                if (empty($comida)) {
                    $errores['comida'] = "selecciona la comida favorita es obligatoria, no lo olvides";
                }
            }else {
                $errores['comida'] = "selecciona la comida favorita es obligatoria, no lo olvides";
            }

            //validar la cita favorita
            if (isset($_POST["cita"])) {
                $cita = $_POST["cita"];
                if (empty($cita)) {
                    $errores['cita'] = "introduce la cita favorita plss,sobre todo la de luke y lorelai.";
                }
            }else {
                $errores['cita'] = "introduce la cita favorita plss,sobre todo la de luke y lorelai.";
            }

            //validar episodio favorito
            if (isset($_POST["episodio"])) {
                $episodio = $_POST["episodio"];
                if (empty($episodio)) {
                    $errores['episodio'] = "introduce el episodio favorito porfiiiii";
                }
            }else {
                $errores['episodio'] = "introduce el episodio favorito porfiiiii";
            }

            //validar calificacion
            if (isset($_POST["calificacion"])) {
                $calificacion = $_POST["calificacion"];
                if (empty($calificacion)) {
                    $errores['calificacion'] = "introduzca la calificación ya que es obligatoria.";
                }
            }else{
                $errores['calificacion'] = "introduzca la calificación ya que es obligatoria.";
            }
            function muestraResumen($nombre, $primeravez, $cafe, $preferencia, $personajes, $temporadas, $ciudad, $comida, $cita, $episodio, $calificacion, $comentarios) {
                echo "<h1>Resumen de tus datos sobre Gilmore Girls</h1><br>";
                echo "<p>Nombre de tu personaje favorito: " . $nombre . "</p>";
                echo "<p>Cuándo la viste por primera vez: " . $primeravez . "</p>";
                echo "<p>¿Te encanta el café?: " . $cafe . "</p>";
                echo "<p>Prefieres a: " . $preferencia . "</p>";
                echo "<p>Personajes favoritos: " . implode(", ", $personajes) . "</p>";
                echo "<p>Temporadas favoritas: " . implode(", ", $temporadas) . "</p>";
                echo "<p>Ciudad favorita de la serie: " . $ciudad . "</p>";
                echo "<p>Comida favorita que sale en la serie: " . $comida . "</p>";
                echo "<p>Cita favorita de gilmore girls: " . $cita . "</p>";
                echo "<p>Episodio favorito de gilmore girls: " . $episodio . "</p>";
                echo "<p>Calificación sobre la serie: " . $calificacion . "</p>";
                echo "<p>Comentarios: " . $comentarios . "</p>";
                echo '<form action="" method="post">';
                echo '<input type="hidden" name="confirmar" value="1">';
                echo '<input type="submit" value="Confirmar datos">';
                echo '</form>';
            }
            //si no hay errores, mostrar resumen
            if (empty($errores)) {
                $mostrarFormulario = false;
                muestraResumen($nombre, $primeravez, $cafe, $preferencia, $personajes, $temporadas, $ciudad, $comida, $cita, $episodio, $calificacion, $comentarios);
            }
        }
        ?>

    <?php if ($mostrarFormulario) { ?>
    <form action="" method="post">
        
        <?php 
        //mostrar información sobre el servidor con la ip remota y cabeceras
        echo " <h2>Informacion del servidor:</h2>";
        echo"ip remota : ". $_SERVER['REMOTE_ADDR'] . "<br>";
        $cabeceras = apache_request_headers();
        echo "cabeceras :". print_r($cabeceras, true);
        ?>
        <br><br>
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

        <!-- Cafe -->
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


        <!-- Ciudad favorita -->
        <label for="ciudad">¿Cuál es tu ciudad favorita de la serie?</label>
        <select id="ciudad" name="ciudad">
            <option value="Stars Hollow" <?php if ($ciudad == "Stars Hollow") echo "selected"; ?>>Stars Hollow</option>
            <option value="Hartford" <?php if ($ciudad == "Hartford") echo "selected"; ?>>Hartford</option>
            <option value="New York" <?php if ($ciudad == "New York") echo "selected"; ?>>Nueva York</option>
            <option value="Otro" <?php if ($ciudad == "Otro") echo "selected"; ?>>Otro</option>
        </select>
        <?php if (isset($errores['ciudad'])) { ?>
            <div style="color: red;"><?php echo $errores['ciudad']; ?></div>
        <?php } ?>

        <br><br>

        <!-- Comida favorita -->
        <label for="comida">¿Cuál es tu comida favorita mencionada en la serie?</label>
        <input type="text" id="comida" name="comida" value="<?php echo $comida; ?>">
        <?php if (isset($errores['comida'])) { ?>
            <div style="color: red;"><?php echo $errores['comida']; ?></div>
        <?php } ?>

        <br><br>

        <!-- Cita favorita -->
        <label for="cita">¿Cuál es tu cita favorita de la serie?</label>
        <input type="text" id="cita" name="cita" value="<?php echo $cita; ?>">
        <?php if (isset($errores['cita'])) { ?>
            <div style="color: red;"><?php echo $errores['cita']; ?></div>
        <?php } ?>

        <br><br>

        <!-- Episodio favorito -->
        <label for="episodio">¿Cuál es tu episodio favorito?</label>
        <input type="text" id="episodio" name="episodio" value="<?php echo $episodio; ?>">
        <?php if (isset($errores['episodio'])) { ?>
            <div style="color: red;"><?php echo $errores['episodio']; ?></div>
        <?php } ?>

        <br><br>

        <!-- Calificación -->
        <label for="calificacion">Califica la serie del 1 al 5:</label>
        <select id="calificacion" name="calificacion">
            <option value="1" <?php if ($calificacion == "1") echo "selected"; ?>>1</option>
            <option value="2" <?php if ($calificacion == "2") echo "selected"; ?>>2</option>
            <option value="3" <?php if ($calificacion == "3") echo "selected"; ?>>3</option>
            <option value="4" <?php if ($calificacion == "4") echo "selected"; ?>>4</option>
            <option value="5" <?php if ($calificacion == "5") echo "selected"; ?>>5</option>
        </select>
        <?php if (isset($errores['calificacion'])) { ?>
            <div style="color: red;"><?php echo $errores['calificacion']; ?></div>
        <?php } ?>

        <br><br>

        <!-- Comentarios -->
        <label for="comentarios">Comentarios adicionales:</label><br>
        <textarea id="comentarios" name="comentarios" rows="3" cols="50"><?php echo $comentarios; ?></textarea>
        
        <br><br>
        <input type="submit" value="Enviar">
        <input type="reset" name="borrar" value="Borrar">
    </form>
    <?php } ?>
    <img src="gilmore.jpg" alt="Gilmore Girls">
</body>
</html>