<?php
session_start();

unset($_SESSION['nom']);
unset($_SESSION['mail']);
unset($_SESSION['ape']);
unset($_SESSION['des']);
unset($_SESSION['admin']);
unset($_SESSION['activo']);
unset($_SESSION['idusr']);


echo "<script language='JavaScript'>";
echo "alert('Sesion cerrada correctamente');";
echo "document.location =('../index.php');";
echo "</script>";

error_reporting (0);
?>