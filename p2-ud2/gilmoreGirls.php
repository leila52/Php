<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gilmore Girls</title>
</head>
<body>
    
    <?php
        $errores=[];
        $nombre="";
        $cafe="";
        $primeravez="";
        $preferencias="";
        $personajes=[];
        $temporadas=[];
        $mostrarFormulario=true;

        //primero verificamos al enviar el formulario
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //validamos nombre 
        

        if (isset($_POST["nombre"])) {
            $nombre = $_POST["nombre"];
            if (empty($nombre)) {
                $errores[] = "El nombre es obligatorio.";
            }elseif (strlen($nombre)<3){
                $errores[] = "el nombre debe tener mas de 3 caracteres.";
            }
        }else{
            $errores[]="el nombre es obligatorio.";
        }
    

        if (isset($_POST["primeravez"])) {
            $primeravez = $_POST["primeravez"];
            if (empty($primeravez)) {
                $errores[] = "debes indicar cuando viste la serie por primera vez";
            }
        } else {
            $errores[] = "debes indicar cuando viste la serie por primera vez";
        }

        if (isset($_POST["cafe"])) {
            $cafe = $_POST["cafe"];
            if (empty($cafe)) {
                $errores[] = "tienes que responder si te encanta el cafe";
            } elseif ($cafe !== "si" && $cafe !== "no") {
                $errores[] = "la respuesta sobre el café debe ser si o no";
            }
        } else {
            $errores[] ="tienes que responder si te encanta el cafe";
        }
        
        //validación del radio
        if (isset($_POST["preferencia"])) {
            $preferencia = $_POST["preferencia"];
        } else {
            $errores[] = "selecciona una preferencia entre Lorelai y Rory";
        }

        //validamos los personajes favoritos
        if (isset($_POST["personajes"])) {
            $personajes=$_POST["personajes"];
            if(empty($personajes)){
                $errores[] = "selecciona al menos un personaje";
        }
        } else {
            $errores[] = "selecciona al menos un personaje";
        }
        // validar temporadas
        if (isset($_POST["temporadas"])) {
            $temporadas = $_POST["temporadas"];
            if (empty($temporadas)) {
                $errores[] = "selecciona al menos una temporada";
            }
        } else {
            $errores[] = "selecciona al menos una temporada";
        }

        //si no hay errores hacer funcion
        if(empty($errores)){
            $mostrarFormulario=false;
            echo "<h1>Resumen de tus datos sobre gilmores girls</h1>";
            echo "<p>nombre de tu personaje favorito: $nombre</p>";
            echo "<p>cuando la viste por primera vez: $primeravez</p>";
            echo "<p>¿te encanta el café?: $cafe</p>";
            echo "<p>prefieres a: $preferencia</p>";
            echo "<p>personajes favoritos: " . implode(", ", $personajes) . "</p>";
            echo "<p>temporadas favoritas: " . implode(", ", $temporadas) . "</p>";
            echo '<form method="post"><input type="submit" name="enviar" value="Enviar"></form>';
        }
    }
        ?>
    
    
    
    <form action="" method="post">
    <?php if ($mostrarFormulario) { ?>
        <h1>Formulario sobre Gilmore Girls</h1>
        <label form="nombre">Nombre de tu personaje favorito</label>
        <input type="text" id="nombre" name="nombre" >
        
        <?php if (isset($errores['nombre'])) { ?>
            <div style="color: red;"><?php echo $errores['nombre']; ?></div>
        <?php } ?>
        
        <br>
        <br>
        <label form="nombre">Cuando la viste por primera vez</label>
        <input type="text" id="primeravez" name="primeravez" >
        <br>
        <br>

        <label form="nombre">Te encanta el cafe,responde con si o no en minusculas ?</label>
        <input type="text" id="cafe" name="cafe" >
        <br>
        <br>

        <label>A quién refieres a Lorelai o Rory Gilmore ?</label>
        <input type="radio" id="lorelai" name="preferencia" value="Lorelai">
        <label for="lorelai">Lorelai</label>
        <input type="radio" id="rory" name="preferencia" value="Rory">
        <label for="rory">Rory</label>
        <br>
        <br>

        <label>Tus personajes favoritos son: </label>
        <br>
        <input type="checkbox" id="luke" name="personajes[]" value="Luke">
        <label for="luke">Luke</label>
        <input type="checkbox" id="sookie" name="personajes[]" value="Sookie">
        <label for="sookie">Sookie</label>
        <input type="checkbox" id="paris" name="personajes[]" value="Paris">
        <label for="paris">Paris</label>
        <input type="checkbox" id="deen" name="personajes[]" value="Deen">
        <label for="deen">Deen</label>
        <input type="checkbox" id="jess" name="personajes[]" value="Jess">
        <label for="jess">Jess</label>
        <br>
        <br>

        <label for="temporadas">Tus temporadas favoritas:</label>
        <br>
        <select multiple id="temporadas" name="temporadas[]" multiple>
            <option value="1">Temporada 1</option>
            <option value="2">Temporada 2</option>
            <option value="3">Temporada 3</option>
            <option value="4">Temporada 4</option>
            <option value="5">Temporada 5</option>
            <option value="6">Temporada 6</option>
            <option value="7">Temporada 7</option>
        </select>
        <br>
        <br>
        <input type="submit" name="enviar" value="Enviar">
        <input type="reset" name="borrar" value="Borrar">
        <br>
        <br>

        <img src="gilmore.jpg" alt="Gilmore Girls" />
        <?php } ?>
    </form>
</body>
</html>