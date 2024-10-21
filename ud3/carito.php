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
        //crer archivo data
        $stock =unserialize(data:file_get_contents(filename:RUTA_FICHERO));
    }else{
        $stock = [
            "base charlotte tilbury" => 5,
            "colorete essence" => 20,
            "lapiz de ojos sephora" => 20,
            "paleta sombras huda beauty" => 8,
            "mascara de pestañas lancome" => 15,
            "labial matte mac" => 12,
            "iluminador fenty beauty" => 6,
            "corrector nars" => 9,
            "brocha para base real techniques" => 25,
            "spray fijador urban decay" => 18,
            "polvos traslucidos laura mercier" => 7,
            "crema hidratante tatcha" => 4,
            "exfoliante facial clinique" => 10,
            "serum vitamina c the ordinary" => 30,
            "labial gloss fenty beauty" => 14,
            "paleta iluminadores anastasia beverly hills" => 5,
            "corrector full coverage tarte" => 11,
            "tinte para cejas benefit" => 13
        ];
        file_put_contents(RUTA_FICHERO,serialize($stock));
    }
    $precios=[
        "base charlotte tilbury" => 49,
        "colorete essence" => 5,
        "lapiz de ojos sephora" => 12.99,
        "paleta sombras huda beauty" => 65,
        "mascara de pestañas lancome" => 29,
        "labial matte mac" => 19.50,
        "iluminador fenty beauty" => 38,
        "corrector nars" => 30,
        "brocha para base real techniques" => 10,
        "spray fijador urban decay" => 33,
        "polvos traslucidos laura mercier" => 39,
        "crema hidratante tatcha" => 68,
        "exfoliante facial clinique" => 29.50,
        "serum vitamina c the ordinary" => 7.99,
        "labial gloss fenty beauty" => 19,
        "paleta iluminadores anastasia beverly hills" => 40,
        "corrector full coverage tarte" => 27,
        "tinte para cejas benefit" => 24
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