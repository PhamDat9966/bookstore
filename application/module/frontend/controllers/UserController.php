<?php

class UserController extends Controller{
    
    public $_statusReturn;

    public function __construct(){ 
        //parent::__construct();    
    }
    
    public  function indexAction(){
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/index', true);
    }

    public  function registerAction(){
        echo "<pre>";
         print_r($this);
        echo "</pre>";
        echo "<pre>GEt";
         print_r($_GET);
        echo "</pre>";
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('register.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/register', true);
    }
      
}

































