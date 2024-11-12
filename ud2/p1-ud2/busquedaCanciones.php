<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda de canciones</title>
    
</head>
<body>
<h1>Busqueda de canciones</h1>
    <?php
    $mostrarFormulario=true;
    if(isset($_POST['buscar'])){
        if(!empty($_POST['cancion']) && !empty($_POST['buscarC']) && !empty($_POST['canciones'])){
            $cancion=$_POST['cancion'];
            $busqueda=$_POST['buscarC'];
            $canciones=$_POST['canciones'];
            if(isset($cancion)){
                echo "<p> Texto a buscar " .  $cancion ."</p>";
                
                if($busqueda ==='titulo'){
                    echo "<p> Busqueda de:Titulo de canciones</p>";
                }
                elseif($busqueda ==='nombre'){
                    echo "<p> Busqueda de:Nombres de álbum</p>";
                }elseif($busqueda ==='ambos'){
                    echo "<p> Busqueda de:ambos</p>";
                }
            }
                echo "<p> Genero: " .  $canciones ."</p>";
                $mostrarFormulario=false;
            }
        }
    ?>
    <form action="" method="post">
        <?php if ($mostrarFormulario) { ?>
            <label for="cancion">Texto a buscar:</label>
            <input type="text" id="cancion" name="cancion" required><br><br>

            <label for="buscarC">Buscar en :</label>
            <input type="radio" id="titulo" name="buscarC" value="titulo" required> Títulos de canción
            <input type="radio" id="nombre" name="buscarC" value="nombre" required> Nombres de álbum
            <input type="radio" id="ambos" name="buscarC" value="ambos" required> Ambos campos
            <br><br>

            <label for="genero">Género musical:</label>
            <select id="canciones" name="canciones" required>
                <option value="">Todos</option>
                <option value="jazz">Jazz</option>
                <option value="blues">Blues</option>
                <option value="electro">Electro Latino</option>
                <option value="pop">Pop</option>
            </select>
            <br><br>
                <input type="submit" name="buscar" value="buscar">
            <?php } ?>
    </form>
</body>
</html>