<?php
	class mobileController extends controller {

		public function __construct() {
			parent::__construct();
        }
        
        public function user_info($id = "") {
            header('Content-type: application/json; charset=utf-8');

            $result = array();
			$users = new users();
			
			$method = $_SERVER['REQUEST_METHOD'];
			
			switch ($method) {
				case 'POST':
					$data = json_decode(file_get_contents('php://input'));

					$user = addslashes($data->user);
					$pass = addslashes($data->pass);

					$result = $users->verifyUserFromMobile($user, $pass);
					break;
				case 'GET':
					$result = $users->isLogged($id);
					break;
				case "LOGOUT":
					$result = $users->logout($id);
					break;
			}

            echo json_encode($result);
        }
		
		public function barcode($barcode) {
			header('Content-type: application/json; charset=utf-8');
			
			$result = array();
			$product = new products();
			
			$method = $_SERVER['REQUEST_METHOD'];
			
			if ($method == 'GET') {
				$result = $product->getProduct($barcode);
			} elseif ($method == 'DELETE') {
				
			}
			
			echo json_encode($result);
		}
	}
?>