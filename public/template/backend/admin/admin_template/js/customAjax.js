function changeGroupACP(link){
	$(document).ready(function() {
		$.ajax({
			url		: link,
			type	: 'GET',
			success	: function(data){	
					/*
					 * <a href="javascript:changeGroupACP('index.php?module=backend&amp;controller=group&amp;action=ajaxGroupACP&amp;id=4&amp;group_acp=0');" id="GroupACP-4" class="btn btn-danger rounded-circle btn-sm">
				            <i class="fas fa-minus"></i>
				        </a>
					 */
				
					var dataOject = JSON.parse(data);
					var id        = dataOject.id;
					var group_acb = dataOject.group_acb;
					var url       = dataOject.url;
					
					var element = 'a#GroupACP-' + id;
					var classRemove = 'btn-success';
					var classAdd 	= 'btn-danger'
					var iclassRemove	= 'fa-check';
					var iclassAdd		= 'fa-minus';
					
					if(group_acb==1){
						classRemove 	= 'btn-danger';
						classAdd 		= 'btn-success';
						iclassRemove	= 'fa-minus';
						iclassAdd		= 'fa-check';
					}
					
					$(element).attr('href',"javascript:changeGroupACP('"+url+"')");
					$(element + ' i').removeClass(iclassRemove).addClass(iclassAdd);
					$(element).removeClass(classRemove).addClass(classAdd).notify("Cập nhật thành công",{ position:"top", className:"success" });
					//$('#GroupACP-' + id).removeClass(classRemove).addClass(classAdd).notify("Cập nhật thành công",{ position:"top", className:"success" });

				}
		})
	})
}


//$(window).load(function changeGroupACP(link){
//	
//	$.ajax({
//		url		: link,
//		type	: 'GET',
//		success	: function(data){	
//				/*
//				 * <a href="javascript:changeGroupACP('index.php?module=backend&amp;controller=group&amp;action=ajaxGroupACP&amp;id=4&amp;group_acp=0');" id="GroupACP-4" class="btn btn-danger rounded-circle btn-sm">
//			            <i class="fas fa-minus"></i>
//			        </a>
//				 */
//			
//				var dataOject = JSON.parse(data);
//				var id        = dataOject.id;
//				var group_acb = dataOject.group_acb;
//				var url       = dataOject.url;
//				
//				var element = 'a#GroupACP-' + id;
//				var classRemove = 'btn-success';
//				var classAdd 	= 'btn-danger'
//				var iclassRemove	= 'fa-check';
//				var iclassAdd		= 'fa-minus';
//				
//				if(group_acb==1){
//					classRemove 	= 'btn-danger';
//					classAdd 		= 'btn-success';
//					iclassRemove	= 'fa-minus';
//					iclassAdd		= 'fa-check';
//				}
//				
//				$(element).attr('href',"javascript:changeGroupACP('"+url+"')");
//				$(element + ' i').removeClass(iclassRemove).addClass(iclassAdd);
//				$(element).removeClass(classRemove).addClass(classAdd).notify("Cập nhật thành công",{ position:"top", className:"success" });
//				//$('#GroupACP-' + id).removeClass(classRemove).addClass(classAdd).notify("Cập nhật thành công",{ position:"top", className:"success" });
//
//			}
//	})
//	
//})



function changeStatus(link){
	$(document).ready(function() {
		$.ajax({
			url		: link,
			type	: 'GET',
			success	: function(data){	
					/*
					 * <a href="javascript:changeStatus('index.php?module=backend&amp;controller=group&amp;action=ajaxStatus&amp;id=2&amp;status=1');" id="status-2" class="btn btn-success rounded-circle btn-sm oncli">
						    <i class="fas fa-check"></i>
						</a>
					 */
					console.log(data);
					var dataOject = JSON.parse(data);
					var id        = dataOject.id;
					var status 	  = dataOject.status;
					var url       = dataOject.url;
					
					var element = 'a#status-' + id;
					classRemove = 'btn-success';
					classAdd 	= 'btn-danger'
					iclassRemove	= 'fa-check';
					iclassAdd		= 'fa-minus';
					
					if(status==1){
						classRemove 	= 'btn-danger';
						classAdd 		= 'btn-success';
						iclassRemove	= 'fa-minus';
						iclassAdd		= 'fa-check';
					}
					
					$(element).attr('href',"javascript:changeStatus('"+url+"')");
					
					//"success");
					$(element).removeClass(classRemove).addClass(classAdd);
					$(element + ' i').removeClass(iclassRemove).addClass(iclassAdd);
					$('.card-body .table-responsive table tbody tr.odd td a#status-' + id).notify("Click me!",{position:"top center",className:"success",autoHideDelay: 55000});
				}
		})
	})	
}

