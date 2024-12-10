<?php session_start() ?>
<html>

<head>
    <meta charset="utf-8">
    <title>Editor de marcador</title>
</head>

<body>
    <?php
    include "partidos.inc";
    if (
        !isset($_REQUEST["partido"])
        || ! is_numeric($_REQUEST["partido"])
        || $_REQUEST["partido"] < 0
        || $_REQUEST["partido"] > count($partidos)
    ) {
        echo "Error, partido inválido";
        echo '<p><a href="Marcadores.php">Volver al listado (actualizar antes)</a></p>';
        exit();
    }

    if (isset($_SESSION["valoresPartidos"]))
        $valoresPartidos = $_SESSION["valoresPartidos"];
    else
        $valoresPartidos = ["partido0" => [0, 0, 0], "partido1" => [0, 0, 0], "partido2" => [0, 0, 0]];

    $partido = $_REQUEST["partido"];
    $equipos = explode(":", $partidos[$partido]);

    if (isset($_POST["actualizar"])) {
        $valoresPartidos["partido$partido"][0] = $_POST["local"];
        $valoresPartidos["partido$partido"][1] = $_POST["visitante"];
        $valoresPartidos["partido$partido"][2] = $_POST["minuto"];
        $_SESSION["valoresPartidos"] = $valoresPartidos;
    }
    ?>

    <form method="POST">
        <input type="hidden" name="partido" value="<?= $partido ?>">
        <?= $equipos[0] ?>:<input type=number name="local" value=<?= $valoresPartidos["partido$partido"][0] ?> />
        <?= $equipos[1] ?>:<input type=number name="visitante" value=<?= $valoresPartidos["partido$partido"][1] ?> />
        Minuto:<input type="number" name="minuto" value=<?= $valoresPartidos["partido$partido"][2] ?> />
        <input type="submit" name="actualizar" value="Actualizar">
        <p><a href="Marcadores.php">Volver al listado (actualizar antes)</a></p>
    </form>
</body>

</html>