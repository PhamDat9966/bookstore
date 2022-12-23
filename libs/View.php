<?php

class View{
    
    public $_moduleName;
    public $_templatePath;
    public $_title;
    public $_metaHTTP;
    public $_metaName;
    public $_cssFile;
    public $_jsFile;
    public $_dirFile;
    public $_dirImg;
    public $_urlImg;
    public $_fileView;
    public $_fontFile;
    public $_pluginsCss;
    public $_pluginsJs;
    
    public $_item;
    public $_tag;
    public $_arrParam;
    //public $_count;
    
    public function __construct($moduleName){
        $this->_moduleName = $moduleName;
    }

    public function render( $fileInclude, $loadFull = true){
        $path = MODULE_PATH . $this->_moduleName . DS . 'views' . DS . $fileInclude . '.php';
        if(file_exists($path)){
            if($loadFull == true){
                
                $this->_fileView = $fileInclude;            
                require_once $this->_templatePath;
                
            }else{
                require_once $path;
            }
        }else{
            echo '<h3>' . __METHOD__ . ': Error</h3>';
        }
    }
    
    public function setTemplatePath($path){
        $this->_templatePath = $path;
        
    }
    
    public function setTitle($value){
        $this->_title = $value;
    }
    
    // SET CSS
    public function appendCSS($arrayCSS){
        if(!empty($arrayCSS)){
            foreach ($arrayCSS as $css){
                $file = APPLICATION_URL . $this->_moduleName . DS . 'views' . DS . $css;
                $this->_cssFiles .= '<link rel="stylesheet" type="text/css" href="'.$file.'"/>';
            }
        }
    }
    
    // SET JS
    public function appendJS($arrayJS){
        if(!empty($arrayJS)){
            foreach ($arrayJS as $js){
                $file = APPLICATION_URL . $this->_moduleName . DS . 'views' . DS . $js;
                $this->_jsFiles .= '<script type="text/javascript" src="'.$file.'"></script>';
            }
        }
    }
    
    // SET FONT NON extendtion
    public function appendFONT($arrayFONT){
        if(!empty($arrayFONT)){
            foreach ($arrayFONT as $font){
                $file = APPLICATION_URL . $this->_moduleName . DS . 'views' . DS . $font;
                $this->_cssFiles .= '<link rel="stylesheet" type="text/css" href="'.$file.'"/>';
            }
        }
    }
}
















