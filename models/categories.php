<?php
	class categories extends model {
		public function getCategories() {
			$sql = $this->db->prepare("SELECT * FROM categories");
			$sql->execute();
			
			$array = array();
			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll();
			}
			
			return $array;
		}
	}
?>