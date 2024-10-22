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
        "exfoliante_facial_clinique" => 29.50,
        "serum_vitamina_c_the_ordinary" => 7.99,
        "labial_gloss_fenty_beauty" => 19,
        "paleta_iluminadores_anastasia_beverly_hills" => 40,
        "corrector_full_coverage_tarte" => 27,
        "tinte_para_cejas_benefit" => 24
    ];
    define("RUTA_FICHERO", "stock.data");

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

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['comprar'])) { 
            $posicion = array_keys($precios); // Obtener las claves del array $precios

            for ($i = 0; $i < count($posicion); $i++) {
                $producto = $posicion[$i]; // Obtener el nombre del producto
                $precio = $precios[$producto]; // Obtener el precio correspondiente

                if (!empty($_POST["$producto"])) {
                    $cantidad = intval($_POST[$producto]);
                    echo "<p>Has añadido $cantidad unidad(es) de $producto a tu carrito.</p>";
                    if ($cantidad > 0) {
                        if ($cantidad > $stock[$producto]) {
                            echo "<p style='color:red;'>No hay suficiente stock de $producto. Solo quedan {$stock[$producto]} unidades.</p>";
                        } else {
                            $stock[$producto] -= $cantidad;
                            if (!isset($_SESSION['compras'][$producto])) {
                                $_SESSION['compras'][$producto] = 0;
                            }
                            $_SESSION['compras'][$producto] += $cantidad;
                        }
                    }
                }
            }

            file_put_contents(RUTA_FICHERO, serialize($stock));
        }

        if (isset($_POST['finalizar'])) { 
            $mostrarFormulario = false;
            echo "<h2>Resumen de tu compra:</h2>";
            echo "<ul>";
            if (isset($_SESSION['compras']) && !empty($_SESSION['compras'])) {
                $totalCompra = 0;
                $posicion = array_keys($_SESSION['compras']); // Obtener claves del carrito

                for ($i = 0; $i < count($posicion); $i++) {
                    $producto = $posicion[$i]; // Producto
                    $cantidad = $_SESSION['compras'][$producto]; // Cantidad
                    $precio = $precios[$producto]; // Precio
                    $totalPrecio = $cantidad * $precio;
                    echo "<li>$producto: $cantidad unidad(es) - Precio total: $totalPrecio €</li>";
                    $totalCompra += $totalPrecio;
                }
                echo "<li><strong>Total de la compra: $totalCompra €</strong></li>";
            } else {
                echo "<li>No has añadido ningún producto a tu carrito.</li>";
            }
            echo "</ul>";
            echo "<form action='' method='post'>";
            echo "<input type='submit' name='confirmar' value='Confirmar compra'>";
            echo "<input type='submit' name='volver' value='Volver a la tienda'>";
            echo "</form>";
        }

        if (isset($_POST['confirmar'])) {
            // Limpiar la sesión del carrito después de confirmar la compra
            $mostrarFormulario = false;
            echo "<p>¡Gracias por tu compra! El carrito ha sido vaciado.</p>";
            unset($_SESSION['compras']);
        }
        if (isset($_POST['volver'])) {
            // Al hacer clic en "Volver a la tienda", simplemente regresamos a mostrar el formulario
            $mostrarFormulario = true;
        }
    }

    if ($mostrarFormulario) {
        ?>
        <form action="" method="post">
            <?php
            $posicion = array_keys($precios); // Obtener las claves de los productos

            for ($i = 0; $i < count($keys); $i++) {
                $producto = $posicion[$i]; // Obtener el producto
                $precio = $precios[$producto]; // Obtener el precio correspondiente
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
