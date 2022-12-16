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
		let result = confirm('Bạn chắc chắn muốn xóa dòng dữ liệu này?');
		if(result){
			window.location.href = $(this).attr('href');
		}
	})	
	
	$('#bulkApply').on('click', function(e) {	
    	
    	var selected		= $("#selectBox option:selected").text();
	    if (selected == "Bulk Action") {
	      alert("Vui lòng chọn action cần thực thiện!");
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
	     		alert("Vui lòng chọn ít nhất 1 dòng!");
	     	}
	    }
    	    
	})		
})
