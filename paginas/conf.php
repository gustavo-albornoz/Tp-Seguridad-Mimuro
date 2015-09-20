<?php             
session_start(); 
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/estilo2.css"/>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>	<!--Enlace a Jquery-->
	<script type="text/javascript" src="js/codigo.js"/></script>
		<script type="text/javascript">
		  $(document).ready(function(){ // Script del Navegador
		    $("ul.subnavegador").not('.selected').hide();
		    $("a.desplegable").click(function(e){
		      var desplegable = $(this).parent().find("ul.subnavegador");
		      $('.desplegable').parent().find("ul.subnavegador").not(desplegable).slideUp('slow');
		      desplegable.slideToggle('slow');
		      e.preventDefault();
		    })
		 });
		</script>
	<title>Perfil</title>

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
					<div id="mensajestitulo">Opciones</div>
					<?php if($_SESSION['activo']!=NULL){ 
					?>
					<ul class="navegador">
						  <li id="priv"><a href="#" class="desplegable" title="Privacidad">Privacidad</a>
						    <ul class="subnavegador">
						      <li>
						      <form id="privacidad" action="privacidad.php" method="post">
								<div><input type="radio" name="privacidad" value="1" id="1"> Solo pueden acceder usuarios que sigues.</div>
								<div><input type="radio" name="privacidad" value="2" id="2"> Todos los usuarios pueden acceder a tu perfil pero solo escribir aquellos que sigues.</div>
								<div><input type="radio" checked name="privacidad" value="3" id="3"> Todos los usuarios registrados pueden acceder a tu perfil y publicar contenido.</div>
								<div><input type="radio" name="privacidad" value="4" id="4"> Usuarios an&oacute;nimos pueden leer contenido.</div>
								<div><input type="radio" name="privacidad" value="5" id="5"> Usuarios an&oacute;nimos pueden crear y leer contenido.</div>
					         
					         	<div><input type="submit" id="botonconf" name="botonconf" value="Guardar"></div>
					            </form>
						      </li>
						    </ul>
						  </li>
						  <li id="sobre"><a class="desplegable" href="#" title="Opciones de Mensajes">Opciones de Mensajes</a>
						    <ul class="subnavegador">
						       <li>
						        <form id="privacidad" action="opcmsj.php" method="post">
								<div><input type="radio" name="opcmensajes" value="5" id="6"> Mostrar 5 Mensajes en MiMuro.</div>
								<div><input type="radio" name="opcmensajes" value="10" id="7"> Mostrar 10 Mensajes en MiMuro.</div>
								<div><input type="radio" name="opcmensajes" value="15" id="8"> Mostrar 15 Mensajes en MiMuro.</div>
								<div><input type="radio" name="opcmensajes" value="20" id="9"> Mostrar 20 Mensajes en MiMuro.</div>
								<div><input type="radio" checked name="opcmensajes" value="1" id="10"> Mostrar Todos los Mensajes en MiMuro.</div>

								<div><input type="submit" id="botonconf2" name="botonconf2" value="Guardar"></div>
					        	</form>
								</li>
							</ul>
						  </li>
					
					 <?php
					 } 	
 
				else{ echo "<div class='aviso'><br/>Solo los usuarios registrados pueden configurar su privacidad. 
												Registrate o inicia sesion!<br/><br/></div>";
										echo "<form action='../index.php'>
    									<input type=submit value='Volver al Inicio' name='logon' id='botonback'>
										</form>";
								}
				
					?>
						

					</ul>

							
					
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