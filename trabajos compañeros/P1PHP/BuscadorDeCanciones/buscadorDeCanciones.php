<?php
// Simulación de una base de datos de canciones
$canciones = [
    "Despacito" => "Luis Fonsi",
    "Shape of You" => "Ed Sheeran",
    "Blinding Lights" => "The Weeknd",
    "Senorita" => "Shawn Mendes & Camila Cabello",
    "DÁKITI" => "Bad Bunny",
    "Highway to Hell" => "AC/DC",
    "Cum on Feel the Noize" => "Quiet Riot",
    "Thunderstruck" => "AC/DC",
    "Luna" => "Feid"
];

// Inicializar resultados
$resultados = [];

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busqueda = $_POST['busqueda'];

    // Buscar canciones que contengan la cadena de búsqueda
    foreach ($canciones as $titulo => $artista) {
        if (stripos($titulo, $busqueda) !== false) {
            $resultados[$titulo] = $artista;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Canciones</title>
</head>
<body>
    <h1>Búsqueda de Canciones</h1>
    <form method="post" action="">
        <label for="busqueda">Buscar Canción:</label>
        <input type="text" name="busqueda" id="busqueda" required>
        <button type="submit">Buscar</button>
    </form>

    <?php if (!empty($resultados)): ?>
        <h2>Resultados de la búsqueda:</h2>
        <ul>
            <?php foreach ($resultados as $titulo => $artista): ?>
                <li><?php echo "$titulo - $artista"; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h2>No se encontraron resultados para: <?php echo htmlspecialchars($busqueda); ?></h2>
    <?php endif; ?>
</body>
</html>