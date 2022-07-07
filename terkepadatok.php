<?php

session_start();
if(!($_SESSION['loggedin'] == true))
	{
		$_SESSION["errormsg"]="Nem vagy bejelentkezve";
		header("location:error.php");
	}
require 'csatlakozas.php';

$adatok=array(
            'id' => array(),
            'boltnev' => array(),
            'varos' => array(),
            'iranyitoszam' => array(),
            'utca' => array(),
            'hsz' => array(),
            'hossz' => array(),
            'szel' => array(),
            'uzemelteto' => array(),
            'kontakt' => array(),
            'tel' => array(),
            'email' => array()
        );

$sql="select * from terkep";

$parancs=$conn->query($sql);

while($elem=$parancs->fetch_array())
		{
			$adatok[]= array(
			'id' =>$elem['id'],
            'boltnev' => $elem['boltnev'],
            'varos' => $elem['varos'],
            'iranyitoszam' => $elem['iranyitoszam'],
            'utca' => $elem['utca'],
            'hsz' => $elem['hsz'],
            'hossz' => $elem['hossz'],
            'szel' => $elem['szel'],
            'uzemelteto' => $elem['uzemelteto'],
            'kontakt' => $elem['kontakt'],
            'tel' => $elem['tel'],
            'email' => $elem['email']);
		}
$ossz = $parancs->num_rows;

?>
<html lang="hu-HU">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>teszt</title>
	</head>
	<body>
	
	<div>
	<table>
	<tr>
	<th>ID</th>
	<th>boltnév</th>
	<th>város</th>
	<th>irányítószám</th>
	<th>utca</th>
	<th>házszám</th>
	<th>hossz</th>
	<th>szélesség</th>
	<th>űzemeltető</th>
	<th>kontakt</th>
	<th>telefonszám</th>
	<th>email</th>
	<th>műveletek</th>
	</tr>
	<?php 
	
	for($i=0;$i < $ossz; $i++)
	{
		echo "<tr>";
		echo "<td>".$adatok[$i]['id']."</td>";
		echo "<td>".$adatok[$i]['boltnev']."</td>";
		echo "<td>".$adatok[$i]['varos']."</td>";
		echo "<td>".$adatok[$i]['iranyitoszam']."</td>";
		echo "<td>".$adatok[$i]['utca']."</td>";
		echo "<td>".$adatok[$i]['hsz']."</td>";
		echo "<td>".$adatok[$i]['hossz']."</td>";
		echo "<td>".$adatok[$i]['szel']."</td>";
		echo "<td>".$adatok[$i]['uzemelteto']."</td>";
		echo "<td>".$adatok[$i]['kontakt']."</td>";
		echo "<td>".$adatok[$i]['tel']."</td>";
		echo "<td>".$adatok[$i]['email']."</td>";
		/*
		echo "<td> <input type='text' value='".$adatok[$i]['boltnev']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['varos']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['iranyitoszam']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['utca']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['hsz']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['hossz']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['szel']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['uzemelteto']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['kontakt']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['tel']."'></td>";
		echo "<td><input type='text' value='".$adatok[$i]['email']."'></td>";
		*/
		echo "<td><a href='szerkeszt.php/?id=".$adatok[$i]['id']."'>Szerkesztés</a>   <a href='torles.php/?id=".$adatok[$i]['id']."'>Törlés</a> </td>";
		echo "</tr>";
	}
	?>
	
	</table>
	</div>
	
	</body>
</html>