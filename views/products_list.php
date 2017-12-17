<h1><span class="glyphicon glyphicon-shopping-cart"></span> Listar <small>Produtos em estoque</small></h1>
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Marca</th>
			<th>Embalagem</th>
			<th>Quantidade em estoque</th>
			<th>Categoria</th>
			<th>Data da compra</th>
			<th>Data de validade</th>
			<th>Código de barras</th>
			<th>Preço</th>
		</tr>
	</thead>
	<tbody id="product_list">
	</tbody>
</table>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/products_list.js"></script>
<script type="text/template" id="categories_menu">
	<ul class="menu-categories">
		<li>{{CATEGORY_NAME}}</li>
	</ul>
</script>
<script type="text/template" id="product_table">
	<tr>
		<td>{{PRODUCT_NAME}}</td>
		<td>{{TRADEMARK}}</td>
		<td>{{PACKING}}</td>
		<td>{{QUANTITY}}</td>
		<td>{{CATEGORY}}</td>
		<td>{{PURCHASE_DATE}}</td>
		<td>{{EXPIRATION_DATE}}</td>
		<td>{{BARCODE}}</td>
		<td>{{PRICE}}</td>
	</tr>
</script>