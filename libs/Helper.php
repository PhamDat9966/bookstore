<?php
class Helper{
    
    //Button
    public static function cmsButton( $type, $class = 'default' , $textOutfit , $name = null , $value = null ){
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
       
       $xhtml = '<button type="'.$type.'" '.$nameButton.' '.$valueButton.' '.$classButton.' '.$nameAndValue.' >'.$textOutfit.'</button>'; 
       return $xhtml;
    }
    
    //A tag
    public static function cmsButtonAtag($url,$class,$textOufit,$spanIcon = null){
        //<a href="#" class="btn btn-info">All <span class="badge badge-pill badge-light">8</span></a>
        
        // default class
        $classAtag='btn btn-info';
        
        if($class=='btn-secondary'){ 
            $classAtag='btn btn-secondary';
        }
        
        $xhtml = '<a href="'.$url.'" class="'.$classAtag.'">
                        '.$textOufit.' '.$spanIcon.'
                 </a>';
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
    public static function cmsSelectbox($name, $class, $arrValue, $keySelect = 'default', $style = null){
        $xhtml = '<select style="'.$style.'" name="'.$name.'" class="'.$class.'" >';
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
        <a href="'.$link.'&id='.$id.'" class="btn '.$strGroupACP.' rounded-circle btn-sm">
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
        <a href="'.$link.'&id='.$id.'" class="btn '.$strStatus.' rounded-circle btn-sm">
            '.$icon.'
        </a>';
	    
	    return $xhtml;
	}
}

