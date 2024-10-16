<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de euros</title>
</head>
<body>
    <h1>Convertir de euros a pesetas</h1>
    <?php
    $equivalentePeseta= 166.386;
    $mostrarFormulario=true;

    // si pulsa el boton de convertir
    if(isset($_POST['convertir'])){
        //si se introduce la cantidad
        if(!empty($_POST['euros'])){
            $euros=$_POST['euros'];
            $pesetas = $euros * $equivalentePeseta;
            if(isset($pesetas)){
                
                echo "<p> $euros  euros equivalen a " . $pesetas ." pesetas </p>";
                echo '<a href="eurosAPesetas.php"> volver</a>';
            }
            $mostrarFormulario=false;
        }else{
            // se muestra que no lo ha introducido
            echo "<p> debe introducir una cantidad</p>";
            echo '<a href="eurosAPesetas.php"> volver</a>';
            $mostrarFormulario=false;
        }
    }
    ?>
    <form method="post" action="">
    <?php
        if($mostrarFormulario){
    ?>
    <label for="euros">Cantidad en euros:</label>
    <input type="number" id="euros" name="euros">
    <input type="submit" name="convertir" value="Convertir">
    <?php }?>
    </form>
</body>
</html>