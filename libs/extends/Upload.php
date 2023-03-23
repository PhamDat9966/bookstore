<?php

class Upload{
    
    public function upload($fileObj, $folderUpload, $options = NULL){
        
        if($options == NULL){
            
//             echo "<pre>";
//             print_r($fileObj);
//             echo "</pre>";   
//             echo $folderUpload;

            if($fileObj['tmp_name'] != NULL){
                
                $uploadDir           = UPLOAD_PATH . $folderUpload . DS;
                $newFileName    = $this->randomString(8);
                $extension           = '.' . pathinfo($fileObj['name'], PATHINFO_EXTENSION);   
                
                copy($fileObj['tmp_name'], $uploadDir . $newFileName . $extension);
                
            }
        }
        
    }
    
    private function randomString($length = 5)
    {
        
        $arrCharacter = array_merge( range('a', 'z'), range(0, 9));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);
        
        $result        = substr($arrCharacter, 0, $length);
        return $result;
    }
    
}