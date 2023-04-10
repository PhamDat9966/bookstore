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

    //Button Input
    // public static function cmsButtonSubmit( $type, $class = 'btn btn-info' , $textOutfit ,$name = null , $value = null, $id = null  ){
    //     //class: default secondary danger
        
    //     $nameButton = '';
    //     if(isset($name)){
    //         $nameButton = "name='$name'";
    //     }
        
    //     $valueButton = '';
    //     if(isset($value)){
    //         $valueButton = "value='$value'";
    //     }
        
    //     $classButton = '';
    //     if($class == 'btn btn-info'){
    //         $classButton = "class='btn btn-info'";
    //     }
        
    //     if($class == 'btn btn-success'){
    //         $classButton = "class='btn btn-success'";
    //     }
        
    //     if($class == 'btn btn-secondary'){
    //         $classButton = "class='btn btn-secondary'";
    //     }
        
    //     if($class == 'btn btn-danger'){
    //         $classButton = "class='btn btn-danger'";
    //     }
        
    //     if($class == 'btn btn-solid'){
    //         $classButton = "class='btn btn-solid'";
    //     }
        
    //     $nameAndValue = '';
    //     if(isset($name) && isset($value)){
    //         $nameAndValue = "name='$name' value='$value'";
    //     }
        
    //     $idAttr = '';
    //     if(!empty($id)){
    //         $idAttr = "id = '$id'";
    //     }
        
        
    //     $xhtml = '<button type="'.$type.'" '.$idAttr.' '.$nameButton.' '.$valueButton.' '.$classButton.' '.$nameAndValue.' >'.$textOutfit.'</button>';
    //     return $xhtml;
    // }
    
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
            
//             $strRequire = '<span class="text-danger">*</span>';
//             $xhtml = "<label $option>".$lblName.$strRequire.'</label>'.$input;
        }
        return $xhtml;
    }
    
    // Create for - PUBLIC
    public static function cmsRow($lblName, $input, $option = null){

        $xhtml = '<label '.$option.' class="required">'.$lblName.'</label>'.$input;
        
        return $xhtml;
    }
    
    // Create INPUT
    public static function cmsInput($type, $name, $id = null, $value, $class = null, $size = null,$option = null){
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
}

