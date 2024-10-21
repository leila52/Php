<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

define('RUTA_FICHERO', "stock.data");

// Cargar el stock desde el archivo
if (file_exists(RUTA_FICHERO)) {
    $stock = unserialize(file_get_contents(RUTA_FICHERO));
} else {
    // Si no existe el archivo, crear un stock inicial
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
    file_put_contents(RUTA_FICHERO, serialize($stock));
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

// Gestión del carrito
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carrito = [];
    $total = 0;

    foreach ($precios as $producto => $precio) {
        $cantidad = isset($_POST[$producto]) ? intval($_POST[$producto]) : 0;

        // Ajustar la cantidad al stock disponible
        if ($cantidad > $stock[$producto]) {
            $cantidad = $stock[$producto];
        }

        if ($cantidad > 0) {
            $carrito[$producto] = $cantidad;
            $total += $cantidad * $precio;
        }
    }

    $_SESSION['carrito'] = $carrito;
    $_SESSION['total'] = $total;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Maquillaje</title>
</head>
<body>
    <h1>Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?>. Bienvenido a Sephora</h1>

    <form method="post">
        <ul>
            <?php foreach ($precios as $producto => $precio): ?>
                <li>
                    <label for="<?php echo $producto; ?>"><?php echo $producto; ?>:</label>
                    <input type="number" name="<?php echo $producto; ?>" value="0" min="0" max="<?php echo $stock[$producto]; ?>">
                    Precio: <?php echo $precio; ?>€ - Stock disponible: <?php echo $stock[$producto]; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <input type="submit" value="Actualizar carrito">
    </form>

    <?php if (isset($_SESSION['carrito'])): ?>
        <h2>Resumen de tu compra:</h2>
        <ul>
            <?php foreach ($_SESSION['carrito'] as $producto => $cantidad): ?>
                <li><?php echo $producto; ?> - Cantidad: <?php echo $cantidad; ?> - Precio total: <?php echo $cantidad * $precios[$producto]; ?>€</li>
            <?php endforeach; ?>
        </ul>
        <p>Total: <?php echo $_SESSION['total']; ?>€</p>

        <form action="finalizar_compra.php" method="post">
            <input type="submit" value="Finalizar compra">
        </form>
    <?php endif; ?>
</body>
</html>
