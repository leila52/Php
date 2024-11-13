<?php
include "partidos.inc";
?>
<html>
<head>
<meta charset="utf-8">
<title>Editor de marcadores</title>
</head>
<body>
<h2>Lista de partidos:</h2>
<ol>
<?php
for ($i=0; $i<count($partidos); $i++) {
 echo "<li><a href=\"EditaMarcador.php?partido=$i\">$partidos[$i]</a></li>";
}
?>
</ol>
</body>
</html>
