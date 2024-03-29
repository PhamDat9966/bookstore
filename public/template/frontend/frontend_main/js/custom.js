function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

//Active menu
//$(document).ready(function(){
//	var controller 	= (getUrlVar('controller') == '' ) ? 'index' : getUrlVar('controller');
//	var action 		= (getUrlVar('action') == '' ) ? 'index' : getUrlVar('action');
//	var classSelect = controller + '-' + action;
//
//	$('ul#main-menu li.' + classSelect + ' a').addClass('my-menu-link active');
//});

function quickViewFunction(htmlentitiesJSON){
	
	console.log(htmlentitiesJSON);
	var ObjectJSON  = htmlentitiesJSON;
	var book_id		= ObjectJSON.book_id;
	var link		= ObjectJSON.url;
	var flag_stop   = ObjectJSON.session_flag_stop;
	
	if(flag_stop == true){
		$('#quick-view-login').modal('show'); 
		//window.location = "index.php?module=frontend&controller=index&action=login";
		window.setTimeout(function(){
	        window.location.href = "index.php?module=frontend&controller=index&action=login";
	    }, 3000);
	}
	
	$.ajax({
		url		: link,
		type	: 'GET',
		data	: {book_id:book_id},
		success	: function(data){	
			
				var dataOject 		 = JSON.parse(data);
				console.log(dataOject);
				var name     		 = dataOject.name;
				var id        		 = dataOject.id;
				var shortDescription = dataOject.shortDescription;
				var picture			 =  dataOject.picture;
					
				$('#book-name').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#book-name').append(name);	// Add text
				
				$('#book-description').contents().filter((_, el) => el.nodeType === 3).remove(); // Remove text
				$('#book-description').append(shortDescription);	// Add text
				
				$("#quick-view-img").attr("src",picture);
				
				/*Quan trọng: ----SET Name input------*/
				$("#input-quantity").attr('name','quantity-'+id);
				
				//price
				var saleOff            = dataOject.sale_off;
			    var priceHaveSaleOFF   = dataOject.price;
			    var priceNotSaleOFF    = '';
			    var priceReal		   = 0;	
			    
			    if(saleOff > 0){
			        priceNotSaleOFF  = dataOject.price;   
			        priceHaveSaleOFF = (dataOject.price * (100 - saleOff) / 100);
			        priceReal        = priceHaveSaleOFF;
			    }else{
				    var priceHaveSaleOFF   = dataOject.price;
				    var priceNotSaleOFF    = '';
				    priceReal        	   = priceHaveSaleOFF;
			    }
			    
			    // Thêm dấu phẩy vào hàng nghìn và 'đ' phía sau
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
				
				var linkOrderAtQuickView = 'index.php?module=frontend&controller=user&action=ajaxOrder&book_id='+id+'&price='+priceReal+'';
				
				$("#order-at-quick-view-book").click(function(){			
					//Lấy giá trị input theo name
					/*Để sử lý vấn đề nếu chọn xem nhiều của sổ lúc thêm vào giỏ hàng nó không bị thêm 
					 * trồng những book đã xem trước đó*/
					var nameInputBook      = 'quantity-'+id;
					var quantity      	   = $('input[name='+nameInputBook+']').val();
					/* Chỉ lấy value tại nơi được order tại input=>name - Còn những nơi khác nếu có bị nhập vào thì mặc định có value = 0 */
					
					$('#quick-view').modal('hide'); 
					
					//Ajax Lần 2 tại order
					$.ajax({
						url		: linkOrderAtQuickView,
						type	: 'GET',
						data	: {quantity:quantity},
						success	: function(dataorder){		
							
							var dataOuput = JSON.parse(dataorder);	
							console.log(dataOuput);
							var total = 0;
							var quantityOject = dataOuput.quantity;
							for (var property in quantityOject) {
							    total += Number(quantityOject[property]);
							}
							
							console.log(total);
							$('#totalItemCart').contents().filter((_, el) => el.nodeType === 3).remove();  // Remove text
							$('#totalItemCart').append(total);											   // Add total	
							$('#totalItemCart').notify("Sản phẩm đã được thêm vào giỏ hàng!",{ position:"bottom	right", className:"success" });
	
						}
					})
					
				});
			}
	})
}

