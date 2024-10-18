<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de la compra</title>
</head>
<body>
    <h1>Carrito de maquillaje del Shephora</h1>
    <form action="" method="post">

    </form>
    <?php
    define('RUTA_FICHERO',"stock.data");
    
    if(file_exists(RUTA_FICHERO)){
        $stock =unserialize(data:file_get_contents(filename:RUTA_FICHERO));
    }else{
        $stock = [
            "base charlottilbury" => 5,
            "colorete essence" => 20,
            "lapiz de ojos" => 20
        ];
        file_put_contents(RUTA_FICHERO,serialize($stock));
    }
    $precios=[
        "base charlottilbury" => 49,
        "colorete essence" => 5,
        "lapiz de ojos" => 12.99
    ];
    
    echo "<ul>";
    foreach($precios as $producto => $precio){
        echo "<li><label for=\"$producto\">$producto:</label>";
        echo "<input type=\"number\" name=\"$producto\"/>";
        echo "precio: $precio,Stock $stock[$producto]</li>";
    }
    echo "</ul>";
    ?>
</body>
</html>