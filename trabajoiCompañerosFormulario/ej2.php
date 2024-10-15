<?php
function mostrarDatosServidor() {
    echo "<h2>Datos del servidor:</h2>";

   
    $ipCliente = $_SERVER['REMOTE_ADDR'];
    echo "IP Remota (Cliente): " . $ipCliente . "<br>";

   
    $nombreServidor = $_SERVER['SERVER_NAME'];
    echo "Nombre del servidor: " . $nombreServidor . "<br>";

   
    $protocolo = $_SERVER['SERVER_PROTOCOL'];
    echo "Protocolo usado: " . $protocolo . "<br>";

   
    $puertoServidor = $_SERVER['SERVER_PORT'];
    echo "Puerto del servidor: " . $puertoServidor . "<br>";

   
    $metodoPeticion = $_SERVER['REQUEST_METHOD'];
    echo "Método de la petición: " . $metodoPeticion . "<br>";


    
    echo "<h2>Cabeceras HTTP:</h2>";
    $cabeceras = apache_request_headers();
    foreach ($cabeceras as $header => $value) {
        echo "$header: $value <br>";
    }
    
}



function si_existe($clave, $valor_por_defecto = "") {
    return isset($_REQUEST[$clave]) ? $_REQUEST[$clave] : $valor_por_defecto; 
}
function validarCampoEdad($edad){
    if($edad ==  ""){
        return "El campo edad es obligatorio";
    }
    else{
        if(!isMayorDeEdad($edad)){
            return "Debes de tener mas de 18 años";
        }
    }
}
function isMayorDeEdad($edad){
    if($edad > 18){
        return true;
    }
    return false;
}

function calcularCaracteresNombre($nombre) {
    return strlen($nombre);
}
function validarNombre($nombre){
    $error = "";
    if
     ($nombre == "") {
        $error .= "El campo nombre es obligatorio";
    }

    elseif (calcularCaracteresNombre($nombre) < 5 || calcularCaracteresNombre($nombre) > 10) {
        $error .= "El campo nombre debe tener entre 5 y 10 caracteres";
    }
    return $error;

}

function validarRadio($radio) {
    if (empty($radio)) {
        return "El campo radio está vacío <br>";
    }
    return "";
}


function validarCheckbox($box) {
    if(!isset($_REQUEST["box"])){
        return "El campo checkbox está vacío <br>";
    }
    else{
        return "";
    }
}

function muestraFormulario($nombre, $radio, $box, $select, $edad, $errorNombre, $errorRadio, $errorBox, $errorEdad) {
    ?>
    <form action="" method="POST"  enctype="multipart/form-data">
        <h2>FORMULARIO PERSONAL</h2>
        <div>
            <label for="">Introduce tu nombre</label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>">
            <span style="color:red;"><?php echo $errorNombre; ?></span>
           
        </div>
       
        <div>
            <p>¿En que curso estás?</p>
            <label for="">Primero</label>
            <input type="radio" name="radio" value="Primero" <?php if ($radio == "Primero") echo "checked"; ?>>
            <label for="">Segundo</label>
            <input type="radio" name="radio" value="Segundo" <?php if ($radio == "Segundo") echo "checked"; ?>>
            <span style="color:red;"><?php echo $errorRadio; ?></span>
          
        </div>
        
       <p>País de nacimiento</p>
        <select name="select">
            <option value="ESP">España</option>
            <option value="FRA">Francia</option>
            <option value="ITA" >Italia</option>
        </select>
        <br>
        <br>
        <div>
            <label for="">Introduce su edad</label>
            <input type="text" name="edad"  value = "<?php echo $edad; ?>">
            <span style="color:red;"><?php echo $errorEdad; ?></span>
        </div>
        <br>
        <div>
            <label for="">Confirmar la veracidad de los datos</label>
            <input type="checkbox" name="box" >
            <span style="color:red;"><?php echo $errorBox; ?></span>
        </div>
        <br>
        <div>
        <label for="">Subir archivo:</label>
        <input type="file" name="archivo">

        </div>
        <br>
        <button type="submit">Enviar</button>
        <button type="reset">Borrar</button>
    </form>
    <?php
}

$errorNombre = "";
$errorBox = "";
$errorRadio = "";
$errorEdad = "";
$nombre = ""; 
$radio = "";  
$box = "";   
$select = "";
$edad = 0;



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = si_existe("nombre");
    $radio = si_existe("radio");
    $box = si_existe("box");
    $select = si_existe("select");
    $edad = intval(si_existe("edad"));
    
    $errorEdad .= validarCampoEdad($edad);
    $errorNombre .= validarNombre($nombre);
    $errorRadio = validarRadio($radio);
    $errorBox = validarCheckbox($box);

    if (isset($_FILES['archivo'])) {
        $archivo = $_FILES['archivo'];
        $nombreArchivo = $archivo['name'];
        $tipoArchivo = $archivo['type'];
        $rutaTemporal = $archivo['tmp_name'];
        $tamañoArchivo = $archivo['size'];
        $rutaDestino = "Descargas/" . $nombreArchivo;

    }
    

    if((isset($_POST['aa']))){
        echo "Formulario enviado correctamente  ";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver al formulario</a>";
    }


    elseif($errorNombre == "" && $errorEdad == "" && $errorRadio == "" && $errorBox == ""){

       
        mostrarDatosServidor();
        echo "<br>";
    
          
        echo "<h3>Por favor, confirma que los datos son correctos:</h3><br>";
        echo "Tu nombre: $nombre <br>";
        echo "Estás en: $radio <br>";
        echo "Veracidad de los datos aceptada<br>";
        echo "Tu edad es: $edad años<br>";
        echo "Tu país de nacimiento es: $select<br>";

        
        echo "Archivo cargado exitosamente: $nombreArchivo <br>";
        echo "Tipo de archivo: $tipoArchivo <br>";
        echo "Tamaño del archivo: $tamañoArchivo bytes<br>";
        echo "Ruta del archivo: $rutaDestino <br>";

        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='aa' value='1'>";
        echo "<button type='submit'>Confirmar</button>";
        echo "</form>";


    }
  
    else{
        muestraFormulario($nombre, $radio, $box, $select, $edad, $errorNombre, $errorRadio, $errorBox, $errorEdad);

    }

}

else {
    muestraFormulario($nombre, $radio, $box, $select, $edad, $errorNombre, $errorRadio, $errorBox, $errorEdad);
}

?>
