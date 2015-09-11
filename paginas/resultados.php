<?php             
session_start(); 
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/estilo2.css"/>
	<script type="text/javascript" src="js/codigo.js"/></script>
	<title>Home</title>
</head>
<body>
		<div id="container">

					<ul class="dropdown"><!--Menu horizontal-->
						<li><a href="home.php" class="dir">Home</a></li>
						<li><a href="perfil.php" class="dir">Mi Perfil</a></li>
						<li><a href="conf.php" class="dir">Configuraci&oacute;n</a></li>
						<?php
              			if($_SESSION['admin']==1){
          				?>
              			<li><a href="admin.php" class="dir">Admin</a></li>
          				<?php   }
					    ?>
					</ul>

					<div class="bienvenidos">
						Hola <?php 
									if ($_SESSION!=NULL) {
									$idusr=$_SESSION['idusr'];
									$nombresesion=$_SESSION['nom'];
									echo " ";
									echo "<a href='perfil.php?id='.$idusr.''>$nombresesion</a>";	
									}

							?>!
					</div>


					<div id="home">
						<div id="search"> <!--buscador-->
						<form method="post" action="resultados.php" name="busqueda">
						<div id="busqueda"><input type="text" placeholder="Buscar por Nombre o Mail" name="search" 
								  style="border-radius:4px; width:300px; height:50px;font-size: 23px" id="busqueda" /></div>
							<div id="lupa"> <input type="image" src="../img/icono_buscar.png" style="width:70px; height:70px;" /></div>
						</form>
						</div>

						<div class="lineavertical2"></div>

						<div id="resultados">
						<div id="mensajestitulo">Resultados</div>
						<?php
						$d=$_POST['search'];
						
            
						$con="CALL search1('%$d%')"; //llama stored procedure
						require ("mysql.php"); //llama al archivo php
						echo "<div class='aviso'>Resultados por Nombre</br></br>";
						while($resultados=mysqli_fetch_array($consulta)){  //devuelve resultados en forma de array 
   						echo '<a href="perfil.php?p='.$resultados['idusuario'].'">Ir al Perfil de:</a>'; //link dinamico que vuelve a la pagina del disco
   						echo ' '.$resultados['nombre'].' ';
   						echo $resultados['apellido']." - ";
   						echo $resultados['descripcion']."</br>";
   						}                
   						echo "</br>";
   						mysqli_close($conexion); //cierra conexion mysql

   						$con="CALL search2('%$d%')"; //llama stored procedure
						require ("mysql.php"); //llama al archivo php
						echo "Resultados por Mail</br></br>";
						while($resultados=mysqli_fetch_array($consulta)){  //devuelve resultados en forma de array 
   						echo '<a href="perfil.php?p='.$resultados['idusuario'].'">Ir al Perfil de:</a>'; //link dinamico que vuelve a la pagina del disco
   						echo ' '.$resultados['mail'].' - ';
   						echo $resultados['descripcion']."</br>";
   						}
   						mysqli_close($conexion); //cierra conexion mysql
					    ?>
					
						</div>
  					</div>

  		</div>

</body>
   			

</body>
</html>