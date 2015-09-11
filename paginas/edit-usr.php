<?php             
session_start(); 
error_reporting(0);

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/estilo2.css"/>
	<script type="text/javascript" src="js/codigo.js"/></script>
	<title>	Admin</title>
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

<?php
		$id=$_GET['id'];
?>
					<div id="home">
						
						
						<div id="mensajestitulo">Editar Perfil</div>

<div id="registro2">
	<div id="registro2b">
			<form method="post" action="updusr.php" id="vregistro" name="vregistro">
			<div id="ingreso">Ingrese el Nombre</div>
			<div id="entrada"><input type="text" name="nombre" id="nombre" placeholder="Nombre" style="width:300px; height:30px; border-radius:3px;"></div>
			<div id="ingreso">Ingrese el Apellido</div>
			<div id="entrada"><input type="text" name="apellido" id="apellido" placeholder="Apellido" style="width:300px; height:30px; border-radius:3px"></div>
			<div id="ingreso">Ingrese el Mail</div>
			<div id="entrada"><input type="text" name="mail" id="mail" placeholder="Mail" style="width:300px; height:30px; border-radius:3px;"></div>
		</div>
		<div id="registro2b">
			<div id="ingreso">Ingrese la Contrase&ntilde;a</div>
			<div id="entrada"><input type="password" name="pass" id="pass1" placeholder="Contrase&ntilde;a" style="width:300px; height:30px; border-radius:3px"></div>
			<div id="ingreso">Confirme la Contrase&ntilde;a</div>
			<div id="entrada"><input type="password" name="pass" id="pass2" placeholder="Contrase&ntilde;a" style="width:300px; height:30px; border-radius:3px"></div>
			<input type="hidden" id="id" name="idusr" value="<?php echo $id;?>"/>		
			<br>
			<div><input type="submit" id="aceptar" name="aceptar" value="ENVIAR"></div>
				</form>
			</div>
</div>



		</div>	


</div>
</div>

</body>
</html>