<?php
$productos = array('Fresas', 'Platanos', 'Limones');
$MAX_PRODUCTOS = 3;
$TOPE_PRODUCTO = 10;
?>
<html>

<head>
    <title>UD2 - Carrito simple</title>
</head>


    <p>Cesta de la compra de fruta y verdura:</p>

    <form action="" method="post">
        <label id="producto1"> producto 1</label>
        <select name="productos1[]" >
            <?php foreach($productos as $producto){
                echo" <option value=\"$producto\"> $producto </option>";
            }?>
        </select>
        <input type="number" id="cantidad" name="cantidad"/>

        <br>
        <br>
        <label id="producto2"> producto 2</label>
        <select name="productos2[]" >
            <?php foreach($productos as $producto){
                echo" <option value=\"$producto\"> $producto </option>";
            }?>
        </select>
        <input type="number" id="cantidad2" name="cantidad2"/>

        <br>
        <br>
        <label id="producto3"> producto 3</label>
        <select name="productos3[]" >
            <?php foreach($productos as $producto){
                echo" <option value=\"$producto\"> $producto </option>";
            }?>
        </select>
        <input type="number" id="cantidad3" name="cantidad3"/>

        <br>
        <br>
        <label id="quiere"> quieres peregil</label>

        <input type="checkbox" id="perejil">
        <br>
        <br>
        <input type="submit" name="confirmar" value="actualizar">
        
    </form>
    <?php
   
   
   $mostrarformulario=true;
   $mensaje=[];
   $produtco1;
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
           $productos =$_POST['productos1'];
           foreach ($productos as $pro){
               $producto1=$pro;
               
           }
           if(isset($_POST['cantidad'])){
               if($_POST['cantidad'] > $TOPE_PRODUCTO){
                   $cantidad=10;
               }else{
                   $cantidad=$_POST['cantidad'];
               }
           }



           $productos =$_POST['productos2'];
           foreach ($productos as $pro){
               $producto2=$pro;
               
           }

           if(isset($_POST['cantidad2'])){
               if($_POST['cantidad2'] > $TOPE_PRODUCTO){
                   $cantidad2=10;
               }else{
                   $cantidad2=$_POST['cantidad2'];
               }
           }



           $productos =$_POST['productos3'];
           foreach ($productos as $pro){
               $producto3=$pro;
               
           }if(isset($_POST['cantidad3'])){
               if($_POST['cantidad3'] > $TOPE_PRODUCTO){
                   $cantidad3=10;
               }else{
                   $cantidad3=$_POST['cantidad3'];
               }
           }


           if(!empty($_POST['perejil'])){
               $menaje="si quiere peregil";
           }else{
               $mensaje="no quiere peregil";
           }

           if(isset($_POST['confirmar'])){
               $mostrarformulario=false;
               echo"<h1>Resummen: </h1>";
               if(!empty($cantidad)){
                echo "producto1: ".$producto1 ." con una cantidad de ". $cantidad;
                echo"<br>";
               }
               if(!empty($cantidad2)){
                echo "producto2: ".$producto2 ." con una cantidad de ". $cantidad2;
               echo"<br>";
               }
               if(!empty($cantidad3)){
                echo "producto3: ".$producto3 ."  con una cantidad de ". $cantidad3;
                echo"<br>";
               }
               
               echo $mensaje;
               $cantidad=0;
               $cantidad2=0;
               $cantidad3=0;
           }
       }
  
   

?>
</body>

</html>