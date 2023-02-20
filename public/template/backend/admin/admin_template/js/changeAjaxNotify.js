// ChangeGroupACP

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
				/*
				 * <div id="alert" class="alert alert-success alert-dismissible">
	                    Trạng thái Group của User đã được cập nhật<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#FFFFFF;opacity: 1;">×</button>
	                </div>
				 */

				var jsonOject 	= $.parseJSON(data);
				var element     = "<div id='inAlert' class='alert alert-success alert-dismissible'>Trạng thái Group của User đã được cập nhật<button type='button' class='close' data-dismiss='alert' aria-hidden='true' style='color:#FFFFFF;opacity: 1;'>×</button></div>";
				if($("#inAlert").length > 0){
					$("#inAlert").remove();
				}
				$("#alert").prepend(element);
					
				console.log(jsonOject);
			}
	})
	
}

