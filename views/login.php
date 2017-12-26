<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>ppramos - Controle de Estoque :: Login</title>
	<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/login.css">
</head>

<body>
	<div class="login">
		<form method="post" id="login-form">
			<div class="form-group">
				<label for="name">Nome</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="Digite o nome" required>
			</div>
			<div class="form-group">
				<label for="password">Senha</label>
				<input type="password" name="password" id="password" class="form-control" placeholder="Digite a senha" required>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-default">Entrar</button>
			</div>
		</form>
		<div id="warning" class="alert alert-danger"></div>
	</div>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		/* ============ LOGIN APP ============ */

		$(function () {
			$('#login-form').submit(function(e) {
				e.preventDefault();
				
				var name = $('input[name=name]').val();
				var password = $('input[name=password]').val();

				// Início do controle de ambiente
				var url = window.location.href;
				var explode = url.split('/');

				if (explode[2] == 'localhost') {
					var link = 'http://localhost/ppramos-ce';
				} else {
					var link = explode[0] + '//' + explode[2] + '/ppramos-ce';
				}
				// Fim do controle de ambiente

				$.ajax({
					type: 'POST',
					url: 'login/login',
					data: {name: name, password: password},
					dataType: 'json',
					success: function(response) {
						if (response.type == true) {
							window.location.href = link;
						} else {
							$('#warning').css('display', 'block')
							.html('<p>' + response.message + '</p>');
						}
					}
				});
			});
		});
	</script>
</body>
</html>