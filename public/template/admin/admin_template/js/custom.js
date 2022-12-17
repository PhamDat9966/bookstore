// Thiếu path

$(document).ready(function(){
	
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
		// alert box
		//		let result = confirm('Bạn chắc chắn muốn xóa dòng dữ liệu này?');
		//		if(result){
		//			//window.location.href = $(this).attr('href');
		//		}
		
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
	
	$('#bulkApply').on('click', function(e) {	
    	
    	var selected		= $("#selectBox option:selected").text();
	    if (selected == "Bulk Action") {
	      //alert("Vui lòng chọn action cần thực thiện!");
	      
	    	///////////////////////////////////////////
			//		    e.preventDefault();
			//	   		let timerInterval
			//	   		Swal.fire({
			//	   		  //title				: 'Vui lòng chọn action cần thực thiện!',
			//	   	      text: 'Vui lòng chọn action cần thực thiện!',	
			//	   		  timer				: 2000,
			//	   		  timerProgressBar	: true,
			//	   		  backdrop 			: false,
			//	   		  background 		: '#fff',
			//	   		  position 			: 'top-end',
			//	   		  width				: '22em',
			//	   		  didOpen: () => {
			//	   		    Swal.showLoading()
			//	   		    const b = Swal.getHtmlContainer().querySelector('b')
			//	   		    timerInterval = setInterval(() => {
			//	   		      b.textContent = Swal.getTimerLeft()
			//	   		    }, 100)
			//	   		  },
			//	   		  willClose: () => {
			//	   		    clearInterval(timerInterval)
			//	   		  }
			//	   		}).then((result) => {
			//	   		  /* Read more about handling dismissals below */
			//	   		  if (result.dismiss === Swal.DismissReason.timer) {
			//	   		    console.log('I was closed by the timer')
			//	   		  }
			//	   		})
	       /////////////////////////////////////////////
	   		e.preventDefault();
	   		Swal.fire({
	     			  html: '<div class="container"><div><svg class="checkmark" viewBox="5 5 40 40"><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></div><div class="textDiv">Vui lòng chọn action cần thực thiện!</div></div>',
	     			  timer				: 2000,
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
	     			//alert("Vui lòng chọn ít nhất 1 dòng!");
	     		    ///////////////////////////////////////////
//		     			e.preventDefault();
//				   		let timerInterval
//				   		Swal.fire({
//				   		  //title				: 'Vui lòng chọn ít nhất 1 cần dòng!',
//				   	      icon				: 'warning',
//				   		  text				: 'Vui lòng chọn ít nhất 1 cần dòng!',
//				   		  timer				: 2000,
//				   		  timerProgressBar	: true,
//				   		  backdrop 			: false,
//				   		  background 		: '#fff',
//				   		  position 			: 'top-end',
//				   		  width				: '22em',
//				   		  didOpen: () => {
//				   		    Swal.showLoading()
//				   		    const b = Swal.getHtmlContainer().querySelector('b')
//				   		    timerInterval = setInterval(() => {
//				   		      b.textContent = Swal.getTimerLeft()
//				   		    }, 100)
//				   		  },
//				   		  willClose: () => {
//				   		    clearInterval(timerInterval)
//				   		  }
//				   		}).then((result) => {
//				   		  /* Read more about handling dismissals below */
//				   		  if (result.dismiss === Swal.DismissReason.timer) {
//				   		    console.log('I was closed by the timer')
//				   		  }
//				   		})
			       /////////////////////////////////////////////
	     		e.preventDefault();
		   		Swal.fire({
		     			  html: '<div class="container"><div><svg class="checkmark" viewBox="5 5 40 40"><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></div><div class="textDiv">Vui lòng chọn ít nhất dòng một dòng dữ liệu!</div></div>',
		     			  timer				: 2000,
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


function changeStatus(link){
	 //e.preventDefault();
	Swal.fire({
		  title: 'Xác nhận?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor		: '#d33',
		  position 				: 'top',
		  confirmButtonText: 'Đồng ý',
		  cancelButtonText: 'Hủy'
			  
		}).then((result) => {
		  if (result.isConfirmed) {
		    window.location.href = link; 
		  }
		})
}

function changeGroupACP(link){
	 //e.preventDefault();
	Swal.fire({
		  title: 'Xác nhận?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor		: '#d33',
		  position 				: 'top',
		  confirmButtonText: 'Đồng ý',
		  cancelButtonText: 'Hủy'
			  
		}).then((result) => {
		  if (result.isConfirmed) {
		    window.location.href = link; 
		  }
		})
}


