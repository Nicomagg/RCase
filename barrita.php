<?php 
	include ('validarEncabezado.php');
 ?>

<style type="text/css">
#enc {
	height:125px;
	font-family:Courier;
	margin:auto;
	background-image: linear-gradient(right , rgb(160,44,44) 100%, rgb(0,0,0) 27%);
	background-image: -o-linear-gradient(right , rgb(160,44,44) 100%, rgb(0,0,0) 27%);
	background-image: -moz-linear-gradient(right , rgb(160,44,44) 100%, rgb(0,0,0) 27%);
	background-image: -webkit-linear-gradient(right , rgb(160,44,44) 100%, rgb(0,0,0) 27%);
	background-image: -ms-linear-gradient(right , rgb(160,44,44) 100%, rgb(0,0,0) 27%);
	background-image: -webkit-gradient(
		linear,
		right top,
		left top,
		color-stop(1, rgb(160,44,44)),
		color-stop(0.27, rgb(0,0,0))
	);
}

#izq{
	float:left;
	width: 30%;
}

.normal {
	color:rgba(255,255,255,0.8);
	background-color:rgba(0,0,0,0.7);
	padding: 10px 20px;
	margin:5px 0px;
	margin-left:-20px;
	font-weight: bold;
	text-align: center;
	float: left;
	position: relative;
	width:100%;
	box-shadow: 1px 1px 5px #000;
	-moz-box-shadow: 1px 1px 5px #000;
	-webkit-box-shadow: 1px 1px 5px #000;
	border-radius: 0px 20px 20px 0px;
	margin-bottom:10px;
	transition: width 0.1s;
}
.normal:hover{
	width: 105%;
}
.sin-bordes {
	color:white;
	background-color:rgba(0,0,0,0.7);
	padding: 10px 20px;
	font-weight: bold;
	text-align: center;
	margin:10px 0px;
	margin-left:-20px;
	float: left;
	position: relative;
	width:100%;
	border-radius: 0px 20px 20px 0px;
	box-shadow: 1px 1px 5px #000;
	-moz-box-shadow: 1px 1px 5px #000;
	-webkit-box-shadow: 1px 1px 5px #000;
	transition: width 0.1s;
}
.sin-bordes:hover{
	width: 105%;
}

.forma {
	width:0px;
	height:0px;
	line-height:0px;
	border-left:20px solid transparent;
	border-top:10px solid rgba(0,0,0,0.7);
	position:absolute;
	top:100%;
	left:0px;
}
#forma-D{
	border-left:0px solid transparent;
	border-right:10px solid transparent;
	left:93%;
	right:0px;
}
.derecha {
	color:rgba(0,0,0,0.9);
	padding: 5px 20px;
	text-align: center;
	font-weight: bold;
	border-radius: 20px 0px 0px 20px;
	background-color:rgba(255,255,255,0.7);
	margin-right:-10px;
	margin-top: 60%;
	float:right;
	width: 105%;
	position: relative;
	box-shadow: 1px 1px 5px #000;
	-moz-box-shadow: 1px 1px 5px #000;
	-webkit-box-shadow: 1px 1px 5px #000;
	transition: width 0.1s;
}
.derecha:hover{
	width: 120%;
}
#logo{
	float:right;
	background: url(img/a.png) no-repeat;
	height: 125px;
	width: 140px;
}
#tabla{
	border:2px;
}
</style>
<div id='enc'>
	<div id='izq'>
		<h3 class="normal"><?php echo $_SESSION['grupo']; ?> 
			<span class="forma"></span>
		</h3>
		<a href="desconectar.php">
			<h3 class="sin-bordes">Salir 
				<span class="forma"></span>
			</h3>
		</a>
	</div>
	<div id="logo">
		<h4 class="derecha"> CASE 
			<span id='forma-D' class="forma"></span>
		</h4>
	</div>
</div>