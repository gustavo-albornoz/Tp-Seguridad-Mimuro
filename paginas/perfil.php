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
					<?php 
					$activo=$_SESSION['activo'];
					?>

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
						
							<div class="imagen"><img src="../img/perfildefault.png." width="120px" height="120px" alt=""/></a></div>
							<div id="infoperfil"><p>
								<?php 
								$perf=$_GET['p'];
								if ($perf!=NULL) {
												$con="CALL perfil('$perf')"; 
												require ("mysql.php");
												while($resultados=mysqli_fetch_array($consulta)){
													echo '<div class="aviso">'.$resultados['nombre'].' ';
													echo $resultados['apellido'].'</br></div>';
													echo '<div class="aviso">'.$resultados['mail'].'</br></div>';
													echo '<div class="aviso">'.$resultados['descripcion'].'</div>';
												}
									   		}
								else {	   
										if ($activo!=NULL) {
												$Nombre=$_SESSION['nom'];
												$Apellido=$_SESSION['ape'];
												$Mail=$_SESSION['mail'];
												$Descripcion=$_SESSION['des'];
												echo '<div class="aviso">'.$Nombre.' ';
												echo ''.$Apellido.'</br></div>';
												echo '<div class="aviso">'.$Mail.'</br></div>';
												echo'<div class="aviso">'.$Descripcion.'</div>';
												}
										else {				
												echo "<div class='aviso'>Usuario An&oacute;nimo</div>";
								          		}								   		
								     }	     		
								?></p></div>
								
								<?php if($activo!=NULL&&$perf!=NULL){ 
													if($perf==$_SESSION['idusr']){
								?>
								<div><form action="conf.php"><input type="submit" id="botonperfil" name="botonperfil" value="Editar mi perfil"></form></div>
								<div><form action="logout.php"><input type="submit" id="botonperfil2" name="botonperfil2" value="Cerrar Sesion"></form></div>
								<?php
										} 
										else {
								?>
								<form method="post" action="seguidores.php" name="seguidores	"> <!-- nuevo!-->
								<input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/><!-- nuevo!-->
								<div><input type="submit" id="botonperfil" name="botonperfil" value="Seguir"></div></form>
								<?php 								}		
									  					}	 
					  					else { 
					  						if($activo!=NULL){
								?>  <div><form action="conf.php"><input type="submit" id="botonperfil" name="botonperfil" value="Editar mi perfil"></form></div>
								<div><form action="logout.php"><input type="submit" id="botonperfil2" name="botonperfil2" value="Cerrar Sesion"></form></div>
								<?php	} 

								else {
								?> 
								<div></div>
								<?php 		
										}
										}
								?>
						
					</div>


					<div class="lineavertical"></div>

					<div id="mensajes">
						<div id="mensajestitulo">Mensajes</div>
					
					<?php //casos de Privacidad
						$con="CALL perfil($perf)";
						require ("mysql.php");
						$g=mysqli_fetch_array($consulta);
						$privacidad=$g['privacidad']; //llama a la columna Privacidad de la tabla usuario
						$opcmsj=$g['opcmensajes']; // llama a la columna Opcmensajes de la tabla usuario
						$con="CALL selseg($perf)";
						//recorrer los seguidores y determinar si son seguidos por el perfil que estan visitando
						while ($h=mysqli_fetch_array($consulta)) {
							if ($_SESSION['idusr']==$h['idseguidor']) {
								$seguidores=1;
							}
						}
						//el usuario debe estar registrado 
						if ($activo!=NULL) {
							//si el usuario esta viendo un perfil ajeno
							if($perf!=NULL){
										//comienzo switch
								switch ($privacidad) {
									//usuarios registrados que visitan un perfil con privacidad 1
									case '1': 
									//solo usuarios que el perfil sigue pueden leer y escribir
									if ($seguidores!=NULL){

										$con="CALL mensajes('$perf')"; 
													require ("mysql.php");
													while ($f=mysqli_fetch_array($consulta)) {
															$Nombre=$f['nombre'];
															$Apellido=$f['apellido'];
															$Mensaje=$f['mensaje'];
															$cuenta++;
															$arreglo[]=array('nombre'=>$Nombre,
															'apellido'=>$Apellido,
															'mensaje'=>$Mensaje);}
													mysqli_close($conexion);
										?>			
										<div class="mensajesrecibidos">	
										<?php	
										if ($opcmsj=='1') {
											$con="CALL mensajes('$perf')"; 
											require ("mysql.php");
											while($recorrer=mysqli_fetch_array($consulta)){
																				echo '<div class="aviso"></br>'.$recorrer['nombre'].' ';
																				echo $recorrer['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$recorrer['mensaje'].'</div>';													
																				}
											mysqli_close($conexion);
											}

										else{
											//require ("cuenta.php");
											if($cuenta<$opcmsj){
												for ($i=0; $i<$cuenta ; $i++){
																				
																				echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
																				echo $arreglo[$i]['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';													
																				}
											}

											else{//require ("cuenta.php");
												
												 for ($i=0; $i<$opcmsj ; $i++) { //de acuerdo a la cantidad que eligio el usr se muestran los msj

												echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
												echo $arreglo[$i]['apellido'].'</br></div>';
												echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';
												
														}
											}
										}		
										?> 
										</div> 
										<div class="escribir">		  
											<form method="post" action="envio-msj.php" name="busqueda">
                                                <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje aqu&iacute;. 
                                                	Maximo 200 caracteres" rows="3" cols="60" onkeypress="return limita(this,event,200)" 
                                                	onkeyup="cuenta(this,event,200,'contador')"></textarea>
                                                <span id="contador"></span>
                                                <input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
                                                <input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>    
										</div>
										<?php
											break;	

									}
										

										 else echo '<div class="aviso">
										 			</br>La privacidad de este usuario no permite que envies ni que leas sus msjs</div>';
						
										
										break;

									
									//usuarios registrados que visitan un perfil con privacidad 2	
									case '2':
									//solo usuarios que el perfil sigue pueden leer y escribir 
									if ($seguidores!=NULL){

										$con="CALL mensajes('$perf')"; 
													require ("mysql.php");
													while ($f=mysqli_fetch_array($consulta)) {
															$Nombre=$f['nombre'];
															$Apellido=$f['apellido'];
															$Mensaje=$f['mensaje'];
															$cuenta++;
															$arreglo[]=array('nombre'=>$Nombre,
															'apellido'=>$Apellido,
															'mensaje'=>$Mensaje);}
													mysqli_close($conexion);
										?>			
										<div class="mensajesrecibidos">	
										<?php	
										if ($opcmsj=='1') {
											$con="CALL mensajes('$perf')"; 
											require ("mysql.php");
											while($recorrer=mysqli_fetch_array($consulta)){
																				echo '<div class="aviso"></br>'.$recorrer['nombre'].' ';
																				echo $recorrer['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$recorrer['mensaje'].'</div>';													
																				}
											mysqli_close($conexion);
											}

										else{
											//require ("cuenta.php");
											if($cuenta<$opcmsj){
												for ($i=0; $i<$cuenta ; $i++){
																				
																				echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
																				echo $arreglo[$i]['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';													
																				}
											}

											else{//require ("cuenta.php");
												
												 for ($i=0; $i<$opcmsj ; $i++) { //de acuerdo a la cantidad que eligio el usr se muestran los msj

												echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
												echo $arreglo[$i]['apellido'].'</br></div>';
												echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';
												
														}
											}
										}		
										?> 
										</div> 
										<div class="escribir">		  
											<form method="post" action="envio-msj.php" name="busqueda">
                                                <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje aqu&iacute;. 
                                                	Maximo 200 caracteres" rows="3" cols="60" onkeypress="return limita(this,event,200)" 
                                                	onkeyup="cuenta(this,event,200,'contador')"></textarea>
                                                <span id="contador"></span>
                                                <input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
                                                <input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>    
										</div>
										<?php
											break;	

									 }
									//registrados que no son seguidos por el perfil que esta visitando
									else {
										$con="CALL mensajes('$perf')"; 
													require ("mysql.php");
													while ($f=mysqli_fetch_array($consulta)) {
															$Nombre=$f['nombre'];
															$Apellido=$f['apellido'];
															$Mensaje=$f['mensaje'];
															$cuenta++;
															$arreglo[]=array('nombre'=>$Nombre,
															'apellido'=>$Apellido,
															'mensaje'=>$Mensaje);}
													mysqli_close($conexion);
										?>			
										<div class="mensajesrecibidos">	
										<?php	
										if ($opcmsj=='1') {
											$con="CALL mensajes('$perf')"; 
											require ("mysql.php");
											while($recorrer=mysqli_fetch_array($consulta)){
																				echo '<div class="aviso"></br>'.$recorrer['nombre'].' ';
																				echo $recorrer['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$recorrer['mensaje'].'</div>';													
																				}
											mysqli_close($conexion);
											}

										else{
											//require ("cuenta.php");
											if($cuenta<$opcmsj){
												for ($i=0; $i<$cuenta ; $i++){
																				
																				echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
																				echo $arreglo[$i]['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';													
																				}
																}

											else{//require ("cuenta.php");
												
												 for ($i=0; $i<$opcmsj ; $i++) { //de acuerdo a la cantidad que eligio el usr se muestran los msj

												echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
												echo $arreglo[$i]['apellido'].'</br></div>';
												echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';
																				}
												}
										}
										}		
										?> 
										</div> 
										<?php
											break;	
										//default casos 3,4 y 5 de privacidad en el perfil que se visita 
										default:
										//usuarios registrados pueden leer y escribir contenido
											$con="CALL mensajes('$perf')"; 
													require ("mysql.php");
													while ($f=mysqli_fetch_array($consulta)) {
															$Nombre=$f['nombre'];
															$Apellido=$f['apellido'];
															$Mensaje=$f['mensaje'];
															$cuenta++;
															$arreglo[]=array('nombre'=>$Nombre,
															'apellido'=>$Apellido,
															'mensaje'=>$Mensaje);}
													mysqli_close($conexion);
										?>			
										<div class="mensajesrecibidos">	
										<?php	
										if ($opcmsj=='1') {
											$con="CALL mensajes('$perf')"; 
											require ("mysql.php");
											while($recorrer=mysqli_fetch_array($consulta)){
																				echo '<div class="aviso"></br>'.$recorrer['nombre'].' ';
																				echo $recorrer['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$recorrer['mensaje'].'</div>';													
																				}
											mysqli_close($conexion);
											}

										else{
											//require ("cuenta.php");
											if($cuenta<$opcmsj){
												for ($i=0; $i<$cuenta ; $i++){
																				
																				echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
																				echo $arreglo[$i]['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';													
																				}
											}

											else{//require ("cuenta.php");
												
												 for ($i=0; $i<$opcmsj ; $i++) { //de acuerdo a la cantidad que eligio el usr se muestran los msj

												echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
												echo $arreglo[$i]['apellido'].'</br></div>';
												echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';
												
														}
											}
										}		
										?> 
										</div> 
										<div class="escribir">		  
											<form method="post" action="envio-msj.php" name="busqueda">
                                                <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje aqu&iacute;. 
                                                	Maximo 200 caracteres" rows="3" cols="60" onkeypress="return limita(this,event,200)" 
                                                	onkeyup="cuenta(this,event,200,'contador')"></textarea>
                                                <span id="contador"></span>
                                                <input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
                                                <input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>    
										</div>
										<?php
											break;	
											
								}//fin de Switch usuarios registrados
								

											} 

						
							else { //usuario registrado y con perfil propio
									$con="CALL mensajes('$idusr')"; 
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
										<div class="escribir">		  
											<form method="post" action="envio-msj.php" name="busqueda">
                                                <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje aqu&iacute;. 
                                                	Maximo 200 caracteres" rows="3" cols="60" onkeypress="return limita(this,event,200)" 
                                                	onkeyup="cuenta(this,event,200,'contador')"></textarea>
                                                <span id="contador"></span>
                                                <input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
                                                <input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>    
										</div>
								<?php
								}	
											}
						//usuario anonimo sin muro
						else	{	
							//usuario anonimo que mira el perfil de otro usuario
							if($perf!=NULL){//switch para anonimos que visitan el perfil de otro
										switch ($privacidad) {
											case '3':
												echo "<div class='aviso'><br/>Solo los usuarios registrados pueden enviar o recibir mensajes a este perfil!<br/>
												Registrate o inicia sesion!<br/><br/></div>";
												echo "<form action='../index.php'>
    											<input type=submit value='Volver al Inicio' name='logon' id='botonback'>
												</form>";
												break;
											case '1':
												echo "<div class='aviso'><br/>Solo los usuarios registrados pueden enviar o recibir mensajes a este perfil!<br/>
												Registrate o inicia sesion!<br/><br/></div>";
												echo "<form action='../index.php'>
    											<input type=submit value='Volver al Inicio' name='logon' id='botonback'>
												</form>";
											break;
											case '4':
												$con="CALL mensajes('$perf')"; 
													require ("mysql.php");
													while ($f=mysqli_fetch_array($consulta)) {
															$Nombre=$f['nombre'];
															$Apellido=$f['apellido'];
															$Mensaje=$f['mensaje'];
															$cuenta++;
															$arreglo[]=array('nombre'=>$Nombre,
															'apellido'=>$Apellido,
															'mensaje'=>$Mensaje);}
													mysqli_close($conexion);
										?>			
										<div class="mensajesrecibidos">	
										<?php	
										if ($opcmsj=='1') {
											$con="CALL mensajes('$perf')"; 
											require ("mysql.php");
											while($recorrer=mysqli_fetch_array($consulta)){
																				echo '<div class="aviso"></br>'.$recorrer['nombre'].' ';
																				echo $recorrer['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$recorrer['mensaje'].'</div>';													
																				}
											mysqli_close($conexion);
											}

										else{
											//require ("cuenta.php");
											if($cuenta<$opcmsj){
												for ($i=0; $i<$cuenta ; $i++){
																				
																				echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
																				echo $arreglo[$i]['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';													
																				}
											}

											else{//require ("cuenta.php");
												
												 for ($i=0; $i<$opcmsj ; $i++) { //de acuerdo a la cantidad que eligio el usr se muestran los msj

												echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
												echo $arreglo[$i]['apellido'].'</br></div>';
												echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';
												
														}
											}
										}		
										?> 
										</div> 
										<div class="escribir">		  
											<form method="post" action="envio-msj.php" name="busqueda">
                                                <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje aqu&iacute;. 
                                                	Maximo 200 caracteres" rows="3" cols="60" onkeypress="return limita(this,event,200)" 
                                                	onkeyup="cuenta(this,event,200,'contador')"></textarea>
                                                <span id="contador"></span>
                                                <input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
                                                <input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>    
										</div>
										<?php
											break;	
										
											case '5':
													$con="CALL mensajes('$perf')"; 
													require ("mysql.php");
													while ($f=mysqli_fetch_array($consulta)) {
															$Nombre=$f['nombre'];
															$Apellido=$f['apellido'];
															$Mensaje=$f['mensaje'];
															$cuenta++;
															$arreglo[]=array('nombre'=>$Nombre,
															'apellido'=>$Apellido,
															'mensaje'=>$Mensaje);}
													mysqli_close($conexion);
										?>			
										<div class="mensajesrecibidos">	
										<?php	
										if ($opcmsj=='1') {
											$con="CALL mensajes('$perf')"; 
											require ("mysql.php");
											while($recorrer=mysqli_fetch_array($consulta)){
																				echo '<div class="aviso"></br>'.$recorrer['nombre'].' ';
																				echo $recorrer['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$recorrer['mensaje'].'</div>';													
																				}
											mysqli_close($conexion);
											}

										else{
											//require ("cuenta.php");
											if($cuenta<$opcmsj){
												for ($i=0; $i<$cuenta ; $i++){
																				
																				echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
																				echo $arreglo[$i]['apellido'].'</br></div>';
																				echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';													
																				}
											}

											else{//require ("cuenta.php");
												
												 for ($i=0; $i<$opcmsj ; $i++) { //de acuerdo a la cantidad que eligio el usr se muestran los msj

												echo '<div class="aviso"></br>'.$arreglo[$i]['nombre'].' ';
												echo $arreglo[$i]['apellido'].'</br></div>';
												echo '<div class="aviso">'.$arreglo[$i]['mensaje'].'</div>';
												
														}
											}
										}		
										?> 
										</div> 
										<div class="escribir">		  
											<form method="post" action="envio-msj.php" name="busqueda">
                                                <textarea id="mensaje" name="mensaje" placeholder="Escriba su mensaje aqu&iacute;. 
                                                	Maximo 200 caracteres" rows="3" cols="60" onkeypress="return limita(this,event,200)" 
                                                	onkeyup="cuenta(this,event,200,'contador')"></textarea>
                                                <span id="contador"></span>
                                                <input type="hidden" id="receptor" name="receptor" value="<?php echo $perf;?>"/>
                                                <input type="submit" id="botonsend" name="enviar" value="Enviar"/></form>    
										</div>
										<?php
											break;	
										
											case '2':
												echo "<div class='aviso'><br/>Solo los usuarios registrados pueden enviar o recibir mensajes a este perfil!<br/>
												Registrate o inicia sesion!<br/><br/></div>";
												echo "<form action='../index.php'>
    											<input type=submit value='Volver al Inicio' name='logon' id='botonback'>
												</form>";
											break;

										}

									}
									//usuario anonimo y privacidad que eligio el perfil que visita = 5
							else{	
							
							echo "<div class='aviso'><br/>Solo los usuarios registrados tienen mensajes! Registrate o inicia sesion!<br/><br/></div>";
							echo "<form action='../index.php'>
    						<input type=submit value='Volver al Inicio' name='logon' id='botonback'>
							</form>";
								}
							
						}
					?>
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

