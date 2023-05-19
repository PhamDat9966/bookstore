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
	//var link    = 'index.php?module=frontend&controller=book&action=quickView';
	//Ajax
	$.ajax({
		url		: link,
		type	: 'GET',
		data	: {book_id:book_id},
		success	: function(data){	
				/*
				 * <a href="javascript:changeGroupACP('index.php?module=backend&amp;controller=group&amp;action=ajaxGroupACP&amp;id=4&amp;group_acp=0');" id="GroupACP-4" class="btn btn-danger rounded-circle btn-sm">
			            <i class="fas fa-minus"></i>
			        </a>
				 */
				console.log(data);
				
				var dataOject = JSON.parse(data);
//				
				console.log(dataOject);
				var name     = dataOject.name;
				console.log(name);
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
	var link = JSON.parse($linkOrderJSON);   

	$.ajax({
		url		: link,
		success	: function(data){	
				var dataOject = JSON.parse(data); 

				var total = 0;
				var quatityOject = dataOject.quatity;
				
				for (var property in quatityOject) {
				    total += quatityOject[property];
				}
				
				$('#totalItemCart').contents().filter((_, el) => el.nodeType === 3).remove();  // Remove text
				$('#totalItemCart').append(total);											   // Add total	
				$('#totalItemCart').notify("Sản phẩm đã được thêm vào giỏ hàng!",{ position:"bottom	right", className:"success" });
		}
	})
}














