$(function() {
	getCategories();
	productsList();
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
					ID: data[i].id,
					CATEGORY_NAME: data[i].category_name
				});
				
				/*var template = $('#categories_menu').html();
				var html = Mustache.render(template, categories[i]);
				$('.menu').append(html);*/
			}
		}
	});
}

function productsList() {
	$.ajax({
		type: 'GET',
		url: 'get_products',
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
			
			showProducts(products);
		}
	});
}

function showProducts(products) {
	for (i = 0; i < products.length; i++) {
		var template = $('#product_table').html();
		var html = Mustache.render(template, products[i]);
		$('#product_list').append(html);
	}
}