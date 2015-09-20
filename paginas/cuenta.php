<?php
session_start(); 
error_reporting(0);


$con="CALL mensajes('$perf')"; 
require ("mysql.php");

$cuenta=0;

while($recorrer=mysqli_fetch_array($consulta)){
 					$cuenta++;
											   }



?>