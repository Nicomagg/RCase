<?php include ('validarEncabezado.php'); ?>

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
            <form class='form-horizontal' action="validar.php" method="POST" onSubmit="validar.php" name="altaEntrevistas">
                <div class="form-group">
                    <label for="inputDescripcion" class="col-lg-offset-2 col-lg-2 control-label">Descripcion</label>
                    <div class="col-lg-4">
                        <input type="text" name="Descripcion" class="form-control" id="inputDescripcion" placeholder="Descripcion">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputProyecto" class="col-lg-offset-2 col-lg-2 control-label">Proyecto</label>
                    <div class="col-lg-4">
                        <select name="Proyecto">
                            <?php 
                            $result = traerProyectos();
                            if($result){
                                while ($cosas = mysqli_fetch_array($result)) {
                                    //Si se paso un proyecto por parametro
                                    //lo seleccionamos por defecto
                                    if(isset($_GET['proyecto']) && 
                                        $_GET['proyecto'] == $cosas['nombreProyecto'])
                                        echo '<option value="'.$cosas['nombreProyecto'].
                                        '" selected>'.$cosas['nombreProyecto'].'</option>';    
                                    else
                                        echo '<option value="'.$cosas['nombreProyecto'].
                                        '">'.$cosas['nombreProyecto'].'</option>';
                                }
                            }
                            //<option value="Cosas" selected>Cosas</option>'
                            ?>
                        </select> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-6 col-lg-offset-2 col-lg-4">
                        <button typea="submit" class="btn btn-default" onClick="validar.php;" name="altaEntrevistas">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>
        
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html>
