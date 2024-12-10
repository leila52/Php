<?php session_start()?>
<!-- Mostrar SOLO si el inicio de sesión es válido cambiando nombre por su usuario: -->
<?php
$mostrarformulario=true;
    $passwd = array(
    "user1" => '$2y$10$3SgeyVJD/mw0rvRtjkwWk.8XM1.GpDr8NWc95bN.tpSK2sEriXtX2',
    "user2" => '$2y$10$OymrA3YaPJ4Pfnh.H3GOneuD2y5OklZVW28OxrniOdkDyLWPN/80u',
    "user3" => '$2y$10$qmNdtRRxXXfVRQy8Sjb7bey1RZqj.I2sz3NvUO2kuz2hjZHud2rrC',
    "user4" => '$2y$10$s4PyteQlBtBLtdL0pO9jQ.3TEB0z2kAMGfQCmpNig91Q8o8hwEZY6',
    "user5" => '$2y$10$kNiEqiag6PPROoFQM9E6BuEEVYPm6Lev9OS7y9N20FdRnTeCqBC0y',
    "user6" => '$2y$10$CrbCkq6F.RCI4nyydjXwKu5hSRf4ZSrNi6J5P3jJJ8Fl4JlTz57Y2',
    "user7" => '$2y$10$rXNAShF5ADOowmIV.82KnuMHntgpbvG5oQtFs1/KQrKCkipDTK2BS',
    "user8" => '$2y$10$FFkEH4zNMAC5R8UPFahqMeYdVqQtSfMMW0oLD6e4zOTWyTtZWmSJG',
    "user9" => '$2y$10$ClccGXvtRiKGkwgh4fhNKOLqnYDs/ta2bqbeiA4o7RVrZ0Koiz1kG',
    "user10" => '$2y$10$dX8LQLCIcJc5IwHqdP1aVOiINd0SF1IfPu8xzf4tnCyxuIonXRbf.'
<<<<<<< HEAD
    );
    
    // Crear un usuario dinámicamente
if (!isset($passwd['user11'])) {
    $passwd['user11'] = password_hash("mandarina", PASSWORD_BCRYPT);
}
// Comprobar si se ha solicitado cerrar sesión
if (isset($_POST['cerrar'])) {
    session_destroy();
    header("Location: passwd.php");
    exit();
}
if (isset($_SESSION['usuario'])) {
    $mostrarformulario=false;
    echo "<p>Bienvenido " . htmlspecialchars($_SESSION['usuario']) . "!</p>";
    echo "<form method='post'>";
    echo "<input type='submit' name='cerrar' value='Cerrar sesión' />";
    echo "</form>";
} else {
    if(isset(($_POST['confirmar']))){
        $usuario= $_POST['usuario'];
        $password= $_POST['contrasena'];
        echo'hola';
        if($passwd[$usuario] && password_verify($password,$passwd[$usuario])){
            $_SESSION['usuario']=$usuario;
            $mostrarformulario=false;
            //aqui se muestra el nombre del usuario 
            echo" Bienvenido $usuario";
            echo"<form method=\"post\">";
            echo" <input type=\"submit\" name=\"cerrar\" value=\"cerrar sesión\" />";
            echo"<form >";
            if( isset($_POST['cerrar'])){
                session_destroy();
=======
    
);



    $nombreAdmin = "user11";
    if (!isset($passwd[$nombreAdmin])) { // Asegúrate de que no exista user11
        $passwordAdmin = password_hash("mandarina", PASSWORD_DEFAULT); 
        $passwd[$nombreAdmin] = $passwordAdmin; // Agregar correctamente user11
    }

    
    if(isset($_SESSION['usuario'])){
        echo" Bienvenido ".$_SESSION['usuario'];
        $mostrarformulario=false;
        //aqui se muestra el nombre del usuario 
        echo"<form method=\"post\">";
        echo" <input type=\"submit\" name=\"cerrar\" value=\"cerrar sesión\" />";
        echo"</form >";
        if( isset($_POST['cerrar'])){
            session_destroy();
        }
        
    }

        if(isset(($_POST['confirmar']))){
            $usuario= $_POST['usuario'];
            $password= $_POST['contrasena'];
            if(isset($passwd[$usuario]) && password_verify($password,$passwd[$usuario])){
                $_SESSION['usuario']=$usuario;
                echo" Bienvenido ".$_SESSION['usuario'];
                $mostrarformulario=false;
                //aqui se muestra el nombre del usuario 
                echo"<form method=\"post\">";
                echo" <input type=\"submit\" name=\"cerrar\" value=\"cerrar sesión\" />";
                echo"</form >";
                if( isset($_POST['cerrar'])){
                    session_destroy();
                }
        
            }else{
                echo "Usuario y/o contraseñas incorrectos";  
                $mostrarformulario=false;
                echo"<form method=\"post\">";
                echo" <input type=\"submit\" name=\"intentar\" value=\"iniciar sesion\" />";
                echo"</form >";
                if( isset($_POST['intentar'])){
                    header('Location: passwd.php');
                }
>>>>>>> 9f68a0a6629cc449a5f7b95697460a2250e6402a
            }
        }
    }
}
?>
<!-- Mostrar solo si no se ha autenticado ya -->
<?php if($mostrarformulario==true){?>
<form method="post">
<p>
<label for="usuario">Usuario:</label>
<input type="text" name="usuario" />
</p>
<p>
<label for="contrasena">Contraseña:</label>
<input type="password" name="contrasena" />
</p>
<p><input type="submit" name="confirmar" value="Iniciar sesión" /></p>
</form>
<?php }?>


