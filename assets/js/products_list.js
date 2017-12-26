$(function() {
	getCategories();
});

function getCategories() {
	$.ajax({
		type: 'GET',
		url: 'get_categories',
		dataType: 'json',
		success: function (data) {
			var categories = [];
			
			for (i = 0; i < data.length; i++) {
				categories.push({
					CATEGORY_ID: data[i].id,
					CATEGORY_NAME: data[i].category_name
				});
				
				var template = $('#categories').html();
				var html = Mustache.render(template, categories[i]);
				$('.products-filter > ul').append(html);
			}
			
			$('.products-filter input').click(function(){
				if ($(this).attr('checked') != "checked") {
					$("#cat_" + $(this).attr('id')).toggleClass('products-filter-checked');
					$("#panel_" + $(this).attr('id')).toggle();
				} else {
					$("#cat_" + $(this).attr('id')).toggleClass('products-filter-checked');
					$("#panel_" + $(this).attr('id')).toggle();
				}
			});
		}
	});
}

function openModal(barcode) {
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
				BARCODE: data.barcode,
				TRADEMARK: data.trademark,
				PACKING: data.packing,
				PRICE: data.price
			});
			
			var template = $('#modal_product').html();
			var html = Mustache.render(template, product[0]);
			$(".modal-content")
				.empty()
				.append(html);

			$("#product_modal").modal('show');
			$('#product_update_save').click(function() {
				var product = $('#product_update').serialize();

				$.ajax({
					type: 'POST',
					url: 'update',
					data: product,
					success: function(response) {
						if (response) {
							$("#product_modal").modal('hide');
							location.reload();
						} else {
							alert('Erro: não foi possível fazer as alterações no momento. Tente novamente mais tarde!');
						}
					}
				});
			});
		}
	});
}

function productsList(cat) {
	$.ajax({
		type: 'GET',
		url: 'get_products/' + cat,
		dataType: 'json',
		success: function(data) {
			var products = [];
			
			for (i = 0; i < data.length; i++) {
				products.push({
					ID: data[i].id,
					PRODUCT_NAME: data[i].product_name,
					QUANTITY: data[i].quantity,
					CATEGORY: data[i].category_name,
					PURCHASE_DATE: data[i].purchase_date,
					EXPIRATION_DATE: data[i].expiration_date,
					BARCODE: data[i].barcode,
					TRADEMARK: data[i].trademark,
					PACKING: data[i].packing,
					PRICE: data[i].price
				});
			}
			
			showProducts(products, cat);
		}
	});
}

function showProducts(products, cat) {
	for (i = 0; i < products.length; i++) {
		var template = $('#product_table').html();
		var html = Mustache.render(template, products[i]);
		$('#product_list_' + cat).append(html);
	}

	$('tr').off('click').click(function() {
		if ($(this).attr('data-modal') == "true") {
			openModal($(this).attr('id'));
		}
	});
}