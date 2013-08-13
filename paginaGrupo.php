<!DOCTYPE html>
<html class="no-js">
    <head>
        <style> th:nth-child(n) { background:#C0BDE4; } </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Home <?php echo $_SESSION['grupo']; ?></title>
        <link rel="icon" type="image/png" href="img/favicon.ico">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script></script>
    </head>
    <body>
        <?php include ('barrita.php'); ?>
        <div class="container">
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
        
            <h3 id="tituloPrincipal">Proyectos</h3>
            <hr>
            <div id="centradoPrimero" class="row">
                <div class="col-lg-9">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cliente</th>
                                <th>Tel&eacute;fono</th>
                            </tr>
                        </thead>
                        <?php 
                        $result = traerProyectos();
                        if($result){
                            echo '<tbody>';
                            while ($cosas = mysqli_fetch_array($result)) {
                                echo '<tr>';
                                    echo '<td>';
                                        echo '<a href="paginaProyecto.php?proyecto='.$cosas['nombreProyecto'].'">';
                                        echo $cosas['nombreProyecto'];
                                        echo '</a>';
                                    echo '</td>';
                                    echo '<td>'.$cosas['nombreCliente'].'</td>';
                                    echo '<td>'.$cosas['telefonoCliente'].'</td>';
                                echo '</tr>';
                                
                            }
                            echo '</tbody>';
                        }
                        ?>
                    </table>
                </div>
                <div class="col-lg-3">
                    <a href="altaProyecto.php">
                        <button id="buttonAltaProyecto" class="btn btn-default" onClick="self.location = altaProyecto.php">
                            Cargar Un Nuevo Proyecto
                        </button>
                    </a>
                </div> 
            </div>

            <hr>

            <h3 id="subtitoPrincipal">Personas del Grupo</h3>
            <hr>
            <div id="centradoSegundo" class="row">
                <div class="col-lg-9">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                            </tr>
                        </thead>
                        <?php 
                        $result = traerPersonas();
                        if($result){
                            echo '<tbody>';
                            while ($cosas = mysqli_fetch_array($result)) {
                                echo '<tr>';
                                    echo '<td>'.$cosas['Nombre'].'</td>';
                                    echo '<td>'.$cosas['Apellido'].'</td>';
                                    echo '<td>'.$cosas['dni'].'</td>';
                                echo '</tr>';
                                
                            }
                            echo '</tbody>';
                        }
                        ?>
                    </table>
                </div> 
                <div class="col-lg-3">
                    <a href="altaPersona.php">
                        <button id="buttonAltaPersona" class="btn btn-default" onClick="self.location = altaPersona.php">
                            Cargar Una nueva Persona al Grupo
                        </button>
                    </a>
                </div> 
            </div>
            
        </div>   
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#buttonAltaProyecto").css("margin-top",($("#centradoPrimero").height()-$("#buttonAltaProyecto").height())/2);
                $(window).resize(function(){
                    $("#buttonAltaProyecto").css("margin-top",($("#centradoPrimero").height()-$("#buttonAltaProyecto").height())/2);
                })

                $("#buttonAltaPersona").css("margin-top",($("#centradoSegundo").height()-$("#buttonAltaPersona").height())/2);
                $(window).resize(function(){
                    $("#buttonAltaPersona").css("margin-top",($("#centradoSegundo").height()-$("#buttonAltaPersona").height())/2);
                })
            })
        </script>
    </body>
</html> 
