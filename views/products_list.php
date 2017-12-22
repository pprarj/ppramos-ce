<h1><span class="glyphicon glyphicon-shopping-cart"></span> Listar <small>Produtos em estoque</small></h1>
<div class="products-filter">
	<ul></ul>
</div>
<?php for ($i = 0; $i < count($categories); $i++): ?>
<div class="card" id="panel_<?php echo $categories[$i]['id']; ?>">
	<div class="card-header bg-dark text-white"><a href="#card_<?php echo $categories[$i]['id']; ?>" data-toggle="collapse" data-parent="#panel_<?php echo $categories[$i]['id']; ?>"><h4 class="card-title"><span class="glyphicon glyphicon-minus" id="toggle_<?php echo $categories[$i]['id']; ?>"></span> <?php echo $categories[$i]['category_name']; ?></h4></a></div>
	<div class="card-body collapse show" id="card_<?php echo $categories[$i]['id']; ?>">
		<?php if ($productsLength[$categories[$i]['id']] != 0): ?>
		<table class="table table-sm" id="table_<?php echo $categories[$i]['id']; ?>">
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
			<tbody id="product_list_<?php echo $categories[$i]['id']; ?>">
			<script type="text/javascript">
				$(function() {
					productsList(<?php echo $categories[$i]['id']; ?>);
				});
			</script>
			</tbody>
		</table>
		<?php else: ?>
		<p class="no-products">Ainda não há produtos cadastrados nessa categoria!</p>
		<?php endif; ?>
	</div>
</div>
<?php endfor; ?>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/products_list.js"></script>

<script type="text/template" id="categories">
	<li id="cat_{{CATEGORY_ID}}" class="products-filter-checked"><label class="checkbox-inline"><input type="checkbox" id="{{CATEGORY_ID}}" checked> {{CATEGORY_NAME}}</label></li>
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