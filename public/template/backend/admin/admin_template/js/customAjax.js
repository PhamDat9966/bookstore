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
				

				}
		})
	})
}

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
					$('#status-' + id).notify("Status đã được cập nhật!",{position:"top center",className:"success",autoHideDelay: 3000});
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
				$('a#status-' + id).notify("Status đã được cập nhật!",{position:"top center",className:"success",autoHideDelay: 3000});
			}
	})
}


// Ajax at SelectBox group for User.
function changeGroupUser(jsonParam){
	var groupUserOject = $.parseJSON(jsonParam);
	console.log(groupUserOject);
	var idBoxSelect = 	groupUserOject.id; 
	console.log(idBoxSelect);
	
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
				
				var elementBoxSelectID	= "#selectGroupForUser-" + idBoxSelect;
				$(elementBoxSelectID).notify("Group đã được cập nhật!",{position:"top center",className:"success",autoHideDelay: 3000});
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
    				
    				$(element).notify("Ordering cập nhật thành công!",{position:"top center",className:"success",autoHideDelay: 55000});
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
    				var id			= jsonOject.id;	
    				var modified    = jsonOject.modi.modified;
    				var modified_by = jsonOject.modi.modified_by;
    			    console.log(jsonOject);
    				var element = '#category-ordering-' + jsonOject.id;	
    				
    				$(element).attr('value',jsonOject.ordering);
    				
    				$(element).notify("Ordering cập nhật thành công!",{position:"top center",className:"success",autoHideDelay: 3000});
    				//console.log(element);
    				
    				// Cập nhật lại modified
    				//var modifiedText = '#category-list-form .table-responsive table tbody tr#category-id-'+id+' td#modified'; 
    				var modifiedText = '#category-list-form tr#category-id-'+id+' td#modified'; // Selector theo id.
    				var textNew      = '<p class="mb-0"><i class="far fa-user"></i>  '+modified_by+'<br><i class="far fa-clock"></i>  '+modified+'</p>';
    				$(modifiedText).empty();
    				$(modifiedText).append(textNew);
    			
    			}
    	})
        
    });
});

//changeCategory for Book
function changeCategoryForBook(jsonParam){
	
	$.ajax({
		url		: 'index.php?module=backend&controller=book&action=selectCategoryForBook',
		type	: 'GET',
		data	: {selectGroup:jsonParam},
		success	: function(data){
			
				var jsonOject 	= $.parseJSON(data);
				var modified    = jsonOject.modi.modified;
				var modified_by = jsonOject.modi.modified_by;
				var id 			= jsonOject.id;
				
				var bookCategoryID = '#selectCategoryForBookID-'+id;	
				//var bookCategoryID = '#book-list-form #card-list .table-responsive #myTable tbody tr td#selectCategoryForBook #selectCategoryForBook-12';
				
				var element     = "<div id='inAlert' class='alert alert-success alert-dismissible'>"+jsonOject[1].content+"<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color:#FFFFFF;opacity: 1;'>×</button></div>";
				if($("#inAlert").length > 0){
					$("#inAlert").remove();
				}
				$("#alert").prepend(element);
				
				//$(bookCategoryID).notify("Cập nhật thành công!",{position:"top center",className:"success",autoHideDelay: 55000});
				$('#selectCategoryForBook-'+id).notify("Cập nhật thành công!",{ position:"top center", className:"success" });
				// Cập nhật lại modified
				var modifiedContent = '#book-list-form tr#book-id-'+id+' td#modified'; //Selector theo id
				var textNew      	= '<p class="mb-0"><i class="far fa-user"></i>  '+modified_by+'<br><i class="far fa-clock"></i>  '+modified+'</p>';
				$(modifiedContent).empty();
				$(modifiedContent).append(textNew);
			}
	})
	
}

//AJAX BOOK ORDERING
$(document).ready(function () {
    $("#book-list-form").find("input,textarea,select").on('input', function () {
    	console.log(this);
    	
        const ordering		= {};
        ordering.id    = this.name;
        ordering.value = this.value;
        
        orderingJSON   =  JSON.stringify(ordering);
        $.ajax({
    		url		: 'index.php?module=backend&controller=book&action=ajaxOrdering',
    		type	: 'GET',
    	    data:{paramOrdering:orderingJSON},
    		success	: function(data){
    				var jsonOject 	= JSON.parse(data);
    				var id			= jsonOject.id;	
    				var modified    = jsonOject.modi.modified;
    				var modified_by = jsonOject.modi.modified_by;
    			    console.log(jsonOject);
    				var element = '#book-list-form .card-body .table-responsive #book-ordering-' + jsonOject.id;	
    				
    				$(element).attr('value',jsonOject.ordering);
    				
    				$(element).notify("Ordering đã được cập nhật!",{position:"top center",className:"success",autoHideDelay: 55000});
    				//console.log(element);
    				
    				// Cập nhật lại modified
    				//var modifiedText = '#category-list-form .table-responsive table tbody tr#category-id-'+id+' td#modified'; 
    				var modifiedText = '#category-list-form tr#category-id-'+id+' td#modified'; // Selector theo id.
    				var textNew      = '<p class="mb-0"><i class="far fa-user"></i>  '+modified_by+'<br><i class="far fa-clock"></i>  '+modified+'</p>';
    				$(modifiedText).empty();
    				$(modifiedText).append(textNew);
    				
    				var element     = "<div id='inAlert' class='alert alert-success alert-dismissible'>Ordering đã được cập nhật!<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color:#FFFFFF;opacity: 1;'>×</button></div>";
    				if($("#inAlert").length > 0){
    					$("#inAlert").remove();
    				}
    				$("#alert").prepend(element);
    			
    			}
    	})
        
    });
});

//Book change Special
function changeSpecial(link){
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
				var special   = dataOject.special;
				var url       = dataOject.url;
				
				var element = '#book-list-form a#special-' + id;
				classRemove = 'btn-success';
				classAdd 	= 'btn-danger'
				iclassRemove	= 'fa-check';
				iclassAdd		= 'fa-minus';
				
				if(special==1){
					classRemove 	= 'btn-danger';
					classAdd 		= 'btn-success';
					iclassRemove	= 'fa-minus';
					iclassAdd		= 'fa-check';
				}
				
				$(element).attr('href',"javascript:changeSpecial('"+url+"')");
				
				//"success");
				$(element).removeClass(classRemove).addClass(classAdd);
				$(element + ' i').removeClass(iclassRemove).addClass(iclassAdd);
				$('a#special-' + id).notify("Special đã được cập nhật!",{position:"top center",className:"success",autoHideDelay: 55000});
			}
	})
}

