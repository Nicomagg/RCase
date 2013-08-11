<?php include ('barrita.php'); ?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <style> th:nth-child(n) { background:#C0BDE4; } </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Home <?php echo $_SESSION['grupo']; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script></script>
    </head>
    <body>
        <br><?php menuGrupo(); ?><br>
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
        <br><br>
        <h3>Proyectos</h3><br><br>
        <div class="col-lg-6 col-lg-offset-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cliente</th>
                        <th>Telefono</th>
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
        <br><br>

        <a href="altaProyecto.php">
            <button class="btn btn-default" onClick="self.location = altaProyecto.php">
                Cargar Un Nuevo Proyecto</button></a>
        <br><br>

        <h3>Personas del Grupo</h3><br><br>
        <div class="col-lg-6 col-lg-offset-3">
            <table class="table table-bordered">
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
        <br><br><br>
        <a href="altaPersona.php">
            <button  class="btn btn-default" onClick="self.location = altaPersona.php">
                Cargar Una nueva Persona al Grupo</button></a>
            
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html> 
