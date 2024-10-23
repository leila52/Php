<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    /*if(isset($_GET['contador'])){
        $cont= $_GET['contador']+1;
    }else{
        $cont=1;
    }*/
    //echo " <p>tus visitas : $cont </p>";
   echo "<a href=contador.php?contador=$cont> seguir</a>";

  /* if(isset($_REQUEST['contador'])){
    $cont=$_REQUEST['contador'] +1;
   }else{
        $cont=1;
   }*/
   echo " <p>tus visitas : $cont </p>";
    ?>
    <!--
    <form>
        <input type="hidden" name=contador value="<?=$cont?>"/>
        <input type="submit" value="cuenta"/>
    </form>-->
</body>
</html>