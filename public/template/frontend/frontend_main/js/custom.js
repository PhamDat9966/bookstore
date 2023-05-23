function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

$(document).ready(function(){
	var controller 	= (getUrlVar('controller') == '' ) ? 'index' : getUrlVar('controller');
	var action 		= (getUrlVar('action') == '' ) ? 'index' : getUrlVar('action');
	var classSelect = controller + '-' + action;
	
	// Add class active link ko sáng, tạm thời sử dụng class của bootstrap
	//$('ul#main-menu li.' + classSelect + ' a').addClass('text-primary');
	$('ul#main-menu li.' + classSelect + ' a').addClass('my-menu-link active');
});

function quickViewFunction(htmlentitiesJSON){
	console.log(htmlentitiesJSON);
	var ObjectJSON  = htmlentitiesJSON;
	var book_id		= ObjectJSON.book_id;
	var link		= ObjectJSON.url;
	//Ajax
	$.ajax({
		url		: link,
		type	: 'GET',
		data	: {book_id:book_id},
		success	: function(data){	

				console.log(data);
				
				var dataOject = JSON.parse(data);			
				var name     = dataOject.name;
				var id        		 = dataOject.id;
				var shortDescription = dataOject.shortDescription;
				var picture			 =  dataOject.picture;
				
					
				$('#book-name').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#book-name').append(name);	// Add text
				
				$('#book-description').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#book-description').append(shortDescription);	// Add text
				
				$("#quick-view-img").attr("src",picture);
				
				//price
				var saleOff            = dataOject.sale_off;
			    var priceHaveSaleOFF   = dataOject.price;
			    var priceNotSaleOFF    = '';

			    if(saleOff > 0){
			    	
			        priceNotSaleOFF  = dataOject.price;   
			        priceHaveSaleOFF = (dataOject.price * (100 - saleOff) / 100);
			        
			    }else{
				    var priceHaveSaleOFF   = dataOject.price;
				    var priceNotSaleOFF    = '';
			    }
			    
			    // Thêm dấu phẩy vào hàng nghìn
			    const formatter = new Intl.NumberFormat('en-US', { maximumSignificantDigits: 3 });
			    priceHaveSaleOFF = formatter.format(priceHaveSaleOFF)+' đ';
			    
			    if(priceNotSaleOFF == 0){
			    	priceNotSaleOFF = '';
			    }else{
			    	priceNotSaleOFF = formatter.format(priceNotSaleOFF)+' đ';
			    }
			    
				$('#book-price').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#book-price').append(priceHaveSaleOFF);	// Add text
			    
				$('#price-not-off').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#price-not-off').append(priceNotSaleOFF);	// Add text
			 
			}
	})
}

//ODER AJAX
function ajaxOrder($linkOrderJSON){
	if($linkOrderJSON == ''){
		alert('Vui lòng đăng nhập để tiến hành mua hàng');
		window.location = "index.php?module=frontend&controller=index&action=login";
	}
	
	var quantity = $("#input-quantity").val();	// Số lượng lấy tại <input id="input-quantity"  type="text" name="quantity" class="form-control input-number" value="1">
	console.log(quantity);
	console.log($linkOrderJSON);
	
	var link = JSON.parse($linkOrderJSON);
	console.log(link);
	
	$.ajax({
		url		: link,
		type	: 'GET',
		data	:{quantity:quantity},
		success	: function(data){	
				console.log(data);
				var dataOject = JSON.parse(data); 

				var total = 0;
				var quatityOject = dataOject.quatity;
				
				for (var property in quatityOject) {
				    total += Number(quatityOject[property]);
				}
				
				$('#totalItemCart').contents().filter((_, el) => el.nodeType === 3).remove();  // Remove text
				$('#totalItemCart').append(total);											   // Add total	
				$('#totalItemCart').notify("Sản phẩm đã được thêm vào giỏ hàng!",{ position:"bottom	right", className:"success" });
				
				//Quick view
				$('#quick-view-complete-order').modal('toggle');  // Chuyển đổi: Mở quickView theo modal
				 
				setTimeout(function(){
					$('#quick-view-complete-order').modal('toggle'); // Chuyển đổi: Đóng quick-view-complete-order Theo modal
				 
				}, 4000);	
		}
	})
}

//ODER AJAX
function ajaxOrderQuickView($linkOrderJSON){
	if($linkOrderJSON == ''){
		alert('Vui lòng đăng nhập để tiến hành mua hàng');
		window.location = "index.php?module=frontend&controller=index&action=login";
	}
	
	var quantity = $("#input-quantity").val();	// Số lượng lấy tại <input id="input-quantity"  type="text" name="quantity" class="form-control input-number" value="1">
	console.log(quantity);
	console.log($linkOrderJSON);
	
	var link = JSON.parse($linkOrderJSON);
	console.log(link);
	
	$.ajax({
		url		: link,
		type	: 'GET',
		data	:{quantity:quantity},
		success	: function(data){	
				console.log(data);
				var dataOject = JSON.parse(data); 

				var total = 0;
				var quatityOject = dataOject.quatity;
				
				for (var property in quatityOject) {
				    total += Number(quatityOject[property]);
				}
				
				$('#totalItemCart').contents().filter((_, el) => el.nodeType === 3).remove();  // Remove text
				$('#totalItemCart').append(total);											   // Add total	
				$('#totalItemCart').notify("Sản phẩm đã được thêm vào giỏ hàng!",{ position:"bottom	right", className:"success" });
				 
				$('#quick-view').modal('toggle'); // Chuyển đổi: Đóng quickView Theo modal
				 
		}
	})
}

function hiddentOrder(){
	 $('#quick-view-complete-order').addClass('hidden');
	 $('#quick-view-complete-order').removeAttr("style");
	 $('#quick-view-complete-order').attr("aria-hidden", "true");
	 
	 $('#quick-view-complete-order').css({ 'display': 'none'});
}














