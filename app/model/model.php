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
		
		function createFolio(){//$type){
			$type = "OS";
			$str = $type;
			$query = $this->mysqli->query("SELECT * FROM folios ORDER BY idfolios DESC LIMIT 1");
			if ($query->num_rows > 0) {
				while ($row = $query->fetch_array()) {
					$numero = $row['idfolios'] + 1;
					$cadena = str_pad($numero,6,"0",STR_PAD_LEFT);
					$folio = $str.$cadena;
				}
			}
			else{
					$numero = 1;
					$cadena = str_pad($numero,6,"0",STR_PAD_LEFT);
					$folio = $str.$cadena;
			}

			return $folio;
			//echo $folio;
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
			//print_r($info);

			$id = $info->idUser;
			$name_customer = utf8_decode($info->name);
			$platforms = $info->platforms;
			$email = $info->email;
			$tel = $info->tel;
			$address = $info->address;
			$idUser = $info->idUser;
			$type = $info->type;

			$id = $this->mysqli->real_escape_string($id);
			$name_customer = $this->mysqli->real_escape_string($name_customer);
			$tel = $this->mysqli->real_escape_string($tel);
			$address = $this->mysqli->real_escape_string($address);
			$type = $this->mysqli->real_escape_string($type);

			if ($type != 1) {
				if ($this->mysqli->query("INSERT INTO customers values ('$id', '$name_customer', '$tel', '$address', '$email', '$type')")) {
					echo "correcto";
				}
				else {
					echo "incorrecto";
				}
			}
			else{
				if ($this->mysqli->query("INSERT INTO customers values ('$id', '$name_customer', '$tel', '$address', '$email', '$type')")) {
					//echo "Se registro al cliente";
					$idCustomer = $this->mysqli->insert_id;
					for ($i=0; $i < count($platforms); $i++) { 
						//echo $platforms[$i];
						if ($this->mysqli->query("INSERT INTO customer_platform values('$idCustomer', '$platforms[$i]')")) {
							echo "correcto";
						}
						else{
							echo "incorrecto";
						}
					}
				}
				else{
					echo "existe";
				}
			}
		}

		public function saveContact(){
			$infoJ = $_POST['info'];
			$info = json_decode($infoJ, false, 512, JSON_BIGINT_AS_STRING);
			print_r($info);
			$idUser = $info->idUser;
			$idCustomers = $info->id;
			$email = $info->email;
			$tel = $info->tel;
			$type = utf8_decode($info->type);
			$name = utf8_decode($info->name);

			$idUser = $this->mysqli->real_escape_string($idUser);
			$idCustomer = $this->mysqli->real_escape_string($idCustomers);
			$email = $this->mysqli->real_escape_string($email);
			$tel = $this->mysqli->real_escape_string($tel);
			$name = $this->mysqli->real_escape_string($name);
			$type = $this->mysqli->real_escape_string($type);

			if ($this->mysqli->query("INSERT INTO contacts values(default, '$name', '$tel', '$email', '$type', '$idCustomer')")) {
				echo "correcto";
			}
			else{
				echo "incorrecto";
			}

		}

		public function saveTicket(){
			$infoJ = $_POST['info'];
			$info = json_decode($infoJ, false, 512, JSON_BIGINT_AS_STRING);
			//print_r($info);

			$idUser = $info->idUser;
			$idCustomer = $info->customer;
			$problemDate = $info->problemDate;
			$serviceType = $info->serviceType;
			$desc = utf8_decode($info->desc);

			$idUser = $this->mysqli->real_escape_string($idUser);
			$customer = $this->mysqli->real_escape_string($idCustomer);
			$problemDate = $this->mysqli->real_escape_string($problemDate);
			$serviceType = $this->mysqli->real_escape_string($serviceType);
			$desc = $this->mysqli->real_escape_string($desc);
			$typeChange = "Abierto";

			$folio = $this->createFolio();

			if ($this->mysqli->query("INSERT INTO folios values(default, '$folio')")) {
				echo "Se ingreso el folio";
				$idFolio = $this->mysqli->insert_id;
				if ($this->mysqli->query("INSERT INTO tickets values(default, '$desc', '$problemDate', current_timestamp, '$idCustomer', '$idFolio', '$serviceType')")) {
					echo "Se guardo el ticket";
					$idTicket = $this->mysqli->insert_id;
					if ($this->mysqli->query("INSERT INTO change_tickets values(default, '$folio', '$typeChange', current_timestamp,'$idTicket')")) {
						echo "correcto";
					}
					else{
						echo "incorrecto";
					}
				}
			}
			else{
				echo "No se ingreso el folio";
			}

		}

		public function allCustomers(){
			$query = $this->mysqli->query("SELECT * FROM customers");
			$output = '{"infoCustomers":[';
			while ($row = $query->fetch_array()) {
				if ($output != '{"infoCustomers":[') {$output .= ",";}
				$output .= '{"id":'.$row['idcustomers'].',';
				$output .= '"name":"'.utf8_encode($row['name_customer']).'",';
				$output .= '"tel":'.$row['number'].',';
				$output .= '"address":"'.utf8_encode($row['address']).'",';
				$output .= '"email":"'.$row['email'].'",';
				if ($row['type']==1) {
					$output .= '"type":"GPS"}';	
				}
				elseif ($row['type'] == 2) {
					$output .= '"type":"Internet Satelital"}';
				}
				elseif ($row['type'] == 3) {
					$output .= '"type":"Cámaras"}';
				}
				
			}
			$output .= "]}";
			echo $output;
		}

		public function allContacts(){
			$query = $this->mysqli->query("SELECT c.name_customer, cc.name_contact, cc.tel, cc.email, cc.type FROM contacts as cc INNER JOIN customers as c on c.idcustomers = cc.customers_idcustomers");
			$output = '{"infoContacts":[';
			while ($row = $query->fetch_array()) {
				if ($output != '{"infoContacts":[') {$output .= ",";}
				//$output .= '{"id":'.$row['idcustomers'].',';
				$output .= '{"name":"'.utf8_encode($row['name_customer']).'",';
				$output .= '"nameContact":"'.utf8_encode($row['name_contact']).'",';
				$output .= '"tel":"'.$row['tel'].'",';
				$output .= '"email":"'.$row['email'].'",';
				$output .= '"type":"'.utf8_encode($row['type']).'"}';
				
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
	elseif ($_POST['type']=="saveContact") {
		$instance->saveContact();
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
	elseif ($_POST['type']=="allCustomers") {
		$instance->allCustomers();
	}
	elseif ($_POST['type']=="allContacts") {
		$instance->allContacts();
	}
	elseif ($_POST['type']=="changePass") {
		$instance->changePass();
	}
	elseif ($_POST['type']=="folio") {
		$instance->createFolio();
	}
	else{
		echo "Error al acceder a la funcion";
	}

?>