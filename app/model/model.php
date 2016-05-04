<?php
	require_once "connect.php";

	class Model extends Conexion{
		
		public function _construct(){
			parent:: _construct();
			date_default_timezone_set('America/Mexico_City');
		}

		function randomString(){
			$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$characters .= "abcdefghijklmnopqrstuvwxyz";
			$characters .= "0123456789";
			$characters .= "*#$%&!*][}{";
			$stringRand = str_shuffle($characters);
			$password = substr($stringRand, 1, 10);
			
			return $password;
		}
		
		function createFolio($type){
			$now = time();
			//$fecha = date("Y-m-d H:i:s");
			$str = date("Y-m-d", $now);
			//$str .= "-Rep-";
			$str .= $type;
			$query = $this->mysqli->query("SELECT idfolios FROM folios ORDER BY idfolios DESC LIMIT 1");
			$cadena = str_pad($numero,8,"0",STR_PAD_LEFT);
			$folio = $str.$cadena;

			return $folio;
		}

		public function login(){
			$infoJ = $_POST['info'];
			$info = json_decode($infoJ, false, 512, JSON_BIGINT_AS_STRING);
			$user = $info->user;
			$pass = $info->pass;

			$user = $this->mysqli->real_escape_string($user);
			$pass = $this->mysqli->real_escape_string($pass);

			$query = $this->mysqli->query("SELECT idusers, user, name_user, pass, type, status FROM users WHERE user = '$user'");
			
			if ($query->num_rows > 0) {
				while ($row = $query->fetch_array()) {
					$name_user = $row['name_user'];
					$user = $row['user'];
					$idusers = $row['idusers'];
					$passHash = $row['pass'];
					$type = $row['type'];
					$status = $row['status'];
				}
				//echo $passHash;
					if (password_verify($pass, $passHash)) {
						session_start();
						$_SESSION['connected'] = true;
						$_SESSION['usuario'] = $user;
						$_SESSION['idusers'] = $idusers;
						$_SESSION['type'] = $type;
						$_SESSION['status'] = $status;
						echo "correcto";
					}
					else{
						echo "incorrecto";
					}
			}
			else{
				echo "no existe";
			}
		}

		public function logout(){
			session_start();
			session_unset();
			session_destroy();
		}

		public function saveUser(){
			$infoJ = $_POST['info'];
			$info = json_decode($infoJ, false, 512, JSON_BIGINT_AS_STRING);
			$user = utf8_decode($info->user);
			$name_user = utf8_decode($info->name);
			$ap_user = utf8_decode($info->ap);
			$email = $info->email;
			//$pass = $info->pass;
			$pass = 'default';
			//$pass = $this->randomString();
			$salt = "i!TIfHW2N";
			$rango = $info->type;
			$idUser = $info->idUser;
			//$rango = 1;

			$user = $this->mysqli->real_escape_string($user);
			$name_user = $this->mysqli->real_escape_string($name_user);
			$ap_user = $this->mysqli->real_escape_string($ap_user);
			$email = $this->mysqli->real_escape_string($email);
			$typeChange = "Guardar usuario";

			$passHash = password_hash($pass, PASSWORD_BCRYPT);

			$query2 = $this->mysqli->query("SELECT user FROM users WHERE user = '$user'");
			$query3 = $this->mysqli->query("SELECT email FROM users WHERE email = '$email'");

			if ($query2->num_rows > 0 || $query3->num_rows > 0) {
				echo "existe";
			}
			else{
				$query = "INSERT INTO users values(default, '$user', '$name_user', '$ap_user', '$passHash', '$email','$rango', '$salt', current_timestamp)";
				if($this->mysqli->query($query)){
					if ($this->mysqli->query("INSERT INTO changes values(default, '$typeChange', '$user', current_timestamp, '$idUser')")) {
						echo "cambioCorrecto";
					}
					//echo "correcto";
					else{
						echo "cambioIncorrecto";
					}
				}
				else{
					echo "incorrecto";
				}
			}
		}

		public function saveCustomer(){
			$infoJ = $_POST['info'];
			$info = json_decode($infoJ, false, 512, JSON_BIGINT_AS_STRING);
			/*$id = $info->id;
			$name_customer = utf8_decode($info->name);
			$platforms = $info->platforms;
			$email = $info->email;
			$tel = $info->tel;
			$address = $info->address;
			$idUser = $info->idUser;*/

			//$id = $this->mysqli->real_escape_string($id);
			//$name_customer = $this->mysqli->real_escape_string($name_customer);
			echo "Funcion correcta";
		}

		public function saveTicket(){
			$infoJ = $_POST['info'];
			$info = json_decode($infoJ, false, 512, JSON_BIGINT_AS_STRING);
			//print_r($info);

			$idUser = $info->idUser;
			$customer = $info->customer;
			$problemDate = $info->problemDate;
			$problemType = $info->problemType;
			$desc = utf8_decode($info->desc);

			$idUser = $this->mysqli->real_escape_string($idUser);
			$customer = $this->mysqli->real_escape_string($customer);
			$problemDate = $this->mysqli->real_escape_string($problemDate);
			$problemType = $this->mysqli->real_escape_string($problemType);
			$desc = $this->mysqli->real_escape_string($desc);

		}

		public function allCustomers(){
			$query = $this->mysqli->query("SELECT * FROM customers");
			$output = '{"infoCustomers":[';
			while ($row = $query->fetch_array()) {
				if ($output != '{"infoCustomers":[') {$output .= ",";}
				$output .= '{"id":'.$row['idcustomers'].',';
				$output .= '"name":"'.$row['name_customer'].'"}';
			}
			$output .= "]}";
			echo $output;
		}

		public function allServices(){
			$query = $this->mysqli->query("SELECT * FROM services");
			$output = '{"infoServices":[';
			while ($row = $query->fetch_array()) {
				if ($output != '{"infoServices":[') {$output .= ",";}
				$output .= '{"id":'.$row['idservices'].',';
				$output .= '"name":"'.utf8_encode($row['name_service']).'"}';
			}
			$output .= "]}";
			echo $output;
		}

		public function allUsers(){
			$query = $this->mysqli->query("SELECT * FROM users where type <> 1");
			$output = '{"infoUsers":[';
    	 	while ($row = $query->fetch_array()) {
    	 		if ($output!='{"infoUsers":[') {$output .= ",";}
				$output .= '{"id":'.$row["idusers"].',';
    	 		$output .= '"user":"'.utf8_encode($row["user"]).'",';
    	 		$output .= '"name":"'.utf8_encode($row["name_user"]).'",';
    	 		$output .= '"lastName":"'.utf8_encode($row["ap_user"]).'",';
    	 		$output .= '"email":"'.$row["email"].'",';
    	 		//$output .= '"type":"'.$row["type"].'",';
    	 		if ($row['type']==2) {
    	 			$output .= '"type":"Consulta",';
    	 		}
    	 		elseif($row['type']==3){
    	 			$output .= '"type":"Técnico",';
    	 		}
    	 		elseif ($row['type']==4) {
    	 			$output .= '"type":"Operador",';
    	 		}
    	 		elseif ($row['type']==5) {
    	 			$output .= '"type":"Auditor",';
    	 		}
    	 		else{
    	 			$output .= '"type":"No asignado",';
    	 		}

    	 		$output .= '"date":"'.$row["date_user"].'"}';

			}
			$output .= "]}";
			echo $output;
		}

		public function allChanges(){
			$query = $this->mysqli->query("SELECT c.idchanges, c.type, c.label, c.date, u.user FROM changes as c INNER JOIN users as u on c.users_idusers = u.idusers");
			$output = '{"infoChanges":[';
			while ($row = $query->fetch_array()) {
				if ($output != '{"infoChanges":[') {$output .= ',';}
				$output .= '{"id":'.$row["idchanges"].',';
    	 		$output .= '"type":"'.utf8_encode($row["type"]).'",';
    	 		$output .= '"label":"'.utf8_encode($row["label"]).'",';
    	 		$output .= '"date":"'.$row["date"].'",';
    	 		$output .= '"user":"'.utf8_encode($row["user"]).'"}';
			}
			$output .= "]}";
			echo $output;
		}

		public function changePass(){
			$infoJ = $_POST['info'];
			$info = json_decode($infoJ, false, 512, JSON_BIGINT_AS_STRING);

			$idUser = $info->idUser;
			//echo $user = utf8_decode($info->user);
			$pass = utf8_decode($info->pass);
			$passBefore = utf8_decode($info->passBefore);
			$typeChange = utf8_decode("Cambio de contraseña");
			$label = "Crypt Pass";
			$pass = $this->mysqli->real_escape_string($pass);
			$passHash = password_hash($pass, PASSWORD_BCRYPT);

			$query2 = $this->mysqli->query("SELECT pass FROM users WHERE idusers = '$idUser'");

			if ($query2->num_rows > 0) {
				while ($row = $query2->fetch_array()) {
					$passDb = $row['pass'];
				}

				if (password_verify($passBefore, $passDb)) {
					
					$query = "UPDATE users SET pass = '$passHash', status = 1 WHERE idusers = '$idUser'";
					if ($this->mysqli->query($query)) {
						if ($this->mysqli->query("INSERT INTO changes values(default, '$typeChange', '$label', current_timestamp, '$idUser')")) {
							echo "cambioCorrecto";
						}
						else {
							echo "cambioIncorrecto";
						}
					}
					else{
						echo "incorrecto";
					}
				}
				else{
					echo "badPass";
				}
			}
			else{
				echo "no existe";
			}

		}

		public function showSession(){
			session_start();
			echo '{"idUser": '.$_SESSION['idusers'].', "usuario": "'.$_SESSION['usuario'].'", "status":'.$_SESSION['status'].'}';
			//echo $_SESSION['idusers'];
		}

	}

	$instance = new Model();
	//$instance->saveUser();
	if ($_POST['type']=="saveUser") {
		$instance->saveUser();
	}
	elseif ($_POST['type']=="saveCustomer") {
		$instance->saveCustomer();
	}
	elseif ($_POST['type']=="saveTicket") {
		$instance->saveTicket();
	}
	elseif ($_POST['type']=="login") {
		$instance->login();
	}
	elseif ($_POST['type']=="logout") {
		$instance->logout();
	}
	elseif ($_POST['type']=="session") {
		$instance->showSession();
	}
	elseif ($_POST['type']=="customer") {
		$instance->allCustomers();
	}
	elseif ($_POST['type']=="services") {
		$instance->allServices();
	}
	elseif ($_POST['type']=="allUsers") {
		$instance->allUsers();
	}
	elseif ($_POST['type']=="allChanges") {
		$instance->allChanges();
	}
	elseif ($_POST['type']=="changePass") {
		$instance->changePass();
	}
	else{
		echo "Error al acceder a la funcion";
	}

?>