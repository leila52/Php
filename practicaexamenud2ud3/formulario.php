<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>FORMULARIO DE PRUEBA:</h1>
    <?php
    $mostrarformulario = true;
    $errores = [];
    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['borrar'])){
        $_POST=[]; //limpiar todo
        header('Location:formulario.php'); //redirigir
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['enviar'])) {

            //VALIDAR NOMBRE
            if (empty($_POST['nombre'])) {
                $errores['nombre'] = "<p style= color:red> ERROR</p>";
            } else if (strlen($_POST['nombre']) < 2 && (strlen($_POST['nombre']) > 16)) {
                $errores['nombre'] = " <p style= color:red > el nombre debe medir más de 2 y menos de 16 </p>";
            } else if (is_numeric($_POST['nombre'])) {
                $errores['nombre'] = "<p style= color:red>El nombre no tiene números</p>";
            } else {
                $_SESSION['nombre'] = $_POST['nombre'];
            }

            //VALIDAR CONTRASEÑA
            if (empty($_POST['passwd'])) {
                $errores['passwd'] = "<p style= color:red> ERROR</p>";
            } else if (strlen($_POST['passwd']) < 10) {
                $errores['passwd'] = " <p style= color:red >la contraseña debe medir más de 10 caracteres</p>";
            } else if (!ctype_upper($_POST['passwd'][0])) {
                $errores['passwd'] = "<p style=color:red> Debe empezar por mayúscula</p>";
            } else {
                $_SESSION['passwd'] = $_POST['passwd'];
            }

            //VALIDAR TELEFONO
            if (empty($_POST['telefono'])) {
                $errores['telefono'] = "<p style= color:red> ERROR</p>";
            } else if (strlen($_POST['telefono']) != 9) { //cuidado con el parentesis 
                $errores['telefono'] = "<p style = color:red> SOLO DEBE TENER 9 NÚMEROS</p>";
            }

            //VALIDAR EMAIL
            if (empty($_POST['email'])) {
                $errores['email'] = "ERROR";
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "EMAIL NO VÁLIDO";
            }

            //VALIDAR RADIO
            if (empty($_POST['mayor'])) {
                $errores['mayor'] = "selecciona una de las dos opciones";
            }

            //VALIDAR CHECKBOX
            if (empty($_POST['id'])) {
                $errores['id'] = "Selecciona una opción al menos";
            }

            //VALIDAR SELECTS
            if(empty($_POST['comunidades'])){
                $errores['comunidades']= "Selecciona una comunidad autónoma";
            }
            if(empty($_POST['comentarios'])){
                $errores['comentarios']= "Introduce un comentario";
            }
        }
      
        
        //FUNCIÓN PARA MOSTRAR LOS DATOS, SE LLAMA CUANDO NO HAY ERRORES
        function mostrarDatos()
        {
            echo "Nombre: " . $_POST['nombre'] . "<br>";
            echo "Contraseña: " . $_POST['passwd'] . "<br>";
            echo "Telefono: " . $_POST['telefono'] . "<br>";
            echo "Email: " . $_POST['email'] . "<br>";
            if ($_POST['mayor'] == 'si') {
                echo "ES MAYOR DE EDAD <br>";
            } else {
                echo "ES MENOR DE EDAD <br>";
            }
            if (!empty($_POST['id'])) {
                echo "Identificación: ";
                foreach ($_POST['id'] as $id) {
                    echo "<li>" . $id . "</li>";
                }
            }
            if(!empty($_POST['comunidades'])){
                echo "Comunidad autónoma";
                foreach($_POST['comunidades'] as $comunidad){
                    echo "<li>".$comunidad."</li>";
                }
            }
            echo "Comentarios: " .$_POST['comentarios']. "<br>";
            echo "<a href = 'formulario.php'>volver</a>";
        }

        if (empty($errores)) {
            $mostrarformulario = false; //utilizar asignación, no igualar
            echo "<h1>RESUMEN</h1><br>";
            mostrarDatos();

        }

    }
    ?>
    <form action="" method="post">
        <?php if ($mostrarformulario) { ?>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?php echo $_POST['nombre'] ?? "" ?>"><br>
            <?php if (isset($errores['nombre'])) {
                echo "<p style= color:red>" . $errores['nombre'] . "</p>";
            } ?>
            <label for="passwd">Contraseña: </label>
            <input type="password" name="passwd" value="<?php echo $_POST['passwd'] ?? "" ?>"><br>
            <?php if (isset($errores['passwd'])) {
                echo "<p style= color:red>" . $errores['passwd'] . "</p>";
            } ?>
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" value="<?php echo $_POST['telefono'] ?? "" ?>"><br>
            <?php if (isset($errores['telefono'])) {
                echo "<p style= color:red>" . $errores['telefono'] . "</p>";
            } ?>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $_POST['email'] ?? "" ?>"><br>
            <?php if (isset($errores['email'])) {
                echo "<p style= color:red>" . $errores['email'] . "</p>";
            } ?>
            <label for="mayor">¿Eres mayor de edad?</label><br>
            <label for="si">si</label>
            <input type="radio" name="mayor" value="si" <?php if (isset($_POST['mayor']) && ($_POST['mayor']) == 'si')
                echo 'checked'; ?>><br>
            <label for="no">no</label>
            <input type="radio" name="mayor" value="no" <?php if (isset($_POST['mayor']) && ($_POST['mayor']) == 'no')
                echo 'checked'; ?>><br>
            <?php if (isset($errores['mayor'])) {
                echo "<p style= color:red>" . $errores['mayor'] . "</p>";
            } ?>
            <br>
            <label for="identificacion">Tipo de Identificación:</label><br>
            <input type="checkbox" name="id[]" value="DNI" <?php if (isset($_POST['id']) && in_array('DNI', $_POST['id'])) echo 'checked'; ?>>DNI</input><br>
            <input type="checkbox" name="id[]" value="NIE" <?php if (isset($_POST['id']) && in_array('NIE', $_POST['id'])) echo 'checked'; ?>>NIE</input><br>
            <input type="checkbox" name="id[]" value="PASAPORTE" <?php if (isset($_POST['id']) && in_array('PASAPORTE', $_POST['id'])) echo 'checked'; ?>> PASAPORTE</input><br>
            <?php if (isset($errores['id'])) {
                echo "<p style= color:red>" . $errores['id'] . " </p>";
            } ?>
            <br>
            <label for="opción">Seleccione su CCAA:</label><br>
            <select multiple name="comunidades[]" size="3">
                <option value="Andalucía"<?php if (isset($_POST['comunidades']) && in_array('Andalucía', $_POST['comunidades'])) echo 'selected'; ?>>Andalucía</option>
                <option value="C.Murcia" <?php if (isset($_POST['comunidades']) && in_array('C.Murcia', $_POST['comunidades'])) echo 'selected'; ?>>Murcia</option>
                <option value="C.Madrid" <?php if (isset($_POST['comunidades']) && in_array('C.Madrid', $_POST['comunidades'])) echo 'selected'; ?>>C.Madrid</option>
                <option value="Galicia" <?php if (isset($_POST['comunidades']) && in_array('Galicia', $_POST['comunidades'])) echo 'selected'; ?>>Galicia</option>
                <option value="Asturias" <?php if (isset($_POST['comunidades']) && in_array('Asturias', $_POST['comunidades'])) echo 'selected'; ?>>Asturias</option>
            </select><br>
            <?php if (isset($errores['comunidades'])) {
                echo "<p style=color:red>" . $errores['comunidades'] . "</p>";
            } ?>
            <br>
            <label for="comentarios">Comentarios:</label><br>
             <textarea name="comentarios"><?php echo $_POST['comentarios'] ?? "" ?></textarea><br>
            <?php if(isset($errores['comentarios'])){
                echo "<p style = color:red> " .$errores['comentarios']."</p>";
            }?>

            <button type="submit" name="enviar">Enviar</button>
            <button type="submit" name="borrar">Borrar</button>
        <?php } ?> <!--el cierre del if de mostrarformulario-->
    </form>
</body>

</html>