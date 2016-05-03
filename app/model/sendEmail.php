<?php 
	require 'libs/PHPMailer/class.phpmailer.php';
	require 'libs/PHPMailer/class.smtp.php';
	date_default_timezone_set('America/Mexico_City'); 
	$conexion = new mysqli('localhost','root','qaz','grupoit');
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}

	//$receiver = $_POST['destino'];
	//$pass = $_POST['pass'];

	$mail = new PHPMailer();

	$infoJ = $_POST['info'];
	$info = json_decode($infoJ, false, 512, JSON_BIGINT_AS_STRING);
	$user = utf8_decode($info->user);
	$name_user = utf8_decode($info->name);
	$ap_user = utf8_decode($info->ap);
	$email = $info->email;
	//$pass = $info->pass;
	//$pass = 'default';
	$pass = randomString();
	$salt = "i!TIfHW2N";
	$rango = $info->type;
	$idUser = $info->idUser;

	$user = $conexion->real_escape_string($user);
	$name_user = $conexion->real_escape_string($name_user);
	$ap_user = $conexion->real_escape_string($ap_user);
	$email = $conexion->real_escape_string($email);
	$typeChange = "Guardar usuario";

	$passHash = password_hash($pass, PASSWORD_BCRYPT);

	$query1 = "SELECT user FROM users WHERE user = '$user'";
	$query2 = "SELECT email FROM users WHERE email = '$email'";

	$result1 = $conexion->query($query1);
	$result2 = $conexion->query($query2);

	if ($result1->num_rows > 0 || $result2->num_rows > 0) {
		echo "existe";
	}
	else{
		$query = "INSERT INTO users values(default, '$user', '$name_user', '$ap_user', '$passHash', '$email','$rango', '$salt', current_timestamp)";
		if ($conexion->query($query)) {
			if ($conexion->query("INSERT INTO changes values(default, '$typeChange', '$user', current_timestamp, '$idUser')")) {
				echo "cambioCorrecto";
				$mail->IsSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->SMTPDebug  = 0;
				$mail->Port = 465;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure="ssl";
				$mail->Username = 'gjrodriguez91@gmail.com';
				$mail->Password = 'MEMO12345';

				$mail->From = "gjrodriguez91@gmail.com";
				$mail->FromName = "Soporte Grupo IT";
				$mail->Subject = utf8_decode("Contraseña para página de servicio de Grupo IT");
				$mail->AddAddress($email);
				   
				//$mail->WordWrap = 50;
				$mail->IsHTML(true);
				   
				$body  = "Su usuario es: <b>".utf8_decode($user)."</b> <br>";
				$body .= utf8_decode("Su Contraseña es:  <b>").$pass."</b> <br>";
				$body .= "Vaya al siguente enlace <a href = '189.236.30.227/grupoit'>Servicios Grupo IT</a> Para acceder a la página de servicio";

				$mail->Body = $body;  

				if( !$mail->Send() ) {  
					echo "No se pudo enviar el Mensaje.";   
				}
				else {   
					echo "Mensaje enviado";
				}
			}
			else{
				echo "cambioIncorrecto";
			}
		}
		else{
			echo "incorrecto";
		}
    
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

 ?>