<?php
session_start();
if(!($_SESSION['loggedin'] == true))
	{
		$_SESSION["errormsg"]="Nem vagy bejelentkezve";
		header("location:error.php");
	}
require 'csatlakozas.php';

$id=$conn->real_escape_string($_POST['id']);
$boltnev=$conn->real_escape_string($_POST['boltnev']);
$varos=$conn->real_escape_string($_POST['varos']);
$isz=$conn->real_escape_string($_POST['iranyitoszam']);
$utca=$conn->real_escape_string($_POST['utca']);
$hsz=$conn->real_escape_string($_POST['hsz']);
$hossz=$conn->real_escape_string($_POST['hossz']);
$szel=$conn->real_escape_string($_POST['szel']);
$uzemelteto=$conn->real_escape_string($_POST['uzemelteto']);
$kontakt=$conn->real_escape_string($_POST['kontakt']);
$tel=$conn->real_escape_string($_POST['tel']);
$email=$conn->real_escape_string($_POST['email']);


$sql="update terkep set boltnev='".$boltnev."',varos='".$varos."',iranyitoszam='".$isz."',utca='".$utca."',hsz='".$hsz."',hossz='".$hossz."',szel='".$szel."',uzemelteto='".$uzemelteto."',kontakt='".$kontakt."',tel='".$tel."',email='".$email."' where id='".$id."'";

$parancs=$conn->query($sql);

header("location:terkepadatok.php");
?>