<?php
/*
if (!isset($_SESSION)) {
    session_start();
}
//Validamos la entrada al grupo
if(!isset($_SESSION['grupo'])){
    echo '<script language = javascript>
    alert("No tienes permiso para ver esta pagina");
    self.location = "index.html"</script>';
}
*/
//---------------
function mensaje($texto){
	echo '<script language = javascript>
    alert("'.$texto.'");</script>';
}

function mensajeRedir($texto,$url){
	mensaje($texto);
	echo '<script language = javascript>
    self.location = "'.$url.'";</script>';
}
//---------------

function ejecutar($consulta){
	//echo '<br>Consulta : '.$consulta.'<br>';
	$con=mysqli_connect("localhost","root","","rcase");
	$var = mysqli_query($con,$consulta);
	mysqli_close($con);
	return $var;
}

function traerUno($consulta){
	$result = ejecutar($consulta);
    $hayAlgo = mysqli_fetch_array($result);
    //echo 'desde traer uno: '.$hayAlgo[0].'<br>';
    return $hayAlgo[0];
}

//--------Validar Cosas--------

function validarLogin($usuario,$contra,$grupo){
	$datos = ejecutar("select * ".
		" from grupo ".
		" where usuario='".$usuario."' ".
		" AND contrasenia='".$contra."' ".
		" AND nombreGrupo = '".$grupo."' ");
	$fila=mysqli_fetch_array($datos);
	//opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
	return $fila[0]; 
}

function validarIdRequerimiento($idR){
	//Validamos que el requerimiento sea de un proyecto
	//y que ese proyecto sea de ese grupo
	//Traemos el nombre del grupo segun el requerimiento que entro
	$result = ejecutar("SELECT g.nombreGrupo ".
	        "FROM `requerimientos` r ".
	        "INNER JOIN `proyectos` p ON r.idP = p.idP ".
	        "INNER JOIN `grupo` g ON g.idG = p.idG ".
	        "WHERE r.idR = ".$idR);
	if(!$result) return 1; //No existe el requerimiento
	$nombre = mysqli_fetch_array($result);
	if($nombre[0] != $_SESSION['grupo']) return 2; //NO es un requerimiento de ese grupo
	return 0; //Todo en orden
}

function validarIdRequisito($idReq){
	//primero nos fijamos si existe
	$existe = traerUno("SELECT count(*) ".
	        "FROM `requisitos` req ".
	        "INNER JOIN `requerimientos` r ON r.idR = req.idR ".
	        "INNER JOIN `proyectos` p ON r.idP = p.idP ".
	        "INNER JOIN `grupo` g ON g.idG = p.idG ".
	        "WHERE req.idReq = ".$idReq);
	if($existe == 0) return 1; //No existe el requisito
	//OK existe, pero debe ser del grupo logeado
	//Validamos que el requisito sea de un requerimiento
	//que el requerimiento sea de un proyecto
	//y que ese proyecto sea de ese grupo
	//Traemos el nombre del grupo segun el requerimiento que entro
	$result = ejecutar("SELECT g.nombreGrupo ".
	        "FROM `requisitos` req ".
	        "INNER JOIN `requerimientos` r ON r.idR = req.idR ".
	        "INNER JOIN `proyectos` p ON r.idP = p.idP ".
	        "INNER JOIN `grupo` g ON g.idG = p.idG ".
	        "WHERE req.idReq = ".$idReq);
	//if(!$result) return 1; //No existe el requisito
	$nombre = mysqli_fetch_array($result);
	if($nombre[0] != $_SESSION['grupo']) return 2; //NO es un requisito de ese grupo
	return 0; //Todo en orden
}

//--------Ver Cosas--------

function verIdGrupo(){
	$result = ejecutar("SELECT idG".
	" FROM `grupo` ".
	" WHERE nombreGrupo = '".$_SESSION['grupo']."' ");
	$idG = mysqli_fetch_array($result);
	return $idG[0];
}

