<?php 
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['grupo']))
{	
	session_destroy();
	echo '<script language = javascript>
		alert("su sesion ha terminado correctamente")
		self.location = "index.html"
		</script>';
}
else {
echo '<h2>'.
'Para Odiar hay que querer,'.'<br>'.
'para destruir hay que hacer,'.'<br>'.
'para dejar hay que beber,'.'<br>'.
'para morir primero hay que nacer.'.'<br>'.
'-EL Pity Alvarez'.'<br>'.
'<br>'.
'Para desloguearse, te ten&eacute;s que haber logueado primero.'.'<br>'.
'-Grupo Loading...<br><br><br><br></h2>';
echo '<a href="index.php">Volver a Casa</a>';

}
?>