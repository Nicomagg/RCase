<?php
//Validamos que entre un id de requerimiento
include ('validarEncabezado.php'); 
if(!isset($_POST['idR']))
    mensajeRedir("debes acceder desde la pagina de un requerimiento",
        "paginaGrupo.php");

$result = validarIdRequerimiento($_POST['idR']);
//Entro un id que nada que ver
if($result != 0) 
    mensajeRedir("Parece que estas tratando de enviar in id".
            "que no pertenece a un requerimiento de este grupo","paginaGrupo.php");
//OK todo bien hasta aca...
//Traemos los datos que faltan
$descripcion = traerUno("select descripcion from `requerimientos` ".
    "WHERE idR = ".$_POST['idR']);
$idP = traerUno("select idP from `requerimientos` ".
    "WHERE idR = ".$_POST['idR']);
$proyecto = traerUno("select nombreProyecto from `proyectos` ".
    "WHERE idP = ".$idP);
?>

<!DOCTYPE html>
<html class="no-js">
    <head>
        <style>  #oculto{ display: none;} </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Alta de Requisito</title>
        <meta name="altaRequisitos" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
        <div class="col-lg-6 col-lg-offset-3">
            <label for="inputNombre" >
                <?php echo $_SESSION['grupo'].'/'.$proyecto.'/'.$descripcion; ?>
            </label>
        </div>
        <label class='navbar-brand'>RCase</label>
		<div class='row' id='log'>
			<form class='form-horizontal' action="validar.php" method="POST" onSubmit="validar.php" name="altaRequisito">
                <div class="form-group">
                    <label for="inputNombre" class="col-lg-offset-2 col-lg-2 control-label">Nombre</label>
                    <div class="col-lg-4">
                        <input type="text" name="Nombre" class="form-control" id="inputUsuario" placeholder="Nombre">
                    </div>
                </div>
                <?php //Input oculto con el ID del Requerimiento ?>
                <div class="form-group">
                    <div class="col-lg-4">
                        <input id="oculto" type="text" name="idR" 
                        value=<?php echo '"'.$_POST['idR'].'"'; ?> class="btn btn-default" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescripcion" class="col-lg-offset-2 col-lg-2 control-label">Descripcion</label>
                    <div class="col-lg-4">
                        <input type="text" name="Descripcion" class="form-control" id="inputUsuario" placeholder="Descripcion">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEntradas" class="col-lg-offset-2 col-lg-2 control-label">Entradas</label>
                    <div class="col-lg-4">
                        <input type="text" name="Entradas" class="form-control" id="inputEntradas" placeholder="Entradas">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSalidas" class="col-lg-offset-2 col-lg-2 control-label">Salidas</label>
                    <div class="col-lg-4">
                        <input type="text" name="Salidas" class="form-control" id="inputUsuario" placeholder="Salidas">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPrioridad" class="col-lg-offset-2 col-lg-2 control-label">Prioridad</label>
                    <div for="checkbox" class="col-lg-offset-4 col-lg-offset-2 col-lg-6">
                        <label>
                            <input type="radio" name="Prioridad" value="Alta"> Alta
                        </label>
                    </div>
                    <div for="checkbox" class="col-lg-offset-4 col-lg-offset-2 col-lg-6">
                        <label>
                            <input type="radio" name="Prioridad" value="Media"> Media
                        </label>
                    </div>
                    <div for="checkbox" class="col-lg-offset-4 col-lg-offset-2 col-lg-6">
                        <label>
                            <input type="radio" name="Prioridad" value="Baja"> Baja
                        </label>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="inputEstado" class="col-lg-offset-2 col-lg-2 control-label">Estado</label>
                    <div for="checkbox" class="col-lg-offset-4 col-lg-offset-2 col-lg-6">
                        <label>
                            <input type="radio" name="Estado" value="En Espera"> En Espera
                        </label>
                    </div>
                    <div for="checkbox" class="col-lg-offset-4 col-lg-offset-2 col-lg-6">
                        <label>
                            <input type="radio" name="Estado" value="En Proceso"> En Proceso
                        </label>
                    </div>
                    <div for="checkbox" class="col-lg-offset-4 col-lg-offset-2 col-lg-6">
                        <label>
                            <input type="radio" name="Estado" value="Terminado"> Terminado
                        </label>
                    </div>
                </div> 
				<div class="form-group">
					<div class="col-lg-offset-6 col-lg-offset-2 col-lg-4">
						<button type="submit" name="altaRequisito" class="btn btn-default" onClick="validar.php;">Sign Up</button>
					</div>
				</div>
			</form>
		</div>
        
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
    </body>
</html>