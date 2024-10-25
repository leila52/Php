<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreUsuario = $_POST['nombre'];

    // Definir el nombre del administrador
    $nombreAdmin = "administrador";  
    // si es el administrador
    if ($nombreUsuario === $nombreAdmin) {
        $_SESSION['usuario'] = $nombreUsuario;
        //si es el admin le mandamos a la zona de actualizar stok
        header('Location: administrar.php'); 
    } else {
        // Si es un usuario normal
        $_SESSION['usuario'] = $nombreUsuario;
        //no es el administrador
        //le mandamos a la tienda normal
        header('Location: carritol.php');
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
        <label for="nombre">Ingrese su nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
