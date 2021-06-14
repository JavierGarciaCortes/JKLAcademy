<?php
session_start();
//error_reporting(0);
include 'functions_JKLA.php';
require 'idioma.php';

?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['lang'] ?>">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="<?php echo $index["MD"]; ?>" />
	<meta name="keywords" content="<?php echo $index["MK"]; ?>">
	<meta name="robots" content="NOODP">
	<title><?php echo $index["T-p5"]; ?></title>
	<link rel="icon" type="image/png" href="img/icono.png" sizes="32x32">
	<link rel="stylesheet" href="css/estilo.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>
	<?php include 'header.php'; ?> <!-- nav hader -->
	<div class="container-fluid" style="background-color: aliceblue;">
		<div class=" d-flex justify-content-center bannertitulo">
			<div class="container row ">
				<div class="col-sm-2 col-lg-1 align-self-center Jimage">
					<img src="img/Jeongye.png" alt="JLK Academy" width="100%">
				</div> <!-- Jeongye img -->
				<div class="col-md-10 col-lg-11 align-self-center">
					<div class="row d-flex justify-content-center">
						<h1 class="text-uppercase text-center" id="titulo"><?php echo $nav["N_05"]; ?></h1>
					</div>
					<div class="row d-flex justify-content-center">
						<h3 class="text-brush"><?php echo $index["T_02"]; ?></h3>
					</div>
				</div> <!-- titulo -->
			</div>
		</div>
	</div>   <!-- Banner titulo -->
	
	<main class="container mb-5 mt-3">
		<article class="container">
			<h2 class="text-uppercase text-center text-info"><?php echo $msj["01"]; ?></h2>

		</article>
	</main>

	<footer class="footer container-fluid mb-0 mt-3 d-flex justify-content-center bg-dark text-white fixed-bottom">
		<div class="container row m-0">
			<div class="col d-flex justify-content-start" id="idiomas">
				<form method="GET">
					<select class="custom-select form-control-sm" name="lang">
						<?php 
						echo '<option value="'.$_SESSION["lang"].'">'.$idiomasCode[$_SESSION["lang"]].'</option>';
						idiomasNav('eat.php'); ?>
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
