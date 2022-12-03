
function deleteItem(id){
	$.post('index.php?module=admin&controller=group&action=delete', {id : id}, function(data){
		console.log(data);
		$('tr#item-' + id).hide(500);
	});
}

function deleteMultItem(checkbox){
	//alert('day la mult');
	alert(checkbox);
	
	
	$.post('index.php?controller=group&action=delete', {id : checkbox}, function(data){
		console.log(data);
		$('tr#item-' + id).hide(500);
	});
}

//function deleteItem(id) {
//	$("#dialog-confirm").dialog({
//		resizable : false,
//		height : 200,
//		modal : true,
//		buttons : {
//			"Yes" : function() {
//				$.post('index.php?controller=group&action=delete', {id : id	}, function(data) {
//					$('tr#item-' + id).hide(500);
//				});
//				$(this).dialog("close");
//			},
//			Cancel : function() {
//				$(this).dialog("close");
//			}
//		}
//	});
//	
//}

$(document).ready(function(){
	$('#cancel-button').click(function(){
		window.location = 'index.php';
	});
	
	$('#multy-delete').click(function(){
		$('#main-form').submit();
	});
	
	$('#check-all').change(function(){
		var checkStatus = this.checked;
		$('#main-form').find(':checkbox').each(function(){
			this.checked = checkStatus;
		});
	});
	
	$('.success, .notice, .error').click(function() {
		 $(this).toggle("slow");
	});
	
	$('#custom-select').addClass("w-25 select--no-search ");
});
