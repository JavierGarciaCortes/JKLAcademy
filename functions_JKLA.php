<?php
// datos base para conectar con BD
include '../../Privado/BBDD_jacademy_connection.php';
// funciones generales
function conecta ($dbHost, $dbUser, $dbPass, $dbName){
    $db= new mysqli ($dbHost, $dbUser, $dbPass, $dbName);
    if($db->connect_error){
        die("No se puede conectar: ".$db->connect_error);
    }
    return $db;
}			// Conecta con la BD
function filtrarResU8($variable){
    $db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $dato=$db->real_escape_string($variable);
    $dato = utf8_encode($dato);
    return $dato;
} 								// Filtros real_escape_string y utf8_encode
function getTabla($table){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT * FROM $table";
    $resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    return $datos;
}										// Retorna un array con los datos de una tabla
function getColumn($table, $column){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT $column FROM $table";
    $resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    return $datos;
}							// Retorna un array con los datos de la columna
function getDistintct($table, $column){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT DISTINCT $column FROM $table";
    $resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    return $datos;
}						// Retorna array con valores unicos de la columna
function printTitlesTable($datos){
	echo "<thead class='thead-dark'><tr>";
    foreach ($datos as $key=>$value){ 
        foreach ($value as $key=>$values){
            $mykey[] = $key;
        }
    }// para sacar los titulos de la tabla
    for($i=0; $i<count($value); $i++){
        echo "<th scope='col'>$mykey[$i]</th>";
    }// Imprime los titulos 
    echo "<thead></tr>";
}								// Imprime los titulos de las tablas
function imprimir($datos){ 
    echo "<table class='table table-striped table-dark'>";
    printTitlesTable($datos);
	echo '<tbody>';
    foreach ($datos as $valor){
        echo "<tr> \n";
        foreach ($valor as $dato){
            $dato = utf8_decode($dato); //decodifica la codificación utf8
            echo "<td>$dato</td>";
        }
        echo "</tr> \n";
    } // Imprime los datos de la tabla
	echo '</tbody>';
    echo "</table>";
     }										// Imprime arrays en tablas
function idiomasNav($pag){
		require 'idioma.php';
		$directory = 'lang/';
		$files = scandir($directory);
		$num = count($files);
		$idiomas = array();
		for ($i = 0; $i < $num  ; $i++) {
			array_push($idiomas, $files[$i]);
		}
		for($i=2; $i < count($idiomas); $i++){
			if ($_SESSION["lang"] != substr($idiomas[$i],0, 2)){
				echo '<option value="'.substr($idiomas[$i],0, 2).'">'.$idiomasCode[substr($idiomas[$i],0, 2)].'</option>';
			}
		}
	}


