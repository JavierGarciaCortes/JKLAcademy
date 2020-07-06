<?php
// datos base para conectar con BD
include '../../Privado/bd_jacademy_connection.php';
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
function idUser($user_email){
    $datos=[]; 
    $db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME ); 
    $sql="SELECT user_id FROM `users` WHERE user_email='$user_email';";
    $resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
		return $datos[0]['user_id'];
	}
function addstudent($name, $email, $mobile, $city, $address, $day, $c_start, $time, $c_type, $pr_class, $pr_trans, $diahoy, $classes_week){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $sql="INSERT INTO users (user_name,  user_email, user_mobile, city, address, pr_class, pr_trans, user_registered, user_status, classes_week) VALUES ( '$name', '$email', '$mobile', '$city', '$address', '$pr_class', '$pr_trans', '$diahoy', 'STUDENT', '$classes_week')"; 
	$db->query($sql);
    $user_id=idUser($email);
    $sql="INSERT INTO classes (user_id, day, c_start, time, c_type) VALUES ( '$user_id', '$day', '$c_start', '$time', '$c_type')";
	$db->query($sql);
}   	// ADD STUDENT
function addlvlstudent($id_student, $state, $text_book, $focus_on, $comprehension){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $sql="INSERT INTO level (user_id, state, text_book, focus_on, comprehension) VALUES ( '$id_student', '$state', '$text_book', '$focus_on', '$comprehension')";
	$db->query($sql);
}						// ADD LVL STUDENT
function addclasstable(){
    // SELECT DISTINCT user_id, count(*) AS classes_added FROM `classes` GROUP BY user_id;
    $classes_added=[]; 
    $db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME ); 
    $sql="SELECT DISTINCT user_id, count(*) AS classes_added FROM `classes` GROUP BY user_id;";
    $resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $classes_added[]=$fila;
    }
    // SELECT user_id, user_name, classes_week FROM `users` WHERE classes_week!=0;
    $classes_week=[]; 
    $sql="SELECT user_id, user_name, classes_week FROM `users` WHERE classes_week!=0;";
    $resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $classes_week[]=$fila;
    }
    // SELECT `user_id`, `user_name` FROM `users` WHERE `user_id` NOT IN (SELECT `user_id` FROM classes) AND `classes_week`!= 0;
    $no_classes_add=[]; 
    $sql="SELECT `user_id`, `user_name` FROM `users` WHERE `user_id` NOT IN (SELECT `user_id` FROM classes) AND `classes_week`!= 0;";
    $resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $no_classes_add[]=$fila;
    }
    
    echo "<table class='table table-hover table-success table-sm'>";
	echo "<thead class='bg-success'><tr>";
	echo "<th class='text-center'>STUDENT</th>";
	echo "<th class='text-center'>DAY</th>";
	echo "<th class='text-center'>START</th>";
	echo "<th class='text-center'>h</th>";
	echo "<th class='text-center'>PLACE</th>";
    echo "<th class='text-center'>EREASE</th>";
    echo "<thead></tr>";
    $numRes1=count($classes_week);
    $numRes2=count($classes_added);
    $numRes3=count($no_classes_add);
	echo '<tbody>';
    for($i=0; $i<$numRes1; $i++){
        for($j=0; $j<$numRes2; $j++){
            if($classes_added[$j]['user_id']==$classes_week[$i]['user_id']){
                $num_week=$classes_week[$i]['classes_week'];
                $num_added=0;
                $num_added=$classes_added[$j]['classes_added'];
                for($m=0; $m<$num_week-$num_added; $m++){
                    echo "<tr>\n ";
                    echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
                    echo "<td class='text-center'>".$classes_week[$i]['user_name']."</td>";
                    echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='day' style='width:120px'><option value='Monday'>Monday</option><option value='Tuesday'>Tuesday</option><option value='Wednesday'>Wednesday</option><option value='Thursday'>Thursday</option><option value='Friday'>Friday</option><option value='Saturday'>Saturday</option></select></td>";
                    echo "<td class='text-center align-middle'><input required class='form-control form-control-sm' type='time' name='hstart' style='width:85px'></td>";
                    echo "<td class='text-center align-middle'><input required class='form-control form-control-sm' type='number' name='time' style='width:65px' step='0.5' max='2' min='1'></td>";
                    echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='c_type' style='width:105px'><option value='Academy'>Academy</option><option value='Online'>Online</option><option value='Home'>Home</option></select></td>";
                    echo "<td class='text-center'><button class='btn btn-dark btn-sm w-100' type='submit' name='AddClass' value='".$classes_week[$i]['user_id']."'>Add</button></td>";
                    echo "</form>";
                    echo "</tr>\n ";
                }
            }
        }
    }
    for($i=0; $i<$numRes3; $i++){
        echo "<tr>\n ";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "<td class='text-center'>".$no_classes_add[$i]['user_name']."</td>";
        echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='day' style='width:120px'><option value='Monday'>Monday</option><option value='Tuesday'>Tuesday</option><option value='Wednesday'>Wednesday</option><option value='Thursday'>Thursday</option><option value='Friday'>Friday</option><option value='Saturday'>Saturday</option></select></td>";
        echo "<td class='text-center align-middle'><input required class='form-control form-control-sm' type='time' name='hstart' style='width:85px'></td>";
        echo "<td class='text-center align-middle'><input required class='form-control form-control-sm' type='number' name='time' style='width:65px' step='0.5' max='2' min='1'></td>";
        echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='c_type' style='width:105px'><option value='Academy'>Academy</option><option value='Online'>Online</option><option value='Home'>Home</option></select></td>";
        echo "<td class='text-center'><button class='btn btn-dark btn-sm w-100' type='submit' name='AddClass' value='".$no_classes_add[$i]['user_id']."'>Add</button></td>";
        echo "</form>";
        echo "</tr>\n ";
    }
	echo '</tbody>';
    echo "</table>";

}                                      //Add class table form
function studentandlvl(){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT DISTINCT u.user_id, user_name, state, text_book, focus_on, comprehension FROM users_classes u JOIN level l ON u.user_id=l.user_id WHERE classes_week!='0' ORDER BY user_name";
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
        echo "<td class='text-center align-middle'><button class='btn btn-dark btn-sm w-100' type='submit' name='modiflvl' value='".utf8_decode($datos[$i]['user_id'])."'>".utf8_decode($datos[$i]['user_name'])."</button></td>";
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
    $sql="SELECT user_id, user_name, user_email, user_mobile, city, address FROM users WHERE classes_week".$active."'0' AND `user_status`='STUDENT' ORDER BY user_name";
	$resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    echo "<table class='table table-bordered table-hover table-sm table-info'>";
    echo "<thead class='bg-info'><tr>";
    if($active!='=') echo "<th class='text-center'>Add class week</th>";
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
        if($active!='=') echo "<form action=".$_SERVER['PHP_SELF']." method='post'><th class='text-center'><button class='btn btn-dark btn-sm w-100' type='submit' name='AddClassWeek' value='".$datos[$i]['user_id']."'>Add</button></th></form>";
        echo "<td class='text-left align-middle'>".utf8_decode($datos[$i]['user_name'])."</td>";
		echo "<td class='text-right align-middle'><a href='mailto:".utf8_decode($datos[$i]['user_email'])."'>".utf8_decode($datos[$i]['user_email'])."</a></td>";
		echo "<td class='text-center align-middle'>".utf8_decode($datos[$i]['user_mobile'])."</td>";
		echo "<td class='text-center align-middle'>".utf8_decode($datos[$i]['city'])."</td>";
		echo "<td class='text-center align-middle'>".utf8_decode($datos[$i]['address'])."</td>";
        echo "</tr>\n ";
    }
	echo '</tbody>';
    echo "</table>";
}									// Tabla info alumnos
function tableStudentsEdit(){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT class_id, user_name, day, c_start, time, c_type FROM users_classes WHERE classes_week!='0' AND `user_status`='STUDENT' ORDER BY FIELD(day, 'STOP', 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY'), c_start";
	$resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    echo "<table class='table table-hover table-success table-sm'>";
	echo "<thead class='bg-success'><tr>";
	echo "<th class='text-center'>STUDENT</th>";
	echo "<th class='text-center'>DAY</th>";
	echo "<th class='text-center'>START</th>";
	echo "<th class='text-center'>h</th>";
	echo "<th class='text-center'>PLACE</th>";
    echo "<th class='text-center'>EREASE</th>";
    echo "<thead></tr>";
    $numRes=count($datos);
	echo '<tbody>';
    for  ($i=0; $i<$numRes; $i++){
        echo "<tr>\n ";
        echo "<form action=".$_SERVER['PHP_SELF']." method='post'>";
        echo "<td class='text-center'><button class='btn btn-dark btn-sm w-100' type='submit' name='modif' value='".utf8_decode($datos[$i]['class_id'])."'>".utf8_decode($datos[$i]['user_name'])."</button></td>";
		echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='day' style='width:120px'><option value='".utf8_decode($datos[$i]['day'])."'>".utf8_decode($datos[$i]['day'])."</option><option value='Monday'>Monday</option><option value='Tuesday'>Tuesday</option><option value='Wednesday'>Wednesday</option><option value='Thursday'>Thursday</option><option value='Friday'>Friday</option><option value='Saturday'>Saturday</option></select></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='time' name='hstart' style='width:85px' value='".utf8_decode($datos[$i]['c_start'])."'></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='number' name='time' style='width:65px' value='".utf8_decode($datos[$i]['time'])."' step='0.5' max='2' min='1'></td>";
		echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='c_type' style='width:105px'><option value='".utf8_decode($datos[$i]['c_type'])."'>".utf8_decode($datos[$i]['c_type'])."</option><option value='Academy'>Academy</option><option value='Online'>Online</option><option value='Home'>Home</option></select></td>";
        echo "<td class='text-center'><button class='btn btn-dark btn-sm w-100' type='submit' name='ereaseClass' value='".utf8_decode($datos[$i]['class_id'])."'>Trash</button></td>";
        echo "</form>";
        echo "</tr>\n ";
    }
	echo '</tbody>';
    echo "</table>";
}	                                // Tabla classes puedes modificarla datos
function tableStudentsEditIn(){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT user_id, user_name, classes_week, pr_class, pr_trans FROM users WHERE classes_week='0' AND `user_status`='STUDENT' ORDER BY user_name";
	$resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    echo "<table class='table table-hover table-danger table-sm'>";
	echo "<thead class='bg-danger'><tr>";
	echo "<th class='text-center'>STUDENT</th>";
    echo "<th class='text-center'>Classes week</th>";
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
        echo "<td class='text-center'><button class='btn btn-dark btn-sm w-100' type='submit' name='modifIn' value='".utf8_decode($datos[$i]['user_id'])."'>".utf8_decode($datos[$i]['user_name'])."</button></td>";
        echo "<td class='text-center align-middle'><input class='form-control form-control-sm  w-100' type='number' name='classes_week' style='width:65px' value='".utf8_decode($datos[$i]['classes_week'])."' class='i-pr'></td>";
		echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='day' style='width:120px'><option value='Monday'>Monday</option><option value='Tuesday'>Tuesday</option><option value='Wednesday'>Wednesday</option><option value='Thursday'>Thursday</option><option value='Friday'>Friday</option><option value='Saturday'>Saturday</option><option value='Stop'>Stop</option></select></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='time' name='hstart' style='width:85px' ></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='number' name='time' style='width:65px' step='0.5' max='2' min='1'></td>";
		echo "<td class='text-center align-middle'><select class='form-control form-control-sm' name='c_type' style='width:105px'><option value='Academy'>Academy</option><option value='Online'>Online</option><option value='Home'>Home</option></select></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='number' name='classp' style='width:65px' value='".utf8_decode($datos[$i]['pr_class'])."' class='i-pr'></td>";
		echo "<td class='text-center align-middle'><input class='form-control form-control-sm' type='number' name='transp' style='width:65px' value='".utf8_decode($datos[$i]['pr_trans'])."' class='i-pr'></td>";
        echo "</form>";
        echo "</tr>\n ";
    }
	echo '</tbody>';
    echo "</table>";
}	                            // Tabla estudiantes inactivos, puedes modificarla datos
function asistencia(){
	$db=conecta(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME );
    $datos=[];
    $sql="SELECT user_id, user_name, day, time FROM users_classes WHERE classes_week!='0' AND `user_status`='STUDENT' ORDER BY FIELD(day, 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY')";
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
    $sql="SELECT id_assist, user_name, a.day FROM users s JOIN assist a ON s.user_id=a.user_id WHERE a.day LIKE '_____".$month."___' ORDER BY a.day";
	$resultados = $db->query($sql);
    $rows=$resultados->num_rows;
    for($i=0; $i<$rows; $i++){
        $fila=$resultados->fetch_assoc();
        $datos[]=$fila;
    }
    return $datos;
}								// Tabla asistencia segun mes
?>
