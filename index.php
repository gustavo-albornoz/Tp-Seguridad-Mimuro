<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/estilo2.css"/>
	<script type="text/javascript" src="js/codigo.js"/></script>
	<title>	Login</title>
</head>
<body>
	<div id="contenedor">
		<div id="login">
			<h1>Iniciar Sesi&oacute;n</h1>
				<div id="formulariologin">
				<form method="post" action="paginas/validalogin.php" id="formulario" name="formulario" onsubmit="return fvalidar(this)">
					<div id="ingreso">Ingrese su Mail</div>
					<div id="entrada"><input type="text" name="mail" id="mail" placeholder="Mail" style="width:300px; height:30px; border-radius:3px;"></div>
				  	<div id="ingreso">Ingrese su Contrase&ntilde;a</div>
				  	<div id="entrada"><input type="password" name="pass" id="pass" placeholder="Contrase&ntilde;a" style="width:300px; height:30px; border-radius:3px"></div>
					<br>
				 	<br>
				 	<div><input type="button" id="aceptar" name="aceptar" value="ACEPTAR" onclick="fvalidar(formulario)"></div>
				</form>
			</div>
		</div>
	
		<div id="registro">
			<h1>Registro</h1>
			<form method="post" action="paginas/register.php" id="vregistro" name="vregistro" onsubmit="return rvalidar(this)">
			<div id="ingreso">Ingrese su Nombre</div>
					<div id="entrada"><input type="text" name="nombre" id="nombre" placeholder="Nombre" style="width:300px; height:30px; border-radius:3px;"></div>
				  	<div id="ingreso">Ingrese su Apellido</div>
				  	<div id="entrada"><input type="text" name="apellido" id="apellido" placeholder="Apellido" style="width:300px; height:30px; border-radius:3px"></div>
					<div id="ingreso">Ingrese su Mail</div>
					<div id="entrada"><input type="text" name="mail" id="mail" placeholder="Mail" style="width:300px; height:30px; border-radius:3px;"></div>
				  	<div id="ingreso">Ingrese su Contrase&ntilde;a</div>
				  	<div id="entrada"><input type="password" name="pass1" id="pass1" placeholder="Contrase&ntilde;a" style="width:300px; height:30px; border-radius:3px"></div>
					<div id="ingreso">Confirme su Contrase&ntilde;a</div>
				  	<div id="entrada"><input type="password" name="pass2" id="pass2" placeholder="Contrase&ntilde;a" style="width:300px; height:30px; border-radius:3px"></div>
					<br>
				 	<div><input type="submit" id="aceptar" name="aceptar" value="ENVIAR"  onclick="rvalidar(vregistro)"></div>
				</form>
		</div>

		<div id="anonimo">
			<h1>Usuarios An&oacute;nimos</h1>
			<form method="post" action="paginas/home.php">
			<br>
			<div><input type="submit" id="aceptar" name="aceptar" value="INGRESAR SIN REGISTRO"></div>
			</form>
		</div>

	</div>		
	</body>
</html>