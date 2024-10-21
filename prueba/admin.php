<?php
define('RUTA_FICHERO',"stock.data");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stock = unserialize(file_get_contents(RUTA_FICHERO));

    foreach ($stock as $producto => $cantidad_actual) {
        if (isset($_POST[$producto])) {
            $nueva_cantidad = intval($_POST[$producto]);
            $stock[$producto] = $nueva_cantidad;
        }
    }

    file_put_contents(RUTA_FICHERO, serialize($stock));
}

$stock = unserialize(file_get_contents(RUTA_FICHERO));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Stock</title>
</head>
<body>
    <h1>Reponer Stock</h1>
    <form method="post">
        <ul>
            <?php foreach ($stock as $producto => $cantidad): ?>
                <li>
                    <label for="<?php echo $producto; ?>"><?php echo $producto; ?>:</label>
                    <input type="number" name="<?php echo $producto; ?>" value="<?php echo $cantidad; ?>" min="0">
                    (Stock actual: <?php echo $cantidad; ?>)
                </li>
            <?php endforeach; ?>
        </ul>
        <input type="submit" value="Actualizar stock">
    </form>
</body>
</html>
