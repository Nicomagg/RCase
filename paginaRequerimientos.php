<?php
include ('barrita.php');

//Validamos que entre un id de requerimiento
if(!isset($_GET['id']))
    mensajeRedir("debes elegir un requerimiento y una descripcion",
        "paginaGrupo.php");
//Validamos que el requerimiento sea de un proyecto
//y que ese proyecto sea de ese grupo
//Traemos el nombre del grupo segun el requerimiento que entro
$result = ejecutar("SELECT g.nombreGrupo ".
        "FROM `requerimientos` r ".
        "INNER JOIN `proyectos` p ON r.idP = p.idP ".
        "INNER JOIN `grupo` g ON g.idG = p.idG ".
        "WHERE r.idR = ".$_GET['id']);
if(!$result)
    mensajeRedir("NO se puede encontrar el Requerimiento","paginaGrupo.php"); 
$nombre = mysqli_fetch_array($result);
if($nombre[0] != $_SESSION['grupo'])
    mensajeRedir("Parece que este requerimiento ".
        "no pertenece a un proyecto de este grupo","paginaGrupo.php");
//OK todo bien hasta aca...
//Traemos los datos que faltan
$descripcion = traerUno("select descripcion from `requerimientos` ".
    "WHERE idR = ".$_GET['id']);
$idP = traerUno("select idP from `requerimientos` ".
    "WHERE idR = ".$_GET['id']);
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
        <title><?php echo $_SESSION['grupo']; ?></title>
        <link rel="icon" type="image/png" href="img/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div id="divDeEspacio"></div>
            <?php menuRequerimiento($proyecto,$descripcion,$_GET['id']); ?>
            <div id="divDeEspacio"></div>
            <h3 id="tituloPrincipal">Requisitos</h3>
            <hr>
            <div id="centradoPrimero" class="row">
                <div class="col-lg-9">
                    <table class="table table-striped">
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
                        $result = ejecutar("SELECT * FROM `requisitos` WHERE idR = ".$_GET['id']);
                        if($result){
                            echo '<tbody>';
                            while ($cosas = mysqli_fetch_array($result)) {
                                echo '<tr>';
                                    echo '<td>';
                                        echo '<a href="paginaRequisitos.php?id='.$cosas['idReq'].'">';
                                        echo $cosas['Nombre'];
                                        echo '</a>';
                                        echo '</td>';
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
                <div class="col-lg-3">
                    <form class='form-horizontal' action="altaRequisitos.php" method="POST" onSubmit="altaRequisitos.php" name="idR">
                        <input id="oculto" type="text" name="idR" value=<?php echo '"'.$_GET['id'].'"'; ?>
                        class="btn btn-default" />
                        <input id="buttonAltaProyecto" value="Cargar Un Nuevo Requisito" type="submit" class="btn btn-default"></input>
                    </form>
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
            })
        </script>
    </body>
</html> 