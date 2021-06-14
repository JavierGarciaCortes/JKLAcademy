<header class="container-fluid ">
	<div class="container-fluid">
		<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark fixed-top">
			<div class="mr-5 JnavImage">
				<img src="img/Jeongye.png" alt="JLK Academy" height="40px">
			</div>
			<a class="navbar-brand" href="index.php"><?php echo $index["T-h"]; ?></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php"><?php echo $nav["N_01"]; ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="FormularioLogin.php"><?php echo $nav["N_02"]; ?></a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-disabled="true">
							<?php echo $nav["N_03"]; ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="food.php"><?php echo $nav["N_04"]; ?></a>
							<a class="dropdown-item" href="eat.php"><?php echo $nav["N_05"]; ?></a>
							<a class="dropdown-item" href="visit.php"><?php echo $nav["N_06"]; ?></a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="manners.php"><?php echo $nav["N_07"]; ?></a>
						</div>
					</li>
				</ul>
				<?php if($_SESSION['acceso']==1 || $_SESSION['acceso']==2){  ?>
				<a class="navbar-brand" href="LogOutZonaAlumno.php"><?php echo $nav["N_08"]; ?></a>
				<?php } ?>
			</div>
		</nav>
	</div> <!-- navBar -->
</header>
