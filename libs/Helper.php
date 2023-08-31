<?php
class Helper{
    
    //A tag
    public static function cmsButton($url,$class,$textOufit,$spanIcon = null){
        
        $xhtml = '<a href="'.$url.'" class="'.$class.'">
                        '.$textOufit.' '.$spanIcon.'
                 </a>';
        return $xhtml;
    }

    //Button Input
    public static function cmsButtonSubmit( $type, $class = 'btn btn-info' , $textOutfit ,$name = null , $value = null, $id = null  ){
        
        $xhtml = '<button type="'.$type.'" id="'.$id.'" name="'.$name.'" value="'.$value.'" class="'.$class.'">'.$textOutfit.'</button>';
        return $xhtml;
    }
    
    public static function cmsButtonSubmitPUBLIC($type = 'submit', $class = 'btn btn-info' , $textOutfit ,$name = null , $value = null, $id = null  ){

        $xhtml = '<button type="'.$type.'" class="'.$class.'" name="'.$name.'" value="'.$value.'" $id="'.$id.'">'.$textOutfit.'</button>';
        return $xhtml;
        
    }
    
    public static function cmsMessage($message){
        
        $xhtml = '';
        $btnHidden = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#FFFFFF;opacity: 1;">×</button>';
        if($message['class'] == 'success'){
            $xhtml = '<div class="alert alert-success alert-dismissible">
                        '.$message['content'].$btnHidden.'
                    </div>';
        }else if($message['class'] == 'error'){
            $xhtml .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            $xhtml .= '<div class="alert alert-danger alert-dismissible">
                        '.$message['content'].'
                    </div>';
        }
        return $xhtml;
        
    }
    
    //show Item Status
    public static function showItemStatus($module,$controller,$action,$id,$status){
        $icon   = 'fa-check';
        $color  = 'btn-success';
        
        if($status == 0){
            $icon   = 'fa-minus';
            $color  = 'btn-danger';
        }
        
        $xhtml = sprintf('<a href="index.php?module=%s&controller=%s&action=%s&id=%s&status=%s" class="btn btn-sm %s"><i class="fas %s"></i></a>',$module,$controller,$action,$id,$status,$color,$icon);
        return $xhtml;
    }
    
