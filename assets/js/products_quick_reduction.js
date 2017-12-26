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
							reduct(barcode);
							added = true;
						}
					} else {
						if (added == false) {
							$('#isRegistered').text('Não há produtos com este código de barras!');
							$('.reduction_product').addClass('not-registered');
							added = true;
						}
					}
				}
			});
		}
	});
});

function reduct(barcode) {
	$.ajax({
		type: 'POST',
		url: 'reduct/' + barcode,
		success: function(data) {
			console.log(data);
			if (data.verify) {
				$('.product-info h4').text(data.product_name + ' (' + data.packing + ')');
				$('.product-info').append('<br><strong> Marca:</strong> ' + data.trademark + '<br>');
				$('.product-info').append('<strong> Quantidade:</strong> <span class="quantity-bc">' + data.quantity_bc + '</span> -> <span class="quantity-ac">' + data.quantity + '</span><br>');
				$('.product-info').append('<strong> Categoria:</strong> ' + data.category_name + '<br>');
				$('.product-info').append('<strong> Data da compra:</strong> ' + data.purchase_date + '<br>');
				$('.product-info').append('<strong> Data de validade:</strong> ' + data.expiration_date);
			} else {
				$('#isRegistered').text('Não foi possível fazer a baixa do produto no momento!');
				$('.reduction_product').addClass('not-registered');
			}
		}
	});
}