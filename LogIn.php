 <?php
    session_start();
	error_reporting(0);
	include 'functions_JKLA.php';
	require 'idioma.php';
    $usuario=$_POST['usuario'];
    $password=md5($_POST['password']);
    
    if(!strcmp($usuario, file_get_contents("../../Privado/adminUser.txt")) && !strcmp($password, file_get_contents("../../Privado/admininfo.txt"))) { // si coinciden, devuelve un 0. al poner ! nos da 1
        session_start();
        $_SESSION['acceso']=1;
    }elseif(!strcmp($usuario, "alumn") && !strcmp($password, md5("alumn"))) {
			session_start();
			$_SESSION['acceso']=2;
		}else{
		$_SESSION['acceso']=0;
	}	
    
    if($_SESSION['acceso']==1){
        header("location:admin.php");
    }elseif($_SESSION['acceso']==2){
		header("location:ZonaAlumno.php");
	}else{
		echo '<script>';
        echo 'alert("'.$login["01"].'");';
        echo 'location.href="index.php";';
        echo '</script>';
 
        
    }
?>
