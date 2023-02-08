function submitForm(url){
	$('#group-list-form').attr('action', url);
	$('#group-list-form').submit();
}

$(document).ready(function(){
	// filter group ACP
	$('#selectGroupACP').on('change', function (e) {
		var selected		= $("#selectGroupACP option:selected").text();
		
		if(selected == "- Select Group ACP -"){	
			$('#formGroupACP').submit();
		}
		if(selected == "Yes"){	
			$('#formGroupACP').submit();
		}
		if(selected == "No"){
			$('#formGroupACP').submit();
		}
	});
	
	// Check box
	$('input[name=checkall-toggle]').change(function(){
		var checkStatus = this.checked;
		$('#group-list-form').find(':checkbox').each(function(){
			this.checked = checkStatus;
		});
	})
	
	$('#submit').click(function(){
		$('#group-list-form').submit();
	})
	
	$('.btn-delete').on('click', function(e) {
		e.preventDefault();
		Swal.fire({
		  title: 'Xác nhận?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  position			: 'top',
		  confirmButtonText: 'Đồng ý',
		  cancelButtonText: 'Hủy'
			  
		}).then((result) => {
		  if (result.isConfirmed) {
		    window.location.href = $(this).attr('href'); 
		  }
		})
		
	})	
	
	// Bulk Apple filter + Ordering for Group
	$('#bulkApply').on('click', function(e) {	
    	
    	var selected		= $("#selectBox option:selected").text();
    	
    	if (selected == "Ordering") {
 	    	$('#group-list-form').find(':checkbox').each(function(){
 	    		e.preventDefault();
	     		Swal.fire({
				  title				: 'Xác nhận?',
				  icon				: 'warning',
				  showCancelButton	: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor	: '#d33',
				  confirmButtonText	: 'Đồng ý',
				  cancelButtonText	: 'Hủy',
				  position 			: 'top' 
				  
			      }).then((result) => {
					  if (result.isConfirmed) {
						  $('#group-list-form').submit();
				      }
			   })
 			});
 		} else if(selected == "Bulk Action") {
	   		e.preventDefault();
	   		Swal.fire({
	   			      // Path warning icon for html 
	     			  html: '<div class="container"><div><svg width="30" height="30" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M 500 0C 224 0 0 224 0 500C 0 776 224 1000 500 1000C 776 1000 1000 776 1000 500C 1000 224 776 0 500 0C 500 0 500 0 500 0M 500 25C 762 25 975 238 975 500C 975 762 762 975 500 975C 238 975 25 762 25 500C 25 238 238 25 500 25C 500 25 500 25 500 25 M 526 150C 576 150 602 175 601 224C 600 300 600 350 575 525C 570 560 560 575 525 575C 525 575 475 575 475 575C 440 575 430 560 425 525C 400 355 400 300 400 226C 400 175 425 150 475 150M 500 650C 527 650 552 661 571 679C 589 698 600 723 600 750C 600 805 555 850 500 850C 445 850 400 805 400 750C 400 723 411 698 429 679C 448 661 473 650 500 650C 500 650 500 650 500 650"/></svg></div><div class="textDiv">Vui lòng chọn action cần thực thiện!</div></div>',

	     			  timer				: 3000,
	     			  timerProgressBar	: true,
	     			  position			: 'top-end',
	     			  background 		: '#fff',
	     			  backdrop 			: false,
	     			  showConfirmButton	: false,
	     			  customClass: {
	     			    popup: 'swal-wide',
	     			    icon: 'icon-class'
	     			  }
	     			})
	   		   		
	    } else{
	    	var i = 0;
	 	    if (selected == "Delete") {
	 	    	$('#group-list-form').find(':checkbox').each(function(){
	 				if(this.checked == true){
	 					i++;
	 				}
	 			});
	 		}
	 	    
	 	    if (selected == "Active") {
	 	    	$('#group-list-form').find(':checkbox').each(function(){
	 				if(this.checked == true){
	 					i++;
	 				}
	 			});
	 		}
	 	    
	 	    if (selected == "Inactive") {
	 	    	$('#group-list-form').find(':checkbox').each(function(){
	 				if(this.checked == true){
	 					i++;
	 				}
	 			});
	 		}
	 	    
	     	if(i==0){

	     		e.preventDefault();
	     		Swal.fire({
     			  html: '<div class="container"><div><svg width="30" height="30" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M 500 0C 224 0 0 224 0 500C 0 776 224 1000 500 1000C 776 1000 1000 776 1000 500C 1000 224 776 0 500 0C 500 0 500 0 500 0M 500 25C 762 25 975 238 975 500C 975 762 762 975 500 975C 238 975 25 762 25 500C 25 238 238 25 500 25C 500 25 500 25 500 25 M 526 150C 576 150 602 175 601 224C 600 300 600 350 575 525C 570 560 560 575 525 575C 525 575 475 575 475 575C 440 575 430 560 425 525C 400 355 400 300 400 226C 400 175 425 150 475 150M 500 650C 527 650 552 661 571 679C 589 698 600 723 600 750C 600 805 555 850 500 850C 445 850 400 805 400 750C 400 723 411 698 429 679C 448 661 473 650 500 650C 500 650 500 650 500 650"/></svg></div><div class="textDiv">Vui lòng chọn ít nhất 1 dòng dữ liệu!</div></div>',

     			  timer				: 3000,
     			  timerProgressBar	: true,
     			  position			: 'top-end',
     			  background 		: '#fff',
     			  backdrop 			: false,
     			  showConfirmButton	: false,
     			  customClass: {
     			    popup: 'swal-wide',
     			    icon: 'icon-class'
     			  }
     			})
		     		
	     	} else{
	     		e.preventDefault();
	     		Swal.fire({
				  title				: 'Xác nhận?',
				  icon				: 'warning',
				  showCancelButton	: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor	: '#d33',
				  confirmButtonText	: 'Đồng ý',
				  cancelButtonText	: 'Hủy',
				  position 			: 'top' 
				  
			      }).then((result) => {
					  if (result.isConfirmed) {
						  $('#group-list-form').submit();
				      }
			   })
			   
	     	}
	    }
    	    
	})		
})

