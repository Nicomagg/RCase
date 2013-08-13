<?php
     if (!isset($_SESSION)) {
        session_start();
    }
    include('coneccion.php');
    //Validamos la entrada al grupo
    if(!isset($_SESSION['grupo'])){
        echo '<script language = javascript>
        alert("No tienes permiso para ver esta pagina");
        self.location = "index.html"</script>';
    }
?>
