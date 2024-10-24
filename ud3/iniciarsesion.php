<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreUsuario = $_POST['nombre'];

    // Definir el nombre del administrador
    $nombreAdmin = "admin";  
    
    // si es el administrador
    if ($nombreUsuario === $nombreAdmin) {
        $_SESSION['usuario'] = $nombreUsuario;
        $_SESSION['admin'] = true; 
        //si es el admin le mandamos a la zona de actualizar stok
        header('Location: administrar.php'); 
        //hace la funcion como un break
        exit();
    } else {
        // Si es un usuario normal
        $_SESSION['usuario'] = $nombreUsuario;
        //no es el administrador
        $_SESSION['admin'] = false; 
        //le mandamos a la tienda normal
        header('Location: carritol.php');
        //hace la funcion como un break  
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
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
