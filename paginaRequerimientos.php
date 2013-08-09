<?php 
    if (!isset($_SESSION)) {
     session_start();
    }
    include ('coneccion.php');
    if(isset($_GET['idR']))$_SESSION['idR'] = $_GET['idR'];
    if(isset($_GET['descripcion']))$_SESSION['descripcion'] = $_GET['descripcion'];
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
            <style> 
                th:nth-child(n)
                {
                    background:#C0BDE4;
                }
            </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Requistos para: <?php echo $_SESSION['grupo']; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script type="text/javascript"><!--
        function getVal(e) {
            var targ;
            if (!e) var e = window.event;
            if (e.target) targ = e.target;
            else if (e.srcElement) targ = e.srcElement;
            if (targ.nodeType == 3) // defeat Safari bug
            targ = targ.parentNode;

             alert(targ.innerHTML);
        onload = function() {
            var t = document.getElementById("main").getElementsByTagName("td");
            for ( var i = 0; i < t.length; i++ )
                t[i].onclick = getVal;
            }

    </script>
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
        <?php 
        //Tabla Beto
        /*
                        <div class="col-lg-6 col-lg-offset-3">
                            <table class="table table-bordered" id="main">
                                <thead>
                                    <tr>
                                        <th>ID Reque.</th>
                                        <th>Nombre Proyecto</th>
                                        <th>Cliente</th>
                                        <th>Telefono</th>
                                        <th>Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>SAAR</td>
                                        <td>Informatorio</td>
                                        <td>3624587458</td>
                                        <td>Alta de presos</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>WTYU</td>
                                        <td>Informatorio</td>
                                        <td>3624587458</td>
                                        <td>Subir mp3</td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
        */ ?>
                        <div class="col-lg-6 col-lg-offset-3">
                            <button type="button" class="btn btn-success">Editar</button>
                            <a href="index.html"><button type="button" class="btn btn-warning" onClick="self.location = index.html">Atras</button></a>
                        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html> 