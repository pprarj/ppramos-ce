<?php
	class mobileController extends controller {

		public function __construct() {
			parent::__construct();
			
			if (!isset($_SESSION['ppramos_ce']) && empty($_SESSION['ppramos_ce'])) {
				header('Location: ' . BASE_URL . '/login');
			}
        }
        
        public function user_info() {
            header('Content-type: text/json; charset=utf-8');

            $result = array();
            
            if ($_POST) {
                $users = new users();

                $user = addslashes($_POST['user']);
                $pass = addslashes($_POST['pass']);

                $result = $users->verifyUserFromMobile($user, $pass);
            }

            echo json_encode($result);
        }
	}
?>