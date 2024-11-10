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
//cremaos el usurio
$nombreAdmin = "admin";
if (!isset($usuarios[$nombreAdmin])) {
    $passwordAdmin = password_hash("admin123", PASSWORD_DEFAULT); 
    $usuarios[$nombreAdmin] = [
        'password' => $passwordAdmin,
        'admin' => true
    ];
    file_put_contents(RUTA_USUARIOS, serialize($usuarios));
}

//el formulario de iniciar sesion
//usamos trim() funcion de php para eliminar espacios
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nombreUsuario = trim($_POST['nombre']);
    $password = trim($_POST['password']);
    //vemos si el usuario exixte y si la contraseña es correcta
    if(isset($usuarios[$nombreUsuario]) && password_verify($password, $usuarios[$nombreUsuario]['password'])){
        $_SESSION['usuario'] = $nombreUsuario;

        //si es admin le llevamos a administrar
        if (($_SESSION['usuario']=="admin")) {
            header('Location: administrar.php');
        } else {
            header('Location: carritol.php');
        }
    }else{
        echo "<p style='color:white;'>No exixte este usuario.</p>";
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
            margin-bottom: 10px;
            font-size: 1.2em;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
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
        <input type="submit" value="Entrar">
        <p>¿Todavía no tienes cuenta? </p>
        <a href="registrar.php">Crear nueva cuenta</a>
        
    </form>
</body>
</html>