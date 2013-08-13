<?php

if (!isset($_SESSION)) {
    session_start();
}
include('coneccion.php');

function validarCampo($texto){
	if(!isset($_POST[$texto])) return false;
	if(trim($_POST[$texto]) == '') return false;
	return true;
}

if(isset($_POST['loginGrupo'])){
	hayCodigoInyectado($_POST['usuario']);
	hayCodigoInyectado($_POST['pass']);
	hayCodigoInyectado($_POST['grupo']);

	if(!validarCampo('usuario') || !validarCampo('pass') || !validarCampo('grupo'))
		mensajeRedir("Hay campos Invalidos", "index.php");

	if(validarLogin($_POST['usuario'],$_POST['pass'],$_POST['grupo'])){
		$_SESSION['grupo'] = $_POST['grupo'];

		echo '<script language = javascript>
		self.location = "paginaGrupo.php"
		</script>';
			
	}else{
		echo '<script language = javascript>
			alert("Parece que te equivocaste en algo");
			self.location = "index.html"
			</script>';
	}
}

if(isset($_POST['altaEntrevistas'])) {
	hayCodigoInyectado($_POST['Descripcion']);
	hayCodigoInyectado($_POST['Proyecto']);

if(!validarCampo('Descripcion') || !validarCampo('Proyecto'))
	mensajeRedir("Hay campos Invalidos", "index.php");

	$result = cargarEntrevista($_POST['Descripcion'],$_POST['Proyecto']);
	if($result >  0){
		echo '<script language = javascript>
		alert("entrevista cargada correctamente al proyecto");
		self.location = "paginaEntrevista.php?id='.$result.'"</script>';
	}
	else if($result == -1){
		echo '<script language = javascript>
		alert("no se pudo cargar la entrevista");
		self.location = "paginaProyecto.php?proyecto='.$_POST['Proyecto'].'"</script>';
	}
	else if($result == -2){
		mensajeRedir("Ya hay cargado una entrevista ".
			"con el mismo nombre para ese proyecto",
			"paginaProyecto.php?proyecto=".$_POST['Proyecto']);
	}
}
if(isset($_POST['altaRequisito'])) {
	hayCodigoInyectado($_POST['Nombre']);
	hayCodigoInyectado($_POST['Descripcion']);
	hayCodigoInyectado($_POST['Entradas']);
	hayCodigoInyectado($_POST['Salidas']);
	hayCodigoInyectado($_POST['Estado']);
	hayCodigoInyectado($_POST['Prioridad']);
	hayCodigoInyectado($_POST['idR']);

if(!validarCampo('Nombre') || !validarCampo('Prioridad') ||
	 !validarCampo('Descripcion')  || !validarCampo('Entradas')  ||
	 !validarCampo('Salidas')  || !validarCampo('Estado') || !validarCampo('idR')) 
		mensajeRedir("Hay campos Invalidos", "index.php");

	$result = cargarRequisito($_POST['Nombre'],$_POST['Descripcion'],
		$_POST['Entradas'],$_POST['Salidas'],
		$_POST['Prioridad'],$_POST['Estado'],$_POST['idR']);
	if($result >  0)
		mensajeRedir("requisito cargado correctamente al requerimiento",
			"paginaRequisitos.php?id=".$result);
	else if($result == -1)
		mensajeRedir("no se pudo cargar el requisito",
			"paginaRequerimientos.php?id=".$_POST['idR']);
	else if($result == -2){
		mensajeRedir("Ya hay cargado un requisito ".
			"con el mismo nombre para ese requerimiento",
			"paginaRequerimientos.php?id=".$_POST['idR']);
	}
	//Entro un id que nada que ver
	else if($result == -3)  
		mensajeRedir("Parece que estas tratando de enviar in id".
            "que no pertenece a un requerimiento de este grupo","paginaGrupo.php");
}
if(isset($_POST['altaRequerimiento'])) {
	hayCodigoInyectado($_POST['descripcion']);
	hayCodigoInyectado($_POST['Proyecto']);

	if(!validarCampo('descripcion') || !validarCampo('Proyecto')) 
		mensajeRedir("Hay campos Invalidos", "index.php");

	$result = cargarRequerimiento($_POST['descripcion'],$_POST['Proyecto']);
	if($result >  0){
		echo '<script language = javascript>
		alert("requerimiento cargado correctamente al proyecto");
		self.location = "paginaRequerimientos.php?id='.$result.'&descripcion='.$_POST['descripcion'].'"</script>';
	}
	else if($result == -1){
		echo '<script language = javascript>
		alert("no se pudo cargar el requerimiento");
		self.location = "paginaProyecto.php?proyecto='.$_POST['Proyecto'].'"</script>';
	}
	else if($result == -2){
		echo '<script language = javascript>
		alert("Ya hay cargado un requerimiento "'.
			'"con el mismo nombre para ese proyecto");
		self.location = "paginaProyecto.php?proyecto='.$_POST['Proyecto'].'"</script>';
	}
}
if(isset($_POST['altaProyecto'])) {
	hayCodigoInyectado($_POST['nombreProyecto']);
	hayCodigoInyectado($_POST['nombreCliente']);
	hayCodigoInyectado($_POST['telefono']);

	if(!validarCampo('nombreProyecto') || !validarCampo('nombreCliente') || !validarCampo('telefono')) 
		mensajeRedir("Hay campos Invalidos", "index.php");

	$result = cargarProyecto($_POST['nombreProyecto'],$_POST['nombreCliente'],$_POST['telefono']);
	if($result == 0){
		echo '<script language = javascript>
		alert("proyecto cargado correctamente al grupo");
		self.location = "paginaProyecto.php?proyecto='.$_POST['nombreProyecto'].'"</script>';
	}
	else if($result == 1){
		echo '<script language = javascript>
		alert("Ya hay un proyecto con el mismo nombre");
		self.location = "paginaGrupo.php"</script>';
	}
	else if($result == 2){
		echo '<script language = javascript>
		alert("no se pudo cargar el proyecto en este grupo");
		self.location = "paginaGrupo.php"</script>';
	}
}
if(isset($_POST['altaPersona'])) {
	hayCodigoInyectado($_POST['nombre']);
	hayCodigoInyectado($_POST['apellido']);
	hayCodigoInyectado($_POST['dni']);

	if(!validarCampo('nombre') || !validarCampo('apellido') || !validarCampo('dni')) 
		mensajeRedir("Hay campos Invalidos", "index.php");

	$result = cargarPersona($_POST['nombre'],$_POST['apellido'],$_POST['dni']);
	if($result){
		echo '<script language = javascript>
		alert("persona cargada correctamente al grupo");
		self.location = "paginaGrupo.php"</script>';
	}
	else{
		echo '<script language = javascript>
		alert("'.$_POST["nombre"].' ya esta cargado en este grupo");
		self.location = "paginaGrupo.php"</script>';
	}
}
if(isset($_POST['altaGrupo'])) {
	hayCodigoInyectado($_POST['usuario']);
	hayCodigoInyectado($_POST['pass']);
	hayCodigoInyectado($_POST['grupo']);

	if(!validarCampo('usuario') || !validarCampo('pass') || !validarCampo('grupo')) 
		mensajeRedir("Hay campos Invalidos", "index.php");

	$result = cargarGrupo($_POST['usuario'],$_POST['pass'],$_POST['grupo']);
	$_SESSION['grupo'] = $_POST['grupo'];
	if($result){
		$_SESSION['grupo'] = $_POST['grupo'];
		echo '<script language = javascript>
		alert("grupo cargado");
		self.location = "paginaGrupo.php"</script>';
	}
	else{
		echo '<script language = javascript>
		alert("Ese usuario o nombre ya existe");
		self.location = "index.php"</script>';
	}
}

//Validamos la entrada al grupo en caso que estee
//Accediendo a la pagina de onda...
if(!isset($_SESSION['grupo'])){
    echo '<script language = javascript>
    alert("No tienes permiso para ver esta pagina");
    self.location = "index.html"</script>';
}

?>