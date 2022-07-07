<?
session_start();
if(!($_SESSION['loggedin'] == true))
	{
		$_SESSION["errormsg"]="Nem vagy bejelentkezve";
		header("location:error.php");
	}



?>
<html>
	<head>
		<title>adminoldal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

	</head>
	<body>
		<div>
			<ul>
			
				<li><a href="terkepadatok.php"> Térképadatok </a></li>
				<li><a href="ujadat.php"> Új adat hozzáadása </a></li>
				<li><a href="logout.php">Kijelentkezés</a></li>
	
			</ul>
		</div>
	</body>
	
	
</html>