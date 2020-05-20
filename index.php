<?php
session_start();
error_reporting(0);
include 'functions_JKLA.php';
include('simplehtmldom/simple_html_dom.php'); 
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
	<title><?php echo $index["T-p"]; ?></title>
	<link rel="icon" type="image/png" href="img/icono.png" sizes="32x32">
	<link rel="stylesheet" href="css/estilo.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>
	<header class="container-fluid ">
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark fixed-top">
				<div class="mr-5 JnavImage">
					<img src="img/Jeongye.png" alt="JLK Academy" height="40px">
				</div>
				<a class="navbar-brand" href="index.php"><?php echo $index["T-p"]; ?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="index.php"><?php echo $nav["N_01"]; ?></a>
						</li>
						<li class="nav-item">
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
				</div>
			</nav>
		</div> <!-- navBar -->
		<div class=" d-flex justify-content-center bannertitulo">
			<div class="container row ">
				<div class="col-sm-2 col-lg-1 align-self-center Jimage">
					<img src="img/Jeongye.png" alt="JLK Academy" width="100%">
				</div> <!-- Jeongye img -->
				<div class="col-md-10 col-lg-11 align-self-center">
					<div class="row d-flex justify-content-center">
						<h1 class="text-uppercase text-center" id="titulo"><?php echo $index["T_01"]; ?></h1>
					</div>
					<div class="row d-flex justify-content-center">
						<h3 class="text-brush"><?php echo $index["T_02"]; ?></h3>
					</div>
				</div> <!-- titulo -->
			</div>
		</div>
	</header>
	<main class="container mb-5 mt-3">
		<article class="container d-flex justify-content-center">
			<div class="col-11">
				<div class="">
					<h2 class="text-left text-brush"><?php echo $index["M_A_T_01"]; ?></h2>
					<h2 class="text-right text-brush"><?php echo $index["M_A_T_02"]; ?></h2>
				</div>
				<div class="entry-content mb-3">
					<p style="text-align:justify"><?php echo $index["M_A_01"]; ?></p>
					<p style="text-align:justify"><?php echo $index["M_A_02"]; ?></p>
					<p style="text-align:justify"><?php echo $index["M_A_03"]; ?></p>
					<blockquote class="text-right">
						<h4 class="text-brush"><?php echo $index["M_A_04"]; ?></h4>
						<footer class="blockquote-footer"><cite title="Source Title">Jeongye Lee</cite></footer>
					</blockquote>
					<p style="text-align:justify"><?php echo $index["M_A_05"]; ?></p>

					<div class="col-sm-12 my-5">
						<img src="img/index-comida.jpeg" alt="Mesa tipica Coreana" width="100%">
					</div>

					<p><?php echo $index["M_A_06"]; ?></p>

					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active" data-interval="10000">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title"><?php echo $opinion["W_1"]; ?></h5>
										<h6 class="card-subtitle mb-2 text-muted"><?php echo $opinion["F_1"]; ?></h6>
										<p class="card-text text-brush text-justify"><?php echo $opinion["O_1"]; ?></p>
									</div>
								</div>
							</div>
							<?php 
							for($i = 2; $i <= 29; $i++){
								echo '<div class="carousel-item" data-interval="10000"><div class="card"><div class="card-body"><h5 class="card-title">'.$opinion["W_".$i].'</h5><h6 class="card-subtitle mb-2 text-muted">'.$opinion["F_".$i].'</h6><p class="card-text text-brush text-justify">'.$opinion["O_".$i].'</p></div></div></div>';
							}
							?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: blue; position: absolute; top: 0px; left:0px"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true" style="background-color: blue; position: absolute; top: 0px; right: 0px;"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div><!-- entry-content -->
			</div>
		</article>
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
