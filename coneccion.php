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
	$usuario = 
    $ar=fopen("hostinger.txt","r+");
    $text= explode(",",fread($ar,250));
    fclose($ar);
    $servidor = $text[0];
    $usuario = $text[1];
    $contra = $text[2];
    $base = $text[3];
    //echo 'servidor = '.$servidor.', usuario = '.$usuario.', contra = '.$contra.', base = '.$base.'<br>';
	//echo '<br>Consulta : '.$consulta.'<br>';
	$con=mysqli_connect($servidor,$usuario,$contra,$base);
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
	//Primero nos fijamos que el proyecto sea del grupo
	$result = traerUno("SELECT count(*)".
	" FROM `proyectos` ".
	" WHERE nombreProyecto = '".$proyecto."'".
	" AND idG = ".verIdGrupo());
	if($result == 0) return -1;

	//Ok seguimos con el id
	$result = ejecutar("SELECT idP".
	" FROM `proyectos` ".
	" WHERE nombreProyecto = '".$proyecto."'".
	" AND idG = ".verIdGrupo());
	$idG = mysqli_fetch_array($result);
	return $idG[0];
}

//--------Traer Cosas--------

function traerProyectos(){
	$result = ejecutar("SELECT * ".
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

function traerEntrevistas($proyecto){
	$result = ejecutar("SELECT * ".
			" FROM `entrevistas` ".
			" WHERE idP = ".verIdProyecto($proyecto));
	return $result;
}

function traerPersonas(){
	$result = ejecutar("SELECT * FROM `personas` p ".
		" inner join `personas grupo` pg on p.idPer = pg.idPer ".
		" inner join `grupo` g on g.idG = pg.idG ".
		" WHERE g.idG = ".verIdGrupo());
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

//--------Menu de Cosas--------

//Menu de Pagina Grupo
function menuGrupo(){
	echo '<a href="paginaGrupo.php">'.$_SESSION['grupo'].'</a>';
}
//Menu de Pagina Proyecto
function menuProyecto($proyecto){
	echo '<a href="paginaGrupo.php">'.$_SESSION['grupo'].'</a>';
	echo ' / ';
	echo '<a href="paginaProyecto.php?proyecto='.$proyecto.'">'.$proyecto.'</a>';
}
//Menu de Pagina Requerimiento
function menuRequerimiento($proyecto,$descripcion,$idR){
	echo '<a href="paginaGrupo.php">'.$_SESSION['grupo'].'</a>';
	echo ' / ';
	echo '<a href="paginaProyecto.php?proyecto='.$proyecto.'">'.$proyecto.'</a>';
	echo ' / ';
	echo '<a href="paginaRequerimientos.php?id='.$idR.'">'.$descripcion.'</a>';
}
//Menu de Pagina Requisito
function menuRequisito($proyecto,$rId,$rDescripcion,$reqDescripcion,$idReq){
	echo '<a href="paginaGrupo.php">'.$_SESSION['grupo'].'</a>';
	echo ' / ';
	echo '<a href="paginaProyecto.php?proyecto='.$proyecto.'">'.$proyecto.'</a>';
	echo ' / ';
	echo '<a href="paginaRequerimientos.php?id='.$rId.'">'.$rDescripcion.'</a>';
	echo ' / ';
	echo '<a href="paginaRequisitos.php?id='.$idReq.'">'.$reqDescripcion.'</a>';
}

//Menu de Pagina Entrevistas
function menuEntrevistas($proyecto,$descripcion,$idEn){
	echo '<a href="paginaGrupo.php">'.$_SESSION['grupo'].'</a>';
	echo ' / ';
	echo '<a href="paginaProyecto.php?proyecto='.$proyecto.'">'.$proyecto.'</a>';
	echo ' / ';
	echo '<a href="paginaEntrevista.php?id='.$idEn.'">'.$descripcion.'</a>';
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
	//Tomamos el id del proyecto, siempre que exista
	$idP = verIdProyecto($proyecto);
	if($idP == -1) -1;
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


function cargarEntrevista($descripcion,$proyecto){
	//Tomamos el id del proyecto, siempre que exista
	$idP = verIdProyecto($proyecto);
	if($idP == -1) -1;
	try {
		//Nos aseguramos que
		//no haya una entrevista con el mismo nombre
		$result = ejecutar("SELECT count(*) ".
			"FROM entrevistas ".
			"WHERE idP = ".$idP." AND descripcion = '".$descripcion."'");
		$cant = mysqli_fetch_array($result);
		if($cant[0] > 0) return -2;

		//Tomamos el ID para asignarle
		$id = proximoId("entrevistas","idEn");

		//Tomamos la fecha actual
		$fecha = date("Y-m-d");

		//Cargamos una nueva entrevista
		$consulta = "insert into entrevistas ".
		"values(".$id.",'".$descripcion."','".$fecha."',".$idP.")";
		ejecutar($consulta);
	} catch (Exception $e) {
		echo $e;
		return -1;
	}
	return $id;
}

//---------Validar Entrada de Cosas--------

function hayCodigoInyectado($texto){
	$texto = strtolower($texto);
	//SQL Inyection
	$lista[0] = 'union';
	$lista[1] = 'select';
	$lista[2] = 'insert';
	$lista[3] = 'delete';
	$lista[4] = 'drop';
	$lista[5] = 'update';
	$lista[6] = ';';
	$lista[7] = "\'";
	$lista[8] = '\"';
	$lista[9] = '*';
	$lista[10] = ')';
	$lista[11] = '(';
	$lista[12] = 'table';
	$lista[13] = 'schema';
	$lista[14] = '%';
	$lista[15] = '=';
	$lista[16] = 'like';
	$lista[17] = '--';
	//Cross Site Scripting
	$lista[18] = 'script';
	//Cross Site Styling
	$lista[19] = 'style';

	for($i = 0; $i < 20; $i = $i +1 )
		if (strpos($texto, $lista[$i]) !== false) banear();
}

function obtenerIP(){
   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
           $ip = getenv("HTTP_CLIENT_IP");
   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
           $ip = getenv("HTTP_X_FORWARDED_FOR");
   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
           $ip = getenv("REMOTE_ADDR");
   else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
           $ip = $_SERVER['REMOTE_ADDR'];
   else
           $ip = "IP desconocida";
   return($ip);
}

function banear(){
	//Tomamos el ID para asignarle
	$id = proximoId("baneados","idBan");
	//Tomamos el IP
	$ip = obtenerIP();
	//Tomamos la fecha actual
	$fecha = date("Y-m-d");
 	$consulta = "insert into baneados values(".$id.",'".$ip."','".$fecha."')";
 	echo $consulta;
	ejecutar($consulta);
	session_destroy();
	header('Location: 403.html');
}

//-------Pateando Gente---------

$ip = obtenerIP();
if(traerUno("select count(*)".
	" from baneados".
	" where IP = '".$ip."'") > 0){
	session_destroy();
	header('Location: 403.html');
}

?>
