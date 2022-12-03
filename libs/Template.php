<?php
class Template{
    
    private $_fileConfig;
    private $_fileTemplate;
    private $_folderTemplate;
    private $_controller;
    private $_folderImageTemplate;
    private $_folderPluginsTemplate;
    
    public function __construct($controller){
        $this->_controller = $controller;
    }
    
    public function load(){
        $fileConfig             = $this->getFileConfig();
        $folderTemplate         = $this->getFolderTemplate();
        $fileTemplate           = $this->getFileTemplate();
        
        $folderImageTemplate    = $this->getFolderImageTemplate();
        $folderPluginsTemplate  = $this->getfolderPluginsTemplate();
        
        $pathFileConfig         = TEMPLATE_PATH . $folderTemplate . $fileConfig; 
        $tempfile               = TEMPLATE_PATH . $folderTemplate . $fileTemplate;
        $templatePath           = TEMPLATE_PATH . $folderTemplate . $fileTemplate;
        
        if(file_exists($pathFileConfig)){
            $arrCofig   =   parse_ini_file($pathFileConfig);
            $view = $this->_controller->_view;
            
            //$view->_title       = $this->createTitle($arrCofig['title']);
            $view->_metaHTTP    = $this->createMetaHTTP($arrCofig['metaHTTP']);
            $view->_metaName    = $this->createMetaHTTP($arrCofig['metaName']);
            
            $view->_cssFile     = $this->createLinkALLCSS($arrCofig['fileCss'],$arrCofig['filePluginsCss']);
            $view->_jsFile      = $this->createLinkALLJS($arrCofig['fileJs'],$arrCofig['filePluginsJs']);
            $view->_fontFile    = $this->createLinkFONT($arrCofig['dirFont'],$arrCofig['fileFont']);

            $view->_dirImg      = TEMPLATE_PATH . $folderImageTemplate.$arrCofig['dirImg'];
            $view->_urlImg      = TEMPLATE_URL . $folderImageTemplate.$arrCofig['dirImg'];

            $view->setTemplatePath(TEMPLATE_PATH . $folderTemplate . $fileTemplate);
        }
    }
    
    public function createLinkALLCSS($fileCSS,$filePluginsCSS){
        $arrayCSS       = array_merge($fileCSS,$filePluginsCSS);
        $arrCSSOut       = [];
        foreach ($arrayCSS as $key=>$value){
            $temp = explode("|", $value);
            $arrCSSOut[$temp[0]] = $temp[1];
        }
        ksort($arrCSSOut);
        
        $xhtml = '';
        if(!empty($arrCSSOut)){
            $path       = TEMPLATE_URL . $this->_folderTemplate;
            foreach ($arrCSSOut as $css){
                $xhtml .= '<link rel="stylesheet" type="text/css" href="'.$path . $css.'">';
            }
        }
        
        return $xhtml;
    }
    
    public function createLinkALLJS($fileJS,$filePluginsJS){

        $arrayJS    = array_merge($fileJS,$filePluginsJS);
        $arrJSOut = [];
        foreach ($arrayJS as $key=>$value){
            $temp = explode("|", $value);
            $arrJSOut[$temp[0]] = $temp[1];             
        }
        ksort($arrJSOut);
        $xhtml = '';
        if(!empty($arrJSOut)){
            $path       = TEMPLATE_URL . $this->_folderTemplate;
            foreach ($arrJSOut as $js){
                $xhtml .= '<script type="text/javascript" src="'.$path . $js.'"></script>'; 
            }
        }
        
        return $xhtml;
    }  
    
    public function createLinkFONT($pathFONT,$fileFONT){
        
        $xhtml = '';
        if(!empty($fileFONT)){
            $path = TEMPLATE_URL . $this->_folderTemplate . $pathFONT;
            foreach ($fileFONT as $font){
                $xhtml .= '<link rel="stylesheet" type="text/css" href="'.$path . DS .$font.'"/>';
            }
        }
        
        return $xhtml;
    }
    
    public function createLinkPluginsCSS($pathPluginsCSS,$filePluginsCSS){
        $xhtml = '';
        if(!empty($filePluginsCSS)){
            $path = TEMPLATE_URL . $this->_folderTemplate . $pathPluginsCSS;     
            foreach ($filePluginsCSS as $plugin){
                $xhtml .= '<link rel="stylesheet" type="text/css" href="'.$path . DS .$plugin.'"/>';
            }
        }
        
        return $xhtml;
    }
    
    public function createLinkPluginsJS($pathPluginsJS,$filePluginsJS){
        $xhtml = '';
        if(!empty($filePluginsJS)){
            $path = TEMPLATE_URL . $this->_folderTemplate . $pathPluginsJS;
            foreach ($filePluginsJS as $plugin){
                $xhtml .= '<script type="text/javascript" src="'.$path . DS .$plugin.'"/>';
            }
        }
        
        return $xhtml;
    }
    
    public function createLinkCSS($pathCSS,$fileCSS){
        
        $xhtml = '';
        if(!empty($fileCSS)){
            $path = TEMPLATE_URL . $this->_folderTemplate . $pathCSS;
            foreach ($fileCSS as $css){
                $xhtml .= '<link rel="stylesheet" type="text/css" href="'.$path . DS .$css.'"/>';
            }
        }
        
        return $xhtml;
    }
    
    public function createLinkJS($pathJS,$fileJS){
        
        $xhtml = '';
        if(!empty($fileJS)){
            $path = TEMPLATE_URL . $this->_folderTemplate . $pathJS;
            foreach ($fileJS as $js){
                $xhtml .= '<script type="text/javascript" src="'.$path.DS.$js.'"></script>';
            }
        }
        
        return $xhtml;
    }  
    
    public function createMetaName($arrMetaName){
        $xhtml = '';
        if(!empty($arrMetaName)){
            foreach ($arrMetaName as $meta){
                $temp = explode('|', $meta);
                
                // The meta khong hien tren brower
                $xhtml .= '<meta http-equiv="'.$temp[0].'" content="'.$temp[1].'" />';
            }
        }
        
        return $xhtml;
    }
    
    public function createMetaHTTP($arrMetaHTTP){
        $xhtml = '';
        if(!empty($arrMetaHTTP)){
            foreach ($arrMetaHTTP as $meta){  
               
                $temp = explode('|', $meta);

                // The meta khong hien tren brower
                $xhtml .= '<meta http-equiv="'.$temp[0].'" content="'.$temp[1].'" />';
            }
        }
        
        return $xhtml;
    }
    
    public function createTitle($value){
        return '<title>'. $value . '</title>';
    }
    
    public function setFolderTemplate($value = "default/main"){
        $this->_folderTemplate = $value;
    }
    
    
    public function setFileTemplate($value = "index.php"){
        $this->_fileTemplate = $value;
    }
    
    public function setFileConfig($value = 'template.ini'){
        $this->_fileConfig = $value;
    }
    
    public function setFolderImageTemplate($value = "default/main"){
        $this->_folderImageTemplate = $value;
    }
    
    public function setfolderPluginsTemplate($value = "default/main/plugins"){
        $this->_folderPluginsTemplate = $value;
    }
    
    public function getFolderTemplate(){
        return $this->_folderTemplate;
    }   
    
    public function getFolderImageTemplate(){
        return $this->_folderTemplate;
    }  
      
    public function getFileTemplate(){
        return $this->_fileTemplate;
    }
    
    public function getFileConfig(){
        return $this->_fileConfig;
    }
    
    public function getfolderPluginsTemplate(){
        return $this->_folderPluginsTemplate;
    }
}













