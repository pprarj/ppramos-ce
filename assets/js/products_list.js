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
	if (products.length != 0) {
		for (i = 0; i < products.length; i++) {
			var template = $('#product_table').html();
			var html = Mustache.render(template, products[i]);
			$('#product_list_' + cat).append(html);
		}
	} else {
		$('#table_' + cat).hide();
		$('#panel_' + cat).append('<p class="no-products">Ainda não há produtos cadastrados nessa categoria!</p>');
	}
}