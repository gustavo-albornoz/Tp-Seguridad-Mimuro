<?php

session_start(); 
error_reporting(0);

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$mail=$_POST['mail'];
$p1=$_POST['pass1'];

$con="CALL usuario_alta('$nombre','$apellido','$mail','$p1')";
require ("mysql.php");
if($consulta!='0'){
					echo "<script language='JavaScript'>";
					echo "alert('Usuario registrado. Pendiente de alta.');";
            		echo "document.location =('../index.php');";
            		echo "</script>";
}				else{
					echo "error en el envio";
					echo "<script language='JavaScript'>";
					echo "alert('El usuario no se pudo registrar. Intente de nuevo mas tarde');";
            		echo "document.location =('../index.php');";
            		echo "</script>";
}


?>