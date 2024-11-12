<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $mensajes="";
        if(isset($_POST['enviar'])){
            $nuevomensaje=$_POST['mensaje'];
            if(!empty($nuevomensaje)){
                $mensajes=$_POST['mensajeAcum'] . $nuevomensaje;

            }else{
                $mensajes=$_POST['mensajeAcum'];
            }
        }lse{
            $mensajes=isset($_POST['mensajeAcum']) ? $_POST['mensajeAcum'] :"";
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
