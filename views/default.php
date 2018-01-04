<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ppramos - Controle de Estoque</title>
	<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/default.css">
	<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/glyphicons.css">
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/mustache.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/popper.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.maskedinput.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
	<script type="text/javascript">
		$.extend(true, $.fn.dataTable.defaults, {
			"ordering": false,
			"lengthChange": false
		});
	</script>
</head>

<body>
	<section id="top">
		<div class="top">
			<div class="menu-mobile">
				<img src="<?php echo BASE_URL; ?>/assets/images/menu.png">
				<div class="menu-dropdown">
					<?php include 'menu.php'; ?>
				</div>
			</div>
			<div class="login-info">
				Olá <?php echo $viewData['user']['name']; ?>! ( <a href="<?php echo BASE_URL; ?>/login/logout"><span class="glyphicon glyphicon-log-out"></span> Sair</a> )
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