// funciones especificas JKLA
function addstudent($name, $email, $mobile, $city, $address, $day, $c_start, $time, $c_type, $pr_class, $pr_trans){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $sql="INSERT INTO students (name, email, mobile, city, address, day, c_start, time, c_type, pr_class, pr_trans) VALUES ( '$name', '$email', '$mobile', '$city', '$address', '$day', '$c_start', '$time', '$c_type', '$pr_class', '$pr_trans')";
	$db->query($sql);
}   	// ADD STUDENT
function addlvlstudent($id_student, $state, $starting_day, $text_book, $focus_on, $comprehension){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $sql="INSERT INTO level (id_student, state, starting_day, text_book, focus_on, comprehension) VALUES ( '$id_student', '$state', '$starting_day', '$text_book', '$focus_on', '$comprehension')";
	$db->query($sql);
}						// ADD LVL STUDENT
function addpass($id_student, $password){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $sql="INSERT INTO pass (id_student, password) VALUES ( '$id_student', '$password')";
	$db->query($sql);
}																				// ADD PASSWORD
function studentandlvl(){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT s.id_student, name, state, text_book, focus_on, comprehension FROM students s JOIN level l ON s.id_student=l.id_student WHERE day!='Stop' ORDER BY name";
	$resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    echo "<table class='table table-hover table-success table-sm'>";
    echo "<thead class='bg-success'><tr>";
	echo "<th class='text-center'>STUDENT</th>";
	echo "<th class='text-center'>STATE</th>";
	echo "<th class='text-center'>TEXT BOOK</th>";
	echo "<th class='text-center'>FOCUS ON</th>";
	echo "<th class='text-center'>COMPREHENSION</th>";
    echo "<thead></tr>";
    $numRes=count($datos);
	echo '<tbody>';
    for  ($i=0; $i<$numRes; $i++){
        echo "<tr>\n ";
        echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
        echo "<td class='text-center align-middle'><button class='btn btn-dark btn-sm w-100' type='submit' name='modiflvl' value='".utf8_decode($datos[$i]['id_student'])."'>".utf8_decode($datos[$i]['name'])."</button></td>";
		echo "<td class='align-middle'><select class='form-control form-control-sm' name='state'><option value='".utf8_decode($datos[$i]['state'])."'>".utf8_decode($datos[$i]['state'])."<option value='Starter'>Starter</option><option value='Beginner'>Beginner</option><option value='Intermediate'>Intermediate</option><option value='Advance'>Advance</option></select></td>";
		echo "<td class='align-middle'><select class='form-control form-control-sm' name='text_book'><option value='".utf8_decode($datos[$i]['text_book'])."'>".utf8_decode($datos[$i]['text_book'])."<option value='열린한국어 Beginner'>열린한국어 Beginner</option><option value='한글이 나르샤'>한글이 나르샤</option><option value='열린한국어 초급1'>열린한국어 초급1</option><option value='열린한국어 초급2'>열린한국어 초급2</option><option value='열린한국어 초급3'>열린한국어 초급3</option></select></td>";
		echo "<td class='align-middle'><select class='form-control form-control-sm' name='focus_on'><option value='".utf8_decode($datos[$i]['focus_on'])."'>".utf8_decode($datos[$i]['focus_on'])."<option value='Step by step'>Step by step</option>
						<option value='Already know Hangul'>Already know Hangul</option>
						<option value='Conversation, Vocabulary, Grammer'>Conversation, Vocabulary, Grammer</option>
						<option value='Making the environment to learn Korean'>Making the environment to learn Korean</option>
						<option value='Weakness of Hangul and self-introduction'>Weakness of Hangul and self-introduction</option></select></td>";
		echo "<td><select class='form-control form-control-sm' name='comprehension'><option value='".utf8_decode($datos[$i]['comprehension'])."'>".utf8_decode($datos[$i]['comprehension'])."<option value='中'>中</option><option value='中上'>中上</option><option value='下'>下</option><option value='上'>上</option></select></td>";
        echo "</form>";
        echo "</tr>\n ";
    }
	echo '</tbody>';
    echo "</table>";
}										// Tabla lvl, puedes modificarla datos
function showInfo($active){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT name, email, mobile, city, address FROM students WHERE day".$active."'Stop' ORDER BY name";
	$resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    echo "<table class='table table-bordered table-hover table-sm table-info'>";
    echo "<thead class='bg-info'><tr>";
	echo "<th class='text-center'>STUDENT</th>";
	echo "<th class='text-center'>EMAIL</th>";
	echo "<th class='text-center'>MOBILE</th>";
	echo "<th class='text-center'>CITY</th>";
	echo "<th class='text-center'>ADDRESS</th>";
    echo "<thead></tr>";
	$numRes=count($datos);
	echo '<tbody>';
    for  ($i=0; $i<$numRes; $i++){
        echo "<tr>\n ";
        echo "<td class='text-left align-middle'>".utf8_decode($datos[$i]['name'])."</td>";
		echo "<td class='text-right align-middle'><a href='mailto:".utf8_decode($datos[$i]['email'])."'>".utf8_decode($datos[$i]['email'])."</a></td>";
		echo "<td class='text-center align-middle'>".utf8_decode($datos[$i]['mobile'])."</td>";
		echo "<td class='text-center align-middle'>".utf8_decode($datos[$i]['city'])."</td>";
		echo "<td class='text-center align-middle'>".utf8_decode($datos[$i]['address'])."</td>";
        echo "</tr>\n ";
    }
	echo '</tbody>';
    echo "</table>";
}									// Tabla info alumnos
function tableStudentsEdit($active, $colorTable, $colorTitle){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT id_student, name, day, c_start, time, c_type, pr_class, pr_trans FROM students WHERE day".$active."'Stop' ORDER BY FIELD(day, 'STOP', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'), c_start";
	$resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    echo "<table class='table table-hover ".$colorTable." table-sm'>";
	echo "<thead class='".$colorTitle."'><tr>";
	echo "<th class='text-center'>STUDENT</th>";
	echo "<th class='text-center'>DAY</th>";
	echo "<th class='text-center'>START</th>";
	echo "<th class='text-center'>h</th>";
	echo "<th class='text-center'>PLACE</th>";
	echo "<th class='text-center'>€ CLASS</th>";
	echo "<th class='text-center'>€ TRIP</th>";
    echo "<thead></tr>";
    $numRes=count($datos);
	echo '<tbody>';
    for  ($i=0; $i<$numRes; $i++){
        echo "<tr>\n ";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "<td class='text-center'><button class='btn btn-dark btn-sm w-100' type='submit' name='modif' value='".utf8_decode($datos[$i]['id_student'])."'>".utf8_decode($datos[$i]['name'])."</button></td>";
		echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='day' style='width:120px'><option value='".utf8_decode($datos[$i]['day'])."'>".utf8_decode($datos[$i]['day'])."</option><option value='Monday'>Monday</option><option value='Tuesday'>Tuesday</option><option value='Wednesday'>Wednesday</option><option value='Thursday'>Thursday</option><option value='Friday'>Friday</option><option value='Saturday'>Saturday</option><option value='Stop'>Stop</option></select></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='time' name='hstart' style='width:85px' value='".utf8_decode($datos[$i]['c_start'])."'></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='number' name='time' style='width:65px' value='".utf8_decode($datos[$i]['time'])."' step='0.5' max='2' min='1'></td>";
		echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='c_type' style='width:105px'><option value='".utf8_decode($datos[$i]['c_type'])."'>".utf8_decode($datos[$i]['c_type'])."</option><option value='Academy'>Academy</option><option value='Online'>Online</option><option value='Home'>Home</option></select></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='number' name='classp' style='width:65px' value='".utf8_decode($datos[$i]['pr_class'])."' class='i-pr'></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='number' name='transp' style='width:65px' value='".utf8_decode($datos[$i]['pr_trans'])."' class='i-pr'></td>";
        echo "</form>";
        echo "</tr>\n ";
    }
	echo '</tbody>';
    echo "</table>";
}	// Tabla estudiantes activos, puedes modificarla datos
function asistencia(){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT id_student, name, day, time FROM students WHERE day!='Stop' ORDER BY FIELD(day, 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY')";
    $resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    return $datos;
}											// Tabla estudiantes para asistencia
function asistencia_month($month){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT id_assist, name, a.day FROM students s JOIN assist a ON s.id_student=a.id_student WHERE a.day LIKE '_____".$month."___' ORDER BY a.day";
	$resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    return $datos;
}								// Tabla asistencia segun mes
?>