function changeGroupACP(link){
	
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
				classRemove = 'btn-success';
				classAdd 	= 'btn-danger'
				iclassRemove	= 'fa-check';
				iclassAdd		= 'fa-minus';
				
				if(group_acb==1){
					classRemove 	= 'btn-danger';
					classAdd 		= 'btn-success';
					iclassRemove	= 'fa-minus';
					iclassAdd		= 'fa-check';
				}
				
				$(element).attr('href',"javascript:changeGroupACP('"+url+"')");
				$(element).removeClass(classRemove).addClass(classAdd);
				$(element + ' i').removeClass(iclassRemove).addClass(iclassAdd);
				
			}
	})
	
}

function changeStatus(link){
	$.ajax({
		url		: link,
		type	: 'GET',
		success	: function(data){	
				/*
				 * <a href="javascript:changeStatus('index.php?module=backend&amp;controller=group&amp;action=ajaxStatus&amp;id=2&amp;status=1');" id="status-2" class="btn btn-success rounded-circle btn-sm oncli">
					    <i class="fas fa-check"></i>
					</a>
				 */
			
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
				$(element).removeClass(classRemove).addClass(classAdd);
				$(element + ' i').removeClass(iclassRemove).addClass(iclassAdd);
				
				console.log(dataOject);
				
			}
	})
}


