<?php

include('coneccion.php');

//Inicio de variables de sesión
if (!isset($_SESSION)) {
  session_start();
}

//echo $_POST['usuario'];
/*
//$mal = false;
if(!isset($_POST['loginGrupo'])){
	echo 'la variable loginGrupo no entro';
	//$mal = true;
}
if(!isset($_POST['pass'])){
	echo 'la variable pass no entro';
	$mal = true; 
}
if(!isset($_POST['grupo'])){
	echo 'la variable grupo no entro';
	$mal = true;
}*/

if(isset($_POST['altaRequerimiento'])) {
	$result = cargarRequerimiento($_POST['descripcion']);
	if($result != ""){
		$_SESSION['descripcion'] = $_POST['descripcion'];
		echo '<script language = javascript>
		alert("requerimiento cargado correctamente al grupo");
		self.location = "paginaRequerimiento.php?id='.$_SESSION['idR'].'&descripcion='.$_POST['descripcion'].'"</script>';
	}
	else{
		echo '<script language = javascript>
		alert("no se pudo cargar el requerimiento");
		self.location = "paginaProyecto.php"</script>';
	}
}
if(isset($_POST['altaProyecto'])) {
	$result = cargarProyecto($_POST['nombreProyecto'],$_POST['nombreCliente'],$_POST['telefono']);
	if($result){
		$_SESSION['nombreProyecto'] = $_POST['nombreProyecto'];
		echo '<script language = javascript>
		alert("proyecto cargado correctamente al grupo");
		self.location = "paginaProyecto.php?nombre='.$_POST['nombreProyecto'].'"</script>';
	}
	else{
		echo '<script language = javascript>
		alert("no se pudo cargar el proyecto en este grupo");
		self.location = "paginaGrupo.php"</script>';
	}
}
if(isset($_POST['altaPersona'])) {
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
	$result = cargarGrupo($_POST['usuario'],$_POST['pass'],$_POST['grupo']);
	if($result){
		echo '<script language = javascript>
		alert("grupo cargado");
		self.location = "paginaGrupo.php"</script>';
	}
	else{
		echo '<script language = javascript>
		alert("Ese usuario o nombre ya existe");
		self.location = "index.html"</script>';
	}
}
if(isset($_POST['loginGrupo'])){
	if(validarLogin($_POST['usuario'],$_POST['pass'],$_POST['grupo'])){
		//if($_POST['grupo'] == 'Loading' && $_POST['usuario'] == 'Loading' && $_POST['pass'] == 'registrodereos'){
		//Definimos las variables de sesión y redirigimos a la página
		$_SESSION['usuario'] = $_POST['usuario'];
		$_SESSION['pass'] = $_POST['pass'];
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

?>