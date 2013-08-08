<?php 
session_start();

if ($_SESSION['usuario'])
{	
	session_destroy();
	echo '<script language = javascript>
		alert("su sesion ha terminado correctamente")
		self.location = "index.php"
		</script>';
}else
{
	echo '<script language = javascript>
		alert("Que carajo?, no te podes desloguar sin haberte logueado");
		self.location = "index.php"
		</script>';
}
?>