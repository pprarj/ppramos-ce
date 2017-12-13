<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>ppramos - Controle de Estoque</title>
	<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/default.css">
</head>

<body>
	<section id="top">
		<div class="top-line"></div>
		<div class="top">
			<div class="login-info">
				Olá <?php echo $viewData['user']['name']; ?>! ( <a href="<?php echo BASE_URL; ?>/login/logout"><span class="glyphicon glyphicon-log-in"></span> Sair</a> )
			</div>
		</div>
	</section>
	<section id="mid">
		<div class="main">
			<div class="menu"><?php include 'menu.php'; ?></div>
			<div class="content"><?php $this->loadViewInTemplate($viewName, $viewData); ?></div>
		</div>
	</section>
</body>
</html>