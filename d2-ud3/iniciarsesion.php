<?php
session_start();

// definimos la ruta del archivo de usuarios
define("RUTA_USUARIOS","usuarios.data");

//verificamos si el archivo exixte y cargar los usuarios o iniciamos el array vacio si esque no exixte

if(file_exists(RUTA_USUARIOS)){
    $usuarios=unserialize(file_get_contents(RUTA_USUARIOS));
}else{
    $usuarios=[];

}
//el formulario de iniciar sesion
//usamos trim() funcion de php para eliminar espacios
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nombreUsuario = trim($_POST['nombre']);
    $password = trim($_POST['password']);
    //vemos si el usuario exixte y si la contraseña es correcta
    if(isset($usuarios[$nombreUsuario]) && password_verify($password, $usuarios[$nombreUsuario]['password'])){
        $_SESSION['usuario'] = $nombreUsuario;
        $_SESSION['admin'] = $usuarios[$nombreUsuario]['admin'];

        //si es admin le llevamos a administrar
        if ($_SESSION['admin']) {
            header('Location: administrar.php');
        } else {
            header('Location: carritol.php');
        }
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
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <p>Todavía no tienes cuenta acede aqui para crear una nueva</p>
        <a href="registrar.php">Crear nueva cuenta</a>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
