<?php
session_start();
require 'csatlakozas.php';

$felhasznalo=$conn->real_escape_string($_POST['uname']);
$jelszo=$conn->real_escape_string($_POST['pw']);
$lekerdezes="select * from users where uname='$felhasznalo'";
$eredmeny=$conn->query($lekerdezes);

	if($eredmeny->num_rows==0)
	{
		//nincs ilyen felhasználó
		
		$_SESSION['errormsg']="Hibás felhasználónév";
		header("location: error.php");
	}

	else
	{
		$belepo=$eredmeny->fetch_assoc();
			if(password_verify($jelszo,$belepo['pw'])){
				$_SESSION['loggedin'] = true;
				$_SESSION["user"]=$belepo["uname"];
		    	header("location: adminoldal.php");
				}
			else
            {
				//hibás jelszó
				$_SESSION['errormsg']="Hibás jelszó";
				header("location: error.php");
            }
	
}


?>