<?php
class Controller{
	
    public $_view;
    protected $_model;
    protected $_templateObj;
    protected $_arrParam;
    protected $_pagination;
	protected $_arrParamOld;
    
	public function __construct($arrParams){
	    
	    $this->setModel($arrParams['module'], $arrParams['controller']);
	    $this->setTemplate($this);
	    $this->setView($arrParams['module']);
	    
	    $this->setParams($arrParams);
	    $this->_view->arrParam = $arrParams;
	    
	}
	
	public function setModel($moduleName, $modelName){     
	    $modelName     = ucfirst($modelName) . 'Model';
	    $path = MODULE_PATH . $moduleName . DS . 'models' . DS. $modelName .'.php';
		if(file_exists($path)){
			require_once $path;
			$this->_model	= new $modelName();
		}
	}
	
	public function setView($moduleName){
	    $this->_view = new View($moduleName);
	}
	
	public function setTemplate($moduleName){
	    //$this->_templateObj = new Template($this);
	    $this->_templateObj = new Template($moduleName);
	}
		
	public function setParams($arrParam){
	    $this->_arrParam = $arrParam;
	}
	
	public function redirec($module = 'admin',$controller = 'index' , $action = 'index' , $page = NULL){
	    $pageLink = '';
	    if(isset($page)){
	        $pageLink = '&page='.$page;
	    }
	    header("location: index.php?module=$module&controller=$controller&action=$action$pageLink");
	    exit();
	}

}