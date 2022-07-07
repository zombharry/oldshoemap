<?php


$host='localhost';
$user='root';
$pw='';
$db='shoessql';


$conn=new mysqli($host,$user,$pw,$db);
$conn->query("SET NAMES UTF8");
$conn->query("set character set UTF8");
$conn->query("set collation_connection='utf8_hungary_ci'");
?>