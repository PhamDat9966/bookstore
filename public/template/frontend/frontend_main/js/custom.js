function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

$(document).ready(function(){
	var controller 	= (getUrlVar('controller') == '' ) ? 'index' : getUrlVar('controller');
	var action 		= (getUrlVar('action') == '' ) ? 'index' : getUrlVar('action');
	var classSelect = controller + '-' + action;
	// Add active ko sáng, tạm thời sử dụng class của bootstrap
	$('ul#main-menu li.' + classSelect + ' a').addClass('text-primary');
	//$('ul#main-menu li.' + classSelect + ' a').addClass('active');
});