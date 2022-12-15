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
})
