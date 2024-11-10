<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de monedas</title>
</head>
<body>
    <h1>Convertir euros a otras monedas</h1>
    <?php
    //array asociativo
    $valoresCon=['Dolares' => 1.325,'Libras' => 0.927,'Yenes' => 118.232,'Pesetas' => 166.386];
    $mostrarFormulario=true;
    //si pulsa el boton convertir
    if(isset($_POST['convertir'])){
        //si no esta vacio
        if(!empty($_POST['euros']) && !empty($_POST['moneda'])){
            $euros=$_POST['euros'];
            $seleccion=$_POST['moneda'];
            //obtenemos la posicion con seleccion
            $valorMoneda=$valoresCon[$seleccion];
            $conversion=$euros* $valorMoneda;
            if(isset($conversion)){
                echo" <p> $euros euros equivalen a $conversion   $seleccion</p>";
                echo '<a href="ejercicio2.php"> volver</a>';
                $mostrarFormulario=false;
            }
        }else{
            echo "<p> debe introducir una cantidad</p>";
            echo '<a href="ejercicio2.php"> volver</a>';
            $mostrarFormulario=false;
        }
    }
    
    ?>
<form method="post" action="">
        <?php if ($mostrarFormulario) { ?>
            <label for="euros">Cantidad en euros:</label>
            <input type="number" id="euros" name="euros" required>

            <label for="moneda">Seleccionar moneda:</label>
            <select id="moneda" name="moneda" required>
                <option value="">Seleccione una moneda</option>
                <option value="Dolares">Dolares USA</option>
                <option value="Libras">Libras Esterlinas</option>
                <option value="Yenes">Yenes Japonesas</option>
                <option value="Pesetas">Pesetas</option>
            </select>

            <input type="submit" name="convertir" value="Convertir">
        <?php } ?>
    </form>
</body>
</html>