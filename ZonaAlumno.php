<?php
session_start();
error_reporting(0);
include 'functions_JKLA.php';
require 'idioma.php';

if ($_SESSION['acceso']!=2){
    ?>
<script>
	alert($alumno["Er"]);
	location.href = "index.php";

</script>
<?php
}else{	
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<title><?php echo $alumno["T-p"]; ?></title>
	<link rel="icon" type="image/png" href="img/icono.png" sizes="32x32">
	<link rel="stylesheet" href="css/estilo.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>
	<header class="container-fluid ">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark fixed-top">
				<div class="mr-5">
					<img src="img/Jeongye.png" alt="JLK Academy" height="40px">
				</div>
				<a class="navbar-brand" href="index.php"><?php echo $index["T-p"]; ?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.php"><?php echo $nav["N_01"]; ?></a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="FormularioLogin.php"><?php echo $nav["N_02"]; ?></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle disabled" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-disabled="true">
								<?php echo $nav["N_03"]; ?>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#"><?php echo $nav["N_04"]; ?></a>
								<a class="dropdown-item" href="#"><?php echo $nav["N_05"]; ?></a>
								<a class="dropdown-item" href="#"><?php echo $nav["N_06"]; ?></a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><?php echo $nav["N_07"]; ?></a>
							</div>
						</li>
					</ul>

					<div><a href="LogOutZonaAlumno.php"><?php echo $nav["N_08"]; ?></a></div>
				</div>
			</nav>
		</div> <!-- navBar -->
	</header>
	<main class="container mb-5 mt-3">

	</main>

	<footer class="footer container-fluid mb-0 mt-3 d-flex justify-content-center bg-dark text-white fixed-bottom">
		<div class="container row m-0">
			<div class="col d-flex justify-content-start" id="idiomas">
				<form method="GET">
					<select class="custom-select form-control-sm" name="lang">
						<?php 
						echo '<option value="'.$_SESSION["lang"].'">'.$idiomasCode[$_SESSION["lang"]].'</option>';
						idiomasNav('index.php'); ?>
					</select>
					<button type="submit" class="btn btn-primary btn-sm">🔄</button>
				</form>
			</div> <!-- elegir idiomas -->
			<div class="col d-flex justify-content-end">
				<a href="http://javiergarciacortes.com/" target='_blanck'>JGCortes</a>
			</div> <!-- web developer -->
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>

</html>

<?php
}
?>
