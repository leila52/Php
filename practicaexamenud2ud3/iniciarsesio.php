<?php session_start()?>
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
    <?php
    define("RUTA_USUARIOS",""usuarios.data);
        if(file_exists(RUTA_USUARIOS)){
            $usuarios=unserialize(file_get_contents(RUTA_USUARIOS));

        }else{
            $usuarios=[];
        }

        //crear admin
        $admin="admin";
        if(!isset($usuarios[$admin])){
            $password=password_hash("admin123",PASSWORD_DEFAULT);
            $usuarios[$admin]=[
                'password'=>$password
            ];
            file_put_contents(RUTA_USUARIOS,serialize($usuarios));

        }

        //iniciar sesion como tal
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $nombreUsuario=$_POST['nombre'];
            $password=$_POST['password'];

            if(isset($usuarios[$nombreUsuario]) && password_verify($password,$usuarios[$nombreUsuario]['$password'])){
                $_SESSION['usuario'] =$nombreUsuario;

                if( $_SESSION['usuario']=="admin"){
                    header('Location:administrar.php');
                }else{
                    header('Location:carrito.php');
                }
            }else{
                echo "<p>no exixte</p>";
            }
        }

    ?>
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