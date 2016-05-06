<?php 
	class controller{
		
		public function pageLogin(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/index.html");
				}
				elseif ($_SESSION['type']==2 && $_SESSION['status'] == 0) {
					include("app/views/pages/userPages/changePass.html");
				}
				elseif($_SESSION['type']==2 && $_SESSION['status'] == 1){
					include("app/views/pages/userPages/test.html");
				}
				else{
					include("app/views/pages/login.html");
					//header('Location: /grupoit/');
				}
			}
			else
				include("app/views/pages/login.html");
				//header('Location: /grupoit/');
		}

		public function main(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/index.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}
		public function userForm(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/adminPages/users.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function customer(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/adminPages/customer.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: /grupoit/');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function contacts(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/adminPages/contacts.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function changes(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/adminPages/changes.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function devices(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/adminPages/devices.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function sims(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/adminPages/sims.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}		

		public function tickets(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/adminPages/tickets.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function allForm(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/adminPages/allForm.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function test(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type']) && isset($_SESSION['status'])) {
				if ($_SESSION['type']==2 && $_SESSION['status'] == 0) {
					include("app/views/pages/userPages/changePass.html");
				}
				elseif ($_SESSION['type']==2 && $_SESSION['status'] == 1) {
					include("app/views/pages/userPages/test.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: ./');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function error(){
			header('Location: ./');
		}

	}

 ?>