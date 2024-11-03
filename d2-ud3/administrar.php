<?php
session_start();

//verificamos si el usuario a iniciado sesion y si es administrador
if(!isset($_SESSION['usuario'])||!$_SESSION['es_admin']){
    header('Location:iniciarsesion.php');
}

// Define la ruta del archivo de stock
define("RUTA_FICHERO", "stock.data");

// iniciar el stoo si no esta creado,como hemos hecho en el principal de la tienda 
if (file_exists(RUTA_FICHERO)) {
    $stock = unserialize(file_get_contents(RUTA_FICHERO));
} else {
    $stock = [
        "base_charlotte_tilbury" => 5,
        "colorete_essence" => 20,
        "lapiz_de_ojos_sephora" => 20,
        "paleta_sombras_huda_beauty" => 8,
        "mascara_de_pestanas_lancome" => 15,
        "labial_matte_mac" => 12,
        "exfoliante_facial_clinique" => 10,
        "serum_vitamina_c_the_ordinary" => 30,
        "labial_gloss_fenty_beauty" => 14,
        "paleta_iluminadores_anastasia_beverly_hills" => 5,
        "corrector_full_coverage_tarte" => 11,
        "tinte_para_cejas_benefit" => 13
    ];
    file_put_contents(RUTA_FICHERO, serialize($stock));
}

// actualización del stock
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($stock as $producto => $cantidadActual) {
        if (isset($_POST[$producto])) {
            //cantidad que el administrador quiere 
            $nuevaCantidad = intval($_POST[$producto]);
            //actualizar el stock con la nueva cantidad ingresada
            if ($nuevaCantidad >= 0) {
                $stock[$producto] = $nuevaCantidad;
            }
        }
    }
    //guardamos el nuevo stock en el archivo
    file_put_contents(RUTA_FICHERO, serialize($stock));
    echo "<p>Stock actualizado correctamente</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Stock</title>
    <style>
         label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"] {
            width: 51px;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
    </style>
   
</head>
<body>
    <h1>Administrador de Stock</h1>

    <form action="" method="post">
        <?php
        foreach ($stock as $producto => $cantidad) {
            echo "<label for=\"$producto\">$producto (Stock actual: $cantidad unidades):</label>";
            echo "<input type=\"number\" name=\"$producto\" min=\"0\" value=\"$cantidad\"/><br>";
        }
        ?>
        <input type="submit" value="Actualizar Stock">
    </form>

    <a href="iniciarsesion.php">Volver al inicio</a>
</body>
</html>
