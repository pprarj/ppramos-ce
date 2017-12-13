<?php
	class homeController extends controller {

		public function __construct() {
			parent::__construct();
			
			if (!isset($_SESSION['ppramos_ce']) && empty($_SESSION['ppramos_ce'])) {
				header('Location: ' . BASE_URL . '/login');
			}
		}

		public function index() {
			$dados = array();
			
			$user = new users();
			$user->setUser();

			$dados['user'] = $user->getUser();
			
			$this->loadTemplate('home', $dados);
		}
	}
?>