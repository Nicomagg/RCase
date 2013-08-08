<?php

	include('coneccion.php');

	//Inicio de variables de sesión
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	//echo $_POST['usuario'];
	/*
	$mal = false;
	if(!isset($_POST['usuario'])){
		echo 'la variable usuario no entro';
		$mal = true;
	}
	if(!isset($_POST['pass'])){
		echo 'la variable pass no entro';
		$mal = true; 
	}
	if(!isset($_POST['grupo'])){
		echo 'la variable grupo no entro';
		$mal = true;
	}*/
	if(validarLogin($_POST['usuario'],$_POST['pass'],$_POST['grupo'])){
	//if($_POST['grupo'] == 'Loading' && $_POST['usuario'] == 'Loading' && $_POST['pass'] == 'registrodereos'){
		//Definimos las variables de sesión y redirigimos a la página
		$_SESSION['usuario'] = $_POST['usuario'];
		$_SESSION['pass'] = $_POST['pass'];
		$_SESSION['grupo'] = $_POST['grupo'];

		echo '<script language = javascript>
			$(document).read(function(){
				$.get("main.html",function(data){
					$("#container").empty();
					$("#container").append(data);
				});
			});
			</script>';
			
	}else{
		echo '<script language = javascript>
			alert("Parece que te equivocaste en algo");
			self.location = "index.html"
			</script>';
	}

	
?>