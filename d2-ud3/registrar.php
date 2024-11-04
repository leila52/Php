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
// Procesar el formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $ciudad = trim($_POST['ciudad']);
    $edad = trim($_POST['edad']);
    $nombreUsuario = trim($_POST['nombre_usuario']);
    $password = trim($_POST['password']);

    // Validaciones
    $errores = [];
    if (empty($nombre) || empty($apellido) || empty($ciudad) || empty($edad) || empty($nombreUsuario) || empty($password)) {
        $errores[] = "Todos los campos son obligatorios.";
    }
    if ($edad < 18) {
        $errores[] = "Debes ser mayor de 18 años para registrarte.";
    }

    // Si no hay errores, agregar el usuario
    if (empty($errores)) {
        //si el nombre ya exixte
        if (isset($usuarios[$nombreUsuario])) {
            $errores[] = "El nombre de usuario ya está en uso.";
        }else{
            //hacemos el hash de la contraseña
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            //agregamos el usuario al array
            $usuarios[$nombreUsuario] = [
                'password' => $hashPassword,
                'admin' => false // Establecer si es administrador o no
            ];
            //guardamos el nuevo array
            file_put_contents(RUTA_USUARIOS, serialize($usuarios));
            echo "<p>Registro exitoso. Puedes iniciar sesión ahora.</p>";
            header('Location: iniciarsesion.php');
        }
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
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: blue;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: ligth blue;
    }

    a {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
    <h1>Registrar de Usuario</h1>
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