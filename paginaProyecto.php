<?php 
    if (!isset($_SESSION)) {
     session_start();
    }
    include('coneccion.php');
    if(isset($_GET['nombre'])) $_SESSION['nombre'] = $_GET['nombre'];
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Home <?php echo $_SESSION['nombre']; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script></script>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top hide" id='logo'>
            <div class="container" id="header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <label class='navbar-brand'>RCase</label>
                 <div  class = "col-lg-6 col-lg-offset-3" > .. . </div> 
            </div>
        </div>
        <h3>Requerimientos</h3><br><br>
        <?php 
            $result = traerRequerimientos();
            if(!is_null($result[0])){
                for ($i=0;$i<sizeof($result); $i+=1) {
                    $cosas = mysqli_fetch_array($result);
                    echo '<a href="paginaRequerimientos.php?id='.$cosas['idR'].'&descrip='.$cosas['descripcion'].'">',$cosas['descripcion']."<br />";
                }
            }
         ?>
         <br><br>
        <a href="altaRequerimientos.html">
            <button type="button" class="btn btn-info" onClick="self.location = altaRequerimientos.html">
                Nuevo Requerimiento</button></a>
        
            
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html> 
