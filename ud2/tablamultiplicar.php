<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tablas de multiplicar</title>
</head>
<body>
    <?php 
    //hazlo con array tmb
    $cont=0;
    while ($cont <=10){
        print("<br>". " la tabla del ".$cont . "<br>");
        echo "<tr>";
        for($i = 0 ; $i <= 10 ; $i++){
            $resultado=$i*$cont;
            print("<td>" . " ".$i ." x ". $cont ." = ".$resultado. " / "."</td>");
        }
        echo "</tr>";
    $cont++;
    }
    ?>
</body>
</html>