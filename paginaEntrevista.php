<?php 
include ('barrita.php');
//Validamos que entre un id de requerimiento
if(!isset($_GET['id']))
    mensajeRedir("debes elegir una entrevista",
        "paginaGrupo.php");
//Validamos que la entrevista sea de un proyecto
//y que ese proyecto sea de ese grupo
//Traemos el nombre del grupo segun el requerimiento que entro
$result = ejecutar("SELECT g.nombreGrupo ".
        "FROM `entrevistas` e ".
        "INNER JOIN `proyectos` p ON e.idP = p.idP ".
        "INNER JOIN `grupo` g ON g.idG = p.idG ".
        "WHERE e.idEn = ".$_GET['id']);
if(!$result)
    mensajeRedir("NO se puede encontrar la entrevista","paginaGrupo.php"); 
$nombre = mysqli_fetch_array($result);
if($nombre[0] != $_SESSION['grupo'])
    mensajeRedir("Parece que esta entrevista ".
        "no pertenece a un proyecto de este grupo","paginaGrupo.php");
//OK todo bien hasta aca...
//Traemos los datos que faltan
$descripcion = traerUno("select descripcion from `entrevistas` ".
    "WHERE idEn = ".$_GET['id']);
$idP = traerUno("select idP from `entrevistas` ".
    "WHERE idEn = ".$_GET['id']);
$proyecto = traerUno("select nombreProyecto from `proyectos` ".
    "WHERE idP = ".$idP);
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <style> th:nth-child(n) { background:#C0BDE4; } </style>
        <style>  #oculto{ display: none;} </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $_SESSION['grupo'].'/'.$proyecto.'/'.$descripcion ; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <br><?php menuEntrevistas($proyecto,$descripcion,$_GET['id']); ?><br>
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

        <h3>Entrevista</h3><br><br>
        <div class="col-lg-6 col-lg-offset-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <?php 
                $result = ejecutar("SELECT * FROM `entrevistas` WHERE idEn = ".$_GET['id']);
                if($result){
                    echo '<tbody>';
                    while ($cosas = mysqli_fetch_array($result)) {
                        echo '<tr>';
                            echo '<td>'.$cosas['descripcion'].'</td>';
                            echo '<td>'.$cosas['fecha'].'</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                }
                ?>
            </table> 
        </div>
        <br>
        <br>
        <br>

        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html> 
