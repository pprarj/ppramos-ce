<?php
	class productsController extends controller {

		public function __construct() {
			parent::__construct();
			
			if (!isset($_SESSION['ppramos_ce']) && empty($_SESSION['ppramos_ce'])) {
				header('Location: ' . BASE_URL . '/login');
			}
		}

		public function barcode() {
			$data = array();
			
			$user = new users();
			$user->setUser();

			$data['user'] = $user->getUser();
			
			$this->loadTemplate('products_barcode', $data);
		}
		
		public function roster() {
			$data = array();
			
			$user = new users();
			$user->setUser();
			
			$categories = new categories();
			$products = new products();
			$data['categories'] = $categories->getCategories();
			$data['user'] = $user->getUser();
			
			for ($i = 1; $i <= count($data['categories']); $i++) {
				$data['products'][$i] = $products->getProductsByCategory($i);
				$data['productsLength'][$i] = $products->getProductLength($i);
			}
			
			$this->loadTemplate('products_list', $data);
		}
		
		public function quick_reduction() {
			$data = array();
			
			$user = new users();
			$user->setUser();
			
			$data['user'] = $user->getUser();
			
			$this->loadTemplate('products_quick_reduction', $data);
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
		
		public function reduct($barcode) {
			header('Content-type: text/json; charset=utf-8');
			
			$result = array();
			
			$product = new products();
			$result = $product->reduct($barcode);
			
			echo json_encode($result);
		}

		public function update() {
			header('Content-type: text/json; charset=utf-8');

			$array = array();
			$result = array();

			if (isset($_POST)) {
				$array['quantity'] = addslashes($_POST['quantity']);
				$array['expiration_date'] = addslashes($_POST['expiration_date']);
				$array['price'] = addslashes($_POST['price']);
				$array['barcode'] = $_POST['barcode'];

				$products = new products();
				$result = $products->update($array);
			}

			echo json_encode($result);
		}
	}
?>