    // Create Selectbox
    public static function cmsSelectbox($name,$class, $arrValue, $keySelect = 'default', $style = null,$id = null, $option = null){
        
        
        $xhtml = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'" id="'.$id.'" '.$option.'>';
        foreach($arrValue as $key => $value){
            if($key == $keySelect && is_numeric($keySelect)){
                $xhtml .= '<option selected="selected" value ='.$key.'>'.$value.'</option>';
            }else{
                $xhtml .= '<option value = "'.$key.'">'.$value.'</option>';
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }
    
    public static function cmsSelectboxFrontend($name,$class, $arrValue, $keySelect = 'default', $style = null,$id = null, $option = null){
        
        
        $xhtml = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'" id="'.$id.'" '.$option.'>';
        foreach($arrValue as $key => $value){
            if($key == $keySelect){
                $xhtml .= '<option selected="selected" value ='.$key.'>'.$value.'</option>';
            }else{
                $xhtml .= '<option value = "'.$key.'">'.$value.'</option>';
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }
    
    // Select Group for one User from SelectBox
    public static function cmsSelectboxForUserSelectGroup($name,$class, $arrValue, $valueSelected = 'default', $style = null,$id = null, $option = null){
          
        $xhtml = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'" id="'.$id.'" '.$option.'>';
        foreach($arrValue as $key => $value){
            if($value == $valueSelected ){
                $xhtml .= '<option selected="selected" value ='.$key.'>'.$value.'</option>';
            }else{
                $xhtml .=   '<option value = '.$key.'>'.$value.'</option>';
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }
    
    // Select Category for one Book from SelectBox
    public static function cmsSelectboxForBookSelectCategory($name,$class, $arrValue, $valueSelected = 'default', $style = null,$id = null, $option = null){
        
        
        $xhtml = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'" id="'.$id.'" '.$option.'>';
        foreach($arrValue as $key => $value){
            if($value == $valueSelected ){
                $xhtml .= '<option selected="selected" value ='.$key.'>'.$value.'</option>';
            }else{
                $xhtml .=   '<option value = '.$key.'>'.$value.'</option>';
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }
    
    // Create for - ADMIN
    public static function cmsRowForm($lblName, $input, $require = FALSE, $option = null){  
        $strRequire = '';
        
        if($require == true) $strRequire = '<span class="text-danger">*</span>';
        $xhtml = "<label $option>".$lblName.$strRequire.'</label>'.$input;
            
        return $xhtml;
    }
    
    public static function cmsRowFormPicture($lblName, $input, $require = FALSE, $option = null){
        
        if($require == TRUE){
            $xhtml = '<div class="form-group">
                        <label for="exampleInputFile">Picture</label>
                        <div class="input-group">
                          <div class="custom-file">
                            '.$input.'
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>';
        } else {
            $xhtml = '<div class="form-group">
                        <label for="exampleInputFile">Picture</label>
                        <div class="input-group">
                          '.$input.'
                        </div>
                      </div>';
            
        }
        
        return $xhtml;
    }
    
    // Create for - PUBLIC
    public static function cmsRow($lblName, $input, $option = null){

        $xhtml = '<label '.$option.' class="required">'.$lblName.'</label>'.$input;
        
        return $xhtml;
    }
    
    // Create INPUT
    public static function cmsInput($type, $name, $value, $id = null, $class = null, $size = null,$option = null){
        $strSize    = ($size == null) ? '' : "size = '$size'";
        $strClass   = ($class == null) ? '' : "class = '$class'";
        
        $xhtml = "<input type='$type' name='$name' id='$id' value='$value' $strClass $strSize $option>";
        return $xhtml;
    }
    
    
    //show Item edit and delete
    public static function showItemAction($module,$controller,$action,$id,$statusAction){
        //edit
        if($statusAction == 'edit'){
            $icon   = 'fa-pen';
            $color  = 'btn-info';
        }
        //delete
        if($statusAction == 'delete'){
            $icon           = 'fa-trash';
            $color          = 'btn-danger btn-delete';
            
        }
        
        $xhtml = sprintf('<a href="index.php?module=%s&controller=%s&action=%s&id=%s" class="btn btn-sm %s rounded-circle"><i class="fas %s"></i></a>',$module,$controller,$action,$id,$color,$icon);
        return $xhtml;
    }
    
    // Button Add
    public static function cmsAccent($Value, $link,  $status = null ,$id =NULL){

        $strBotton = $Value;
        
        if($Value == 'Cancel'){
            $xhtml          ='
            <a href="'.$link.'&id='.$id.'" class="btn btn-danger">
                '.$strBotton.'
            </a>';
            
            if($id==null){
                $xhtml          ='
            <a href="'.$link.'" class="btn btn-danger">
                '.$strBotton.'
            </a>';
            }
            
            return $xhtml;
        }
        
        $xhtml          ='
        <a href="'.$link.'&id='.$id.'" class="btn btn-success m-15">
            '.$strBotton.'
        </a>';
        
        if($id==null){
            $xhtml          ='
            <a href="'.$link.'" class="btn btn-success m-15">
                '.$strBotton.'
            </a>';
        }
        
        return $xhtml;
    }
    
    //HighLight
    public static function highLight($search, $value){
        
        if($search != ''){
            return preg_replace('/' . preg_quote($search,'/') . '/ui', '<mark>$0</mark>' , $value);
        }
        
        return $value;
    }
    
    public static function showMassage($massage,$alert){
        $re_alert = ($alert != 0) ? "alert-success" : "alert-danger";
        $xhtml = '<div class="card-body">
                	<div class="pl-1">
                        <div class="alert '.$re_alert.'">'.$massage.'</div>
                    </div>
                </div>';
        return $xhtml;
    }
    
	// Formate Date
	public static function formatDate($format, $value){
		$result = '';
		if(!empty($value) && $value != '0000-00-00'){
		  $result = date($format, strtotime($value));
		}  
		return $result;
	}
	
	// Create Icon Group ACP
	public static function cmsGroupACP($groupAcpValue, $link, $id){

	    if($groupAcpValue == 0){
	        $strGroupACP = 'btn-danger';
	        $icon        =  '<i class="fas fa-minus"></i>';
	    } else{
	        $strGroupACP = 'btn-success';
	        $icon        =  '<i class="fas fa-check"></i>';
	    }
	    
        $xhtml          ='
        <a href="javascript:changeGroupACP(\''.$link.'\');" id="GroupACP-'.$id.'" class="btn '.$strGroupACP.' rounded-circle btn-sm">
            '.$icon.'
        </a>';
	    
	    return $xhtml;
	}
	
	// Create Icon Group cmsStatus
	public static function cmsStatus($statusValue, $link, $id){

	    if($statusValue == 0){
	        $strStatus = 'btn-danger';
	        $icon        =  '<i class="fas fa-minus"></i>';
	    } else{
	        $strStatus = 'btn-success';
	        $icon        =  '<i class="fas fa-check"></i>';
	    }
	    
	    $xhtml          ='
        <a href="javascript:changeStatus(\''.$link.'\');" id="status-'.$id.'" class="btn '.$strStatus.' rounded-circle btn-sm oncli">
            '.$icon.'
        </a>';
	    
	    return $xhtml;
	}

    // Create Icon Group cmsStatus
	public static function cmsStatusUser($statusValue, $link, $id){

	    if($statusValue == 0){
	        $strStatus = 'btn-danger';
	        $icon        =  '<i class="fas fa-minus"></i>';
	    } else{
	        $strStatus = 'btn-success';
	        $icon        =  '<i class="fas fa-check"></i>';
	    }
	    
	    $xhtml          ='
        <a href="javascript:changeStatusUser(\''.$link.'\');" id="status-'.$id.'" class="btn '.$strStatus.' rounded-circle btn-sm oncli">
            '.$icon.'
        </a>';
	    
	    return $xhtml;
	}
	
	// special
	public static function cmsSpecial($specialValue, $link, $id){
	    
	    if($specialValue == 0){
	        $strSpecial = 'btn-danger';
	        $icon        =  '<i class="fas fa-minus"></i>';
	    } else{
	        $strSpecial = 'btn-success';
	        $icon        =  '<i class="fas fa-check"></i>';
	    }
	    
	    $xhtml          ='
        <a href="javascript:changeSpecial(\''.$link.'\');" id="special-'.$id.'" class="btn '.$strSpecial.' rounded-circle btn-sm oncli">
            '.$icon.'
        </a>';
	    
	    return $xhtml;
	}
	
	// Create Image
	public static function createImage($folder, $prefix, $pictureName, $attribute = null){
	    
	    $class	= !empty($attribute['class']) ? $attribute['class'] : '';
	    $width	= !empty($attribute['width']) ? $attribute['width'] : '';
	    $height	= !empty($attribute['height']) ? $attribute['height'] : '';
	    $strAttribute	= "class='$class' width='$width' height='$height'";
	    
	    $picturePath	= UPLOAD_PATH . $folder . DS . $prefix . $pictureName;
	    if(file_exists($picturePath)==true){
	        $picture    = '<img  '.$strAttribute.' src="'.UPLOAD_URL . $folder . DS . $prefix . $pictureName.'">';
	    }else{
	        $picture	= '<img '.$strAttribute.' src="'.UPLOAD_URL . $folder . DS . $prefix . 'default.jpg' .'">';
	    }
	    
	    return $picture;
	}
	
	public static function createImageShort($folder,$pictureName,$attribute = null,$style = null){
	    
	    $picturePath        = Helper::createImageURL($folder, $pictureName);
	       
	    $class	= !empty($attribute['class']) ? $attribute['class'] : '';
	    
	    $width      = '';
	    if(isset($attribute['width'])){
	        $width	= 'width='.$attribute['width'].'';
	    }  
	    $height	= '';
	    if(isset($attribute['height'])){
	        $height	= 'height='.$attribute['height'].'';
	    }
	    
	    $strAttribute	= "class='$class' $width $height";
	    
	    $styleDisplay   = '';
	    if(isset($style['display'])){
	        $styleDisplay = 'style="display: '.$style['display'].';"';
	    }
	    
	    $picture    = '<img  '.$strAttribute.' src="'.$picturePath.'" '.$styleDisplay.'>';
	    
	    return $picture;
	}
	
	public static function createImageURL($folder,$pictureName){
	    $pictureURL          = UPLOAD_URL .$folder . DS . $pictureName;
	    $strSpecial1       = '\\';
	    $strSpecial2       = "/";
	    $pictureURL          = str_replace($strSpecial1 ,$strSpecial2, $pictureURL); 
	    return $pictureURL;
	}
	
	public static function createImageATag($href,$attribute = null,$style = null,$picture,$tabindexValue = null,$altTag = null){
	    
	    $class	= !empty($attribute['class']) ? $attribute['class'] : '';
	    $width	= !empty($attribute['width']) ? $attribute['width'] : '';
	    $height	= !empty($attribute['height']) ? $attribute['height'] : '';
	    $strAttribute	= "class='$class' width='$width' height='$height'";
	    
	    $background_image      = !empty($style['background-image']) ? $style['background-image'] : '';
	    $background_size       = !empty($style['background-size']) ? $style['background-size'] : '';
	    $background_position   = !empty($style['background-position']) ? $style['background-position'] : '';
	    $display               = !empty($style['display']) ? $style['display'] : '';
	    
	    $strStyle   = 'background-image: url(&quot;'.$background_image.'&quot;); 
                	   background-size: '.$background_size.'; 
                	   background-position: '.$background_position.'; 
                	   display: '.$display.';';
	    
	    $tabindex   = !empty($tabindexValue) ? $tabindexValue : '-1';
	    $alt        = !empty($altTag) ? $altTag : 'Product';
	    
	    $aTagXhtml  = '<a href="'.$href.'" 
                            '.$strAttribute.'    
                    		style="'.$strStyle.'" 
                    		tabindex="'.$tabindex.'"
                            alt="'.$alt.'">
                                '.$picture.'
                       </a>';
	    return $aTagXhtml;
	}
	
	public static function removeImage($folderUpload, $fileName){
	    
	    $fileName   =   UPLOAD_PATH . $folderUpload . DS . $fileName;
	    @unlink($fileName);
	}
	
	public static function replaceSpecialChar($str){
	    $res = str_replace( array( '\'', '"',
	        ',' , ';', '<', '>' ,':','/','|','\\','?','.','(',')','–' ), ' ', $str);
	    
	    return $res;
	}
	
	public static function replaceNumberChar($str){
	    
	    $value      = $str;
	    
	    $characterA = '#(1)#imsU';
	    $repaceA    = 'one';
	    $value      = preg_replace($characterA, $repaceA, $value);
	    
	    $characterD = '#(2)#imsU';
	    $repaceD    = 'two';
	    $value      = preg_replace($characterD, $repaceD, $value);
	    
	    $characterE = '#(3)#imsU';
	    $repaceE    = 'three';
	    $value      = preg_replace($characterE, $repaceE, $value);
	    
	    $characterI = '#(4)#imsU';
	    $repaceI    = 'four';
	    $value      = preg_replace($characterI, $repaceI, $value);
	    
	    $characterO = '#(5)#imsU';
	    $repaceO    = 'five';
	    $value      = preg_replace($characterO, $repaceO, $value);
	    
	    $characterA = '#(6)#imsU';
	    $repaceA    = 'six';
	    $value      = preg_replace($characterA, $repaceA, $value);
	    
	    $characterD = '#(7)#imsU';
	    $repaceD    = 'seven';
	    $value      = preg_replace($characterD, $repaceD, $value);
	    
	    $characterE = '#(8)#imsU';
	    $repaceE    = 'eight';
	    $value      = preg_replace($characterE, $repaceE, $value);
	    
	    $characterI = '#(9)#imsU';
	    $repaceI    = 'nine';
	    $value      = preg_replace($characterI, $repaceI, $value);
	    
	    $characterO = '#(0)#imsU';
	    $repaceO    = 'zero';
	    $value      = preg_replace($characterO, $repaceO, $value);
	    
	    return $value;
	}
	
	public static function check_email_exists($email) {
	    
	    // Kiểm tra xem email có hợp lệ hay không.
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	        return false;
	    }
	    
	    // Tách miền khỏi email.
	    $domain = explode("@", $email)[1];
	    
	    // Kiểm tra xem miền có tồn tại trên máy chủ DNS hay không.
	    $result = checkdnsrr($domain, "MX");
	    
	    // Nếu miền không tồn tại trên máy chủ DNS thì email không tồn tại.
	    if (!$result) {
	        return false;
	    }
	    
	    // Email tồn tại.
	    return true;
	}
	
	public static function check_email_exists_with_google_api($email) {
    
	    require_once LIBRARY_PATH . 'google-api-php-client/vendor/autoload.php';
	    //Composer 2.5.8
	    // Tạo client.
	    $client = new Google_Client();

	    $client->setApplicationName('Kiem Tra Gmail');
	    $client->setClientId('113379841975710140864');
	    //$client->setClientSecret('YOUR_CLIENT_SECRET');
	    //$client->setRedirectUri('YOUR_REDIRECT_URI');
	    
	    // Lấy token.
	    $authUrl = $client->createAuthUrl();
	    header('Location: ' . $authUrl);
	    exit;
	    
	    // Xử lý phản hồi.
	    if (isset($_GET['code'])) {
	        $client->fetchAccessTokenWithAuthCode($_GET['code']);
	    }
	    
	    // Kiểm tra xem địa chỉ email có tồn tại hay không.
	    $service = new Google_Service_Gmail($client);
	    $result = $service->users->messages->list('me', ['query' => "to:{$email}"]);
	    if (isset($result['messages'])) {
	        return true;
	    } else {
	        return false;
	    }
	}
}





















