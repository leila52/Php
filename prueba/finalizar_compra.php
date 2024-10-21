<?php
session_start();
define('RUTA_FICHERO', "stock.data");

// Verificar si el carrito existe
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<h1>Tu carrito está vacío</h1>";
    echo '<a href="productos.php">Volver a productos</a>';
    exit();
}

// Cargar stock y precios
if (file_exists(RUTA_FICHERO)) {
    $stock = unserialize(file_get_contents(RUTA_FICHERO));
} else {
    echo "<h1>Error: No se puede cargar el stock</h1>";
    exit();
}

// Precios de los productos
$precios = [
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

$carrito = $_SESSION['carrito'];
$total = 0;
$compra_posible = true;

// Verificar stock disponible
foreach ($carrito as $producto => $cantidad) {
    if ($cantidad > $stock[$producto]) {
        $compra_posible = false;
        break;
    }
}

// Si hay suficiente stock
if ($compra_posible) {
    // Mostrar resumen de la compra
    echo "<h1>Resumen de tu compra</h1>";
    echo "<ul>";

    foreach ($carrito as $producto => $cantidad) {
        // Actualizar el stock
        $stock[$producto] -= $cantidad;

        // Calcular el total de la compra
        $precio_producto = $precios[$producto];
        $subtotal = $cantidad * $precio_producto;
        $total += $subtotal;

        // Mostrar el producto y el subtotal
        echo "<li>$producto - Cantidad: $cantidad - Subtotal: " . number_format($subtotal, 2) . "€</li>";
    }
    echo "</ul>";
    echo "<p><strong>Total de la compra: " . number_format($total, 2) . "€</strong></p>";

    // Guardar el nuevo stock
    file_put_contents(RUTA_FICHERO, serialize($stock));

    // Vaciar el carrito
    unset($_SESSION['carrito']);
    unset($_SESSION['total']);

    echo "<h2>¡Compra realizada con éxito!</h2>";
    echo "<p>Gracias por tu compra, " . htmlspecialchars($_SESSION['usuario']) . ".</p>";
} else {
    // Si no hay suficiente stock, no se realiza la compra
    echo "<h1>No se pudo completar la compra</h1>";
    echo "<p>No hay suficiente stock para uno o más productos en tu carrito.</p>";
}

// Enlace para volver a la página de productos
echo '<a href="productos.php">Volver a productos</a>';
?>
