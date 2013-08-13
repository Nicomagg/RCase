<?php
include ('barrita.php');
//Validamos que entre un id de requerimiento
if(!isset($_GET['id']))
    mensajeRedir("debes elegir un requisito","paginaGrupo.php");
$result = validarIdRequisito($_GET['id']);
//Entro un id que nada que ver
if($result == 1)  mensajeRedir("No se puede encontrar ese rqequisito","paginaGrupo.php");
if($result == 2)  mensajeRedir("Parece que estas tratando de enviar in id ".
            "que no pertenece a un requerimiento de este grupo","paginaGrupo.php");
//OK todo bien hasta aca...
//Traemos los datos que faltan
$result = ejecutar(
"select p.nombreProyecto as proyecto, ".
"r.idR as rId, r.descripcion as rDescripcion, ".
"req.descripcion as reqDescripcion ".
"from requisitos req inner join requerimientos r on req.idR = r.idR ".
"inner join proyectos p on r.idP = p.idP ".
"where req.idReq = ".$_GET['id']);
$cosas = mysqli_fetch_array($result);
$proyecto = $cosas['proyecto'];
$rId = $cosas['rId'];
$rDescripcion = $cosas['rDescripcion'];
$reqDescripcion = $cosas['reqDescripcion'];

?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <style> th:nth-child(n) { background:#C0BDE4; } </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Requistos para: <?php echo $_SESSION['grupo']; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script></script>
    </head>
    <body>
        <br><?php menuRequisito($proyecto,$rId,$rDescripcion,$reqDescripcion,$_GET['id']); ?><br>
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

        <h3>Requisitos</h3><br><br>
        <div class="col-lg-6 col-lg-offset-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <?php 
                $result = ejecutar("SELECT * FROM `requisitos` WHERE idReq = ".$_GET['id']);
                if($result){
                    echo '<tbody>';
                    while ($cosas = mysqli_fetch_array($result)) {
                        echo '<tr>';
                            echo '<td>'.$cosas['Nombre'].'</td>';
                            echo '<td>'.$cosas['Descripcion'].'</td>';
                            echo '<td>'.$cosas['Entrada'].'</td>';
                            echo '<td>'.$cosas['Salida'].'</td>';
                            echo '<td>'.$cosas['Prioridad'].'</td>';
                            echo '<td>'.$cosas['Estado'].'</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                }
                ?>
            </table> 
        </div>
<?php  /*
        <div class="col-lg-6 col-lg-offset-3">
            <button type="button" class="btn btn-success">Editar</button>
            <a href="altaRequisitos.html"><button type="button" class="btn btn-info" onClick="self.location = altaRequisitos.html">Nuevo</button></a>
            <a href="index.html"><button type="button" class="btn btn-warning" onClick="self.location = index.html">Atras</button></a>
        </div>
*/?>
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html> 
