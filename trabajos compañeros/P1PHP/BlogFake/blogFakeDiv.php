<!DOCTYPE html>
<html>
    <head>
        <title>Formulario de Mensajes</title>
    </head>
    <body>

        <h1>Formulario de Mensajes</h1>

        <!--FORMULARIO-->
        <form method="post" action="">
            <label for="nuevoMensaje">Nuevo mensaje:</label>
            <input type="text" id="nuevoMensaje" name="nuevoMensaje" required>
            <button type="submit" name="enviar">Enviar</button>
        </form>

        <div id="mensajes">
            <?php
            // Verificamos si se ha enviado un nuevo mensaje
            if (isset($_POST['enviar']) && isset($_POST['nuevoMensaje'])) {
                $nuevoMensaje = $_POST['nuevoMensaje'];

                // Agregamos el nuevo mensaje al div como un párrafo
                echo "<p>$nuevoMensaje</p>";
            }
            ?>
        </div>

    </body>
</html>