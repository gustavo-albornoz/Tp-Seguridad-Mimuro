<?php             
session_start(); 
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/estilo2.css"/>
	<script type="text/javascript" src="js/codigo.js"/></script>
	<title>Perfil</title>
</head>
<body>
		<div id="container">
				<ul class="dropdown"><!--Menu horizontal-->
					<li><a href="home.php" class="dir">Home</a></li>
					<li><a href="perfil.php" class="dir">Mi Perfil</a></li>
					<li><a href="mensajes-privados.php" class="dir">Mensajes Privados</a></li>
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

				<div id="perfilmostrar">
						
					<div class="imagen"><img src="../img/perfildefault.png" width="120px" height="120px" alt=""/></a></div>
					<div id="infoperfil"><p></p></div>

					<div><input type="submit" id="botonperfilguardar" name="botonperfil" value="Guardar Cambios"></div>

				</div>

				<div class="lineavertical"></div>

				<div id="mensajes">
					<div id="mensajestitulo">Privacidad</div>
					<?php if($_SESSION['activo']!=NULL){ 
					?>
					<form id="privacidad" action="privacidad.php" method="post">
					<div><input type="radio" name="privacidad" value="1" id="1"> Solo pueden acceder usuarios que sigues.</div>
					<div><input type="radio" name="privacidad" value="2" id="2"> Todos los usuarios pueden acceder a tu perfil pero solo escribir aquellos que sigues.</div>
					<div><input type="radio" checked name="privacidad" value="3" id="3"> Todos los usuarios registrados pueden acceder a tu perfil y publicar contenido.</div>
					<div><input type="radio" name="privacidad" value="4" id="4"> Usuarios an&oacute;nimos pueden leer contenido.</div>
					<div><input type="radio" name="privacidad" value="5" id="5"> Usuarios an&oacute;nimos pueden crear y leer contenido.</div>

					<div><input type="submit" id="botonconf" name="botonconf" value="Guardar"></div>
					</form>
					<?php } else{ 		echo "<div class='aviso'><br/>Solo los usuarios registrados pueden configurar su privacidad. 
												Registrate o inicia sesion!<br/><br/></div>";
										echo "<form action='../index.php'>
    									<input type=submit value='Volver al Inicio' name='logon' id='botonback'>
										</form>";
								}
					?>
				</div>

  		</div>
</body>
   			

</body>
</html>					