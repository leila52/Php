<?php
session_start();

// Cargar usuarios y contraseñas desde un archivo
define("RUTA_USUARIOS", "usuarios.data");

// Verificar si el archivo de usuarios existe
if (file_exists(RUTA_USUARIOS)) {
    $usuarios = unserialize(file_get_contents(RUTA_USUARIOS));
} else {
    // Inicializar con un administrador por defecto si no existe el archivo
    $usuarios = [
        "administrador" => [
            "hash" => password_hash("admin123", PASSWORD_DEFAULT),
            "rol" => "admin"
        ]
    ];
    file_put_contents(RUTA_USUARIOS, serialize($usuarios));
}

// Procesar el formulario de autenticación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreUsuario = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el usuario existe
    if (isset($usuarios[$nombreUsuario]) && password_verify($contrasena, $usuarios[$nombreUsuario]['hash'])) {
        $_SESSION['usuario'] = $nombreUsuario;
        $_SESSION['rol'] = $usuarios[$nombreUsuario]['rol'];

        // Redirigir según el rol del usuario
        if ($usuarios[$nombreUsuario]['rol'] === "admin") {
            header('Location: administrar.php');
        } else {
            header('Location: carrito.php');
        }
        exit();
    } else {
        echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
        body{
            background-image: url('fondo.jpg');
        }
        h1 {
            font-size:50px;
            text-align: center; 
            margin-bottom: 20px; 
            color: black;
            background: white;
        }
        form {
            text-align: center;
            background: rgba(255, 255, 255, 255); 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size:30px;
            font-weight: bold;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Bienvenido a Sephora</h1>
    <form method="post">
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
