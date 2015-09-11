<?php             
session_start(); 
error_reporting(0);

$id=$_POST['id'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$mail=$_POST['mail'];
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];

if ($pass1==$pass2) {

$con="CALL updusr('$nombre','$apellido','$mail','$pass1','$id')";
require ("mysql.php");
if($consulta!='0'){
					echo "<script language='JavaScript'>";
					echo "alert('Usuario actualizado');";
            		echo "document.location =('admin.php');";
            		echo "</script>";
}				
		else{
					echo "<script language='JavaScript'>";
					echo "alert('El usuario no pudo ser actualizado');";
            		echo "document.location =('admin.php');";
            		echo "</script>";
}

}else   echo "<script language='JavaScript'>";
		echo "alert('Los passwords no coinciden');";
        echo "document.location =('admin.php');";
        echo "</script>";

mysqli_close($conexion); 

?>