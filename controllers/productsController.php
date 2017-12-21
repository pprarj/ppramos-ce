<?php
	class productsController extends controller {

		public function __construct() {
			parent::__construct();
			
			if (!isset($_SESSION['ppramos_ce']) && empty($_SESSION['ppramos_ce'])) {
				header('Location: ' . BASE_URL . '/login');
			}
		}

		public function register() {
			$data = array();
			
			$user = new users();
			$user->setUser();

			$data['user'] = $user->getUser();
			
			$this->loadTemplate('products_register', $data);
		}
		
		public function roster() {
			$data = array();
			
			$user = new users();
			$user->setUser();
			
			$categories = new categories();
			$data['categories'] = $categories->getCategories();
			$data['user'] = $user->getUser();
			
			$this->loadTemplate('products_list', $data);
		}
		
		public function add() {
			header('Content-type: text/json; charset=utf-8');
			
			$array = array();
			$return = array();
			if (isset($_POST)) {
				$array['product_name'] = addslashes($_POST['product_name']);
				$array['category'] = $_POST['category'];
				$array['quantity'] = addslashes($_POST['stock_quantity']);
				$array['barcode'] = addslashes($_POST['barcode']);
				$array['purchase_date'] = date('Y-m-d H:i:s');
				$array['expiration_date'] = addslashes($_POST['expiration_date']);
				$array['trademark'] = addslashes($_POST['trademark']);
				$array['packing'] = addslashes($_POST['packing']);
				$array['price'] = addslashes($_POST['price']);
				
				$product = new products();
				$return = $product->addProduct($array);
				
				echo json_encode($return);
			}
		}
		
		public function check_product($barcode) {
			header('Content-type: text/json; charset=utf-8');
			
			if (isset($_POST)) {
				$return = array();
			
				$product = new products();
				$return = $product->checkProduct($barcode);

				echo json_encode($return);
			}
		}
		
		public function get_categories() {
			header('Content-type: text/json; charset=utf-8');
			
			$return = array();
			
			$categories = new categories();
			$return = $categories->getCategories();
			
			echo json_encode($return);
		}
		
		public function get_product($barcode) {
			header('Content-type: text/json; charset=utf-8');
			
			$return = array();
			
			$product = new products();
			$return = $product->getProduct($barcode);
			
			echo json_encode($return);
		}
		
		public function get_products($category = "") {
			header('Content-type: text/json; charset=utf-8');
			
			$return = array();
			
			$product = new products();
			
			if ($category == "") {
				$return = $product->getProducts();
			} else {
				$return = $product->getProducts($category);
			}
			
			echo json_encode($return);
		}
	}
?>