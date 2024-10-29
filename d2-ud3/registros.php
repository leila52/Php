<?php
session_start();
define("RUTA_USUARIOS", "usuarios.data");

// Cargar el archivo de usuarios
if (file_exists(RUTA_USUARIOS)) {
    $usuarios = unserialize(file_get_contents(RUTA_USUARIOS));
} else {
    $usuarios = [];
}

// Procesar el formulario de registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreUsuario = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];  // Permitir que elija el rol de usuario

    // Verificar que el usuario no exista
    if (isset($usuarios[$nombreUsuario])) {
        echo "<p style='color:red;'>El usuario ya existe. Elige otro nombre.</p>";
    } else {
        // Guardar el usuario con la contraseña en hash
        $usuarios[$nombreUsuario] = [
            "hash" => password_hash($contrasena, PASSWORD_DEFAULT),
            "rol" => $rol
        ];
        file_put_contents(RUTA_USUARIOS, serialize($usuarios));
        echo "<p>Registro exitoso. Ahora puedes iniciar sesión.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
    <style> /* (Tu CSS aquí si lo necesitas) */ </style>
</head>
<body>
    <h1>Registro de nuevo usuario</h1>
    <form method="post">
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <label for="rol">Rol:</label>
        <select name="rol">
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
        </select>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>