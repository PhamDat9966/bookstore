<?php
class URL{
	
    public static function createLink($module, $controller, $action, $params = NULL, $strRequest = NULL,$option = NULL, $router = NULL){
        
        if($router != NULL) return ROOT_URL . DS . $router;   
        
        if($option == 'pagination'){
            unset($params['page']);
        }
        
	    $linkParams = '';
	    
	    if(!empty($params)){
	        foreach ($params as $key => $value){
	            @$linkParams .= "&$key=$value";
	        }
	    }
	    
	    $linkRequest = '';
	   if(!empty($strRequest)){
	       $linkRequest = '&'.$strRequest;
	   }
	    
		$url = ROOT_URL. DS . 'index.php?module='.$module.'&controller='.$controller.'&action='.$action . $linkParams . $linkRequest ;
		return $url;
	}
	
	public static function redirect($module, $controller, $action,$params = NULL,$strRequest = NULL,$option = NULL, $router = NULL){
	    $link  =   self::createLink($module, $controller, $action,$params,$strRequest,$option,$router);
		header('location: ' . $link);
		exit();
	}
	
	public static function checkRefreshPage($value, $module, $controller, $action, $params = null){
	    if(Session::get('token') == $value){
	        Session::delete('token');
	        URL::redirect($module, $controller, $action, $params);
	    }else{
	        Session::set('token', $value);
	    }
	}
	
	/*Loại bớt nhiều khoảng trắng dư thừa liên tiếp thành 1 khoảng trắng duy nhất*/
	public static function removeSpace($value){
	    
	    $value = trim($value);
	    $value = preg_replace('#(\s)+#', ' ', $value); // '\s' là nhiều khoảng trắng, '+' là n lần
	    return $value;
	}
	
	public static function replaceSpace($value){
	    $value = trim($value);
	    $value = str_replace(' ', '-', $value);
	    $value = preg_replace('#(-)+#', '-', $value);
	    return $value;
	}
	
	public static function removeCircumflex($value){
	    
	    $value      = strtolower($value);
	    
	    $characterA = '#(a|à|á|ả|ã|ạ|ă|ằ|ắ|ẳ|ẵ|ặ|â|ầ|ấ|ẩ|ẫ|ậ|A|À|Á|Ả|Ã|Ạ|Ă|Ằ|Ắ|Ẳ|Ẵ|Ặ|Â|Ầ|Ấ|Ẩ|Ẫ|Ậ)#imsU';
	    $repaceA    = 'a';       
	    $value      = preg_replace($characterA, $repaceA, $value);
	    
	    $characterD = '#(đ|Đ)#imsU';
	    $repaceD    = 'd';
	    $value      = preg_replace($characterD, $repaceD, $value);
	    
	    $characterE = '#(e|è|é|ẻ|ẽ|ẹ|ê|ề|ế|ể|ễ|ệ|E|È|É|Ẻ|Ẽ|Ẹ|Ê|Ề|Ế|Ể|Ễ|Ệ)#imsU';
	    $repaceE    = 'e';
	    $value      = preg_replace($characterE, $repaceE, $value);
	    
	    $characterI = '#(i|ì|í|ỉ|ĩ|ị|I|Ì|Í|Ỉ|Ĩ|Ị)#imsU';
	    $repaceI    = 'i';
	    $value      = preg_replace($characterI, $repaceI, $value);
	    
	    $characterO = '#(o|ò|ó|ỏ|õ|ọ|ô|ồ|ố|ổ|ỗ|ộ|ơ|ờ|ớ|ở|ỡ|ợ|O|Ò|Ó|Ỏ|Õ|Ọ|Ô|Ồ|Ố|Ổ|Ỗ|Ộ|Ơ|Ờ|Ớ|Ở|Ỡ|Ợ)#imsU';
	    $repaceO    = 'o';
	    $value      = preg_replace($characterO, $repaceO, $value);
	    
	    $characterU = '#(u|ù|ú|ủ|ũ|ụ|ư|ừ|ứ|ử|ữ|ự|U|Ù|Ú|Ủ|Ũ|Ụ|Ư|Ừ|Ứ|Ử|Ữ|Ự)#imsU';
	    $repaceU    = 'u';
	    $value      = preg_replace($characterU, $repaceU, $value);
	    
	    $characterY = '#(y|ỳ|ý|ỷ|ỹ|ỵ|Y|Ỳ|Ý|Ỷ|Ỹ|Ỵ)#imsU';
	    $repaceY    = 'y';
	    $value      = preg_replace($characterY, $repaceY, $value);
	    
	    return $value;
	}
	
	public static function filterURL($value){
	    //$value = URL::removeSpace($value);
	    $value = URL::replaceSpace($value);
	    $value = URL::removeCircumflex($value);

	    return $value;
	}

}