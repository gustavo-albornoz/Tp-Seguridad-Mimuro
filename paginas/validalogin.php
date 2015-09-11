<?php 						
session_start(); 
error_reporting (0);
?>
				<?php //validacion de login
						$email = $_POST["mail"];
						$p1 = $_POST["pass"];

						//validacion
						$con="CALL conusr('$email')";
						require("mysql.php");
						$f=mysqli_fetch_array($consulta);
						$pass=$f['password'];
						
						if($f!=NULL) {

							if ($pass==$p1) {
						
						$Nombre=$f['nombre'];
						$Apellido=$f['apellido'];
						$Mail=$f['mail'];
						$descripcion=$f['descripcion'];
						$admin=$f['administrador'];
						$id=$f['idusuario'];
						echo "<script language='JavaScript'>";
            			echo "location = 'home.php';";
            			echo "</script>";  
						//abre una sesion nueva con los valores del usuario registrado 
						$_SESSION['nom']=$Nombre;
						$_SESSION['mail']=$Mail;
						$_SESSION['ape']=$Apellido;
						$_SESSION['des']=$descripcion;
						$_SESSION['admin']=$admin;											
						$_SESSION['activo']=1;
						$_SESSION['idusr']=$id;
						
						mysqli_close($conexion);
						}
						else{ echo "<script language='JavaScript'>";
						      echo "alert('Contraseña ingresada incorrectamente');";
            			      echo "document.location =('../index.php');";
            				  echo "</script>";
            			}
						
						} 
						else{ echo "<script language='JavaScript'>";
						      echo "alert('El usuario no existe');";
            			      echo "document.location =('../index.php');";
							  echo "</script>";
						}
					
						/*--Fin isset validar--*/ 
				?>