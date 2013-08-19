<?php 

include('validarEncabezado.php');

//Si no pone el nombre del proyecto...
if(!isset($_GET['proyecto']))
    mensajeRedir("debes elegir un proyecto","paginaGrupo.php");

//validar que ese proyecto sea de ese grupo
$hayAlgo = traerUno("select count(*) from proyectos".
    " where nombreProyecto = '".$_GET['proyecto']."'".
    " AND idG = ".verIdGrupo());

if($hayAlgo < 1)
	mensajeRedir("Parece que este proyecto no pertenece a este grupo","paginaGrupo.php");

//Ok todo bien hasta aca...
function nombre(){ return $_SESSION['grupo']."-".$_GET['proyecto'].".txt";}

function crear(){
	$ar=fopen(nombre(),"w");
	fclose($ar);
}

function escribir($texto){
	$ar=fopen(nombre(),"a+");
	fwrite($ar,$texto);
	fclose($ar);
}

function salto(){
	$ar=fopen(nombre(),"a+");
	fwrite($ar,"\n");
	fclose($ar);
}

//primero truncamos el archivo borrandolo si existe
crear();
//En esta parte se escribe el archivo
//escribir("Grupo: ".$_SESSION['grupo']);salto();
escribir("Grupo: ".$_SESSION['grupo']);salto();
escribir("Proyecto: ".$_GET['proyecto']);salto();
salto();
//requerimientos
$result = traerRequerimientos($_GET['proyecto']);
if($result){ 
	//Bucle de Requerimientos
    while ($cosas = mysqli_fetch_array($result)) {
		escribir("------------------------------------------");salto();
		escribir("Requerimiento: ".$cosas['descripcion'].", ");
		escribir("Id: ".$cosas['idR']." ");salto();
		salto();
		escribir("[Requisitos]");salto();
		salto();
		//Traemos los resuisitos
		$result2 = traerRequisitos($cosas['idR']);
		if($result2){
			//Bucle de Requisitos
			while ($cosas2 = mysqli_fetch_array($result2)) {
				escribir("Id: ".$cosas2['idReq'].". ");salto();
				escribir("Nombre: ".$cosas2['Nombre'].". ");salto();
				escribir("Descripcion: ".$cosas2['Descripcion'].". ");salto();
				escribir("Entrada: ".$cosas2['Entrada'].". ");salto();
				escribir("Salida: ".$cosas2['Salida'].". ");salto();
				escribir("Prioridad: ".$cosas2['Prioridad'].". ");salto();
				escribir("Estado: ".$cosas2['Estado'].". ");salto();
				salto();
				escribir("        --------------               ");salto();
			}
		}
	}
}
//Entrevistas
salto();
escribir("[Entrevistas]");salto();
salto();
$result =  traerEntrevistas($_GET['proyecto']);
if($result){
	while ($cosas = mysqli_fetch_array($result)) {
		escribir("------------------------------------------");salto();
		escribir("Id: ".$cosas['idEn'].". ");salto();
		escribir("Descripcion: ".$cosas['descripcion'].". ");salto();
		escribir("Fecha: ".$cosas['fecha'].". ");salto();
		salto();
	}
}
//Preguntamos para descargar
$file = nombre();
header('Content-type: text/plain');
header('Content-Length: '.filesize($file));
header('Content-Disposition: attachment; filename="'.$file.'"');
readfile($file);
//Deberiamos borrar el archivo pero el vago lo tiene que descargar

//NO abrir nunca el archivo con el notepad xq no te toma los espacios

?>

<html>
<head>
	<title>Resumen</title>
</head>
<body>
	Vieja, tu archivo se tiene que haber bajado
</body>
</html>
