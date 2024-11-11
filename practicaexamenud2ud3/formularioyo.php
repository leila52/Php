<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formulario de practica de examen </h1>
    <?php
    $mostrarformulario = true;
    $errores =[];
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrar'])){
        //limpiamos si quiere borrar
        $_POST=[];
        header('Location:formularioyo.php');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['enviar'])){
            //validamos el nombre
            //si esta vacia
            if(empty($_POST['nombre'])){
                $errores['nombre'] = "<p>error</p>";
            }//cadena mayor a 2
            else if(stren($_POST['nombre'])<2  && (strlen($_POST['nombre']) > 16)){
                $errores['nombre'] = " <p style= color:red > el nombre debe medir más de 2 y menos de 16 </p>";

            }else if (is_numeric($_POST['nombre'])) {
                $errores['nombre'] = "<p style= color:red>El nombre no tiene números</p>";
            } else {
                $_SESSION['nombre'] = $_POST['nombre'];
            }
            //validar contraseña
            if (empty($_POST['passwd'])) {
                $errores['passwd'] = "<p style= color:red> ERROR</p>";
            } else if (strlen($_POST['passwd']) < 10) {
                $errores['passwd'] = " <p style= color:red >la contraseña debe medir más de 10 caracteres</p>";
            } else if (!ctype_upper($_POST['passwd'][0])) {
                $errores['passwd'] = "<p style=color:red> Debe empezar por mayúscula</p>";
            } else {
                $_SESSION['passwd'] = $_POST['passwd'];
            }
            //validar telefono
            if (empty($_POST['telefono'])) {
                $errores['telefono'] = "<p style= color:red> ERROR</p>";
            } else if (strlen($_POST['telefono']) != 9) { //cuidado con el parentesis 
                $errores['telefono'] = "<p style = color:red> SOLO DEBE TENER 9 NÚMEROS</p>";
            }
            //validar email
            if (empty($_POST['email'])) {
                $errores['email'] = "ERROR";
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "EMAIL NO VÁLIDO";
            }

            // validar radio
            if (empty($_POST['mayor'])) {
                $errores['mayor'] = "selecciona una de las dos opciones";
            }
            //validar checkbox
            if (empty($_POST['id'])) {
                $errores['id'] = "Selecciona una opción al menos";
            }

        }
    }
?>
</body>
</html>