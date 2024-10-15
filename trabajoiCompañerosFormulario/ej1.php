<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #contenedor {
            padding: 10px;
            border: solid 1px black;
        }

        #errores {
            color: red;
        }
    </style>
</head>

<body>

    <?php

    $mandarForm = true;
    $errores = [];
    $info = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // La validación de si el usuario seleccionó o no una opción

        if (isset($_POST["correo"])) {
            $correo = $_POST["correo"];
            $posArroba = strpos($correo, "@");
            $posPunto = strpos($correo, ".");
            //(suponiendo que el @ está en 0) Si usara 0 != false,
            //daría falso ya que interpreta a 0 como falso
            //y falso no es diferente a falso
            if (
                $posArroba !== false &&
                $posPunto !== false &&
                $posArroba != 0 &&
                $posPunto !== $posArroba + 1 &&
                $posPunto !== strlen($correo) - 1
            ) {
                $info["correo"] = $correo;
            } else {
                $errores['correo'] = "Por favor, introduce un correo válido.";
                $mandarForm = false;
            }
        } else {
            $errores['correo'] = "Por favor, introduce un correo válido.";
            $mandarForm = false;
        }

        if (isset($_POST["fechaNac"])) {
            $fechaNac = $_POST["fechaNac"];

            if (
                strlen($fechaNac) == 10 &&
                strpos($fechaNac, "/") == 2 &&
                strrpos($fechaNac, "/") == 5
            ) {
                $info["fechaNac"] = $fechaNac;
            } else {
                $errores['fechaNac'] = "Formato de fecha incorrecto. Debe ser (01/01/0001).";
                $mandarForm = false;
            }
        }

        if (isset($_POST["CantanteGrupo"])) {
            $cantanteGrupo = $_POST["CantanteGrupo"];
            $info["CantanteGrupo"] = $cantanteGrupo;
        } else {
            $errores['CantanteGrupo'] = "Por favor, selecciona un cantante o grupo.";
            $mandarForm = false;
        }

        if (isset($_POST["ropa"])) {
            $ropa = $_POST["ropa"];
            $arribaSeleccionada = in_array("Camiseta", $ropa) ||
                in_array("Polo Ralph Lauren", $ropa) ||
                in_array("North Face puffer", $ropa);
            $abajoSeleccionada = in_array("Baggy jeans", $ropa) ||
                in_array("Chinos", $ropa) ||
                in_array("Jogger", $ropa);

            if ($arribaSeleccionada && $abajoSeleccionada) {
                $info["ropa"] = $ropa;
            } else {
                $errores['ropa'] = "Debes seleccionar al menos una prenda de arriba y una de abajo.";
                $mandarForm = false;
            }
        } else {
            $errores['ropa'] = "Debes seleccionar al menos una prenda de arriba y una de abajo.";
            $mandarForm = false;
        }


        //los <select> siempre envían un valor al ser enviados por lo que si uso
        //isset en vez de empty siempre va a ser válido
        //por ello he puesto una opción extra en el select
        //cuyo valor es "" osea empty
        if (!empty($_POST["pelicula"])) {
            $pelicula = $_POST["pelicula"];
            $info["pelicula"] = $pelicula;
        } else {
            $mandarForm = false;
            $errores["pelicula"] = "Debe seleccionar alguna película.";
        }
    }

    ?>










    <?php if ($mandarForm && $_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <!-- Si la comparación es true en el $server, significa que el usuario
        ha enviado un formulario utilizando el método POST -->
        
        <!-- En el caso de que se haya enviado el formulario correctamente
         enviaremos la información recopilada -->
         <div>
            <h3>Información enviada: </h3>

            <p><strong>Correo:</strong> <?= $info['correo'] ?></p>
            <p><strong>Fecha de nacimiento:</strong> <?= $info['fechaNac'] ?></p>
            <p><strong>Cantante/Grupo seleccionado:</strong> <?= $info['CantanteGrupo'] ?></p>
            <p><strong>Ropa seleccionada:</strong> <?= implode(", ", $info['ropa']) ?></p>
            <p><strong>Película seleccionada:</strong> <?= $info['pelicula'] ?></p>
            <br>
            <p>No me ha dado tiempo a hacer que según las respuestas
                obtenidas te diga a que subcultura perteneces: otaku, alternativo,
                moderno, pijo, cani, un gym bro pretencioso... pero seguro que tu mismo
                sabes dónde perteneces.
            </p>
        </div>
        


    <?php } else { ?>
        <!-- en este caso todavía no se ha mandado
        nada por lo que acaba de cargar la página por primera vez
        así que mostraremos el formulario-->

        <div>¿Quieres saber a que subcultura pertences? Rellena el siguiente cuestionario:</div>
        <br>
        <div id="contenedor">
            <form action="" method="post">

                <!-- CORREO -->
                <label for="nombre">Introduce un correo válido: </label>
                <input type="text" name="correo" value="<?= isset($_POST['correo']) ? $_POST['correo'] : '' ?>">
                <!-- En el caso de que ya existiera un valor en correo recordaremos el contenido 
                así cuando se envíe un formulario que no cumpla con las validaciones
                volveremos a mostrar el valor anteriormente introducido-->
                <?php if (isset($errores["correo"])): ?>
                    <p id="errores"><?= $errores["correo"] ?></p>
                <?php endif; ?>
                <!-- Si existe un error en el correo mostramos el mensaje generado previamente -->


                <br>
                <!-- FECHA NACIMIENTO -->
                <label for="fecha">Introduce tu fecha de nacimiento en el siguiente formato (01/01/0001): </label>
                <input type="text" name="fechaNac" value="<?= isset($_POST['fechaNac']) ? $_POST['fechaNac'] : '' ?>">
                <?php if (isset($errores['fechaNac'])): ?>
                    <p id="errores"><?= $errores['fechaNac'] ?></p>
                <?php endif; ?>

                <br>
                <hr>

                <!-- test -->

                <!-- CANTANTES/GRUPOS -->
                <label for="">Elige uno de los siguientes cantantes/grupos:</label>

                <br>
                <input type="radio" name="CantanteGrupo" value="Green Day" <?= isset($_POST['CantanteGrupo']) && $_POST['CantanteGrupo'] == 'Green Day' ? 'checked' : '' ?>>
                <label for="Green day">Green day</label>

                <input type="radio" name="CantanteGrupo" value="Rosalía" <?= isset($_POST['CantanteGrupo']) && $_POST['CantanteGrupo'] == 'Rosalía' ? 'checked' : '' ?>>
                <label for="Rosalía">Rosalía</label>

                <input type="radio" name="CantanteGrupo" value="Ralphie Choo" <?= isset($_POST['CantanteGrupo']) && $_POST['CantanteGrupo'] == 'Ralphie Choo' ? 'checked' : '' ?>>
                <label for="Ralphie Choo">Ralphie Choo</label>

                <input type="radio" name="CantanteGrupo" value="El canto del loco" <?= isset($_POST['CantanteGrupo']) && $_POST['CantanteGrupo'] == 'El canto del loco' ? 'checked' : '' ?>>
                <label for="El canto del loco">El canto del loco</label>

                <input type="radio" name="CantanteGrupo" value="La mafia del amor" <?= isset($_POST['CantanteGrupo']) && $_POST['CantanteGrupo'] == 'La mafia del amor' ? 'checked' : '' ?>>
                <label for="La mafia del amor">La mafia del amor</label>

                <input type="radio" name="CantanteGrupo" value="Eladio Carrion" <?= isset($_POST['CantanteGrupo']) && $_POST['CantanteGrupo'] == 'Eladio Carrion' ? 'checked' : '' ?>>
                <label for="Eladio Carrion">Eladio Carrion</label>

                <?php if (isset($errores['CantanteGrupo'])): ?>
                    <p id="errores"><?= $errores['CantanteGrupo'] ?></p>
                <?php endif; ?>

                <br>



                <!-- ROPA -->
                <label for="ropa">Elige al menos 2 de las siguientes opciones (mínimo una pieza de arriba y una de abajo): </label>

                <input type="checkbox" name="ropa[]" value="Camiseta" <?= isset($_POST['ropa']) && in_array('Camiseta', $_POST['ropa']) ? 'checked' : '' ?>>
                <label for="Camiseta ACDC">Camiseta ACDC/Green day</label>

                <input type="checkbox" name="ropa[]" value="Polo Ralph Lauren" <?= isset($_POST['ropa']) && in_array('Polo Ralph Lauren', $_POST['ropa']) ? 'checked' : '' ?>>
                <label for="Polo Ralph Lauren">Polo Ralph Lauren</label>

                <input type="checkbox" name="ropa[]" value="North Face puffer" <?= isset($_POST['ropa']) && in_array('North Face puffer', $_POST['ropa']) ? 'checked' : '' ?>>
                <label for="North Face puffer">North Face puffer</label>


                <input type="checkbox" name="ropa[]" value="Baggy jeans" <?= isset($_POST['ropa']) && in_array('Baggy jeans', $_POST['ropa']) ? 'checked' : '' ?>>
                <label for="Baggy jeans">Baggy jeans</label>

                <input type="checkbox" name="ropa[]" value="Chinos" <?= isset($_POST['ropa']) && in_array('Chinos', $_POST['ropa']) ? 'checked' : '' ?>>
                <label for="Chinos">Chinos</label>

                <input type="checkbox" name="ropa[]" value="Jogger" <?= isset($_POST['ropa']) && in_array('Jogger', $_POST['ropa']) ? 'checked' : '' ?>>
                <label for="Jogger">Jogger</label>

                <?php if (isset($errores['ropa'])): ?>
                    <p id="errores"><?= $errores['ropa'] ?></p>
                <?php endif; ?>


                <!-- PELÍCULAS/SERIES -->
                <br>
                <label for="pelicula">Elige una de las siguientes películas/series: </label>
                <select name="pelicula">
                    <option value="">Selecciona una opción</option> <!-- Opción predeterminada -->
                    <option value="Cualquier anime" <?= isset($_POST['pelicula']) && $_POST['pelicula'] == "Cualquier anime" ? 'selected' : '' ?>>Cualquier anime</option>
                    <option value="Cualquier película de Tarantino" <?= isset($_POST['pelicula']) && $_POST['pelicula'] == 'Cualquier película de Tarantino' ? 'selected' : '' ?>>Cualquier película de Tarantino</option>
                    <option value="Elite" <?= isset($_POST['pelicula']) && $_POST['pelicula'] == 'Elite' ? 'selected' : '' ?>>Élite</option>
                    <option value="La que se avecina" <?= isset($_POST['pelicula']) && $_POST['pelicula'] == 'La que se avecina' ? 'selected' : '' ?>>La que se avecina</option>
                    <option value="El club de la lucha" <?= isset($_POST['pelicula']) && $_POST['pelicula'] == 'El club de la lucha' ? 'selected' : '' ?>>El club de la lucha</option>
                </select>

                <?php if (isset($errores['pelicula'])): ?>
                    <p id="errores"><?= $errores['pelicula'] ?></p>
                <?php endif; ?>
                <br>

                <input type="submit" value="Enviar">
                <input type="reset" value="Limpiar">

            </form>
        </div>

    <?php } ?>

</body>

</html>