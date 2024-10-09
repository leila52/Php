<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina el número</title>
</head>
<body>
    <?php
        // Constante de límite superior para el número aleatorio
        define('TOPE', 50);

        // Verificamos si el usuario ha pedido un nuevo número aleatorio
        if (isset($_POST['reset'])) {
            $numAleatorio = rand(1, TOPE); // Generamos un nuevo número aleatorio
            $aleatorio = $_REQUEST['numeroAleatorio'] ?? $numAleatorio;
            $contador = 0; // Reiniciamos el contador de intentos
        } else {
            // Usamos los valores enviados en el formulario para mantener el estado
            $numAleatorio = $_POST['numeroAleatorio'] ?? rand(1, TOPE); // Si no existe el número aleatorio, lo generamos
            $contador = $_POST['contador'] ?? 0; // Si no existe contador, lo inicializamos en 0
            $contador++; // Incrementamos el contador en cada intento
        }

        // Recogemos el número introducido por el usuario
        $numeroUsuario = $_POST["numero"] ?? null;

        // Validación del número ingresado
        if ($numeroUsuario !== null && is_numeric($numeroUsuario)) {
            // Comparación entre el número aleatorio y el ingresado por el usuario
            if ($numAleatorio > $numeroUsuario) {
                echo "El número aleatorio es mayor<br>";
            } elseif ($numAleatorio < $numeroUsuario) {
                echo "El número aleatorio es menor<br>";
            } else {
                echo "¡Enhorabuena, eres un crack! Lo has adivinado.<br>";
                echo "Lo has conseguido en " . $contador . " intentos.<br>";
                // Al acertar, podemos reiniciar el contador y el número aleatorio (o dejar que el usuario decida)
                $contador = 0;
                $numAleatorio = rand(1, TOPE); // Opcional: generar un nuevo número aleatorio al ganar
            }
        } elseif ($numeroUsuario !== null) {
            // Si el número ingresado no es válido
            echo "Tienes que poner un número válido.<br>";
        }

        // Mostramos el número aleatorio (opcional, puedes ocultarlo)
        echo "El número aleatorio es " . $numAleatorio . "<br>";
        echo "Intentos: " . $contador . "<br>";
    ?>

    <!-- Formulario para enviar los datos -->
    <form method="POST">
        <label for="numero">Introduce el número que crees que es:</label>
        <input type="text" name="numero"/>
        <!-- Pasamos el número aleatorio y el contador como campos ocultos para mantener el estado -->
        <input type="hidden" name="numeroAleatorio" value="<?=$numAleatorio?>"/>
        <input type="hidden" name="contador" value="<?=$contador?>"/>
        <input type="submit" value="Enviar"/>
    </form>

    <!-- Botón para generar un nuevo número (resetear el juego) -->
    <form method="POST">
        <input type="hidden" name="reset" value="1"/>
        <input type="submit" value="Generar nuevo número"/>
    </form>
</body>
</html>
