<?php 
    include ('barrita.php');

    //Si no pone el nombre del proyecto...
    if(!isset($_GET['proyecto'])){
        echo '<script language = javascript>
        alert("debes elegir un proyecto");
        self.location = "paginaGrupo.php"</script>';
    }
    //validar que ese proyecto sea de ese grupo
    $hayAlgo = traerUno("select count(*) from proyectos".
        " where nombreProyecto = '".$_GET['proyecto']."'".
        " AND idG = ".verIdGrupo());

    if($hayAlgo < 1) echo '<script language = javascript>
        alert("Parece que este proyecto no pertenece a este grupo");
        self.location = "paginaGrupo.php"</script>';
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <style> th:nth-child(n) { background:#C0BDE4; } </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $_SESSION['grupo'].'/'.$_GET['proyecto']; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script></script>
    </head>
    <body>
        <br><?php menuProyecto($_GET['proyecto']); ?><br>
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
        <div class="col-lg-6 col-lg-offset-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <?php 
                $result = traerRequerimientos($_GET['proyecto']);
                if($result){
                    echo '<tbody>';
                    while ($cosas = mysqli_fetch_array($result)) {
                        echo '<tr>';
                            echo '<td>';
                                echo '<a href="paginaRequerimientos.php?id='.$cosas['idR'].'&descrip='.$cosas['descripcion'].'">';
                                echo $cosas['idR'];
                                echo '</a>';
                            echo '</td>';
                            echo '<td>'.$cosas['descripcion'].'</td>';
                        echo '</tr>';
                        
                    }
                    echo '</tbody>';
                }
                ?>
            </table> 
        </div>
        <br><br>
        
        <br><br>
        <div class="form-group">
            <div class="col-lg-offset-6 col-lg-offset-2 col-lg-4">
                 <?php echo '<a href="altaRequerimientos.php?proyecto='.$_GET["proyecto"].'">';?>
                    <button type="button" class="btn btn-info" onClick="self.location = altaRequerimientos.php">
                        Nuevo Requerimiento</button></a>
            </div>
        </div>

        <br><br>
        <h3>Entrevistas</h3><br><br>
        <div class="col-lg-6 col-lg-offset-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <?php 
                $result =  traerEntrevistas($_GET['proyecto']);
                if($result){
                    echo '<tbody>';
                    while ($cosas = mysqli_fetch_array($result)) {
                        echo '<tr>';
                            echo '<td>';
                                echo '<a href="paginaEntrevista.php?id='.$cosas['idEn'].'">';
                                echo $cosas['idEn'];
                                echo '</a>';
                            echo '</td>';
                            echo '<td>'.$cosas['descripcion'].'</td>';
                            echo '<td>'.$cosas['fecha'].'</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                }
                ?>
            </table> 
        </div>
        <br><br>
        <div class="form-group">
            <div class="col-lg-offset-6 col-lg-offset-2 col-lg-4">
                <?php echo '<a href="altaEntrevistas.php?proyecto='.$_GET["proyecto"].'">';?>
                    <button type="button" class="btn btn-info" onClick="self.location = altaEntrevistas.php">
                        Nueva Entrevista</button></a>
            </div>
        </div>
            
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html> 
