<?php 						
session_start(); 
error_reporting (0);
						//envio de settings de opciones de msj
						$id = $_SESSION['idusr'];
						$opcion = $_POST["opcmensajes"];
							  //cantidad de msj
						
					$con="CALL cant_msj('$id','$opcion')";
						 require("mysql.php");
						if ($consulta!='0') {
							  echo "<script language='JavaScript'>";
						      echo "alert('Se actualizo su configuracion de Mensajes');";
            			      echo "document.location =('conf.php');";
							  echo "</script>";
						} 

						else{
							  echo "<script language='JavaScript'>";
						      echo "alert('Ocurrio un error al tratar de cambiar las opciones de Mensajes. Intente nuevamente mas tarde');";
            			      echo "document.location =('conf.php');";
							  echo "</script>";}	

							  
						?>
						
