<?php
//error_reporting(0);
session_start();
$hoy = getdate();
if($hoy['mday'] <= 9 ){
	$mday="0".$hoy['mday'];
}else{
	$mday=$hoy['mday'];
}
if($hoy['mon'] <= 9 ){
	$month="0".$hoy['mon'];
}else{
	$month=$hoy['mon'];
}
$diahoy=$hoy['year']."-".$month."-".$mday;
if ($_SESSION['acceso']!=1){
?>
<script>
    alert("Esto es una zona restringida. Acceso denegado.");
    location.href = "FormularioLogin.php";

</script>
<?php
}else{
	include 'functions_JKLA.php';	
	if(isset($_POST['modif'])){
		$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
		$class_id=filtrarResU8($_POST['modif']);
		$day=filtrarResU8($_POST['day']);
        $c_start=filtrarResU8($_POST['hstart']);
        $time=filtrarResU8($_POST['time']);
        $c_type=filtrarResU8($_POST['c_type']);
        $classes_week=filtrarResU8($_POST['classes_week']);
        $sql= "UPDATE classes SET day='{$day}', c_start='{$c_start}', time='{$time}', c_type='{$c_type}' WHERE class_id={$class_id}";  
        $db->query($sql);
	} 		// Modify classes
    if(isset($_POST['ereaseClass'])){
		$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
		$class_id=filtrarResU8($_POST['ereaseClass']);
        $sql="SELECT `user_id` FROM `classes` WHERE `class_id`={$class_id}";
        $resultados = $db->query($sql);
        $rows=$resultados->num_rows;
        for($i=0; $i<$rows; $i++){
            $fila=$resultados->fetch_assoc();
            $datos[]=$fila;
        }
        $sql= "UPDATE users SET `classes_week`=`classes_week`-1 WHERE user_id ={$datos[0]['user_id']}";
		$db->query($sql);
        $sql= "DELETE FROM classes WHERE class_id={$class_id}";
		$db->query($sql);
	} 	// Erease Class
    if(isset($_POST['modifIn'])){
		$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
		$id=filtrarResU8($_POST['modif']);
		$day=filtrarResU8($_POST['day']);
		$c_start=filtrarResU8($_POST['hstart']);
		$time=filtrarResU8($_POST['time']);
		$c_type=filtrarResU8($_POST['c_type']);
		$pr_class=filtrarResU8($_POST['classp']);
		$pr_trans=filtrarResU8($_POST['transp']);
        $classes_week=filtrarResU8($_POST['classes_week']);
		$sql= "UPDATE users_classes SET day='{$day}', c_start='{$c_start}', time='{$time}', c_type='{$c_type}', pr_class='{$pr_class}', pr_trans='{$pr_trans}' WHERE user_id={$id}";
		$db->query($sql);
	} 		// Modify student information
	if(isset($_POST['modiflvl'])){
		$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
		$id=filtrarResU8($_POST['modiflvl']);
		$state=filtrarResU8($_POST['state']);
		$text_book=filtrarResU8($_POST['text_book']);
		$focus_on=filtrarResU8($_POST['focus_on']);
		$comprehension=filtrarResU8($_POST['comprehension']);
		$sql= "UPDATE level SET state='{$state}', text_book='{$text_book}', focus_on='{$focus_on}', comprehension='{$comprehension}' WHERE user_id ={$id}";
		$db->query($sql);
	} 	// Modify level
	if(isset($_POST['AddStudent'])){
		$name=filtrarResU8($_POST['name']);
		$email=filtrarResU8($_POST['email']);
		$mobile=filtrarResU8($_POST['mobile']);
		$city=filtrarResU8($_POST['city']);
		$address=filtrarResU8($_POST['address']);
		$day=filtrarResU8($_POST['day']);
		$c_start=filtrarResU8($_POST['c_start']);
		$time=filtrarResU8($_POST['time']);
		$c_type=filtrarResU8($_POST['c_type']);
		$pr_class=filtrarResU8($_POST['pr_class']);
		$pr_trans=filtrarResU8($_POST['pr_trans']);
        $classes_week=filtrarResU8($_POST['classes_week']);
		addstudent($name, $email, $mobile, $city, $address, $day, $c_start, $time, $c_type, $pr_class, $pr_trans, $diahoy, $classes_week);
	}	// Add new student
	if(isset($_POST['AddLvl'])){
		$id_student=filtrarResU8($_POST['numIdL']);
		$state=filtrarResU8($_POST['state']);
		$text_book=filtrarResU8($_POST['textbook']);
		$focus_on=filtrarResU8($_POST['focuson']);
		$comprehension=filtrarResU8($_POST['comprehension']);
		addlvlstudent($id_student, $state, $text_book, $focus_on, $comprehension);
	}		// Add lvl student
    if(isset($_POST['AddClass'])){
        $db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
		$user_id=filtrarResU8($_POST['AddClass']);
		$day=filtrarResU8($_POST['day']);
		$c_start=filtrarResU8($_POST['hstart']);
		$time=filtrarResU8($_POST['time']);
		$c_type=filtrarResU8($_POST['c_type']);
		
        $sql= "INSERT INTO classes (user_id, day, c_start, time, c_type) VALUES ( '$user_id', '$day', '$c_start','$time', '$c_type')";
		$db->query($sql);
	}	    // Add classes
    if(isset($_POST['AddClassWeek'])){
        $db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
        $user_id=filtrarResU8($_POST['AddClassWeek']);
		$sql= "UPDATE users SET `classes_week`=`classes_week`+1 WHERE user_id ={$user_id}";
		$db->query($sql);
	}	// Add classes Week
	if(isset($_POST['sendTest'])){
		$name=$_POST['name'];
		$para=$_POST['email'];	// Destinatario		
		$título = 'Jeongye\'s Academy'; // título
		$contenido='';
		if(isset($_POST['online'])){
			$contenido .='<p> Las Clases Online las realizo por Skype. Antes de la clase mandaré un email con el material que utilizaremos en la clase para que lo imprimas. Los deberes que mande en la clase, durante la semana, me los tendréis que mandar por email para que los corrija. Si tenéis alguna duda podéis preguntarme por WhatsApp en cualquier momento. Contestare lo más rápido posible. </p><p> El precio de la clase es '.$_POST['pr_class'].' €/h, tendrá que abonarse un día antes de la clase. Se puede pagar por Paypal o Bizum.</p>';
		}
		if(isset($_POST['academy'])){
			$contenido .='<p> En las clases presenciales, antes de la clase mandaré un email con el material que utilizaremos en la clase para que lo imprimas y lo traigas a la clase. Los deberes que mande en la clase, los tendréis que traer hechos a la clase y los corregiremos al empezar la clase. Si tenéis alguna duda podéis preguntarme por WhatsApp en cualquier momento. Contestare lo más rápido posible. </p><p> El precio de la clase es '.$_POST['pr_class'].' €/h. Se puede pagar en efectivo el mismo día de la clase. También se puede pagar por Paypal o Bizum, en tal caso es preferible que se haga al menos un día antes.</p>';
		}
		if(isset($_POST['presencial'])){
			$contenido .='<p> En las clases a domicilio, antes de la clase mandaré un email con el material que utilizaremos en la clase para que lo imprimas y lo traigas a la clase. Los deberes que mande en la clase, los tendréis que tener hechos para la clase y los corregiremos al empezar la clase. Si tenéis alguna duda podéis preguntarme por WhatsApp en cualquier momento. Contestare lo más rápido posible. </p><p> El precio de la clase es '.$_POST['pr_class'].' €/h + '.$_POST['pr_trans'].' € de desplazamiento. Se puede pagar en efectivo el mismo día de la clase. También se puede pagar por Paypal o Bizum, en tal caso es preferible que se haga al menos un día antes.</p>';
		}
		if(isset($_POST['online']) || isset($_POST['presencial']) || isset($_POST['academy'])){
			$contenido .='<p> Si por cualquier motivo alguna semana se tiene que cambiar el día de clase o no se puede hacer clase, si es posible, me gustaría que se comunicara un día antes, por lo menos.</p>';
		}
		if(isset($_POST['ingles'])){
			$contenido .='<p> La clase se imparte en inglés. Aunque no hace falta tener un conocimiento amplio de Ingles. Algunas cosas si las digo en castellano, pero aún no lo hablo del todo bien. A medida que pasen las clases, iré utilizando más el coreano que otro idioma. Para ir reforzando el aprendizaje de lo ya aprendido y practicar lo más posible la conversación durante la clase. </p>';
		}
		if(isset($_POST['whatsapp'])){
			$contenido .='<p> Mi teléfono es 640641389. Podemos estar en contacto por WhatsApp.</p>';
		}
		if(isset($_POST['test'])){
			$contenido .='<p>Aquí puedes descargar el <a href="http://www.javiergarciacortes.com/JA/ficheros/ActivityHangulTest.pdf" download="Acme Documentation (ver. 2.0.1).txt" target="_blank">Test</a> de nivel y los <a href="http://www.javiergarciacortes.com/JA/ficheros/ActivityHangulAudioTest.zip" download="Acme Documentation (ver. 2.0.1).txt" target="_blank">Audios</a> que necesitaras para el test. En cuanto lo tengas hecho, mándamelo para preparar la clase y mandarte el material que usaremos.</p>';
		}
		
		
		// mensaje
		$mensaje = '
		<html>

		<head>
			<title>Jeongye\'s Academy</title>
		</head>

		<body>
			<div class="d-flex flex-column align-items-center" style="height: 200vh">
				<div id="box" style="max-width: 700px; margin: auto;">
					<div class="row">
						<div class="col-12 text-center">
							<div id="JeongyeLeefoto"><img style="vertical-align: bottom; max-width: 100%; width: 100px;" src="http://www.javiergarciacortes.com/JA/img/Jeongye.png" alt=""></div>
						</div>
					</div>
					<div class="row mt-3">
						<p>Hola '.$name.',</p>
						'.$contenido.'
						<p>Saludos,</p>
						<p>Jeongye Lee</p>
					</div>
				</div>
			</div>

		</body>

		</html>
		';

		// Para enviar un correo HTML, debe establecerse la cabecera Content-type
		$cabeceras = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Cabeceras adicionales
		$cabeceras .= 'To: '.$name.' <'.$para.'>' . "\r\n";
		$cabeceras .= 'From: Jeongye\'s Academy <jeongyesacademy@gmail.com>' . "\r\n";
		

		// Enviarlo
		mail($para, $título, $mensaje, $cabeceras);
	}		// Send email with level test	
	if(isset($_POST['assist'])){
		$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
		$id_student=$_POST['assist'];
		$day=$_POST['day'];
		$time=$_POST['time'];
        $pr_class=$_POST['pr_class'];
        $pr_trans=$_POST['pr_trans'];
        $paid = $pr_class * $time + $pr_trans;
		$sql= "INSERT INTO assist (user_id, day, time, paid) VALUES ( '$id_student', '$day', '$time','$paid')";
		$db->query($sql);
	}		// Add assistence
	if(isset($_POST['ereaseA'])){
		$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
		$id=filtrarResU8($_POST['ereaseA']);
		$sql= "DELETE FROM assist WHERE id_assist={$id}";
		$db->query($sql);
	} 		// Erease assistence
		
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Jeongye´s Academy - Admin Area</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script>
        window.onload = inicio;

        function inicio() {
            document.getElementById('CloseTables').onclick = CloseTables;
            document.getElementById('AddStudent').onclick = AddStudent;
            document.getElementById('AddLevel').onclick = AddLevel;
            document.getElementById('showStudents').onclick = showStudents;
            document.getElementById('showStudentsPanel').onclick = showStudents;
            document.getElementById('showInStudents').onclick = showInStudents;
            document.getElementById('showInStudentsPanel').onclick = showInStudents;
            document.getElementById('showLevels').onclick = showLevels;
            document.getElementById('showInfo').onclick = showInfo;
            document.getElementById('showInfoIn').onclick = showInfoIn;
            document.getElementById('showInfoPanel').onclick = showAssistance;
            document.getElementById('showAssistance').onclick = showAssistance;
            document.getElementById('SendFirstEmail').onclick = SendFirstEmail;
        }

        function CloseTables() {
            document.getElementById('addAssistance').style.display = 'block';
            document.getElementById('tablaStudentsInfo').style.display = 'none';
            document.getElementById('tablaStudentsInInfo').style.display = 'none';
            document.getElementById('tablaLevels').style.display = 'none';
            document.getElementById('tablaStudents').style.display = 'none';
            document.getElementById('tablaInStudents').style.display = 'none';
            document.getElementById('BoxAddLevel').style.display = 'none';
            document.getElementById('BoxAddStudent').style.display = 'none';
            document.getElementById('first_email').style.display = 'none';
            document.getElementById('Assistance').style.display = 'none';
        } // Close all tables and forms
        function AddStudent() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('BoxAddStudent').style.display = 'flex';
        } // Show form studient
        function AddLevel() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('BoxAddLevel').style.display = 'flex';
        } // Show form studient

        function showStudents() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('tablaStudents').style.display = 'block';
        } // Show students table
        function showInStudents() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('tablaInStudents').style.display = 'block';
        } // Show students inactive table
        function showLevels() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('tablaLevels').style.display = 'block';
        } // Show/hide levels table
        function showInfo() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('tablaStudentsInfo').style.display = 'block';
        } // Show Info active studients

        function showInfoIn() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('tablaStudentsInInfo').style.display = 'block';
        } // Show Info inactive studients
        function showAssistance() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('Assistance').style.display = 'block';
        } // Show Info
        function SendFirstEmail() {
            CloseTables();
            document.getElementById('addAssistance').style.display = 'none';
            document.getElementById('first_email').style.display = 'block';
        } // Show 1st email form

    </script>
    <style>
        #tablaStudentsInfo,
        #first_email,
        #BoxAddLevel,
        #BoxAddStudent,
        #BoxAddPass,
        #tablaStudents,
        #tablaInStudents,
        #tablaLevels,
        #Assistance,
        #tablaStudentsInInfo {
            display: none;
        }

        #BoxAddStudent input,
        #BoxAddLevel input,
        #BoxAddPass input {
            margin: 5px !important;
        }

        #info button {
            text-decoration: none !important;
            color: black !important;
        }

        .table-sm td,
        .table-sm th {
            padding: 0rem !important;
        }

    </style>
