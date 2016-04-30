<?php 
	class controller{
		
		public function pageLogin(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==1) {
					include("app/views/pages/index.html");
				}
				elseif ($_SESSION['type']==2) {
					include("app/views/pages/userPages/test.html");
				}
				else{
					//include("app/views/pages/login.html");
					header('Location: /grupoit/');
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
					header('Location: /grupoit/');
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
					header('Location: /grupoit/');
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
					header('Location: /grupoit/');
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
					header('Location: /grupoit/');
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
					header('Location: /grupoit/');
				}
			}
			else{
				include("app/views/pages/login.html");
			}
		}

		public function test(){
			session_start();
			if (isset($_SESSION["connected"]) && isset($_SESSION['type'])) {
				if ($_SESSION['type']==2) {
					include("app/views/pages/userPages/test.html");
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

		public function error(){
			header('Location: /grupoit/');
		}

	}

 ?>