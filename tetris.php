<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Tetris</title>
	<link href="http://o1.t26.net//tetris/tetris.css"	rel="stylesheet" type="text/css">
	<link href="http://grupoloading.com.ar/estilo.css"	rel="stylesheet" type="text/css">
	<script	type="text/javascript" src="http://o1.t26.net//tetris/tetris.js"></script>
</head>
<?php
	//Iniciar Sesión
	session_start();
	
	//Validar si se está ingresando con sesión correctamente
	if (!$_SESSION['usuario']){
		echo '<script language = javascript>
		alert("usuario no autenticado")
		self.location = "index.php"
		</script>';
	}
?>
	<body>
		<?php include('../logo.html');?>
		
	<style type="text/css">
		#tetris	{ margin: 0	auto; }
		#menu { display: none }
		.subMenuContent { display: none }
	</style>

	<table style="width: 100%; height: 100%;" cellspacing="0" cellpadding="0"><tr><td style="vertical-align: middle;">

		<div id="tetris">
			<div class="left">
				<div class="menu">
					<div><a href="javascript:void(0)" id="tetris-menu-start">Juego nuevo</a></div>
					<div id="tetris-pause">
						<a href="javascript:void(0)" id="tetris-menu-pause">Pausa</a>
					</div>
					<div style="display: none;" id="tetris-resume">
						<a href="javascript:void(0)" id="tetris-menu-resume">Continuar</a>
					</div>
					<div style="display: none"><a href="javascript:void(0)" id="tetris-menu-highscores">Top score</a></div>
					<div style="display: none"><a href="javascript:void(0)" id="tetris-menu-help">Acerca</a></div>
				</div>
				<div id="tetris-nextpuzzle"></div>
				<div id="tetris-gameover">Game Over</div>
				<div id="tetris-keys">
					<div class="h5">Keyboard:</div>
					<table cellspacing="0" cellpadding="0">
					<tr>
						<td>Rotate:</td>
						<td></td>
						<td><img src="http://o1.t26.net/key-up.gif" width="14" height="14" alt=""></td>
						<td></td>
					</tr>
					<tr>
						<td>Move:</td>
						<td><img src="http://o1.t26.net//tetris/key-left.gif" width="14" height="14" alt=""></td>
						<td><img src="http://o1.t26.net//tetris/key-down.gif" width="14" height="14" alt=""></td>
						<td><img src="http://o1.t26.net//tetris/key-right.gif" width="14" height="14" alt=""></td>
					</tr>
					<tr>
						<td>Fall:</td>
						<td colspan="3">
							<img src="http://o1.t26.net//tetris/key-space.gif" width="44" height="13" alt="">
						</td>
					</tr>
					</table>
				</div>
				<div class="stats">
					<div class="h5">Statistics:</div>
					<table cellspacing="0" cellpadding="0">
					<tr>
						<td	class="level">Level:</td>
						<td><span id="tetris-stats-level">1</span></td>
					</tr>
					<tr>
						<td	class="score">Score:</td>
						<td><span id="tetris-stats-score">0</span></td>
					</tr>
					<tr>
						<td	class="lines">Lines:</td>
						<td><span id="tetris-stats-lines">0</span></td>
					</tr>
					<tr>
						<td	class="apm">APM:</td>
						<td><span id="tetris-stats-apm">0</span></td>
					</tr>
					<tr>
						<td	class="time">Time:</td>
						<td><span id="tetris-stats-time">0</span></td>
					</tr>

					</table>
				</div>
			</div>
			<div class="left-border"></div>
			<div id="tetris-area">
				<div class="grid1"></div>
				<div class="grid2"></div>
				<div class="grid3"></div>
				<div class="grid4"></div>
				<div class="grid5"></div>
				<div class="grid6"></div>
			</div>
			<div id="tetris-help" class="window">
				<div class="top">
					About <span id="tetris-help-close" class="close">x</span>
				</div>
				<div class="content" style="margin-top:	1em;">
					<div style="margin-top:	1em;">
					<div>JsTetris is a highly customizable tetris game written in javascript,
					full sources available, it is free to modify.
					</div>
					<br>
					<div>Author: Cezary Tomczak</div>
					<div>Site: <a href="http://www.gosu.pl/tetris/">www.gosu.pl/tetris/</a></div>
					<br>
					<div>License: BSD revised (free for any use)</div>
					</div>
				</div>
			</div>
			<div id="tetris-highscores"	class="window">
				<div class="top">
					Highscores <span id="tetris-highscores-close" class="close">x</span>
				</div>
				<div class="content">
					<div id="tetris-highscores-content"></div>
					<br>
					Note: these	scores are kept	in cookies,	they are only visible to your computer.
				</div>
			</div>
		</div>
		</td></tr>
	</table>

	<script	type="text/javascript">
		var tetris = new Tetris();
		tetris.unit = 14;
		tetris.areaX = 12;
		tetris.areaY = 22;
	</script>
	
	<!-- Un par de botones para ver que onda -->
	<center>
		<a class="boton" href="index.php">Volver</a>
		<a class="boton" href="desconectar.php">Cerrar Sesi&oacute;n</a>
		<br>
		<a class="boton" href="http://firstpersontetris.com/">Jugar a Firts-Person Tetris</a>
	</center>

</body>
</html>