</head>

<body>
    <div class="container-fluid p-0 fixed-top">
        <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="" id='CloseTables'>Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ACTIVE STUDENTS
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <button class="dropdown-item" id='showInfo'>INFO</button>

                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" id='showStudents'>MODIFY CLASS</button>
                                <button class="dropdown-item" id='showLevels'>MODIFY LEVEL</button>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                INACTIVE STUDENTS
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <button class="dropdown-item" id='showInfoIn'>INFO</button>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" id='showInStudents'>ACTIVE STUDENTS</button>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id='showAssistance' style="cursor: pointer;">ASSISTANCE</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ADD</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <button class="dropdown-item" id='AddStudent'>STUDENTS</button>
                                <button class="dropdown-item" id='AddLevel'>LEVEL</button>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="SendFirstEmail" style="cursor: pointer;">EMAIL INFO</a>
                        </li>
                    </ul>
                    <a class="navbar-brand" href="LogOutZonaAlumno.php">Logout</a>
                </div>
            </div>
        </nav>
    </div> <!-- navbar -->
    <div class="container" style="margin-top: 78px;">
        <div class="row d-flex justify-content-left" id="info">
            <div class="col-sm-6 col-md-3 border p-3 mb-2 bg-info text-dark align-self-start" style="font-size: 13px; ">
                <?php 
					$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
					$sql= "SELECT count(*) as num FROM users_classes WHERE c_type='Home' && day!='Stop'";
					$sql1= "SELECT count(*) as num FROM users_classes WHERE c_type='Online' && day!='Stop'";
					$sql2= "SELECT count(*) as num FROM users_classes WHERE c_type='Academy' && day!='Stop'";
					$resultados = $db->query($sql);
					$resultados1 = $db->query($sql1);
					$resultados2 = $db->query($sql2);
					$home=$resultados->fetch_assoc();
					$online=$resultados1->fetch_assoc();
					$academy=$resultados2->fetch_assoc();
				?>
                <div class="col-auto">
                    <?php echo "<strong>Home:</strong> ".$home['num'] ?>
                </div>
                <div class="col-auto">
                    <?php echo "<strong>Online:</strong> ".$online['num'] ?>
                </div>
                <div class="col-auto">
                    <?php echo "<strong>Academy:</strong> ".$academy['num'] ?>
                </div>
            </div> <!-- Type of classes -->
            <div class="col-sm-6 col-md-3 border p-3 mb-2 bg-success text-white align-self-start">
                <div class="col-auto">
                    <?php 
					$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
					$sql= "SELECT count(*) as num FROM users_classes WHERE classes_week!='0' AND `user_status`='STUDENT';";
					$resultados = $db->query($sql);
					$active=$resultados->fetch_assoc();
                    $sql= "SELECT SUM(`classes_week`) AS num FROM `users` WHERE `classes_week`!=0;";
					$resultados = $db->query($sql);
					$total=$resultados->fetch_assoc();
					echo '<button id="showStudentsPanel" class="btn btn-link"><strong>'.$active['num'].'/'.$total['num'].' CLASSES WEEK</strong></button>';
				?>
                </div>
            </div> <!-- CLASSES WEEK -->
            <div class="col-sm-6 col-md-3 border p-3 mb-2 bg-danger text-white align-self-start">
                <div class="col-auto">
                    <?php 
					$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
					$sql0= "SELECT count(*) as num FROM users WHERE classes_week='0'";
					$resultados0 = $db->query($sql0);
					$stop=$resultados0->fetch_assoc();
					echo '<button id="showInStudentsPanel" class="btn btn-link"><strong>'.$stop['num'].' INACTIVE STUDENTS</strong></button>';
					?>
                </div>
            </div> <!-- INACTIVE STUDENTS -->
            <div class="col-sm-6 col-md-3 border p-3 mb-2 bg-warning text-dark align-self-start">
                <div class="col-auto">
                    <?php 
					$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
					$sql= "SELECT SUM((pr_class*a.time)+pr_trans) as total FROM users_classes s JOIN assist a ON s.user_id=a.user_id WHERE a.day LIKE '_____".$month."___'";
					$sql2= "SELECT count(*) as num FROM users_classes s JOIN assist a ON s.user_id=a.user_id WHERE a.day LIKE '_____".$month."___'";
					$resultados = $db->query($sql);
					$resultados2 = $db->query($sql2);
					$num_class_month=$resultados2->fetch_assoc();
					$income=$resultados->fetch_assoc();
					echo "<div>". $num_class_month['num']."<button id='showInfoPanel' class='btn btn-link'><strong>classes</strong></button>".$income['total']."<strong>€ this month</strong></div>";
				?>
                </div>
            </div> <!-- Nº classes month and income -->
        </div>
    </div> <!-- Some info -->
    <div class="container p-0">
        <div class="row d-flex justify-content-center">
            <div id='tablaStudentsInfo' class="overflow-auto col-auto">
                <?php showInfo('!='); ?>
            </div> <!-- Tabal estudiantes activos info -->
            <div id='tablaStudentsInInfo' class="overflow-auto col-auto">
                <?php showInfo('='); ?>
            </div> <!-- Tabal estudiantes inactivos info -->
            <div id='tablaStudents' class="overflow-auto col-auto">
                <?php 
                if($active['num']!=$total['num']) addclasstable();
                tableStudentsEdit(); 
                
                ?>
            </div> <!-- Tabal estudiantes editable -->
            <div id='tablaInStudents' class="overflow-auto col-auto">
                <?php tableStudentsEditIn(); ?>
            </div> <!-- Tabal estudiantes inactivos editable -->
            <div id='tablaLevels' class="overflow-auto col-auto">
                <?php studentandlvl(); ?>
            </div> <!-- Tabla lvls -->
        </div>
    </div> <!-- Tablas -->
    <div class="container d-flex justify-content-center mt-3">
        <div id="BoxAddStudent">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <legend>New Student</legend>
                <div class="row">
                    <input class="form-control" type="text" name="name" placeholder="Name" required>
                </div>
                <div class="row">
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                </div>
                <div class="row">
                    <input class="form-control" type="number" name="mobile" placeholder="Mobile" maxlength="9" size="9" required>
                </div>
                <div class="row">
                    <input class="form-control" type="text" name="address" placeholder="Address">
                </div>
                <div class="row">
                    <input class="form-control" type="text" name="city" placeholder="City">
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-12 col-sm-4">
                        <label class="m-0" for="day">DAY CLASS</label>
                        <select class="form-control" name="day">
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label class="m-0" for="c_type">TYPE OF CLASS</label>
                        <select class="form-control" name="c_type">
                            <option value="Academy">Academy</option>
                            <option value="Online">Online</option>
                            <option value="Home">Home</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-4">
                        <label class="m-0" for="c_start">TIME START</label>
                        <input class="form-control" type="time" name="c_start">
                    </div>
                </div>
                <div class="form-group row d-flex justify-content-center">
                    <div class="col-12 col-sm-5 col-lg-3">
                        <label class="m-0" for="c_end">CLASSES WEEK</label>
                        <input class="form-control" type="number" name="classes_week" value="1" step="1" max="2" min="0">
                    </div>
                    <div class="col-12 col-sm-5 col-lg-3">
                        <label class="m-0" for="c_end">DURATION</label>
                        <input class="form-control" type="number" name="time" value="1" step="0.5" max="2" min="1">
                    </div>
                    <div class="col-12 col-sm-5 col-lg-3">
                        <label class="m-0" for="pr_class">CLASS PRICE</label>
                        <input class="form-control" type="number" name="pr_class" value="15" required min="0" maxlength="2">
                    </div>
                    <div class="col-12 col-sm-5 col-lg-3">
                        <label class="m-0" for="pr_trans">TRANSPORTATION PRICE</label>
                        <input class="form-control" type="number" name="pr_trans" value="0" required min="0" maxlength="2">
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary" name="AddStudent" value="Add student" style="width: 100%">ADD</button>
                </div>
            </form>
        </div> <!-- ADD STUDENT -->
        <div id="BoxAddLevel">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <legend>Level Student</legend>
                <div class="form-group row d-flex align-items-center">
                    <div class="col-4 pl-1">
                        <label class="m-0" for="">Student</label>
                        <?php 
						$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
						$sql= "SELECT DISTINCT user_id, user_name FROM users_classes WHERE user_id NOT IN (SELECT user_id FROM `level`) AND `classes_week`!='0' AND `user_status`='STUDENT'";
						$resultados = $db->query($sql);
						$rows=$resultados->num_rows;
						for($i=0; $i<$rows; $i++){
							$fila=$resultados->fetch_assoc();
							$list[]=$fila;
						}
						echo '<select class="form-control" name="numIdL">';
						for($i = 0; $i < count($list); $i++){
							echo "<option value='".$list[$i]['user_id']."'>".$list[$i]['user_name']."</option>";
						}
						echo '</select>';
					?>
                    </div>
                    <div class="col p-0">
                        <label class="m-0" for="state">State</label>
                        <select class="form-control" name="state" id="state">
                            <option value="Starter">Starter</option>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advance">Advance</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label class="m-0" for="textbook">Textbook</label>
                    <select class="form-control" name="textbook" id="textbook">
                        <option value="열린한국어 Beginner">열린한국어 Beginner</option>
                        <option value="한글이 나르샤">한글이 나르샤</option>
                        <option value="열린한국어 초급1">열린한국어 초급1</option>
                        <option value="열린한국어 초급2">열린한국어 초급2</option>
                        <option value="열린한국어 초급3">열린한국어 초급3</option>
                    </select>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label class="m-0" for="focuson">Focus on</label>
                    <select class="form-control" name="focuson" id="focuson">
                        <option value="Step by step">Step by step</option>
                        <option value="Already know Hangul">Already know Hangul</option>
                        <option value="Conversation, Vocabulary, Grammer">Conversation, Vocabulary, Grammer</option>
                        <option value="Making the environment to learn Korean">Making the environment to learn Korean</option>
                        <option value="Weakness of Hangul and self-introduction">Weakness of Hangul and self-introduction</option>
                    </select>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <label class="m-0" for="comprehension">Comprehension</label>
                    <select class="form-control" name="comprehension" id="comprehension">
                        <option value="中">中</option>
                        <option value="中上">中上</option>
                        <option value="下">下</option>
                        <option value="上">上</option>
                    </select>
                </div>

                <div class="row">
                    <button type="submit" class="btn btn-primary" name="AddLvl" value="Add level student" style="width: 100%">ADD</button>
                </div>
            </form>
        </div><!-- ADD LEVEL -->
    </div> <!-- Formularios Add Student, Add Level -->
    <div class="container d-flex justify-content-center mt-3">
        <div class="row" id="first_email">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <legend>EMAIL INFO NEW STUDENT</legend>
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" name="name" placeholder="Name" required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="email" name="email" placeholder="Email" required>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="online" value="1" id="online">
                            <label class="form-check-label" for="online">
                                Online
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="presencial" value="1" id="presencial">
                            <label class="form-check-label" for="presencial">
                                Home
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="academy" value="1" id="academy">
                            <label class="form-check-label" for="academy">
                                Academy
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="test" value="1" id="test">
                            <label class="form-check-label" for="test">
                                Test
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ingles" value="1" id="ingles">
                            <label class="form-check-label" for="ingles">
                                English
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="whatsapp" value="1" id="whatsapp">
                            <label class="form-check-label" for="whatsapp">
                                Whatsapp
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center">
                    <div class="col-6 pl-1">
                        <label class="m-0" for="pr_class">CLASS PRICE</label>
                        <input class="form-control" type="number" name="pr_class" value="15" required min="0" maxlength="2">
                    </div>
                    <div class="col-6 p-0">
                        <label class="m-0" for="pr_trans">TRANSPORTATION PRICE</label>
                        <input class="form-control" type="number" name="pr_trans" value="4" required min="0" maxlength="2">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary" name="sendTest" value="1" style="width: 100%">SEND</button>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- 1st Email -->
    <div class="container p-0">
        <div class="row d-flex justify-content-center">
            <div class="overflow-auto col-auto" id="addAssistance">
                <?php
				$lista=asistencia();
    			echo "<table class='table table-hover table-success table-sm w-auto'>";
				echo "<thead class='bg-success'><tr>";
				echo "<th class='text-center'>STUDENT</th>";
				echo "<th class='text-center'>DAY</th>";
				echo "<th class='text-center'>DATE</th>";
				echo "<th class='text-center'>DURATION</th>";
                echo "<th class='text-center'>€/h</th>";
                echo "<th class='text-center'>€ Trasnport</th>";
    			echo "<thead></tr>";
				echo '<tbody>';
				foreach($lista as $valor){
						echo "<tr>\n ";
        				echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
						echo "<td class='p-0 text-center align-middle'><button class='btn-dark btn-sm w-100' type='submit' name='assist' value='".utf8_decode($valor['user_id'])."'>".utf8_decode($valor['user_name'])."</button></td>"; 
						echo "<td class='p-0'>".utf8_decode($valor['day'])."</td>";
						echo "<td class='p-0 text-center align-middle'><input class='text-center' type='date' name='day' value='".$diahoy."'></td>";
						echo "<td class='p-0 text-center align-middle'><input class='text-center' type='number' name='time' value=".$valor['time']." step='0.5'></td>";
                        echo "<td class='p-0 text-center align-middle'><input class='text-center' type='number' name='pr_class' value=".$valor['pr_class']."></td>";
                        echo "<td class='p-0 text-center align-middle'><input class='text-center' type='number' name='pr_trans' value=".$valor['pr_trans']."></td>";
						echo "</form>";
        				echo "</tr>\n ";									
				}
				echo '</tbody>';
    			echo "</table>";
			?>
            </div> <!-- Add assistencia -->
            <div class="" id="Assistance">
                <?php 							
					$datos = asistencia_month($month);
					echo "<table class='table table-hover table-warning table-sm'>";
    						echo "<thead class='bg-warning'><tr>";
							echo "<th class='text-center'>EREASE</th>";
							echo "<th class='text-center'>STUDENT</th>";
							echo "<th class='text-center'>DAY</th>";
    						echo "<thead></tr>";
    						$numRes=count($datos);
							echo '<tbody>';
    						for  ($i=0; $i<$numRes; $i++){
    						    echo "<tr>\n ";
    						    echo "<form method='post'>";
    						    echo "<td class='text-center align-middle'><button class='btn btn-secondary btn-sm' type='submit' name='ereaseA' value='".utf8_decode($datos[$i]['id_assist'])."'>X</button></td>";
    						    echo "<td class='text-center align-middle'>".utf8_decode($datos[$i]['user_name'])."</td>";
								echo "<td class='text-center align-middle'>".utf8_decode($datos[$i]['day'])."</td>";
    						    echo "</form>";
    						    echo "</tr>\n ";
    						}
							echo '</tbody>';
    						echo "</table>";
					
						?>
            </div> <!-- tabla Assistance -->
        </div>
    </div> <!-- Tablas asistencia -->
    <div class="container p-0">
        <div class="row d-flex justify-content-center" id="alumno">
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<?php
	}  // Cierre de else $_SESSION['acceso']==1
	?>
