<?php             
session_start(); 
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/estilo2.css"/>
	<script type="text/javascript" src="js/codigo.js"/></script>
	<title>Mensajes Privados</title>
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
			<?php   
			}
		    ?>
		
		</ul>

		<?php
		// $activo indica que es un usuario registrado y no anonimo 
		$activo=$_SESSION['activo'];
		
		// Toma el parametro 'p' de la url, si existe es porque es el perfil de otro usuario y este indica el de quien. 
		// Sino no existe, el usuario esta en su mismo perfil y obtiene un null
		$perf=$_GET['p'];

		// Limite de la cantidad de mensajes privados
		$con="CALL limitemensajesprivados()";
		require ("mysql.php");
		$a = mysqli_fetch_array($consulta);
		$cantidadLimiteMsjsPrivados = $a['cantidad_limite'];
		?>

		<div class="bienvenidos">
			Hola 
			
			<?php 
			if ($_SESSION!=NULL) {
				$idusr=$_SESSION['idusr'];
				$nombresesion=$_SESSION['nom'];
				echo " <a href='perfil.php?id='.$idusr.''>$nombresesion</a>";	
			}
			?>!

		</div>

		<div id="mensajes">
			<div id="mensajestitulo">Mensajes Privados</div>
			
			<?php //casos de Privacidad
			
			// En el caso de que el usuario este en un perfil ajeno 	
			if ($perf != NULL) {
			
				// Consultamos los datos de ese perfil
				$con="CALL perfil($perf)";
				require ("mysql.php");
				$g=mysqli_fetch_array($consulta);
			
				// Obtenemos el tipo de privacidad
				$privacidad=$g['privacidad'];
			
				// Consultamos si el usuario es seguido por este perfil
				$con="CALL selseg($idusr)";
				require ("mysql.php");
			
				// Recorremos los seguidores y preguntamos si el usuario es seguidor de este perfil
				while ($h=mysqli_fetch_array($consulta)) {
					if ($perf==$h['idseguidor']) {
						$seguidor=true; // = 1 si es seguidor
					}
				}
			} // if($perf != NULL)
				
			// Si el usuario no es anonimo
			if ($activo!=NULL) {
				// Si el perfil no es del usuario y es de otro usuario
				if($perf!=NULL) {
					
					switch ($privacidad) {
						// Perfil con privacidad 1: Solo usuarios que el perfil sigue pueden leer y escribir
						case '1': 
							// Si el perfil es seguidor del usuario
							if ($seguidor==true){
							?>			
								
								<div class="mensajesrecibidos">		
								
								<?php
								
								// Cargo todos los mensajes
								$con="CALL mensajesprivados('$perf')"; 
								require ("mysql.php");

								while($f=mysqli_fetch_array($consulta)){
									echo '<div class="aviso"></br>'.$f['nombre'].' ';
									echo $f['apellido'].'</br></div>';
									echo '<div class="aviso">'.$f['mensaje'].'</div>';													
								}
								?> 
								
								</div> 

								<?php
								if(mysqli_num_rows($consulta) < $cantidadLimiteMsjsPrivados){
								?>

								<div class="escribir">		  
									<form method="post" action="envio-msj-privado.php" name="busqueda">
									<textarea id="mensaje" name="mensaje" rows="3" cols="65" maxlength="300"></textarea>
									<input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
									<input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>							
								</div>

								<?php
								} else {
								?>

								<div class="escribir">		  
									<p>El perfil ya no puede recibir mas mensajes privados. <?php echo 'Cantidad limite: '.$cantidadLimiteMsjsPrivados; ?></p>					
								</div>
								
								<?php	
								}

								mysqli_close($conexion);
							
							} else 
								echo '<div class="aviso"></br>La privacidad de este usuario no permite que envies ni que leas sus msjs</div>';
						
							break;
							
						// Privacidad 2: Todos los usuarios pueden acceder a tu perfil pero solo escribir aquellos que sigues.
						case '2':
							
							// Si el perfil es seguidor del usuario
							if ($seguidor==true){

								$con="CALL mensajesprivados('$perf')"; 
								require ("mysql.php");
								?>			
								
								<div class="mensajesrecibidos">		
								
								<?php	
								while($f=mysqli_fetch_array($consulta)){
									echo '<div class="aviso"></br>'.$f['nombre'].' ';
									echo $f['apellido'].'</br></div>';
									echo '<div class="aviso">'.$f['mensaje'].'</div>';													
								}
											
								?> 
								
								</div> 
								
								<?php
								if(mysqli_num_rows($consulta) < $cantidadLimiteMsjsPrivados){
								?>

								<div class="escribir">		  
									<form method="post" action="envio-msj-privado.php" name="busqueda">
									<textarea id="mensaje" name="mensaje" rows="3" cols="65" maxlength="300"></textarea>
									<input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
									<input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>							
								</div>

								<?php
								} else {
								?>

								<div class="escribir">		  
								<p>El perfil ya no puede recibir mas mensajes privados. <?php echo 'Cantidad limite: '.$cantidadLimiteMsjsPrivados; ?></p>					
								</div>	

									<?php
									mysqli_close($conexion);
								}

							} else { // El perfil no es seguidor del usuario. Entonces el usuario no puede escribir, solo leer

								//registrados que no son seguidos por el perfil que esta visitando
								$con="CALL mensajesprivados('$perf')"; 
								require ("mysql.php");
								?>			
								
								<div class="mensajesrecibidos">		
							
								<?php	
								while($f=mysqli_fetch_array($consulta)){
									echo '<div class="aviso"></br>'.$f['nombre'].' ';
									echo $f['apellido'].'</br></div>';
									echo '<div class="aviso">'.$f['mensaje'].'</div>';													
								}
								
								mysqli_close($conexion);			
								?> 

								</div>
								
							<?php
							}

							break;

						// Privacidad 3: Todos los usuarios registrados pueden acceder a tu perfil y publicar contenido.
						case '3':

							$con="CALL mensajesprivados('$perf')"; 
							require ("mysql.php");
							?>			
							
							<div class="mensajesrecibidos">		
							
							<?php	
							while($f=mysqli_fetch_array($consulta)){
								echo '<div class="aviso"></br><strong>'.$f['nombre'].' ';
								echo $f['apellido'].'</strong></br></div>';
								echo '<div class="aviso">'.$f['mensaje'].'</div>';													
							}
				
							?> 

							</div> 
							
							<?php
							if(mysqli_num_rows($consulta) < $cantidadLimiteMsjsPrivados){
							?>

							<div class="escribir">		  
								<form method="post" action="envio-msj-privado.php" name="busqueda">
								<textarea id="mensaje" name="mensaje" rows="3" cols="65" maxlength="300"></textarea>
								<input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
								<input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>							
							</div>

							<?php
							} else {
							?>	

							<div class="escribir">		  
								<p>El perfil ya no puede recibir mas mensajes privados. <?php echo 'Cantidad limite: '.$cantidadLimiteMsjsPrivados; ?></p>					
							</div>
							<?php	
							}

							mysqli_close($conexion);

							break;
					} // Fin de Switch usuarios registrados

				} else { // El usuario esta en su propio perfil
				
					$con="CALL mensajesprivados('$idusr')"; 
					require ("mysql.php");
					?>			
					
					<div class="mensajesrecibidos">		
					
					<?php	
					while($f=mysqli_fetch_array($consulta)){
						echo '<div class="aviso"></br>'.$f['nombre'].' ';
						echo $f['apellido'].'</br></div>';
						echo '<div class="aviso">'.$f['mensaje'].'</div>';													
					}		
					?>
					
					</div>
					
					<?php
					if(mysqli_num_rows($consulta) < $cantidadLimiteMsjsPrivados){
					?>
					
					<div class="escribir">		  
						<form method="post" action="envio-msj-privado.php" name="busqueda">
						<textarea id="mensaje" name="mensaje" rows="3" cols="65" maxlength="300"></textarea>
						<input type="hidden" id="receptor" name="receptor" value="<?php echo $idusr;?>"/>
						<input type="hidden" id="privado" name="privado" value="1"/>
						<input type="submit" id="botonsend" name="enviar" value="enviar"/></form>							
					</div>
					
					<?php
					} else {
					?>		
					
					<div class="escribir">		  
						<p>El perfil ya no puede recibir mas mensajes privados. <?php echo 'Cantidad limite: '.$cantidadLimiteMsjsPrivados; ?></p>					
					</div>
					
					<?php	
					}

					mysqli_close($conexion);		
				}	
			}else { // Es un usuario anonimo

				if($perf!=NULL){ // Si el perfil no es del anonimo, es de otro usuario
			
					echo "<div class='aviso'><br/>Solo los usuarios registrados pueden enviar o recibir mensajes a este perfil!<br/>
					Registrate o inicia sesion!<br/><br/></div>";
					echo "<form action='../index.php'>
					<input type=submit value='Volver al Inicio' name='logon' id='botonback'>
					</form>";

				} else{

					echo "<div class='aviso'><br/>Solo los usuarios registrados tienen mensajes! Registrate o inicia sesion!<br/><br/></div>";
					echo "<form action='../index.php'>
					<input type=submit value='Volver al Inicio' name='logon' id='botonback'>
					</form>";
				}			
			} 

			?>
		</div>
	</div>
</body>
</html>