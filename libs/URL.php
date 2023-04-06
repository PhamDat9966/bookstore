<?php
class URL{
	
    public static function createLink($module, $controller, $action, $params = NULL, $strRequest = NULL){
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
	    
		$url = 'index.php?module='.$module.'&controller='.$controller.'&action='.$action . $linkParams . $linkRequest ;
		return $url;
	} 
	
	public static function redirect($module, $controller, $action,$params = NULL,$strRequest = NULL){
	    $link  =   self::createLink($module, $controller, $action,$params,$strRequest);
		header('location: ' . $link);
		exit();
	}
	
	public static function redirectObFlush($module, $controller, $action,$params = NULL,$strRequest = NULL){
// 	    flush(); // Flush the buffer
// 	    ob_flush();
	    $link  =   self::createLink($module, $controller, $action,$params,$strRequest);
	    header('location: ' . $link);
	    ob_end_flush();
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

}