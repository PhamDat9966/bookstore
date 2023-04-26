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
    
    public function moveTempFileGoMainFile($fileMove, $folderMove,$option = Null){
        $fileName          = $fileMove;
        $newLocation      = $this->randomString(8) . '.' . pathinfo($fileMove, PATHINFO_EXTENSION); 
        
        $fileMoveLocation  = UPLOAD_PATH . $folderMove . DS . 'temp' . DS . $fileName;
        $imageFolderMove = UPLOAD_PATH . $folderMove . DS;
        copy($fileMoveLocation, $imageFolderMove . $newLocation);        
        return $newLocation;
    }
    
//     public function getImageInfoAction($imageName, $arrParam ,$option = null){
        
//         echo "<pre>getImage";
//         print_r($arrParam);
//         echo "</pre>";
        
//         die("Function is Die");
        
//         $folderLocation = $arrParam['controller'];
        
//         if($option == null){
//             $pathImage          = UPLOAD_PATH .$folderLocation. DS . $imageName;
//             $imageInfo          = pathinfo($pathImage);
//             $imageInfo['size']  = filesize($pathImage);
//             return $imageInfo;
//         }
//         if($option == 'temp'){
            
//             $pathImage          = UPLOAD_PATH . $folderLocation . DS . 'temp' . DS .$imageName;
//             $imageInfo          = pathinfo($pathImage);
//             $imageInfo['size']  = filesize($pathImage);
//             return $imageInfo;
//         }
//     }
    
    public function getImageInfoAction($arrParam ,$option = null){
        
        $folderLocation = $arrParam['controller'];

        if(isset($arrParam['form']['picture_temp'])){
            $imageName          = $arrParam['form']['picture_temp'];
            $pathImage          = UPLOAD_PATH . $folderLocation . DS . 'temp' . DS .$imageName;
            $imageInfo          = pathinfo($pathImage);
            $imageInfo['size']  = filesize($pathImage);
            return $imageInfo;
        } else if(isset($arrParam['form']['picture'])) {
            $imageName          = $arrParam['form']['picture'];
            $pathImage          = UPLOAD_PATH .$folderLocation. DS . $imageName;
            $imageInfo          = pathinfo($pathImage);
            $imageInfo['size']  = filesize($pathImage);
            return $imageInfo;
        } else{
            $imageInfo['basename']  = '';
            $imageInfo['size']      = '';
            return $imageInfo;
        }
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