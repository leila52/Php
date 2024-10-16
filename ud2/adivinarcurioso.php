<?php
define('TOPE', 50); // Definimos el tope para el número aleatorio (en este caso, 50)

// Comprobamos si el formulario ha sido enviado (si el valor del número oculto no está definido, es la primera vez que accedemos).
if (!isset($_REQUEST['miNum'])) {
    // Generamos el número aleatorio solo la primera vez
    $miNum = rand(1, TOPE);
    $intentos = 0; // Inicializamos los intentos
    $mensaje = "Adivina un número entre 1 y " . TOPE . ".";
} else {
    // Recuperamos el número aleatorio guardado en el campo hidden del formulario
    $miNum = intval($_REQUEST['miNum']);
    
    // Recuperamos el número de intentos pasados
    $intentos = intval($_REQUEST['intentos']) + 1; // Aumentamos en 1 el contador de intentos

    // Recuperamos el número ingresado por el usuario
    $adivinado = intval($_REQUEST['numero']);

    // Comprobamos si el número ingresado es mayor, menor o igual
    if ($adivinado > $miNum) {
        $mensaje = "El número es menor que $adivinado. Llevas $intentos intentos.";
    } elseif ($adivinado < $miNum) {
        $mensaje = "El número es mayor que $adivinado. Llevas $intentos intentos.";
    } else {
        $mensaje = "¡Felicidades! Has adivinado el número en $intentos intentos.";
        // Si el número es correcto, puedes reiniciar el juego generando un nuevo número aleatorio.
        $miNum = rand(1, TOPE); // Generamos un nuevo número
        $intentos = 0; // Reiniciamos el contador de intentos
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Adivinar el Número</title>
</head>
<body>
    <h1>Juego de Adivinar el Número</h1>
    <p><?php echo $mensaje; ?></p>

    <!-- Formulario para enviar la adivinanza -->
    <form action="formulario.php" method="post">
        <label for="numero">Introduce el número:</label>
        <input type="number" id="numero" name="numero" required><br>
        <br>
        <!-- Campo oculto para mantener el número aleatorio generado -->
        <input type="hidden" name="miNum" value="<?php echo $miNum; ?>">
        <!-- Campo oculto para llevar el conteo de intentos -->
        <input type="hidden" name="intentos" value="<?php echo $intentos; ?>">
        <button type="submit">Comprobar</button>
    </form>
</body>
</html>
