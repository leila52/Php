<html>
<head>
<meta charset="utf-8">
<title>Editor de marcador</title>
</head>
<body>
<?php
include "partidos.inc";
if (!isset($_REQUEST["partido"])
    || ! is_numeric($_REQUEST["partido"])
    || $_REQUEST["partido"]<0
    || $_REQUEST["partido"]>count($partidos)) {
 echo "Error, partido inválido";
 echo '<p><a href="Marcadores.php">Volver al listado (actualizar antes)</a></p>';
 exit();
}
$partido = $_REQUEST["partido"];
$equipos = explode(":",$partidos[$partido]);
?>

<form method="POST">
<input type="hidden" name="partido" value="<?=$partido?>">
<?= $equipos[0] ?>:<input type=number name="local"  value ="<?=$local?>" />
<?= $equipos[1] ?>:<input type=number name="visitante" value ="<?=$visitante?>"/>
Minuto:<input type="number" name="minuto" value ="<?=$minuto?>"/>
<input type="submit" name ="actuqalizar" value="Actualizar">
<p><a href="Marcadores.php">Volver al listado (actualizar antes)</a></p>
</form>
</body>
</html>
