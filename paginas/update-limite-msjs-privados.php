<?php 						
session_start(); 
error_reporting (0);
		
$limiteMsjsPrivados = $_POST["limiteMsjsPrivados"];

$con="CALL updt_limite_msjs_priv($limiteMsjsPrivados)";

require("mysql.php");

if ($consulta!='0') {
	  echo "<script language='JavaScript'>";
      echo "alert('Se actualizo el limite de mensajes privados.');";
      echo "document.location =('admin.php');";
	  echo "</script>";
} else{
	  echo "<script language='JavaScript'>";
      echo "alert('Ocurrio un error al tratar de cambiar el limite de mensajes privados. Intente nuevamente mas tarde');";
      echo "document.location =('admin.php');";
	  echo "</script>";}
?>