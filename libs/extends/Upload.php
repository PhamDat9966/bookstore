<?php

class Upload{
    
    public function upload($fileObj, $folderUpload, $options = NULL){
        
        if($options == NULL){

            if($fileObj['tmp_name'] != NULL){
                
                $uploadDir     = UPLOAD_PATH . $folderUpload . DS;
                //$newFileName   = $this->randomString(8);
                //$extension     = '.' . pathinfo($fileObj['name'], PATHINFO_EXTENSION);   
                
                $fileName      = $this->randomString(8) . '.' . pathinfo($fileObj['name'], PATHINFO_EXTENSION); 
                
                copy($fileObj['tmp_name'], $uploadDir . $fileName);
                
            }
        }
        
        return $fileName;
    }
    
    public function removeFile($folderUpload, $fileName){
        
        $fileName   =   UPLOAD_PATH . $folderUpload . DS . $fileName;
        @unlink($fileName);
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