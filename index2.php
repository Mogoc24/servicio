<?php 
	date_default_timezone_set('America/Mexico_City');
	$conexion = new mysqli('localhost','root','qaz','db_frames2');
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}
	$type = "OS";	
	//function createFolio($type){
		//$now = time();
		//$str = date("Ymd", $now);
		//$str .= "-Rep-";
		$str = $type;
		$query = $conexion->query("SELECT iddata_frame FROM data_frame ORDER BY iddata_frame DESC LIMIT 1");
		while ($row = $query->fetch_array()) {
			$numero = $row['iddata_frame'];
		}
		$cadena = str_pad($numero,8,"0",STR_PAD_LEFT);
		echo $str.$cadena;
	//}

	$type = "Reporte";
	//createFolio($type);
	
	/*function comparar($start, $end, $assign, $unassign){
		$assi = strtotime($assign)
		$unassi = strtotime($unassign);
		$ini = strtotime($start);
		$fin = strtotime($end);

		if ($ini < $assi && $fin > $unassi) {
			$fechas = array('inicio' => $assign, 'fin' => $unassign);

			return $fechas;
		}
		elseif ($ini > $assi && $fin > $unassi) {
			$fechas = array('inicio' => $start, 'fin' => $unassign);

			return $fechas;
		}
		elseif ($ini < $assi && $fin < $unassi) {
			$fechas = array('inicio' => $assign, 'fin' => $end);

			return $fechas;
		}
		elseif ($ini > $assi && $fin < $unassi) {
			$fechas = array('inicio' => $start, 'fin' => $end);

			return $fechas;
		}
		else{
			$fechas = array('inicio' => $assign, 'fin' => $unassign);
			return $fechas;
		}
	}

	function mostrar (){
		$start = '2016-04-15';
		$end = '2016-04-19';
		$assign = '2016-04-14 11:16:11';
		$unassign = '2016-04-15 10:54:00';

		$fecha = comparar($start, $end, $assign, $unassign);
		echo $fecha['inicio']."-------";
		echo $fecha['fin'];

	}*/

	//mostrar();

	//$arreglo = array(18, 14, 6);
	
	//print_r($arreglo);
	//print_r($b);
	
	/*$query = $conexion->query("SELECT * FROM (SELECT v.idvehicle, v.name_vehicle, d.name_driver, f.up, f.down, f.onboard, f.event_date 
		FROM data_frame as f
		INNER JOIN vehicles as v on v.idvehicle = f.vehicle_idvehicle
		LEFT JOIN driver_events as de on de.vehicles_idvehicle = v.idvehicle
		LEFT JOIN drivers as d on de.drivers_iddrivers = d.iddrivers
		WHERE date(event_date) = '2016-04-21' and vehicle_idvehicle = 17 
		ORDER BY event_date DESC) as sub1
	GROUP BY hour(event_date)
	ORDER BY event_date DESC");

	while ($row = $query->fetch_array()) {
		$arreglo[] = $row['up'];
	}

	for ($i=0; $i < count($arreglo); $i++) { 
		$b[$i] = $arreglo[$i] - (isset($arreglo[$i+1]) ? $arreglo[$i+1] : 0);
		//$b[$i] = $arreglo[$i] - (isset($arreglo[$i+1]) ? $arreglo[$i+1] : $arreglo[$i]);
	}
	print_r($b);

	$password = 'BrunoGuaschino';
	$password2 = 'BrunoGuaschino';
	$salt = '$bgr$/';
	$s_salt = md5($salt . $password);

	if ($s_salt == md5($salt . $password2)) {
		echo "Las contraseñas son iguales";
	}

	else{
		echo "No corresponden las contraseñas";
	}*/
 ?>