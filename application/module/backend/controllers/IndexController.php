<?php

class IndexController extends Controller{
    
    public $_statusReturn;

    public function __construct(){ 
        //parent::__construct();
          
    }
    
    public function loginAction(){
        
        $this->_view->_title        = 'Index: Admin Login';
        $this->_view->_tag          = 'login'; //for Sidebar
        
        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('login.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('index/login', true);
    }

    public function indexAction(){
        $this->_view->_tag  = 'dashboard';  
        
        $this->_view->_arrParam       = $this->_model->countFilterSearch();
        
        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('index/index', true);  
    }
      
}

































