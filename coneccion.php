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

function verIdGrupo(){
	$result = ejecutar("SELECT idG".
	" FROM `grupo` ".
	" WHERE nombreGrupo = '".$_SESSION['grupo']."' ");
	$idG = mysqli_fetch_array($result);
	return $idG[0];
}

function verIdProyecto(){
	$result = ejecutar("SELECT idP".
	" FROM `proyectos` ".
	" WHERE nombreProyecto = '".$_SESSION['nombreProyecto']."' ");
	$idG = mysqli_fetch_array($result);
	return $idG[0];
}

function cargarGrupo($usuario,$contra,$grupo){
	//Antes que nada nos aseguramos que no exista el grupo ni el usuario
	$result = ejecutar("SELECT count( * )".
		" FROM `grupo` ".
		" WHERE usuario = '".$usuario."' ".
		" OR nombreGrupo = '".$grupo."'");

	$hayAlgo = mysqli_fetch_array($result);
	if($hayAlgo[0] > 0) return false;

	//OK, todo bien hasta ahora
	//primero obtenemos el id mas alto para seguir cargando
	$datos = ejecutar("SELECT max( idG ) FROM grupo");

	$id = mysqli_fetch_array($datos);
	//echo "id = ".$id[0];
	if(is_null($id[0])) $id[0] = 1;
	else $id[0] = $id[0] + 1;

	$consulta = "insert into grupo ".
	"values(".$id[0].",'".$usuario."','".$contra."','".$grupo."')";
	ejecutar($consulta);
	return true;
}

function cargarPersona($nombre,$apellido,$dni){
	//Antes que nada tenemos que saber si existe la persona
	$result = ejecutar("SELECT count( * )".
		" FROM `personas` ".
		" WHERE dni = '".$dni."' ");

	//Si no esta la cargamos
	$hayAlgo = mysqli_fetch_array($result);
	if(!$hayAlgo[0] > 0){// return false;
		//primero obtenemos el id mas alto para seguir cargando
		$datos = ejecutar("SELECT max( idPer ) FROM personas");
		$id = mysqli_fetch_array($datos);
		if(is_null($id[0])) $id[0] = 1;
		else $id[0] = $id[0] + 1;

		//Cargamos una nueva persona
		$consulta = "insert into personas ".
		"values(".$id[0].",'".$nombre."','".$apellido."',".$dni.")";
		ejecutar($consulta);
	}else{
		//Si ya esta solo obtenemos su ID
		$result = ejecutar("SELECT idPer".
			" FROM `personas` ".
			" WHERE Nombre = '".$nombre."' ");
		$id = mysqli_fetch_array($result);
	}
	//OK, todo bien hasta ahora
	//Ahora agregamos la peresona al grupo
	//Primero buscamos el id del grupo
	$result = ejecutar("SELECT idG".
		" FROM `grupo` ".
		" WHERE nombreGrupo = '".$_SESSION['grupo']."' ");
	$idG = mysqli_fetch_array($result);

	//Nos tenemos que asegurar que la persona no este cargada a ese grupo
	$result = ejecutar("SELECT count( * )".
	" FROM `personas grupo` ".
	" WHERE idPer = ".$id[0]." AND idG = ".$idG[0]);
	$hayAlgo = mysqli_fetch_array($result);
	if($hayAlgo[0] > 0) return false;


	//Hacemos la asociacion de la persona al grupo
	$consulta = "insert into `personas grupo` ".
	"values(".$id[0].",".$idG[0].")";
	ejecutar($consulta);

	return true;
}

function cargarProyecto($nombreP,$nombreC,$telefono){
	//Tomamos el id del grupo
	$idG = verIdGrupo();
	try {
		//Tomamos el ID para asignarle
		$result = ejecutar("SELECT max( idP ) ".
			"FROM proyectos ".
			"WHERE idG = ".$idG);

		$id = mysqli_fetch_array($result);
		if(is_null($id[0])) $id[0] = 1;
		else $id[0] = $id[0] + 1;

		echo 'ID obtenido: '.$id[0];

		//Cargamos un nuevo proyecto
		$consulta = "insert into proyectos ".
		"values(".$id[0].",'".$nombreP."','".$nombreC."',".$telefono.",".$idG.")";
		echo 'consulta'.$consulta;
		ejecutar($consulta);
	} catch (Exception $e) {
		echo $e;
		return false;
	}
	return true;
}

function cargarRequerimiento($descripcion){
	//Tomamos el id del grupo
	$idP = verIdProyecto();
	try {
		//Tomamos el ID para asignarle
		$result = ejecutar("SELECT max( idR )".
			" FROM `requerimientos` ".
			" WHERE idP = ".$idP);
		$id = mysqli_fetch_array($result);
		if(is_null($id[0])) $id[0] = 1;
		else $id[0] = $id[0] + 1;

		//Cargamos un nuevo proyecto
		$consulta = "insert into requerimientos ".
		"values(".$id[0].",'".$descripcion."',".$idP.")";
		ejecutar($consulta);
	} catch (Exception $e) {
		echo $e;
		return $id[0];
	}
	return "";
}

function traerProyectos(){
	$result = ejecutar("SELECT nombreProyecto".
			" FROM `proyectos` ".
			" WHERE idG = ".verIdGrupo());
	return $result;
}

function traerRequerimientos(){
	$result = ejecutar("SELECT idR, descripcion".
			" FROM `requerimientos` ".
			" WHERE idP = ".verIdProyecto());
	return $result;
}

?>