// changeStatusForUser
function changeStatusUser(link){
	$.ajax({
		url		: link,
		type	: 'GET',
		success	: function(data){	
				/*
				 * <a href="javascript:changeStatus('index.php?module=backend&amp;controller=group&amp;action=ajaxStatus&amp;id=2&amp;status=1');" id="status-2" class="btn btn-success rounded-circle btn-sm oncli">
					    <i class="fas fa-check"></i>
					</a>
				 */
				console.log(data);
				
				var dataOject = JSON.parse(data);
				var id        = dataOject.id;
				var status 	  = dataOject.status;
				var url       = dataOject.url;
				
				var element = 'a#status-' + id;
				classRemove = 'btn-success';
				classAdd 	= 'btn-danger'
				iclassRemove	= 'fa-check';
				iclassAdd		= 'fa-minus';
				
				if(status==1){
					classRemove 	= 'btn-danger';
					classAdd 		= 'btn-success';
					iclassRemove	= 'fa-minus';
					iclassAdd		= 'fa-check';
				}
				
				$(element).attr('href',"javascript:changeStatus('"+url+"')");
				
				//"success");
				$(element).removeClass(classRemove).addClass(classAdd);
				$(element + ' i').removeClass(iclassRemove).addClass(iclassAdd);
				$('a#status-' + id).notify("Click me!",{position:"top center",className:"success",autoHideDelay: 55000});
			}
	})
}


// Ajax at SelectBox group for User.
function changeGroupUser(jsonParam){

	$.ajax({
		url		: 'index.php?module=backend&controller=user&action=selectGroupForUser',
		type	: 'GET',
		data	: {selectGroup:jsonParam},
		success	: function(data){

				var jsonOject 	= $.parseJSON(data);
				var element     = "<div id='inAlert' class='alert alert-success alert-dismissible'>"+jsonOject[1].content+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color:#FFFFFF;opacity: 1;'>×</button></div>";
				if($("#inAlert").length > 0){
					$("#inAlert").remove();
				}
				$("#alert").prepend(element);
			}
	})
	
}

//AJAX GROUP ORDERING
$(document).ready(function () {
    $("#group-list-form").find("input,textarea,select").on('input', function () {
        const ordering		= {};
        ordering.id    = this.name;
        ordering.value = this.value;
        
        orderingJSON   =  JSON.stringify(ordering);
        $.ajax({
    		url		: 'index.php?module=backend&controller=group&action=ajaxOrdering',
    		type	: 'GET',
    	    data:{paramOrdering:orderingJSON},
    		success	: function(data){
    				var jsonOject 	= JSON.parse(data);
    			
    				var element = '#group-list-form .card-body .table-responsive #group-ordering-' + jsonOject.id;	
    				
    				$(element).attr('value',jsonOject.ordering);
    				
    				$(element).notify("Cập nhật thành công!",{position:"top center",className:"success",autoHideDelay: 55000});
    				console.log(element);
    			
    			}
    	})
        
    });
});

//AJAX CATEGORY ORDERING
$(document).ready(function () {
    $("#category-list-form").find("input,textarea,select").on('input', function () {
        const ordering		= {};
        ordering.id    = this.name;
        ordering.value = this.value;
        
        orderingJSON   =  JSON.stringify(ordering);
        $.ajax({
    		url		: 'index.php?module=backend&controller=category&action=ajaxOrdering',
    		type	: 'GET',
    	    data:{paramOrdering:orderingJSON},
    		success	: function(data){
    				var jsonOject 	= JSON.parse(data);
    			
    				var element = '#category-list-form .card-body .table-responsive #category-ordering-' + jsonOject.id;	
    				
    				$(element).attr('value',jsonOject.ordering);
    				
    				$(element).notify("Cập nhật thành công!",{position:"top center",className:"success",autoHideDelay: 55000});
    				//console.log(element);
    			
    			}
    	})
        
    });
});

//changeCategory for Book
function changeCategoryForBook(jsonParam){
	
	console.log(jsonParam);
	
	$.ajax({
		url		: 'index.php?module=backend&controller=book&action=selectCategoryForBook',
		type	: 'GET',
		data	: {selectGroup:jsonParam},
		success	: function(data){
				
				console.log(data);

				var jsonOject 	= $.parseJSON(data);
				console.log(jsonOject);
				
				var bookCategoryID = '#category-list-form #selectCategoryForBook-' + jsonOject.id;	
				
				var element     = "<div id='inAlert' class='alert alert-success alert-dismissible'>"+jsonOject[1].content+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color:#FFFFFF;opacity: 1;'>×</button></div>";
				if($("#inAlert").length > 0){
					$("#inAlert").remove();
				}
				$("#alert").prepend(element);
				
				$(bookCategoryID).notify("Cập nhật thành công!",{position:"top center",className:"success",autoHideDelay: 55000});
				
			}
	})
	
}

