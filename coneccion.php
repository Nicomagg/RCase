<?php
function ejecutar($consulta){
	//echo $usuario.'<br>';


  $con=mysqli_connect("localhost","root","","rcase");
  // Check connection
  $var = mysqli_query($con,$consulta);
  mysqli_close($con);
  return $var;
}

function validarLogin($usuario,$contra,$grupo){

	$datos = ejecutar("select * from grupo where usuario='".$usuario."' AND contrasenia='".$contra."' AND nombreGrupo = '".$grupo."' ");

	$fila=mysqli_fetch_array($datos);

	return $fila[0]; //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
}


?>
