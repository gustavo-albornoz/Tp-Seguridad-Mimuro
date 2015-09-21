<?php

session_start(); 
error_reporting(0);

if ($_SESSION!=NULL) {
	
	$idemi=$_SESSION['idusr'];

}else $idemi='13';

$idreceptor=$_POST['receptor'];
$mensaje=$_POST['mensaje'];

$con="CALL enviarmensajesprivados('$mensaje','$idemi','$idreceptor')";

require ("mysql.php");

if($consulta!='0'){
	echo "<script language='JavaScript'>";
	echo "alert('Mensaje Enviado!');";
	
	// Si el emisor es a su vez el receptor. El mismo se envia el mensaje
	if ($idemi == $idreceptor) {
		echo "document.location =('mensajes-privados.php');";
	} else {
		echo "document.location =('mensajes-privados.php?p=".$idreceptor."');";	
	}

	echo "</script>";
} else{			
	echo "error en el envio";
	echo "<script language='JavaScript'>";
	echo "alert('El mensaje no pudo ser enviado. Intenta de nuevo mas tarde.');";
	
	// Si el emisor es a su vez el receptor. El mismo se envia d mensaje
	if ($idemi == $idreceptor) {
		echo "document.location =('mensajes-privados.php');";
	} else {
		echo "document.location =('mensajes-privados.php?p=".$idreceptor."');";	
	}
	
	echo "</script>";
}

mysqli_close($conexion); 
?>