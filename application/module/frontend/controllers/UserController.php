<?php

class UserController extends Controller{
    
    public $_statusReturn;

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        
    }
      
    public  function indexAction(){
        $this->_view->_title = "This is User: IndexAction";
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('user-index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/index', true);
    }
    
}

































