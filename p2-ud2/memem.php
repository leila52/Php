<?php

$errores = [];
$nombre = "";
$primeravez = "";
$cafe = "";
$preferencia = "";
$personajes = [];
$temporadas = [];
$mostrarFormulario = true; // Bandera para controlar si mostramos el formulario

// Validación al enviar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    if (isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
        if (empty($nombre)) {
            $errores[] = "El nombre es obligatorio.";
        } elseif (strlen($nombre) < 3 || strlen($nombre) > 20) {
            $errores[] = "El nombre debe tener entre 3 y 20 caracteres.";
        }
    } else {
        $errores[] = "El nombre es obligatorio.";
    }

    // Validar "primera vez"
    if (isset($_POST["primeravez"])) {
        $primeravez = $_POST["primeravez"];
        if (empty($primeravez)) {
            $errores[] = "Debes indicar cuándo viste la serie por primera vez.";
        }
    } else {
        $errores[] = "Debes indicar cuándo viste la serie por primera vez.";
    }

    // Validar café
    if (isset($_POST["cafe"])) {
        $cafe = $_POST["cafe"];
        if (empty($cafe)) {
            $errores[] = "Debes responder si te encanta el café.";
        } elseif ($cafe !== "Sí" && $cafe !== "No") {
            $errores[] = "La respuesta sobre el café debe ser 'Sí' o 'No'.";
        }
    } else {
        $errores[] = "Debes responder si te encanta el café.";
    }

    // Validar preferencia entre Lorelai o Rory
    if (isset($_POST["preferencia"])) {
        $preferencia = $_POST["preferencia"];
    } else {
        $errores[] = "Debes seleccionar una preferencia entre Lorelai y Rory.";
    }

    // Validar personajes favoritos
    if (isset($_POST["personajes"])) {
        $personajes = $_POST["personajes"];
        if (count($personajes) < 2 || count($personajes) > 4) {
            $errores[] = "Debes seleccionar entre 2 y 4 personajes favoritos.";
        }
    } else {
        $errores[] = "Debes seleccionar entre 2 y 4 personajes favoritos.";
    }

    // Validar temporadas favoritas
    if (isset($_POST["temporadas"])) {
        $temporadas = $_POST["temporadas"];
        if (empty($temporadas)) {
            $errores[] = "Debes seleccionar al menos una temporada.";
        }
    } else {
        $errores[] = "Debes seleccionar al menos una temporada.";
    }

    // Si no hay errores, mostramos el resumen y cambiamos la bandera para ocultar el formulario
    if (empty($errores)) {
        $mostrarFormulario = false; // Ocultar el formulario
        muestraResumen($nombre, $primeravez, $cafe, $preferencia, $personajes, $temporadas);
    }
}

// Si la bandera está en "true", mostramos el formulario; si está en "false", no
if ($mostrarFormulario) {
    muestraFormulario($errores, $nombre, $primeravez, $cafe, $preferencia, $personajes, $temporadas);
}

// Función para mostrar el formulario
function muestraFormulario($errores, $nombre, $primeravez, $cafe, $preferencia, $personajes, $temporadas) {
    ?>
    <h1>Formulario sobre Gilmore Girls</h1>

    <!-- Mostramos errores si existen -->
    <?php if (!empty($errores)): ?>
        <ul style="color: red;">
            <?php foreach ($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="" method="post">
        <label for="nombre">Nombre de tu personaje favorito</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
        <br><br>

        <label for="primeravez">Cuando la viste por primera vez</label>
        <input type="text" id="primeravez" name="primeravez" value="<?php echo htmlspecialchars($primeravez); ?>">
        <br><br>

        <label for="cafe">¿Te encanta el café?</label>
        <input type="text" id="cafe" name="cafe" value="<?php echo htmlspecialchars($cafe); ?>">
        <br><br>

        <label>¿A quién prefieres, a Lorelai o Rory Gilmore?</label>
        <input type="radio" id="lorelai" name="preferencia" value="Lorelai" <?php if ($preferencia == "Lorelai") echo "checked"; ?>>
        <label for="lorelai">Lorelai</label>
        <input type="radio" id="rory" name="preferencia" value="Rory" <?php if ($preferencia == "Rory") echo "checked"; ?>>
        <label for="rory">Rory</label>
        <br><br>

        <label>Tus personajes favoritos son:</label>
        <br>
        <input type="checkbox" id="luke" name="personajes[]" value="Luke" <?php if (in_array("Luke", $personajes)) echo "checked"; ?>>
        <label for="luke">Luke</label>
        <input type="checkbox" id="sookie" name="personajes[]" value="Sookie" <?php if (in_array("Sookie", $personajes)) echo "checked"; ?>>
        <label for="sookie">Sookie</label>
        <input type="checkbox" id="paris" name="personajes[]" value="Paris" <?php if (in_array("Paris", $personajes)) echo "checked"; ?>>
        <label for="paris">Paris</label>
        <input type="checkbox" id="deen" name="personajes[]" value="Deen" <?php if (in_array("Deen", $personajes)) echo "checked"; ?>>
        <label for="deen">Deen</label>
        <input type="checkbox" id="jess" name="personajes[]" value="Jess" <?php if (in_array("Jess", $personajes)) echo "checked"; ?>>
        <label for="jess">Jess</label>
        <br><br>

        <label for="temporadas">Tus temporadas favoritas:</label>
        <br>
        <select multiple id="temporadas" name="temporadas[]">
            <option value="1" <?php if (in_array("1", $temporadas)) echo "selected"; ?>>Temporada 1</option>
            <option value="2" <?php if (in_array("2", $temporadas)) echo "selected"; ?>>Temporada 2</option>
            <option value="3" <?php if (in_array("3", $temporadas)) echo "selected"; ?>>Temporada 3</option>
            <option value="4" <?php if (in_array("4", $temporadas)) echo "selected"; ?>>Temporada 4</option>
            <option value="5" <?php if (in_array("5", $temporadas)) echo "selected"; ?>>Temporada 5</option>
            <option value="6" <?php if (in_array("6", $temporadas)) echo "selected"; ?>>Temporada 6</option>
            <option value="7" <?php if (in_array("7", $temporadas)) echo "selected"; ?>>Temporada 7</option>
        </select>
        <br><br>

        <input type="submit" name="enviar" value="Enviar">
        <input type="reset" name="borrar" value="Borrar">
        <br><br>

        <img src="gilmore.jpg" alt="Gilmore Girls">
    </form>
    <?php
}

// Función para mostrar el resumen
function muestraResumen($nombre, $primeravez, $cafe, $preferencia, $personajes, $temporadas) {
    echo "<h1>Resumen de tus datos</h1>";
    echo "<p>Nombre de tu personaje favorito: $nombre</p>";
    echo "<p>Cuando la viste por primera vez: $primeravez</p>";
    echo "<p>¿Te encanta el café?: $cafe</p>";
    echo "<p>Prefieres a: $preferencia</p>";
    echo "<p>Personajes favoritos: " . implode(", ", $personajes) . "</p>";
    echo "<p>Temporadas favoritas: " . implode(", ", $temporadas) . "</p>";
    echo '<form method="post"><button type="submit" name="confirmar">Confirmar datos</button></form>';
}