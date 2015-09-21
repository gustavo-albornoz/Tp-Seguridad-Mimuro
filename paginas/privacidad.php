<?php 						
session_start(); 
error_reporting (0);
						//envio de settings de privacidad
						$id = $_SESSION['idusr'];
						$priv = $_POST["privacidad"];
						//validacion
						$con="CALL updpriv('$id','$priv')";
						require("mysql.php");
						if ($consulta!='0') {
							  echo "<script language='JavaScript'>";
						      echo "alert('Se actualizo su configuracion de privacidad');";
            			      echo "document.location =('conf.php');";
							  echo "</script>";
						} else{
							  echo "<script language='JavaScript'>";
						      echo "alert('Ocurrio un error al tratar de cambiar la privacidad. Intente nuevamente mas tarde');";
            			      echo "document.location =('conf.php');";
							  echo "</script>";}


					
						/*--Fin isset validar--*/ 
				?>
				
