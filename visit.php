<?php
session_start();
error_reporting(0);
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
	<title><?php echo $index["T-p"]; ?></title>
	<link rel="icon" type="image/png" href="img/icono.png" sizes="32x32">
	<link rel="stylesheet" href="css/estilo.css" type="text/css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script>
		// Cierra masinfo	
		function cerrar() {
			document.getElementById("masinfo").style.display = "none";
		}
		// Seleccionar producto para masinfo     
function readBlog(e){
    indice=Number(e.getAttribute("id").substr(1));
    document.getElementById("masinfo").style.display="block";
    //repetir();
    } 
		function repetir(){
    document.getElementById("foto").src = `img/${imagenes[indice]}`;
    document.getElementById("nombre").innerHTML = nombres[indice];
    document.getElementById("precio").innerHTML = `${precios[indice]} € + iva`;
    document.getElementById("tipo").innerHTML = tipos[indice];
    document.getElementById("descripcion").innerHTML = descripciones[indice];
}

	</script>
</head>

<body>
	<?php include 'header.php'; ?>
	<!-- nav hader -->
	<div class="container-fluid" style="background-color: aliceblue;">
		<div class="d-flex justify-content-center bannertitulo">
			<div class="container row">
				<div class="col-sm-2 col-lg-1 align-self-center Jimage">
					<img src="img/Jeongye.png" alt="JLK Academy" width="100%">
				</div> <!-- Jeongye img -->
				<div class="col-md-10 col-lg-11 align-self-center">
					<div class="row d-flex justify-content-center">
						<h1 class="text-uppercase text-center" id="titulo"><?php echo $nav["N_06"]; ?></h1>
					</div>
					<div class="row d-flex justify-content-center">
						<h3 class="text-brush"><?php echo $index["T_02"]; ?></h3>
					</div>
				</div> <!-- titulo -->
			</div>
		</div>
	</div> <!-- Banner titulo -->
	<main class="container mb-5 mt-3">
		<div class="row d-flex justify-content-center">
			<div class="col-11 col-md-6 col-lg-4 mb-2">
				<div class="card border border-dark">
					<img class="card-img-top" src="img/blog/V001/000.jpg" alt="Cheong Wa Dae">
					<div class="card-body">
						<h5 class="card-title">Cheong Wa Dae</h5>
						<p class="card-text" style="text-align:justify">Cheong Wa Dae o Casa Azul es la oficina ejecutiva y residencia oficial del jefe de estado y de gobierno de Corea del Sur localizado en la capital, Seúl.</p>
						<button class="btn btn-primary" id="b1" onclick="readBlog(this)">Go somewhere</button>

					</div>
				</div>
			</div>
		</div>
		<div id="masinfo">
			<div id="post_grande" class="d-flex justify-content-center">
				<div id="prev"><img src="img/flecha.png"></div>
				<article id="caja_post">
					<div id="cerrar" onclick="cerrar()">X</div>
					<div class="row m-0">
						<img src="img/blog/V001/000.jpg" alt="Cheong Wa Dae">
					</div>
					<div id="titulo">
						<h1 class="text-center">Cheong Wa Dae</h1>
					</div>
					<div class="row d-flex justify-content-center m-0">
						<div class="col-10">
							<p style="text-align:justify">El nombre <a href="http://english.president.go.kr/" target="_blank">Cheong Wa Dae</a> significa edificio con tejas azules. La Cheong Wa Dae (Casa Azul) es el hogar de la oficina ejecutiva y la residencia del presidente. El nombre Cheong Wa Dae se utilizó por primera vez por el presidente <a href="https://en.wikipedia.org/wiki/Yun_Posun" target="_blank">Yun Posun</a>, quien sirvió en la República de Corea en el cuarto mandato presidencial (1960-62). Hoy, Cheong Wa Da denota no solo el complejo específico sino también toda la Secretaría Presidencial que asiste al Presidente con deberes oficiales.</p>

							<p style="text-align:justify">Cheong Wa Dae se encuentra cerca del <a href="https://es.wikipedia.org/wiki/Gyeongbokgung">Palacio Gyeongbokgung</a>, la principal residencia real de la <a href="https://es.wikipedia.org/wiki/Dinast%C3%ADa_Joseon" target="_blank">dinastía Joseon</a> (1392-1910). Durante el período de Joseon, el emplazamiento de hoy de la Casa Azul fue el hogar de Gyeongmudae, un sitio donde se llevaron a cabo exámenes de servicio civil, torneos de artes marciales, reclutamiento militar y otros eventos estatales importantes.</p>

							<p style="text-align:justify">Detrás de Cheong Wa Dae se encuentra la imponente <a href="https://en.wikipedia.org/wiki/Bukhansan" target="_blank">montaña Bugaksan</a> (342m), una de las cuatro montañas que rodean los antiguos límites de la capital en cada una de las direcciones cardinales. A lo largo de la cordillera, se construyó un muro de fortaleza durante Joseon, algunas de las secciones originales permanecen hoy.</p>

							<p style="text-align:justify">Hoy, la Casa Azul es considerada una de las áreas más verdes de Seúl, y se están haciendo esfuerzos para preservar cuidadosamente su entorno natural.</p>
						</div>
						<div class="col-10 col-lg-5">
							<p style="text-align:justify">Si te encuentras en Seúl, no pierdas la oportunidad de visitarla. Se organizan tours guiados. Pero tienes que hacer reserva con antelación. Puedes hacer la reserva <a href="http://english1.president.go.kr/Contact/Tours/Step1" target="_blank">aqui</a>. </p>

							<p style="text-align:justify">En el tour visitareis: Chunchugwan, Nokjiwon, Sugungteo, el edificio de la oficina principal, Yeongbingwan y Sarangchae o Chilgung.</p>

							<p style="text-align:justify">El punto de partida del recorrido es el estacionamiento en la puerta este de Gyeongbokgung. Allí tomará el autobús que lo llevará al Centro de Prensa Cheong Wa Dae, donde comienza el recorrido. Antes de subirse al autobús, tendréis que identificaros con el pasaporte, en la caseta que hay al lado de la parada. Allí os darán un identificativo que tenéis que llevar durante el tour. Hay que hacerlo antes de poneros en la cola para subir al autobús, o tendréis que salir de la cola para hacerlo y luego hacer otra vez cola.</p>

							<p style="text-align:justify">Durante el tour solo esta permitido hacer fotos en unos sitios en concreto y en una dirección concreta. El guía os avisara donde y hacia donde podéis tomar las fotos.</p>
						</div>
						<div class="col-10  col-lg-5 align-self-center">
							<img src="img/blog/V001/001.jpg" alt="Puesto de información del tour de Cheong Wa Dae">
						</div>
						<div class="col-10">
							<p style="text-align:justify">Fotos del tour:</p>
						</div>
						<div class="col-8 mb-3">
							<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
									<li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
								</ol>
								<div class="carousel-inner">
									<div class="carousel-item active">
										<img class="d-block w-100" src="img/blog/V001/002.jpg" alt="">
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="img/blog/V001/003.jpg" alt="">
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="img/blog/V001/005.jpg" alt="">
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="img/blog/V001/006.jpg" alt="">
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="img/blog/V001/007.jpg" alt="">
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="img/blog/V001/008.jpg" alt="">
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="img/blog/V001/009.jpg" alt="">
									</div>
									<div class="carousel-item">
										<img class="d-block w-100" src="img/blog/V001/011.jpg" alt="">
									</div>
								</div>
								<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>
								<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>
							</div>
						</div>
					</div>
				</article>
				<div id="next"><img src="img/flecha.png"></div>
			</div>
		</div>
	</main>

	<footer class="footer container-fluid mb-0 mt-3 d-flex justify-content-center bg-dark text-white fixed-bottom">
		<div class="container row m-0">
			<div class="col d-flex justify-content-start" id="idiomas">
				<form method="GET">
					<select class="custom-select form-control-sm" name="lang">
						<?php 
						echo '<option value="'.$_SESSION["lang"].'">'.$idiomasCode[$_SESSION["lang"]].'</option>';
						idiomasNav('visit.php'); ?>
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
