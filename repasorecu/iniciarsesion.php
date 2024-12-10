<?php sesion_star();?>
<?php
    define("RUTA_USUARIOS","usuario.data");
    
    if(file_exists(RUTA_USUARIOS)){
        $usuarios=unserialize(file_get_contents(RUTA_USUARIOS))
    }else{
        $usuarios=[];
    }

    $nombreAdmin="admin";
    if(!isset($usuarios[$nombreAdmin])){
        $passwordAdmin=password_hash("123",PASSWORD_DEFAULT);
        $usuarios[$nombreAdmin]=[
            'password'=> $passwordAdmin
        ];
        file_put_contents(RUTA_USUARIOS,serialize($usuarios));

    }

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $nombreUsuario = trim($_POST['nombre']);
        $password = trim($_POST['password']);
        if(isset($usuarios[$usuario]) && password_verify($password,$usuarios[$nombreUsuario]['password'])){
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