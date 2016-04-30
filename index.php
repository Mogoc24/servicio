<?php 
	require "app/controller/controller.php";
	$mvc = new controller();

	if (empty($_GET['action'])) {	
		$_GET['action'] = "login";
	}

	if ($_GET["action"]=="login") {
		$mvc->pageLogin();
	}

	elseif($_GET['action']=="main"){
		$mvc->main();
	}
	elseif($_GET['action']=="userForm"){
		$mvc->userForm();
	}
	elseif($_GET['action']=="customer"){
		$mvc->customer();
	}
	elseif($_GET['action']=="contacts"){
		$mvc->contacts();
	}
	elseif($_GET['action']=="changes"){
		$mvc->changes();
	}
	elseif($_GET['action']=="tickets"){
		$mvc->tickets();
	}
	elseif($_GET['action']=="test"){
		$mvc->test();
	}
	else{
		$mvc->error();
	}

 ?>