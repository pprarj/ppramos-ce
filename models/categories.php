<?php
	class categories extends model {
		public function getCategories() {
			$sql = $this->db->prepare("SELECT * FROM ppramos_ce_categories");
			$sql->execute();
			
			$array = array();
			if ($sql->rowCount() > 0) {
				$array = $sql->fetchAll(PDO::FETCH_ASSOC);
			}
			
			return $array;
		}
	}
?>