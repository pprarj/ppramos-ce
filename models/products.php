<?php
	class products extends model {
		public function checkProduct($barcode) {
			$sql = $this->db->prepare("SELECT * FROM products WHERE barcode = :barcode");
			$sql->bindValue(":barcode", $barcode);
			$sql->execute();
			
			$array = array();
			if ($sql->rowCount() > 0) {
				$row = $sql->fetch();
				
				$array['check'] = true;
				$array['product'] = $row[0];
			} else {
				$array['check'] = false;
			}
			
			return $array;
		}
		
		public function addProduct($product) {
			$sql = $this->db->prepare("INSERT INTO products SET product_name = :product_name, category = :category, quantity = :quantity, purchase_date = :purchase_date, expiration_date = :expiration_date, barcode = :barcode, observations = :observations");
			
			$sql->bindValue(":product_name", $product['product_name']);
			$sql->bindValue(":category", $product['category']);
			$sql->bindValue(":quantity", $product['quantity']);
			$sql->bindValue(":purchase_date", $product['purchase_date']);
			$sql->bindValue(":expiration_date", $product['expiration_date']);
			$sql->bindValue(":barcode", $product['barcode']);
			$sql->bindValue(":observations", $product['obs']);
			
			if ($sql->execute()) {
				$result = true;
			} else {
				$result = false;
			}
			
			return $result;
		}
		
		public function getProduct($barcode) {
			$sql = $this->db->prepare("SELECT * FROM products WHERE barcode = :barcode");
			$sql->bindValue(":barcode", $barcode);
			$sql->execute();
			
			if ($sql->rowCount() > 0) {
				$row = $sql->fetch();
				$row['purchase_date'] = $this->data_padrao_br_numero($row['purchase_date']);
				
				return $row;
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