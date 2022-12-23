<?php
class Helper{
    
    //Button
    public static function cmsButton( $type, $class = 'default' , $textOutfit ,$name = null , $value = null, $id = null  ){
       //class: default secondary danger 
        
       $nameButton = '';     
       if(isset($name)){
           $nameButton = "name='$name'";
       }
       
       $valueButton = '';
       if(isset($value)){
           $valueButton = "value='$value'";
       }
       
       $classButton = '';
       if($class == 'default'){
           $classButton = "class='btn btn-info'";
       }
       
       if($class == 'secondary'){
           $classButton = "class='btn btn-secondary'";
       }
       
       //class="btn btn-danger"
       if($class == 'danger'){
           $classButton = "class='btn btn-danger'";
       }

       $nameAndValue = '';
       if(isset($name) && isset($value)){
           $nameAndValue = "name='$name' value='$value'";
       }
       
       $idAttr = '';
       if(!empty($id)){
           $idAttr = "id = '$id'";
       }
       
       $xhtml = '<button type="'.$type.'" '.$idAttr.' '.$nameButton.' '.$valueButton.' '.$classButton.' '.$nameAndValue.' >'.$textOutfit.'</button>'; 
       return $xhtml;
    }
    
    //A tag
    public static function cmsButtonAtag($url,$class,$textOufit,$spanIcon = null){
        
        $xhtml = '<a href="'.$url.'" class="'.$class.'">
                        '.$textOufit.' '.$spanIcon.'
                 </a>';
        return $xhtml;      
    }
    
//     public static function cmsButtonAtag($name,$class ,$id, $link, $icon, $type = 'new'){
//         //<button type="submit" class="btn btn-success" namne="type" value="saveAndClose" "="">Save</button>
//         $xhtml = '';
//         if($type == 'new'){
//             $xhtml .= '<a class="'.$class.'" href="'.$link.'" id="'.$id.'"><span class="'.$icon.'"></span>'.$name.'</a>';
//         }else if($type == 'submit'){
//             $xhtml .= '<a class="'.$class.'" href="#" onclick="javascript:submitForm(\''.$link.'\');" id="'.$id.'"><span class="'.$icon.'"></span>'.$name.'</a>';
//         }
//         return $xhtml;
//     }
    
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
    public static function cmsSelectbox($name,$class, $arrValue, $keySelect = 'default', $style = null,$id = null){
        
        $xhtml = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'" id="'.$id.'">';
        foreach($arrValue as $key => $value){
            if($key == $keySelect && is_numeric($keySelect)){
                $xhtml .= '<option selected="selected" value = "'.$key.'">'.$value.'</option>';
            }else{
                $xhtml .= '<option value = "'.$key.'">'.$value.'</option>';
            }
        }
        $xhtml .= '</select>';
        return $xhtml;
    }
    
    // Create Selectbox
    public static function cmsRowForm($lblName, $input, $require = FALSE){  
        $strRequire = '';
        if($require == true) $strRequire = '<span class="text-danger">*</span>';
        $xhtml = '<label>'.$lblName.$strRequire.'</label>'.$input;

        return $xhtml;
    }
    
    // Create Row
    public static function cmsInput($type, $name, $id, $value, $class = null, $size = null){
        $strSize    = ($size == null) ? '' : "size = '$size'";
        $strClass   = ($class == null) ? '' : "class = '$class'";
        
        $xhtml = "<input type='$type' name='$name' id='$id' value='$value' $strClass $strSize>";
        
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
        //<a href="index.php?module=admin&controller=rss&action=index" class="btn btn-danger">Cancel</a>
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
	    //$strStatus 	= ($statusValue == 0) ? 'btn-danger' : 'btn-success';
	    
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
}

