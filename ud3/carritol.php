<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de la compra</title>
    <style>
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"] {
            width: 50px;
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
    <h1>Carrito de la compra de Shephora:</h1>
    <?php
    $mostrarFormulario = true;
        // precios de los productos disponibles
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
    // define la ruta del archivo que almacena el stock
    define("RUTA_FICHERO", "stock.data");

    //  si stock existe y carga
    if (file_exists(RUTA_FICHERO)) {
        $stock = unserialize(file_get_contents(RUTA_FICHERO));
    } else {
        // sino existe, inicializar el stock y crear
        //si se queda sin stock, borrar data y que empiece de nuevo
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
        // guarda el stock en el archivo
    
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
                    echo "<p>Has añadido $cantidad unidad(es) de $producto a tu carrito.</p>";
                    //echo "traza: $cantidad";
                    if ($cantidad > 0) {
                        // Comprobar stock
                        if ($cantidad > $stock[$producto]) {
                            echo "<p style='color:red;'>No hay suficiente stock de $producto. Solo quedan {$stock[$producto]} unidades.</p>";
                        } else {
                            // Restar del stock
                            $stock[$producto]= $stock[$producto]-$cantidad;
                            if (!isset($_SESSION['compras'][$producto])) {
                                // inicializa la compra en sesión si no existe
                                $_SESSION['compras'][$producto] = 0;
                            }
                             // actualiza la cantidad en la sesión
                            $_SESSION['compras'][$producto] += $cantidad;
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
                // inicializa el total de la compra
                $totalCompra = 0;
                foreach ($_SESSION['compras'] as $producto => $cantidad) {
                    $precio = $precios[$producto];
                    // obtiene el precio del producto
                    $totalPrecio = $cantidad * $precio;
                    echo "<li>$producto: $cantidad unidad(es) - Precio total: $totalPrecio €</li>";
                    // suma al total de la compra general
                    $totalCompra += $totalPrecio;
                }
                echo "<li><strong>Total de la compra: $totalCompra €</strong></li>";

            } else {
                echo "<li>No has añadido ningún producto a tu carrito.</li>";
            }
            echo "</ul>";
            echo "<form action='' method='post'>";
            // muestra opciones para confirmar la compra o volver a la tienda
            echo "<input type='submit' name='confirmar' value='Confirmar compra'>";
            echo "<input type='submit' name='volver' value='Volver a la tienda'>";
            echo "</form>";
        }
        
        if (isset($_POST['confirmar'])) {
            // Limpiar la sesión del carrito después de confirmar la compra
            $mostrarFormulario = false;
            echo "<p>¡Gracias por tu compra! El carrito ha sido vaciado.</p>";
            echo "<form action='' method='post'>";
            echo "<input type='submit' name='enviarusuario' value='Volver a iniciar sesion'>";
            echo "</form>";
            // limpia el carrito de compras
            unset($_SESSION['compras']);

        }
        if (isset($_POST['volver'])) {
            // Al hacer clic en "Volver a la tienda", simplemente regresamos a mostrar el formulario
            $mostrarFormulario = true;
        }
          
        if (isset($_POST['enviarusuario'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_SESSION['usuario'] = $_POST['nombre'];
                header('Location: index.php');
                exit();
            }
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
