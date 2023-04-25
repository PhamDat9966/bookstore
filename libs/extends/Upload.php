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
    
    public function moveTempFileGoMainFile($fileMove, $folderMove, $option = Null){
        $fileName          = $fileMove;
        $fileLocation      = $this->randomString(8) . '.' . pathinfo($fileMove, PATHINFO_EXTENSION); 
        
        $fileMoveLocation  = UPLOAD_PATH . 'category' . DS . 'temp' . DS . $fileName;
        $imageFolderMove = UPLOAD_PATH . 'category' . DS;
        copy($fileMoveLocation, $imageFolderMove . $fileLocation);        
        return $fileLocation;
    }
    
    public function deleteAllTempFile($arrParam){
        $files = glob(UPLOAD_PATH . $arrParam['controller'] . DS . 'temp' . DS .'*'); // get all file names
        foreach($files as $file){ // iterate files
            if(@is_array(getimagesize($file))) {
                unlink($file); // delete file
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