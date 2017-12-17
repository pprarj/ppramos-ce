$(function () {
	var added = false;
	
	$('#barcode').blur(function () {
		var barcode = $('#barcode').val();
		
		if (barcode != '') {
			$.ajax({
				type: 'POST',
				url: 'check_product/' + barcode,
				dataType: 'json',
				success: function (response) {
					if (response.check == true) {
						if (added == false) {
							getProduct(barcode);
							added = true;
						}
					} else {
						if (added == false) {
							productRegister(barcode);
							added = true;
						}
					}
				}
			});
		}
	});
	
	$('#form_add_product').on('submit', function(event) {
		event.preventDefault();
		
		var product = $('#form_add_product').serialize();
		
		$.ajax({
			type: 'POST',
			url: 'add',
			data: product,
			success: function(response) {
				if (response) {
					$('#isRegistered')
						.empty()
						.append('Produto cadastrado com sucesso!')
						.addClass('registered');
					$('.add_product').css('background-color', '#dff0d8');
				}
			}
		});
	});
});

function getCategories() {
	$.ajax({
		type: 'GET',
		url: 'get_categories',
		dataType: 'json',
		success: function (response) {
			var option = $("<option>", {
				'value': '',
				'text': 'Escolha uma categoria:',
				'selected': 'selected'
			});
			
			$.each(response, function(key, value) {
				var categoriesOptions = $("<option>", {
					'value': value.id,
					'text': value.category_name
				});
				
				$('#category').append(categoriesOptions);
			});
			
			$('#category').prepend(option);
		}
	});
}

function getProduct(barcode) {
	$.ajax({
		type: 'GET',
		url: 'get_product/' + barcode,
		dataType: 'json',
		success: function(data) {
			var product = [];
			
			product.push({
				ID: data.id,
				PRODUCT_NAME: data.product_name,
				QUANTITY: data.quantity,
				CATEGORY: data.category_name,
				PURCHASE_DATE: data.purchase_date,
				EXPIRATION_DATE: data.expiration_date,
				TRADEMARK: data.trademark,
				PACKING: data.packing,
				PRICE: data.price
			});
			
			var template = $('#product_info').html();
			var html = Mustache.render(template, product[0]);
			$('.add_product').append(html);
		}
	});
}

function productRegister(barcode) {
	var date = new Date();
	
	$('#isRegistered').append('Produto não cadastrado.');
	$('.add_product').append('<div class="form-group">'+
    '<div class="row">'+
        '<div class="col-md-6 col-sm-6">'+
            '<label for="product_name">Nome do produto</label>'+
            '<input type="text" name="product_name" id="pruduct_name" class="form-control" placeholder="Nome do produto" required>'+
        '</div>'+
        '<div class="col-md-6 col-sm-6">'+
            '<label for="category">Categoria</label>'+
            '<select name="category" id="category" class="form-control" required>'+
			getCategories() +
            '</select>'+
        '</div>'+
    '</div>'+
'</div>'+
'<div class="form-group">'+
    '<div class="row">'+
        '<div class="col-md-4 col-sm-4">'+
            '<label for="stock_quantity">Quantidade em estoque</label>'+
            '<input type="text" name="stock_quantity" id="stock_quantity" class="form-control" placeholder="Exemplo: 3 pacotes" required>'+
        '</div>'+
        '<div class="col-md-4 col-sm-4">'+
            '<label for="purchase_date">Data da compra</label>'+
            '<input type="text" name="purchase_date" id="purchase_date" class="form-control" value="'+ date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() +'" readonly>'+
        '</div>'+
		 '<div class="col-md-4 col-sm-4">'+
            '<label for="expiration_date">Data de validade</label>'+
            '<input type="text" name="expiration_date" id="expiration_date" class="form-control" maxlength="7" required>'+
        '</div>'+
    '</div>'+
'</div>'+
'<div class="form-group">'+
	'<div class="row">'+
		'<div class="col-md-6 col-sm-6">'+
			'<label for="trademark">Marca do produto</label>'+
			'<input type="text" name="trademark" id="trademark" class="form-control">'+
		'</div>'+
		'<div class="col-md-6 col-sm-6">'+
			'<label for="packing">Embalagem</label>'+
			'<input type="text" name="packing" id="packing" class="form-control">'+
		'</div>'+
	'</div>'+
'</div>'+
'<div class="form-group">'+
	'<div class="row">'+
		'<div class="col-md-6 col-sm-6">'+
			'<label for="price">Preço</label>'+
			'<input type="text" name="price" id="price" class="form-control">'+
		'</div>'+
	'</div>'+
'</div>'+
'<div class="form-group">'+
    '<div class="row">'+
        '<div class="col-md-2 col-sm-2">'+
            '<button type="submit" class="btn btn-default">Cadastrar produto</button>'+
        '</div>'+
    '</div>'+
'</div>');
	$('#isRegistered').addClass('not-registered');
	$('.add_product').css('background-color', '#e4b9c0');
	$('#expiration_date').mask('99/9999');
}