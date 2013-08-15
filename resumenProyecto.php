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
        <title><?php echo $_SESSION['grupo']; ?></title>
        <link rel="icon" type="image/png" href="img/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script></script>
    </head>
    <body>
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
            <h3 id="tituloPrincipal">Proyecto <?php echo $_GET['proyecto']; ?></h3>
            <hr>
            <hr>
            <?php 
            $result = traerRequerimientos($_GET['proyecto']);
            if($result){ 
        	//Bucle de Requerimientos
	            while ($cosas = mysqli_fetch_array($result)) { ?>
		            <h3 id="subtitoPrincipal">requerimiento <?php echo $cosas['descripcion']; ?></h3>
		            <hr>
		            <div id="centradoPrimero" class="row">
		                <div class="col-lg-9">
		                    <table class="table table-striped">
		                        <thead>
		                            <tr>
		                                <th>Id</th>
		                                <th>Descripcion</th>
		                            </tr>
		                        </thead> <?php
                            	echo '<tbody>';
                                echo '<tr>';
                                    echo '<td>';
                                        echo '<a href="paginaRequerimientos.php?id='.$cosas['idR'].'&descrip='.$cosas['descripcion'].'">';
                                        echo $cosas['idR'];
                                        echo '</a>';
                                    echo '</td>';
                                    echo '<td>'.$cosas['descripcion'].'</td>';
                                echo '</tr>';
                            	echo '</tbody>'; ?>
							</table>
	                    </div>
	                </div>
                    <br>
                    <h3 id="subtitoPrincipal">Requisitos</h3>
    				<hr>
    				<div id="centradoPrimero" class="row">
		                <div class="col-lg-9">
		                    <table class="table table-striped">
                            	<thead>
	                                <tr>
	                                    <th>Id</th>
	                                    <th>Nombre</th>
	                                    <th>Descripcion</th>
	                                    <th>Entrada</th>
	                                    <th>Salida</th>
	                                    <th>Prioridad</th>
	                                    <th>Estado</th>
	                                    <th>Id Requerimiento</th>
	                                </tr>
	                            </thead><?php
		                        $result2 = traerRequisitos($cosas['idR']);
		                        if($result2){
		                        	//Bucle de Requisitos
		                            while ($cosas2 = mysqli_fetch_array($result2)) { ?>
						                <?php
		                            	echo '<tbody>';
		                                echo '<tr>';
		                                    echo '<td>';
		                                        echo '<a href="paginaRequisitos.php?id='.$cosas2['idReq'].'">';
		                                        echo $cosas2['idReq'];
		                                        echo '</a>';
		                                    echo '</td>';
		                                    echo '<td>'.$cosas2['Nombre'].'</td>';
		                                    echo '<td>'.$cosas2['Descripcion'].'</td>';
		                                    echo '<td>'.$cosas2['Entrada'].'</td>';
		                                    echo '<td>'.$cosas2['Salida'].'</td>';
		                                    echo '<td>'.$cosas2['Prioridad'].'</td>';
		                                    echo '<td>'.$cosas2['Estado'].'</td>';
		                                    echo '<td>'.$cosas2['idR'].'</td>';
		                                echo '</tr>';
		                            	echo '</tbody>';
		                            	echo '<br>';
		                        	}
		                		} ?>
		            		</table> 
		        		</div>
	            	</div> <?php
                }
            }
            ?>
            
            <hr>
            <h3 id="subtitoPrincipal">Entrevistas</h3>
            <hr>
            <div id="centradoSegundo" class="row">
                <div class="col-lg-9">
                    <table class="table table-striped">
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
                            while ($cosas = mysqli_fetch_array($result)) {
	                            echo '<tbody>';
	                                echo '<tr>';
	                                    echo '<td>';
	                                        echo '<a href="paginaEntrevista.php?id='.$cosas['idEn'].'">';
	                                        echo $cosas['idEn'];
	                                        echo '</a>';
	                                    echo '</td>';
	                                    echo '<td>'.$cosas['descripcion'].'</td>';
	                                    echo '<td>'.$cosas['fecha'].'</td>';
	                                echo '</tr>';
	                            echo '</tbody>';
                            }
                        }
                        ?>
                    </table> 
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
