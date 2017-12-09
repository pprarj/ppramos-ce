<?php
	class core {
		public function run() {
			global $config;
			$url = $_SERVER['REQUEST_URI'];
			
			$params = array();
			if (!empty($url)) {
				if (strpos($url, 'index.php') === false) {
					$url = explode('/', $url);
					/* *******************************************************************************************************************
					** Se o sistema estiver sendo rodado em localhost, entrará no if, caso contrário, irá para o else.
					** Caso haja muitas pastas onde o sistema estiver alocado, para cada pasta deverá ser adicionado dois array_shift
					** Exemplo:
					** public_html/raiz -> 1 array_shift
					** public_html/raiz/pasta1 -> 3 array_shift
					** public_html/raiz/pasta1/pasta2 -> 5 array_shift
					**********************************************************************************************************************
					** O padrão possui 3 pois supõe-se que irá ser alocado em public_html/raiz(do servidor da ka1t)/pasta_do_sistema
					** Deverá ser alterado corretamente caso seja para um servidor externo
					** ******************************************************************************************************************/
					if ($config['environment'] == 'development') {
						array_shift($url);
						array_shift($url);
					} else {
						array_shift($url);
						array_shift($url);
						array_shift($url);
					}
				} else {
					$url = explode('index.php', $url);
					array_shift($url);
					$url = explode('/', $url[0]);
					array_shift($url);
				}
				
				if (!empty($url[0])) {
					// Cria um array com as páginas contidas no menu principal do site (para não ter que criar um controller para cada página)
					$controllers = array();
					
					// Verifica se na url digitada contém alguma das páginas do menu principal. Caso tenha, então ele automaticamente puxará a action ao invés do controller, evitando assim precisar ter que criar um controller para cada página do menu
					if (in_array($url[0], $controllers)){
						$currentController = 'homeController';
					} else {
						$currentController = $url[0].'Controller';
						array_shift($url);
					}
				} else {
					$currentController = 'homeController';
				}
				
				// Verifica se o controller solicitado existe. Senão existir, redireciona para o controller de Erro
				if (!file_exists('controllers/'.$currentController.'.php')) {
					$currentController = 'erroController';
				}
				
				if (!empty($url[0])) {
					$currentAction = $url[0];
					array_shift($url);
				} else {
					$currentAction = 'index';
				}
				
				// Verifica se o método solicitado existe. Senão existir, redireciona para o controller de Erro
				if (!method_exists($currentController, $currentAction)) {
					$currentController = 'erroController';
					$currentAction = 'index';
				}
				
				if (count($url) > 0) {
					$params = $url;
				}
			} else {
				$currentController = 'homeController';
				$currentAction = 'index';
			}
			
			$c = new $currentController();
			call_user_func_array(array($c, $currentAction), $params);
		}
	}
?>