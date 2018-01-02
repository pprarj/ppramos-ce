<?php
	class users extends model {
		private $user_info;

		public function doLogin($name, $pass) {
			$sql = $this->db->prepare("SELECT * FROM ppramos_ce_users WHERE name = :name");
			$sql->bindValue(":name", $name);
			$sql->execute();
			
			$array = array();
			if ($sql->rowCount() > 0) {
				$row = $sql->fetch(PDO::FETCH_ASSOC);
				
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
			$sql = $this->db->prepare("SELECT * FROM ppramos_ce_users WHERE id = :id");
			$sql->bindValue(":id", $_SESSION['ppramos_ce']);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$this->user_info = $sql->fetch(PDO::FETCH_ASSOC);
			}
		}

		public function getUser() {
			return $this->user_info;
		}
		
		public function isLogged($id) {
			$sql = $this->db->prepare("SELECT islogged FROM ppramos_ce_users WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();
			
			$result = array();
			if ($sql->rowCount() > 0) {
				$result = $sql->fetch(PDO::FETCH_ASSOC);
			}
			
			return $result;
		}
		
		private function login($user) {
			$sql = $this->db->prepare("UPDATE ppramos_ce_users SET islogged = :islogged WHERE name = :name");
			$sql->bindValue(":islogged", 1);
			$sql->bindValue(":name", $user);
			$sql->execute();
		}
		
		public function logout($id) {
			$sql = $this->db->prepare("UPDATE ppramos_ce_users SET islogged = :islogged WHERE id = :id");
			$sql->bindValue(":islogged", 0);
			$sql->bindValue(":id", $id);
			$sql->execute();
		}

		public function verifyUserFromMobile($user, $pass) {
			$sql = $this->db->prepare("SELECT * FROM ppramos_ce_users WHERE name = :name");
			$sql->bindValue(":name", $user);
			$sql->execute();

			$result = array();
			if ($sql->rowCount() > 0) {
				$row = $sql->fetch(PDO::FETCH_ASSOC);
				
				if (password_verify($pass, $row['password'])) {
					$result['login'] = true;
					$result['message'] = "";
					$result['user_id'] = $row['id'];
					
					$this->login($user);
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