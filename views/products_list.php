<h1><span class="glyphicon glyphicon-shopping-cart"></span> Listar <small>Produtos em estoque</small></h1>
<div class="products-filter">
	<ul></ul>
	<p class="text-center"><button class='btn btn-primary' type='button' id='all' onclick='marcardesmarcar();'>Desmarcar todas</button></p>
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
					<th class="text-center">Marca</th>
					<th class="text-center">Embalagem</th>
					<th class="text-center">Quantidade em estoque</th>
					<th class="text-center mobile-no-display">Categoria</th>
					<th class="text-center mobile-no-display">Data da compra</th>
					<th class="text-center">Data de validade</th>
					<th class="text-center mobile-no-display">Código de barras</th>
					<th class="text-center">Preço</th>
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
		<script type="text/javascript">
			$(function() {
				$('#table_<?php echo $categories[$i]['id']; ?>').DataTable();
			});
		</script>
		<?php else: ?>
		<p class="no-products">Ainda não há produtos cadastrados nessa categoria!</p>
		<?php endif; ?>
	</div>
</div>
<?php endfor; ?>
<div class="container-fluid">
	<!-- The Modal -->
	<div class="modal fade" id="product_modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/products_list.js"></script>

<script type="text/template" id="categories">
	<li id="cat_{{CATEGORY_ID}}" class="products-filter-checked"><label class="checkbox-inline"><input type="checkbox" class="marcar" name="check[]" id="{{CATEGORY_ID}}" checked> {{CATEGORY_NAME}}</label></li>
</script>
<script type="text/template" id="product_table">
	<tr data-modal="true" id="{{BARCODE}}">
		<td>{{PRODUCT_NAME}}</td>
		<td class="text-center">{{TRADEMARK}}</td>
		<td class="text-center">{{PACKING}}</td>
		<td class="text-center">{{QUANTITY}}</td>
		<td class="text-center mobile-no-display">{{CATEGORY}}</td>
		<td class="text-center mobile-no-display">{{PURCHASE_DATE}}</td>
		<td class="text-center">{{EXPIRATION_DATE}}</td>
		<td class="text-center mobile-no-display">{{BARCODE}}</td>
		<td class="text-center">{{PRICE}}</td>
	</tr>
</script>
<script type="text/template" id="modal_product">
	<!-- Modal Header -->
	<div class="modal-header">
		<h4 class="modal-title">{{PRODUCT_NAME}} - {{TRADEMARK}} ({{PACKING}})</h4>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
	</div>

	<!-- Modal body -->
	<div class="modal-body">
		<form method="POST" id="product_update">
			<input type="hidden" name="barcode" value="{{BARCODE}}">
			<div class="form-group">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<label for="quantity">Alterar quantidade em estoque</label>
						<input type="text" name="quantity" id="quantity" value="{{QUANTITY}}" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<label for="expiration_date">Alterar data de validade</label>
						<input type="text" name="expiration_date" id="expiration_date" value="{{EXPIRATION_DATE}}" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<label for="price">Alterar preço da última compra</label>
						<input type="text" name="price" id="price" value="{{PRICE}}" class="form-control">
					</div>
				</div>
			</div>
		</form>
	</div>

	<!-- Modal footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-success" id="product_update_save">Salvar</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	</div>
</script>