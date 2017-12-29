<?php
	class users extends model {
		public $user_info;

		public function doLogin($name, $pass) {
			$sql = $this->db->prepare("SELECT * FROM users WHERE name = :name");
			$sql->bindValue(":name", $name);
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

		public function setUser() {
			$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
			$sql->bindValue(":id", $_SESSION['ppramos_ce']);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$this->user_info = $sql->fetch();
			}
		}

		public function getUser() {
			return $this->user_info;
		}

		public function verifyUserFromMobile($user, $pass) {
			$sql = $this->db->prepare("SELECT * FROM users WHERE name = :name");
			$sql->bindValue(":name", $user);
			$sql->execute();

			$result = array();
			if ($sql->rowCount() > 0) {
				if (password_verify($pass, $row['password'])) {
					$result['login'] = true;
					$result['message'] = "";
				} else {
					$result['login'] = false;
					$result['message'] = "Senha inválida!";
				}
			} else {
				$result['login'] = false;
				$result['message'] = "Usuário inválido!";
			}

			return $result;
		}
	}
?>