//ODER AJAX
function ajaxOrder($linkOrderJSON){
	if($linkOrderJSON == ''){
		$('#quick-view-login').modal('show'); 
		window.setTimeout(function(){
	        window.location.href = "index.php?module=frontend&controller=index&action=login";
	    }, 3000);
	}
	
	var quantity = $("#input-quantity").val();	// Số lượng lấy tại <input id="input-quantity"  type="text" name="quantity" class="form-control input-number" value="1">
	var link = JSON.parse($linkOrderJSON);

	$.ajax({
		url		: link,
		type	: 'GET',
		data	:{quantity:quantity},
		success	: function(data){	
				console.log(data);
				var dataOject = JSON.parse(data); 

				var total = 0;
				var quantityOject = dataOject.quantity;
				
				for (var property in quantityOject) {
				    total += Number(quantityOject[property]);
				}
				
				$('#totalItemCart').contents().filter((_, el) => el.nodeType === 3).remove();  // Remove text
				$('#totalItemCart').append(total);											   // Add total	
				$('#totalItemCart').notify("Sản phẩm đã được thêm vào giỏ hàng!",{ position:"bottom	right", className:"success" });
				
				//Quick view
				//$('#quick-view-complete-order').modal('toggle');  // Chuyển đổi: Mở quickView theo modal
				$('#quick-view-complete-order').modal('show');  
				setTimeout(function(){
					//$('#quick-view-complete-order').modal('toggle'); // Chuyển đổi: Đóng quick-view-complete-order Theo modal
					$('#quick-view-complete-order').modal('hide'); // Chuyển đổi: Đóng quick-view-complete-order Theo modal
				}, 4000);	
		}
	})
}

// ORDER 
function deleteItemOrder(id){
	var idItem = id;
	var link   = "index.php?module=frontend&controller=user&action=ajaxDeleteItemOrder";;
	$.ajax({
		url		: link,
		type	: 'GET',
		data	:{id:idItem},
		success	: function(data){	
				console.log(data);
				var dateOject 			= JSON.parse(data); 
				var id       			= dateOject.id;
				var totalquantity 		= dateOject.totalQuantity;
				var totalPriceAllItem	= dateOject.totalPriceAllItem;
				
				$('tr#order-'+id+'').remove();
				$("#totalItemCart").text(totalquantity);
				$('#cart-form #totalPriceAllItem').text(totalPriceAllItem);
				$('#totalItemCart').notify("Sản phẩm đã được đưa ra khỏi giỏ hàng!",{ position:"bottom	right", className:"success" });
		}
	})
	
}

//ORDER SELECT BOX
$(document).ready(function () {
    $("#cart-form").find("input,textarea,select").on('input', function () {
    	console.log(this);
    	
        const quantity		= {};
        quantity.id    = this.name;
        quantity.value = this.value;
        
        quantityJSON   =  JSON.stringify(quantity);
        console.log(quantityJSON);
        $.ajax({
    		url		: 'index.php?module=frontend&controller=user&action=ajaxQuantity',
    		type	: 'GET',
    	    data:{paramQuantity:quantityJSON},
    		success	: function(data){

    				var jsonOject 			= JSON.parse(data);
    				var id					= jsonOject.id;	
    				var quantity    		= jsonOject.quantity;
    				var allQuantity    		= jsonOject.allQuantity;
    				var totalPriceItem		= jsonOject.totalPriceItem;
    				var totalPriceAllItem	= jsonOject.totalPriceAllItem;

    				totalPriceItem  	= addCommas(totalPriceItem)+' đ';
    				totalPriceAllItem	= addCommas(totalPriceAllItem)+' đ';
    				var element = '#cart-form #quantity-' + jsonOject.id;	 				
    				$(element).attr('value',jsonOject.quantity);    				
    				$(element).notify("Số lượng đã được cập nhật!",{position:"bottom center",className:"success",autoHideDelay: 3000});
    				
    				$('#cart-form #totalPrice-'+id+'').text(totalPriceItem);
    				$('#cart-form #totalPriceAllItem').text(totalPriceAllItem);
    				$("#totalItemCart").text(allQuantity);
    				

    			}
    	})
        
    });
});

// hàm để Number format
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

// Form search  Enter submit
//$('#search-input').live("keypress", function(e) {
//    var code = (e.keyCode ? e.keyCode : e.which);
//    if (code == 13) {
//       e.preventDefault();
//       e.stopPropagation();
//       $(this).closest('form').submit();
//    }
// });

//$("#search-form").submit(function( event ) {
//  event.preventDefault();
//// your code here
//});

//function sortBookList(sort)
//{
//	console.log(sort);
//    alert(sort.value);
//    var sorlVal = sort.value;
//    //var link = 'index.php?module=frontend&controller=book&action=list';
//    
//    $.ajax({
//		url		: 'index.php?module=frontend&controller=book&action=list',
//		type	: 'GET',
//	    data:{sort:sorlVal},
//		success	: function(data){
//				
//				console.log(data);
//
//			}
//	})
//}

//$('select #sort').on('change', function() {
//	  alert( this.value );
//});





