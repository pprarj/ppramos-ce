<?php
	class loginController extends controller {

		public function __construct() {
			parent::__construct();
			
			if (isset($_SESSION['ppramos_ce']) && !empty($_SESSION['ppramos_ce'])) {
				header('Location: ' . BASE_URL);
			}
		}

		public function index() {
			$dados = array();
			
			$this->loadView('login', $dados);
		}
		
		public function logout() {
			unset($_SESSION['ppramos_ce']);
			header("Location: ".BASE_URL);
		}
		
		public function login() {
			header('Content-type: text/json; charset=utf-8');
			
			if (isset($_POST)) {
				$name = addslashes($_POST['name']);
				$pass = addslashes($_POST['password']);
				
				if (!empty($name) || !empty($pass)) {
					$user = new users();
					$login = $user->doLogin($name, $pass);

					if ($login['check']) {
						$return['type'] = true;
						echo json_encode($return);
					} else {
						$return['type'] = false;
						$return['message'] = $login['error'];
						echo json_encode($return);
					}
				} else {
					$return['type'] = false;
					$return['message'] = 'Por favor, preencha todos os campos acima!';
					echo json_encode($return);
				}
			}
		}
	}
?>