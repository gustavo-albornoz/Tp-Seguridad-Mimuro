<?php

session_start(); 
error_reporting(0);

$iddor=$_SESSION['idusr'];
$idseg=$_POST['receptor'];

$con="CALL Seguimiento('$iddor','$idseg')"; 
require ("mysql.php");
if($consulta!='0'){
					echo "<script language='JavaScript'>";
					echo "alert('Ya sigues a este usuario!');";
            		echo 'document.location =("perfil.php?p='.$iddor.'");';
            		echo "</script>";
}				else{
					echo "No se ha podido efectuar el seguimiento";
					echo "<script language='JavaScript'>";
					echo "alert('No ha podido comenzar a seguir a la persona que desea. Intente de nuevo mas tarde.');";
            		echo "document.location =('perfil.php?p=".$iddor."');";
            		echo "</script>";
}

mysqli_close($conexion); 

?>