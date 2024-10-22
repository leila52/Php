<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de la compra</title>
</head>

<body>
    <h1>Carrito de la compra de Shephora:</h1>
    <?php
    $mostrarFormulario = true;
  
    $precios = [
        "base_charlotte_tilbury" => 49,
        "colorete_essence" => 5,
        "lapiz_de_ojos_sephora" => 12.99,
        "paleta_sombras_huda_beauty" => 65,
        "mascara_de_pestanas_lancome" => 29,
        "labial_matte_mac" => 19.50,
        "iluminador_fenty_beauty" => 38,
        "corrector_nars" => 30,
        "brocha_para_base_real_techniques" => 10,
        "spray_fijador_urban_decay" => 33,
        "polvos_traslucidos_laura_mercier" => 39,
        "crema_hidratante_tatcha" => 68,
        "exfoliante_facial_clinique" => 29.50,
        "serum_vitamina_c_the_ordinary" => 7.99,
        "labial_gloss_fenty_beauty" => 19,
        "paleta_iluminadores_anastasia_beverly_hills" => 40,
        "corrector_full_coverage_tarte" => 27,
        "tinte_para_cejas_benefit" => 24
    ];
    define("RUTA_FICHERO", "stock.data");

    //  si stock existe y carga
    if (file_exists(RUTA_FICHERO)) {
        $stock = unserialize(file_get_contents(RUTA_FICHERO));
    } else {
        // sino, inicializar el stock y crear
        //si se queda sin stock, borrar data y que empiece de nuevo
        $stock = [
            "base_charlotte_tilbury" => 5,
            "colorete_essence" => 20,
            "lapiz_de_ojos_sephora" => 20,
            "paleta_sombras_huda_beauty" => 8,
            "mascara_de_pestanas_lancome" => 15,
            "labial_matte_mac" => 12,
            "iluminador_fenty_beauty" => 6,
            "corrector_nars" => 9,
            "brocha_para_base_real_techniques" => 25,
            "spray_fijador_urban_decay" => 18,
            "polvos_traslucidos_laura_mercier" => 7,
            "crema_hidratante_tatcha" => 4,
            "exfoliante_facial_clinique" => 10,
            "serum_vitamina_c_the_ordinary" => 30,
            "labial_gloss_fenty_beauty" => 14,
            "paleta_iluminadores_anastasia_beverly_hills" => 5,
            "corrector_full_coverage_tarte" => 11,
            "tinte_para_cejas_benefit" => 13
        ];
        file_put_contents(RUTA_FICHERO, serialize($stock));
    }
    //echo "traza: " . var_dump($_POST);

    // proceso para la compra
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['comprar'])) { // Si se presiona el botón "Comprar"
            //echo "<br>traza dentro de comprar";
            foreach ($precios as $producto => $precio) {
                //echo "<br>traza producto $producto";

                if (!empty($_POST["$producto"])) {
                    $cantidad = intval($_POST[$producto]);
                    
                    //echo "traza: $cantidad";
                    if ($cantidad > 0) {
                        // Comprobar stock
                        if ($cantidad > $stock[$producto]) {
                            echo "<p style='color:red;'>No hay suficiente stock de $producto. Solo quedan {$stock[$producto]} unidades.</p>";
                        } else {
                            // Restar del stock
                            $stock[$producto]= $stock[$producto]-$cantidad;
                            if (!isset($_SESSION['compras'][$producto])) {
                                $_SESSION['compras'][$producto] = 0;
                            }
                            $_SESSION['compras'][$producto] += $cantidad;

                            echo "<p>Has añadido $cantidad unidad(es) de $producto a tu carrito.</p>";
                            
                        }
                    }
                }
            }
            // Actualizar stock en el fichero
            file_put_contents(RUTA_FICHERO, serialize($stock));
            
        }

        if (isset($_POST['finalizar'])) { // Si se presiona el botón "Finalizar"
            $mostrarFormulario = false;
            echo "<h2>Resumen de tu compra:</h2>";
            echo "<ul>";
            if (isset($_SESSION['compras']) && !empty($_SESSION['compras'])) {
                $totalCompra = 0;
                foreach ($_SESSION['compras'] as $producto => $cantidad) {
                    $precio = $precios[$producto];
                    $totalPrecio = $cantidad * $precio;
                    echo "<li>$producto: $cantidad unidad(es) - Precio total: $totalPrecio €</li>";
                    $totalCompra += $totalPrecio;
                }
                echo "<li><strong>Total de la compra: $totalCompra €</strong></li>";
            } else {
                echo "<li>No has añadido ningún producto a tu carrito.</li>";
            }
            echo "</ul>";
            echo "<a href='?volver=1'>Volver</a><br>";
            echo "<a href='?confirmar=1'>Confirmar compra</a>";
        }

        if (isset($_POST['confirmar'])) {
            // Limpiar la sesión del carrito después de confirmar la compra
            unset($_SESSION['compras']); // Elimina solo el carrito
            //session_destroy(); // O puedes destruir toda la sesión si no necesitas más datos
            $mostrarFormulario = false;
            echo "<p>¡Gracias por tu compra! El carrito ha sido vaciado.</p>";
        }
    }
    

    // Mostrar el formulario si es necesario
    if ($mostrarFormulario) {
        ?>
        <form action="" method="post">
            <?php
            foreach ($precios as $producto => $precio) {
                echo "<label for=\"$producto\">$producto:</label><br>";
                echo "<input type=\"number\" name=\"$producto\" min=\"0\" value=\"0\"/><br>";
                echo " Precio: $precio €, Stock: " . $stock[$producto] . "<br/><br/>";
            }
            ?>
            <input type="submit" name="comprar" value="Añadir al carrito">
            <input type="submit" name="finalizar" value="Finalizar compra">
        </form>
        <?php
    }
    ?>
</body>

</html>
