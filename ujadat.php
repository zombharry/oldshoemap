<?php

session_start();
if(!($_SESSION['loggedin'] == true))
	{
		$_SESSION["errormsg"]="Nem vagy bejelentkezve";
		header("location:error.php");
	}
require 'csatlakozas.php';

?>
<html lang="hu-HU">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>teszt</title>
	</head>
	<body>
	
	<div>
	<form action="uj.php" method="POST">
	
	<label for="boltnev">Bolt</label><br>
	<input type="text" name="boltnev" class="boltnev"><br>
	
	<label for="varos">Város</label><br>
	<input type="text" name="varos" class="varos"><br>
	
	<label for="iranyitoszam">Irányítószám</label><br>
	<input type="number" name="iranyitoszam" class="iranyitoszam"><br>
	
	<label for="utca">Utca</label><br>
	<input type="text" name="utca" class="utca"><br>
	
	<label for="hsz"></label>Házszám<br>
	<input type="text" name="hsz" class="hsz"><br>
	
	<label for="hossz">Hossz</label><br>
	<input type="number" name="hossz" class="hossz"> . <input type="number" name="hosszdec" class="hosszdec"><br>
	
	<label for="szel">Szélesség</label><br>
	<input type="number" name="szel" class="szel"> . <input type="number" name="szeldec" class="szeldec"><br>
	
	<label for="uzemelteto">Üzemeltető</label><br>
	<input type="text" name="uzemelteto" class="uzemelteto"><br>
	
	<label for="kontakt">Kontakt</label><br>
	<input type="text" name="kontakt" class="kontakt"><br>
	
	<label for="tel">Telefon</label><br>
	+36 <input type="number" name="tel" class="tel"><br>
	
	<label for="email">Email</label><br>
	<input type="email" name="email" class="email"><br>
	
	
	<input type="submit" value="Felvétel">
	</form>
	</div>
	</body>
</html>