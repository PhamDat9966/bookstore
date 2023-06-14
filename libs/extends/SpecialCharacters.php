<?php

class SpecialCharacters{
    
    public function sequence($strParam, $options = NULL){
        $arrParam = str_split($strParam); 
        foreach ($arrParam as $key=>$strElemet){
            if($strElemet=='\'' || $strElemet=='\"' || $strElemet=='\\' || $strElemet=='\_' || $strElemet=='\%'){
                $arrParam[$key] = "\\".$strElemet;
            }
        }
        
    }

}