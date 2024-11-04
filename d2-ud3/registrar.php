<?php
session_start();

// Ruta del archivo de usuarios
define("RUTA_USUARIOS", "usuarios.data");


// Verificar si el archivo existe y cargar los usuarios, o inicializar un array vacío si no existe
if (file_exists(RUTA_USUARIOS)) {
    $usuarios = unserialize(file_get_contents(RUTA_USUARIOS));
} else {
    $usuarios = [];
}

//variables iniciales
$errores = [];
$registro_exitoso = false;

// Procesar el formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $ciudad = trim($_POST['ciudad']);
    $edad = trim($_POST['edad']);
    $nombreUsuario = trim($_POST['nombre_usuario']);
    $password = trim($_POST['password']);

    // Validaciones
    if (empty($nombre) || empty($apellido) || empty($ciudad) || empty($edad) || empty($nombreUsuario) || empty($password)) {
        $errores[] = "Todos los campos son obligatorios.";
    }
    if ($edad < 18) {
        $errores[] = "Debes ser mayor de 18 años para registrarte.";
    }
    //comprobar si exixte ya el nombre 
    if (isset($usuarios[$nombreUsuario])) {
        $errores[] = "El nombre de usuario ya está en uso.";
    }

    // Si no hay errores, agregar el usuario
    if (empty($errores)) {

        //hacemos el hash de la contraseña
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        //agregamos el usuario al array
        $usuarios[$nombreUsuario] = [
            'password' => $hashPassword,
            'admin' => false // Establecer si es administrador o no
        ];

        //guardamos el nuevo array
        file_put_contents(RUTA_USUARIOS, serialize($usuarios));

        // Establecer el registro como exitoso
        $registro_exitoso = true;
        
    }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            background-image: url('fondo.jpg');
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size:50px;
            text-align: center; 
            margin-bottom: 20px; 
            color: black;
            background: white;
        }

        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label, input[type="submit"] {
            display: block;
            margin: 10px 0;
            width: 100%;
        }

        input[type="text"],
        input[type="number"],
        input[type="password"] {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: blue;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
        .mensaje, .errores {
            padding: 10px;
            border-radius: 5px;
        }
 
        a {
            display: block;
            margin-top: 10px;
            color: blue;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
</style>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <?php if ($registro_exitoso== true){?>
        <div class="mensaje">
            <p>Registro exitoso </p>
            <a href="iniciarsesion.php">iniciar sesión</a>
        </div>
    <?php }if (!empty($errores)){?>
        <div class="errores">
        <?php foreach ($errores as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
        </div>
    <?php }?>
    <form method="post">
    <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="ciudad">Ciudad:</label>
        <input type="text" id="ciudad" name="ciudad" required>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>

        <label for="nombre">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Registrar">
    </form>
    <a href="iniciarsesion.php">Ya tengo cuenta</a>
</body>
</html>