// User
$(document).ready(function(){
	// filter group User
	$('#selectGroup').on('change', function (e) {
		//var selected		= $("#selectGroup option:selected").text();
		//$('#formGroupACP').submit();
		document.forms['filterGroupForUser'].submit();
	});
	
//	$('#selectGroupForUser').on('change', function (e) {
//  		$('#user-list-form').submit();
//	});

	
	// Bulk Apple filter + Ordering for User
	$('#bulkApplyUser').on('click', function(e) {	
    	var selected		= $("#selectBoxUser option:selected").text();
    	
    	if(selected == "Bulk Action") {
	   		e.preventDefault();
	   		Swal.fire({
	   			      // Path warning icon for html 
	     			  html: '<div class="container"><div><svg width="30" height="30" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M 500 0C 224 0 0 224 0 500C 0 776 224 1000 500 1000C 776 1000 1000 776 1000 500C 1000 224 776 0 500 0C 500 0 500 0 500 0M 500 25C 762 25 975 238 975 500C 975 762 762 975 500 975C 238 975 25 762 25 500C 25 238 238 25 500 25C 500 25 500 25 500 25 M 526 150C 576 150 602 175 601 224C 600 300 600 350 575 525C 570 560 560 575 525 575C 525 575 475 575 475 575C 440 575 430 560 425 525C 400 355 400 300 400 226C 400 175 425 150 475 150M 500 650C 527 650 552 661 571 679C 589 698 600 723 600 750C 600 805 555 850 500 850C 445 850 400 805 400 750C 400 723 411 698 429 679C 448 661 473 650 500 650C 500 650 500 650 500 650"/></svg></div><div class="textDiv">Vui lòng chọn action cần thực thiện!</div></div>',

	     			  timer				: 3000,
	     			  timerProgressBar	: true,
	     			  position			: 'top-end',
	     			  background 		: '#fff',
	     			  backdrop 			: false,
	     			  showConfirmButton	: false,
	     			  customClass: {
	     			    popup: 'swal-wide',
	     			    icon: 'icon-class'
	     			  }
	     			})
	   		   		
	    } else{
	    	var i = 0;
	 	    if (selected == "Delete") {
	 	    	$('#user-list-form').find(':checkbox').each(function(){
	 				if(this.checked == true){
	 					i++;
	 				}
	 			});
	 		}
	 	    
	 	    if (selected == "Active") {
	 	    	$('#user-list-form').find(':checkbox').each(function(){
	 				if(this.checked == true){
	 					i++;
	 				}
	 			});
	 		}
	 	    
	 	    if (selected == "Inactive") {
	 	    	$('#user-list-form').find(':checkbox').each(function(){
	 				if(this.checked == true){
	 					i++;
	 				}
	 			});
	 		}
	 	    
	     	if(i==0){

	     		e.preventDefault();
	     		Swal.fire({
     			  html: '<div class="container"><div><svg width="30" height="30" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M 500 0C 224 0 0 224 0 500C 0 776 224 1000 500 1000C 776 1000 1000 776 1000 500C 1000 224 776 0 500 0C 500 0 500 0 500 0M 500 25C 762 25 975 238 975 500C 975 762 762 975 500 975C 238 975 25 762 25 500C 25 238 238 25 500 25C 500 25 500 25 500 25 M 526 150C 576 150 602 175 601 224C 600 300 600 350 575 525C 570 560 560 575 525 575C 525 575 475 575 475 575C 440 575 430 560 425 525C 400 355 400 300 400 226C 400 175 425 150 475 150M 500 650C 527 650 552 661 571 679C 589 698 600 723 600 750C 600 805 555 850 500 850C 445 850 400 805 400 750C 400 723 411 698 429 679C 448 661 473 650 500 650C 500 650 500 650 500 650"/></svg></div><div class="textDiv">Vui lòng chọn ít nhất 1 dòng dữ liệu!</div></div>',

     			  timer				: 3000,
     			  timerProgressBar	: true,
     			  position			: 'top-end',
     			  background 		: '#fff',
     			  backdrop 			: false,
     			  showConfirmButton	: false,
     			  customClass: {
     			    popup: 'swal-wide',
     			    icon: 'icon-class'
     			  }
     			})
		     		
	     	} else{
	     		e.preventDefault();
	     		Swal.fire({
				  title				: 'Xác nhận?',
				  icon				: 'warning',
				  showCancelButton	: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor	: '#d33',
				  confirmButtonText	: 'Đồng ý',
				  cancelButtonText	: 'Hủy',
				  position 			: 'top' 
				  
			      }).then((result) => {
					  if (result.isConfirmed) {
						  $('#user-list-form').submit();
				      }
			   })
			   
	     	}
	    }
    	    
	})
	
	
})

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

