<?php
	class users extends model {
		public function doLogin($email, $pass) {
			$sql = $this->db->prepare("SELECT * FROM users WHERE name = :name");
			$sql->bindValue(":name", $email);
			$sql->execute();
			
			$array = array();
			if ($sql->rowCount() > 0) {
				$row = $sql->fetch();
				
				if (password_verify($pass, $row['password'])) {
					$_SESSION['ppramos_ce'] = $row['id'];
					
					$array['check'] = true;
				} else {
					$array['check'] = false;
					$array['error'] = "Senha inválida!";
				}
			} else {
				$array['check'] = false;
				$array['error'] = "Nome inválido!";
			}
			
			return $array;
		}
	}
?>