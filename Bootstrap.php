<?php
class Bootstrap{
    
    private $_params;
    private $_controllerOject;
    
    public function init(){
        $this->setParam();
        @$controllerName   =  ucfirst($this->_params['controller']) . 'Controller';
        @$filePath         =  MODULE_PATH . $this->_params['module'] . DS . 'controllers' . DS . $controllerName  . '.php';   
        
        if(file_exists($filePath)){
            $this->loadExistingController($filePath, $controllerName);
            $this->callMethod();
        }else {
            //$this->loadDefaultController();
            URL::redirect('frontend', 'index', 'notice',array('type'=>'not-url'));
        }
        
    }
    
    // CALL METHOD
    public function callMethod(){
        
        $actionName         = $this->_params['action'].'Action';
        
        if(method_exists($this->_controllerOject, $actionName) == true){
            
            $module     = $this->_params['module'];
            $controller = $this->_params['controller'];
            $action     = $this->_params['action']; 
            
            // Login First
            $userInfo   = array();
            $logged     = '';
            
            $userInfo   = Session::get('user');
            
            if(!empty($userInfo)){
               $logged     = ($userInfo['login'] == 'true' && $userInfo['time'] + TIME_LOGIN); // return 'True' or 'False'
            }

            if($module == 'backend'){

                if($logged == true){
                    
                    if($userInfo['group_acp'] == 1){
                        $this->_controllerObject->$actionName();
                    }else{
                        URL::redirect('frontend','index','notice',array('type'=>'not-permission'));
                    }

                }else{
                    $this->callLoginAction($module);
                }

            }else if($module == 'frontend'){
                
                if($controller == 'user'){
                    if($logged == true){
                        $this->_controllerObject->$actionName();
                    }else{
                        $this->callLoginAction($module);
                    }
                }else {
                    $this->_controllerOject->$actionName();
                }
                
            }
            
        }else {
            
            URL::redirect('frontend', 'index', 'notice',array('type'=>'not-url'));
            
        }
        
    }
    
    // LOAD EXISTING CONTROLLER
    public function loadExistingController($filePath, $controllerName){
        
        require_once $filePath;
        $this->_controllerOject = new $controllerName($this->_params);
        
        //Load Old
        //$this->_controllerOject   = new $controllerName();
        //$this->_controllerOject->setModel($this->_params['module'],$this->_params['controller']);
        //$this->_controllerOject->setView($this->_params['module']);
        //$this->_controllerOject->setTemplate($this->_controllerOject);
        //$this->_controllerOject->setParams($this->_params);
       
    }
 
    // CALL ACTION LOGIN
    private function callLoginAction($module = 'frontend'){
        Session::delete('user');
        require_once (MODULE_PATH . $module . DS . 'controllers' . DS . 'IndexController.php');
        $indexController = new IndexController($this->_params);
        $indexController->loginAction();
    }
    
    //  SET PARAMS
    public function setParam(){
        
        $this->_params = array_merge($_GET,$_POST);

        $this->_params['module'] 		= isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
        $this->_params['controller'] 	= isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;
        $this->_params['action'] 		= isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;
    }
    
    // LOAD DEFAULT CONTROLLER
    public function loadDefaultController(){
        $controllerName = ucfirst(DEFAULT_CONTROLLER) .'Controller';
        $actionName     = DEFAULT_ACTION .'Action';
        $path = MODULE_PATH . DEFAULT_MODULE . DS . 'controllers' . DS . $controllerName .'.php';
        if(file_exists($path)){
            require_once $path;
            $this->_controllerOject    = new $controllerName();            
            $this->_controllerOject->setView(DEFAULT_MODULE);
            $this->_controllerOject->{$actionName}();
        }    
    }
    
    //ERROR CONTROLLER
    //     public function _error(){
    //         require_once MODULE_PATH . 'default' . DS . 'controllers' . DS . 'ErrorController.php';
    //         $this->_controllerOject    = new ErrorController();
    //         $this->_controllerOject->setView('default');
    //         $this->_controllerOject->indexAction();
    //     }
    
}