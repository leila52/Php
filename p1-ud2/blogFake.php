<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog fake </title>
</head>
<body>
    <h1>Blog fake</h1>

    <?php
    //la variable que almacena los mensajes
    $mensajes="";

    //si se ha enviado
    if(isset($_POST['enviar'])){
        //cogemos el nuevo mensaje para ir acumulando
        $nuevoMensaje =($_POST['mensaje']);
        //acumulamos el nuevo mensaje
        if(!empty($nuevoMensaje)){
            $mensajes=$_POST['mensajeAcum'] . $nuevoMensaje. "\n";
        }else{
            $mensajes =$_POST['mensajeAcum'];
        }
    } else{
        $mensajes = isset($_POST['mensajeAcum']) ? $_POST['mensajeAcum'] : "";
    }
    ?>

    <form method="post">
        <label for="mensaje">mensaje:</label>
        <input type="text" id="mensaje" name="mensaje" required>
        <input type="submit" name="enviar" value="Enviar">

        <textarea name="mensajeAcum"rows="10" cols="50"><?php echo($mensajes);?></textarea>
    </form>
</body>
</html>



