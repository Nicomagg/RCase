<?php include ('barrita.php'); ?>

<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
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

        <div class='row' id='log'>
            <form class='form-horizontal' action="validar.php" method="POST" onSubmit="validar.php" name="altaProyecto">
                <div class="form-group">
                    <label for="inputUsuario" class="col-lg-offset-2 col-lg-2 control-label">Nombre Proyecto</label>
                    <div class="col-lg-4">
                        <input type="text" name="nombreProyecto" class="form-control" id="inputUsuario" placeholder="Usuario">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputGrupo" class="col-lg-offset-2 col-lg-2 control-label">Nombre Cliente</label>
                    <div class="col-lg-4">
                        <input type="text" name="nombreCliente" class="form-control" id="inputGrupo" placeholder="Grupo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-lg-offset-2 col-lg-2 control-label">Telefono Cliente</label>
                    <div class="col-lg-4">
                        <input type="text" name="telefono" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-6 col-lg-offset-2 col-lg-4">
                        <button typea="submit" class="btn btn-default" onClick="validar.php;" name="altaProyecto">Nuevo</button>
                    </div>
                </div>
            </form>
        </div>
        
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html>