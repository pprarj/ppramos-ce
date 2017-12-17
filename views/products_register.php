<h1><span class="glyphicon glyphicon-barcode"></span> Código de barras <small>Buscar produtos / Cadastrar novos produtos</small></h1>
<div class="add_category">
	<a href="<?php echo BASE_URL; ?>/products/category_register" class="button"><span class="glyphicon glyphicon-plus"></span> Adicionar categoria</a>
</div>
<form id="form_add_product">
	<div class="add_product">
		<div class="form-group">
			<div class="row">
				<div class="col-md-2 col-sm-2">
					<label for="barcode">Código de barras</label>
					<input type="text" name="barcode" id="barcode" class="form-control" placeholder="Código de barras" autofocus>
				</div>
				<div class="col-md-2 col-sm-2">
					<p id="isRegistered"></p>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/products.js"></script>
<script type="text/template" id="product_info">
	<div class="product-info">
		<h4>{{PRODUCT_NAME}} ({{PACKING}})</h4><br>
		<strong>Marca:</strong> {{TRADEMARK}}<br>
		<strong>Quantidade em estoque:</strong> {{QUANTITY}}<br>
		<strong>Categoria:</strong> {{CATEGORY}}<br>
		<strong>Data da compra:</strong> {{PURCHASE_DATE}}<br>
		<strong>Validade:</strong> {{EXPIRATION_DATE}}
	</div>
</script>