<?php include('coneccion.php'); ?>

<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sign Up - RCase</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script type="text/javascript" src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script></script>
    </head>
    <body>
		<div class='row' id='log'>
			<form class='form-horizontal' action="validar.php" method="POST" onSubmit="validar.php">
				<div class="form-group">
					<label for="inputUsuario" class="col-lg-offset-2 col-lg-2 control-label">Usuario</label>
					<div class="col-lg-4">
						<input type="text" name="usuario" class="form-control" id="inputUsuario" placeholder="Usuario">
					</div>
				</div>
				<div class="form-group">
					<label for="inputGrupo" class="col-lg-offset-2 col-lg-2 control-label">Grupo</label>
					<div class="col-lg-4">
						<input type="text" name="grupo" class="form-control" id="inputGrupo" placeholder="Grupo">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword" class="col-lg-offset-2 col-lg-2 control-label">Password</label>
					<div class="col-lg-4">
						<input type="password" name="pass" class="form-control" id="inputPassword" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-offset-6 col-lg-offset-2 col-lg-4">
						<button type="submit" name="altaGrupo" class="btn btn-primary" onClick="validar.php;">Sign Up</button>
					</div>
				</div>
			</form>
		</div>
        
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.row').css('margin-top',(window.innerHeight - $('.row').height())/2)
                $(window).resize(function() {
                    $('.row').css('margin-top',(window.innerHeight - $('.row').height())/2)
                })
            })
        </script>
    </body>
</html>
