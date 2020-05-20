<?php
session_start();
error_reporting(0);
include 'functions_JKLA.php';
require 'idioma.php';

if ($_SESSION['acceso']==1){
	header("location:admin.php");
}elseif($_SESSION['acceso']==2){
	header("location:ZonaAlumno.php");
}else{

?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
	<meta name="description" content="" />
	<title><?php echo $flogin["T-p"] ?></title>
	<link rel="icon" type="image/png" href="img/icono.png" sizes="32x32">
	<link rel="stylesheet" href="css/estilo.css" type="text/css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

	<main class="container" style="height: 100vh">
		<div class="d-flex flex-column align-items-center" style="height: 100vh">
			<div id="box">
				<div class="row">
					<div class="col-12 text-center">
						<div id="JeongyeLeefoto"><img style="width: 100px;" src="img/Jeongye.png" alt="Jeongye Lee"></div>
					</div>
					<div class="col-12">
						<p class="text-center"><?php echo $flogin["L_01"] ?></p>
					</div>
					<div class="col-12">
						<p class="text-center"><?php echo $flogin["L_02"] ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<form action="LogIn.php" method="post" class="col-12 d-flex align-items-center flex-column">
							<input type="text" name="usuario" autocomplete="off" placeholder="<?php echo $flogin["F_01"] ?>" class="form-control">
							<input type="password" name="password" placeholder="<?php echo $flogin["F_02"] ?>" class="form-control">
							<button type="submit" name="enviar" class="btn btn-primary mb-2" style="width: 100%" value="1"><?php echo $flogin["F_03"] ?></button>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<p><a href="index.php"><?php echo $flogin["L_03"] ?></a></p>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php } ?>
