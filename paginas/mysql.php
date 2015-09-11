
<?php
//declaracion de variables
$server="localhost:3306";
$user="root";
$password="";
$db="mensajes";

//conexion Mysql
$conexion=(mysqli_connect($server,$user,$password));
$bdd=mysqli_select_db($conexion,$db);
//Query que envia dos variables
$consulta=mysqli_query($conexion,$con);
?>