function verIdProyecto($proyecto){
	$result = ejecutar("SELECT idP".
	" FROM `proyectos` ".
	" WHERE nombreProyecto = '".$proyecto."'".
	" AND idG = ".verIdGrupo());
	$idG = mysqli_fetch_array($result);
	return $idG[0];
}

//--------Traer Cosas--------

function traerProyectos(){
	$result = ejecutar("SELECT nombreProyecto".
			" FROM `proyectos` ".
			" WHERE idG = ".verIdGrupo());
	return $result;
}

function traerRequerimientos($proyecto){
	$result = ejecutar("SELECT idR, descripcion".
			" FROM `requerimientos` ".
			" WHERE idP = ".verIdProyecto($proyecto));
	return $result;
}

function proximoId($tabla,$campo){
	$result = ejecutar("SELECT max( ".$campo." ) ".
			"FROM ".$tabla);

	$id = mysqli_fetch_array($result);
	if(is_null($id[0])) $id[0] = 1;
	else $id[0] = $id[0] + 1;
	return $id[0];
}

//--------Cargar Cosas--------

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
		//Nos aseguramos que
		//no haya un proyecto con el mismo nombre
		$result = ejecutar("SELECT count(*) ".
			"FROM proyectos ".
			"WHERE idG = ".$idG." AND nombreProyecto = '".$nombreP."'");
		$cant = mysqli_fetch_array($result);
		if($cant[0] > 0) return 1;

		//Tomamos el ID para asignarle
		$id = proximoId("proyectos","idP");

		//Cargamos un nuevo proyecto
		$consulta = "insert into proyectos ".
		"values(".$id.",'".$nombreP."','".$nombreC."',".$telefono.",".$idG.")";
		ejecutar($consulta);
	} catch (Exception $e) {
		echo $e;
		return 2;
	}
	return 0;
}

function cargarRequerimiento($descripcion,$proyecto){
	//Tomamos el id del proyecto
	$idP = verIdProyecto($proyecto);
	try {
		//Nos aseguramos que
		//no haya un requerimiento con el mismo nombre
		$result = ejecutar("SELECT count(*) ".
			"FROM requerimientos ".
			"WHERE idP = ".$idP." AND descripcion = '".$descripcion."'");
		$cant = mysqli_fetch_array($result);
		if($cant[0] > 0) return -2;

		//Tomamos el ID para asignarle
		$id = proximoId("requerimientos","idR");

		//Cargamos un nuevo requerimiento
		$consulta = "insert into requerimientos ".
		"values(".$id.",'".$descripcion."',".$idP.")";
		ejecutar($consulta);
	} catch (Exception $e) {
		echo $e;
		return -1;
	}
	return $id;
}

function cargarRequisito($nombre,$descripcion,
	$entrada,$salida,$prioridad,$estado,$requerimiento){
	try {
		//Primero validamos que el id del requerimiento que entro
		//pertenezca a uno de un proyecto del grupo
		$result = validarIdRequerimiento($requerimiento);
		if($result != 0) return -3;
		//Nos aseguramos que
		//no haya un requisito con el mismo nombre
		$result = ejecutar("SELECT count(*) ".
			" FROM requisitos ".
			" WHERE  Nombre = '".$nombre."'".
			" AND idR = ".$requerimiento);
		$cant = mysqli_fetch_array($result);
		if($cant[0] > 0) return -2;

		//Tomamos el ID para asignarle
		$id = proximoId("requisitos","idReq");

		//Cargamos un nuevo requisito
		$consulta = "insert into requisitos ".
			"values(".$id.",'".$nombre."','".
			$descripcion."','".$entrada."','".
			$salida."','".$prioridad."','".
			$estado."',".$requerimiento.")";
		ejecutar($consulta);
	} catch (Exception $e) {
		echo $e;
		return -1;
	}
	return $id;
}

?>
