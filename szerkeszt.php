<?php
session_start();
if(!($_SESSION['loggedin'] == true))
	{
		$_SESSION["errormsg"]="Nem vagy bejelentkezve";
		header("location:error.php");
	}
require 'csatlakozas.php';

$teszt=htmlspecialchars($_GET["id"]);
if (!(is_numeric($teszt)))
{
	
header ("location:../terkepadatok.php");
}


$sql="select * from terkep where id=$teszt";

$parancs=$conn->query($sql);
$elem=$parancs->fetch_assoc();

?>
<html lang="hu-HU">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>teszt</title>
	</head>
	<body>
	
	<div>
	<form action="../mentes.php" method="POST">
	<table >
	<?php 
	

		echo "<tr>";
		echo "<td><input type='hidden' name='id' value='".$elem['id']."'></td>";
			echo "<td>ID: ".$elem['id']."</td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>boltnév: <input type='text' name='boltnev' value='".$elem['boltnev']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>város: <input type='text' name='varos' value='".$elem['varos']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>irányítószám: <input type='text' name='iranyitoszam' value='".$elem['iranyitoszam']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>utca: <input type='text' name='utca' value='".$elem['utca']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>házszám: <input type='text' name='hsz' value='".$elem['hsz']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>hossz: <input type='text' name='hossz' value='".$elem['hossz']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>szélesség: <input type='text' name='szel' value='".$elem['szel']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>űzemeltető: <input type='text' name='uzemelteto' value='".$elem['uzemelteto']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>kontakt: <input type='text' name='kontakt' value='".$elem['kontakt']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>telefonszám: <input type='text' name='tel' value='".$elem['tel']."'></td>";
		echo "</tr>";
		echo "<tr>";
			echo "<td>email: <input type='text' name='email'value='".$elem['email']."'></td>";
		echo "</tr>";

	?>
		</table>
		<input type="submit" name="mentes" value="Mentés">
		</form>
	</div>
	
	</body>
</html>