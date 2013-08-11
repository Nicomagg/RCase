<?php 
	include ('validarEncabezado.php');
 ?>

<style type="text/css">
	#barrita{
		width: 100%;
		background-color: red;
		text-decoration: bold;
		color: black;
		font-size: 20px;
	}
	#barrita a{
		margin-left: 85%;
		background-color: black;
		color: white;
		text-decoration: none;
		width: 30;
		height: 10;
	}
	#barrita a:hover{
		color: red;
	}
</style>

 <div id="barrita"> 	
 	<font><?php echo $_SESSION['grupo']; ?></font>
 	<a  href="desconectar.php" id="csesion" type="button">
 		Cerrar Sesion</a>
 </div>
 <br>
 <br>
 <br>
 <br>