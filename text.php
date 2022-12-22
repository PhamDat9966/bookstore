<?php
Sửa lại nút submit tại form để đưa được save-close
Mã:
// Create Button
public static function cmsButton($name, $id, $link, $icon, $type = 'new'){
    $xhtml  = '<li class="button" id="'.$id.'">';
    if($type == 'new'){
        $xhtml .= '<a class="modal" href="'.$link.'"><span class="'.$icon.'"></span>'.$name.'</a>';
    }else if($type == 'submit'){
        $xhtml .= '<a class="modal" href="#" onclick="javascript:submitForm(\''.$link.'\');"><span class="'.$icon.'"></span>'.$name.'</a>';
    }
    $xhtml .= '</li>';
    
    return $xhtml;
}