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
            URL::redirect('frontend', 'index', 'note', array('type'=>'not-url'));
            //$this->loadDefaultController();
        }
        
    }
    
    // CALL METHOD
    public function callMethod(){
 
        $actionName         = $this->_params['action'].'Action';
        
        if(method_exists($this->_controllerOject, $actionName) == true){

            $module     = $this->_params['module'];
            $controller = $this->_params['controller'];
            $action     = $this->_params['action']; 
            
            echo $requestURL = "$module-$controller-$action";
            
            $userInfo   = array();
            $logged     = '';

            $userInfo   = Session::get('user');
            
            if(!empty($userInfo)){
               $logged     = ($userInfo['login'] == 'true' && $userInfo['time'] + TIME_LOGIN); // return 'True' or 'False'
            }

            $pageLogin  = ($controller == 'index') && ($action == 'login');                 // return 'True' or 'False'
            
            echo "<pre>";
            print_r($userInfo);
            echo "</pre>";
            
            // MODULE BACKEND
            if($module == 'backend'){

                if($logged == true){
                    
                    // Go backend: group_acp : Admin control Panel
                    if($userInfo['group_acp'] == 1){
                        if(in_array($requestURL, $userInfo['info']['privilege']) == TRUE){
                            $this->_controllerOject->$actionName();
                        }else {
                            URL::redirect('frontend','index','notice',array('type'=>'not-permission'));
                        }
                            
                    }else{
                        URL::redirect('frontend','index','notice',array('type'=>'not-permission'));
                    }

                }else{
                    
                    $this->callLoginAction($module);
                }
            
            // MODULE FRONTEND
            }else if($module == 'frontend'){
                //USER CONTROLLER - gio hang vv....
                if($controller == 'user'){
                    
                    if($logged == true){
                        $this->_controllerOject->$actionName();
                    }else {
                        
                        $this->callLoginAction($module);
                    }
                    
                }else{
                    
                    $this->_controllerOject->$actionName();
                    
                }
            }

            //$this->_controllerOject->{$actionName}();
            //$controllerOject->indexAction();

        }else{
            URL::redirect('frontend', 'index', 'notice',array('type'=>'not-url'));
            //$this->_error();
        }
        
    }
    
    // CALL ACTION LOGIN
    public function callLoginAction($module = 'frontend'){
        Session::delete('user');
        require_once MODULE_PATH . $module . DS . 'controllers' . DS . 'IndexController.php';
        $indexController    =   new IndexController($this->_params);
        $indexController->loginAction();
    }
    
    // LOAD EXISTING CONTROLLER
    public function loadExistingController($filePath, $controllerName){
        
        require_once $filePath;
        $this->_controllerOject   = new $controllerName($this->_params);
       
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
            $this->_controllerOject    = new $controllerName($this->_params);            
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