<?php
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: carrito.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    include 'users.php';

    if (isset($users[$username]) && password_verify($password, $users[$username])) {
        $_SESSION['authenticated'] = true;
        header('Location: carrito.php');
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
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
        <label>Contraseña:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Ingresar">
    </form>
    <?php if (isset($error)) echo $error; ?>
</body>
</html>
