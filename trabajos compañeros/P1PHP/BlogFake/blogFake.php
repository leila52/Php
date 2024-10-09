<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Mensajes</title>
</head>
<body>
    <div class="container">
        <h2>Acumular Mensajes</h2>

        <?php
        // Inicializar la variable para los mensajes anteriores
        $mensajesAnteriores = "";

        // Si ya existen mensajes anteriores en el campo hidden, cargarlos
        if (isset($_POST['mensajesOcultos'])) {
            $mensajesAnteriores = $_POST['mensajesOcultos'];
        }

        // Si se envía el formulario, añadir el nuevo mensaje al final
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty(trim($_POST['mensaje']))) {
            $nuevoMensaje = trim($_POST['mensaje']); // Obtener el nuevo mensaje
            $mensajesAnteriores .= $nuevoMensaje . "\n"; // Agregar el nuevo mensaje a los mensajes anteriores
        }
        ?>

        <!-- Formulario -->
        <form method="POST">
            <label for="mensaje">Nuevo mensaje:</label><br>
            <input type="text" id="mensaje" name="mensaje" placeholder="Escribe tu mensaje aquí" required><br><br>
            <input type="submit" value="Enviar">
            
            <!-- Campo oculto para almacenar los mensajes anteriores -->
            <input type="hidden" name="mensajesOcultos" value="<?php echo htmlspecialchars($mensajesAnteriores); ?>">
        </form>

        <h3>Mensajes anteriores:</h3>
        <!-- Área de texto de solo lectura con los mensajes acumulados -->
        <textarea readonly><?php echo htmlspecialchars($mensajesAnteriores); ?></textarea>
    </div>
</body>
</html>