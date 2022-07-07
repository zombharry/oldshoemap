<?php
/* Displays all error messages */
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Hiba</title>
  
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<div class="urlapkinezet">
<h1>Hiba</h1>
    
    <?php 
    if( isset($_SESSION['errormsg']) AND !empty($_SESSION['errormsg']) ): 
        echo $_SESSION['errormsg'];    
    else:
        header( "location: index.php" );
    endif;
    ?>
	<a href="index.php"><button class="btn btn-danger gomb" name="vissza" />Vissza a főoldalra</button></a>
 </div>
    
        
    
</body>
</html>
