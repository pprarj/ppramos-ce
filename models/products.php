<?php
	class products extends model {
		public function checkProduct($barcode) {
			$sql = $this->db->prepare("SELECT * FROM ppramos_ce_products WHERE barcode = :barcode");
			$sql->bindValue(":barcode", $barcode);
			$sql->execute();
			
			$array = array();
			if ($sql->rowCount() > 0) {
				$row = $sql->fetch(PDO::FETCH_ASSOC);
				
				$array['check'] = true;
				$array['product'] = $row;
			} else {
				$array['check'] = false;
			}
			
			return $array;
		}
		
		public function addProduct($product) {
			$sql = $this->db->prepare("INSERT INTO ppramos_ce_products SET product_name = :product_name, category = :category, quantity = :quantity, purchase_date = :purchase_date, expiration_date = :expiration_date, barcode = :barcode, trademark = :trademark, packing = :packing, price = :price");
			
			$sql->bindValue(":product_name", $product['product_name']);
			$sql->bindValue(":category", $product['category']);
			$sql->bindValue(":quantity", $product['quantity']);
			$sql->bindValue(":purchase_date", $product['purchase_date']);
			$sql->bindValue(":expiration_date", $product['expiration_date']);
			$sql->bindValue(":barcode", $product['barcode']);
			$sql->bindValue(":trademark", $product['trademark']);
			$sql->bindValue(":packing", $product['packing']);
			$sql->bindValue(":price", $product['price']);
			
			if ($sql->execute()) {
				$result = true;
			} else {
				$result = false;
			}
			
			return $result;
		}
		
		public function getProduct($barcode) {
			$sql = $this->db->prepare("SELECT ppramos_ce_products.*, ppramos_ce_categories.category_name FROM ppramos_ce_products LEFT JOIN ppramos_ce_categories ON ppramos_ce_products.category = ppramos_ce_categories.id WHERE barcode = :barcode");
			$sql->bindValue(":barcode", $barcode);
			$sql->execute();
			
			if ($sql->rowCount() > 0) {
				$row = $sql->fetch(PDO::FETCH_ASSOC);
				$row['purchase_date'] = $this->data_padrao_br_numero($row['purchase_date']);
				
				return $row;
			}
		}
		
		public function getProducts($category = "") {
			if ($category == "") {
				$sql = $this->db->prepare("SELECT ppramos_ce_products.*, ppramos_ce_categories.category_name FROM ppramos_ce_products LEFT JOIN ppramos_ce_categories ON ppramos_ce_products.category = ppramos_ce_categories.id ORDER BY ppramos_ce_products.product_name ASC");
				$sql->execute();
			} else {
				$sql = $this->db->prepare("SELECT ppramos_ce_products.*, ppramos_ce_categories.category_name FROM ppramos_ce_products LEFT JOIN ppramos_ce_categories ON ppramos_ce_products.category = ppramos_ce_categories.id WHERE ppramos_ce_products.category = :category ORDER BY ppramos_ce_products.product_name ASC");
				$sql->bindValue(":category", $category);
				$sql->execute();
			}
			
			$row = array();
			if ($sql->rowCount() > 0) {
				$row = $sql->fetchAll(PDO::FETCH_ASSOC);

				for ($i = 0; $i < count($row); $i++) {
					$row[$i]['purchase_date'] = $this->data_padrao_br_numero($row[$i]['purchase_date']);
				}
			}
			
			return $row;
		}

		public function getProductsByCategory($category) {
			$sql = $this->db->prepare("SELECT ppramos_ce_products.*, ppramos_ce_categories.category_name FROM ppramos_ce_products LEFT JOIN ppramos_ce_categories ON ppramos_ce_products.category = ppramos_ce_categories.id WHERE ppramos_ce_products.category = :category");
			$sql->bindValue(":category", $category);
			$sql->execute();

			$row = array();
			if ($sql->rowCount() > 0) {
				$row = $sql->fetchAll(PDO::FETCH_ASSOC);

				for ($i = 0; $i < count($row); $i++) {
					$row[$i]['purchase_date'] = $this->data_padrao_br_numero($row[$i]['purchase_date']);
				}
			}

			return $row;
		}
		
		public function getProductLength($id) {
			$sql = $this->db->prepare("SELECT COUNT(*) as c FROM ppramos_ce_products WHERE category = :category");
			$sql->bindValue(":category", $id);
			$sql->execute();
			
			$array = array();
			if ($sql->rowCount() > 0) {
				$array = $sql->fetch();
			}
			
			return $array['c'];
		}
		
		public function reduct($barcode) {
			$product_bc = $this->getProduct($barcode);
			$quantity_bc = $product_bc['quantity'];
			$quantity = explode(" ", $product_bc['quantity']);
			
			if ($quantity[0] > 0) {
				$quantity_ac = intval($quantity[0] - 1);
				
				if($quantity_ac == 1 && substr($quantity[1], -1) == "s") {
					$quantity_ac .= " " . substr($quantity[1], 0, -1);
				} elseif ($quantity_ac == 0 && substr($quantity[1], -1) != "s") {
					$quantity_ac .= " " . $quantity[1] . "s";
				} else {
					$quantity_ac .= " " . $quantity[1];
				}
			} else if ($quantity[0] == 0) {
				$quantity_ac = 0 . " " . $quantity[1];
			}
			
			$sql = $this->db->prepare("UPDATE ppramos_ce_products SET quantity = :quantity WHERE barcode = :barcode");
			$sql->bindValue(':quantity', $quantity_ac);
			$sql->bindValue(':barcode', $barcode);
			
			if ($sql->execute()) {
				$result = $this->getProduct($barcode);
				$result['quantity_bc'] = $quantity_bc;
				$result['verify'] = true;
			} else {
				$result['verify'] = false;
			}
			
			return $result;
		}

		public function update($data) {
			$product = $this->getProduct($data['barcode']);

			if ($product['quantity'] == 0) {
				$sql = $this->db->prepare("UPDATE ppramos_ce_products SET quantity = :quantity, purchase_date = :purchase_date, expiration_date = :expiration_date, price = :price WHERE barcode = :barcode");
				$sql->bindValue(":purchase_date", date('Y-m-d H:i:s'));
			} else {
				$sql = $this->db->prepare("UPDATE ppramos_ce_products SET quantity = :quantity, expiration_date = :expiration_date, price = :price WHERE barcode = :barcode");
			}

			$sql->bindValue(":quantity", $data['quantity']);
			$sql->bindValue(":expiration_date", $data['expiration_date']);
			$sql->bindValue(":price", $data['price']);
			$sql->bindValue(":barcode", $data['barcode']);

			if ($sql->execute()) {
				return true;
			} else {
				return false;
			}
		}
		
		private function data_padrao_br_numero($data) {
			$nd = explode('-', $data);
			$hora = explode(' ', $nd[2]);
			$data = $hora[0].'/'.$nd[1].'/'.$nd[0];
			
			return $data;
		}
	}
?>