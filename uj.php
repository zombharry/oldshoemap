<?php
session_start();
if(!($_SESSION['loggedin'] == true))
	{
		$_SESSION["errormsg"]="Nem vagy bejelentkezve";
		header("location:error.php");
	}
require 'csatlakozas.php';


$boltnev=$conn->real_escape_string($_POST['boltnev']);
$varos=$conn->real_escape_string($_POST['varos']);
$isz=$conn->real_escape_string($_POST['iranyitoszam']);
$utca=$conn->real_escape_string($_POST['utca']);
$hsz=$conn->real_escape_string($_POST['hsz']);
$hosszegesz=$conn->real_escape_string($_POST['hossz']);
$hosszdec=$conn->real_escape_string($_POST['hosszdec']);
$szelegesz=$conn->real_escape_string($_POST['szel']);
$szeldec=$conn->real_escape_string($_POST['szeldec']);
$uzemelteto=$conn->real_escape_string($_POST['uzemelteto']);
$kontakt=$conn->real_escape_string($_POST['kontakt']);
$tel=$conn->real_escape_string($_POST['tel']);
$email=$conn->real_escape_string($_POST['email']);

$hossz=$hosszegesz.".".$hosszdec;
$szel=$szelegesz.".".$szeldec;
$tel='+36'.$tel;



$sql= "Insert into terkep (boltnev,varos,iranyitoszam,utca,hsz,hossz,szel,uzemelteto,kontakt,tel,email) Values ('".$boltnev."','".$varos."','".$isz."','".$utca."','".$hsz."','".$hossz."','".$szel."','".$uzemelteto."','".$kontakt."','".$tel."','".$email."')";

$conn->query($sql) or die();

header("location:ujadat.php");
?>