<?php             
session_start(); 
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/estilo2.css"/>
	<script type="text/javascript" src="js/codigo.js"/></script>
	<title>Home</title>
</head>
<body>
					<div class="header">

						<div class="mimuro">MiMuro</div>

					</div>
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
									$idusr=$_SESSION['idusr'];
									$nombresesion=$_SESSION['nom'];
									echo " ";
									echo "<a href='perfil.php?id='.$idusr.''>$nombresesion</a>";
							?>!
					</div>

					<div id="home">
						<div id="search"> <!--buscador-->
						<form method="post" action="resultados.php" name="busqueda">
						<div id="busqueda"><input type="text" placeholder="Buscar por Nombre o Mail" name="search" 
								  style="border-radius:4px; width:300px; height:50px;font-size: 23px" id="busqueda"/></div>
						<div id="lupa"> <input type="image" src="../img/icono_buscar.png" style="width:70px; height:70px;" /></div>
						</form>
						</div>

						<div class="lineavertical2"></div>

						<div id="resultados">
						<div id="mensajestitulo">Resultados</div>

					
						</div>
  					</div>

  		</div>
<div class="footer">
  		<div class="pie">
  		Universidad Nacional de la Matanza - Seguridad y Calidad de Aplicaciones Web <br>
  		 Grupo 8 - 2015

  		</div>
  			
  		</div>

</body>
 
</html>
