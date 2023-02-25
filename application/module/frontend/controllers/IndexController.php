<?php

class IndexController extends Controller{
    
    public $_statusReturn;

    public function __construct(){ 
        //parent::__construct();    
    }
    
    public  function noticeAction(){
        
        $this->_view->arrParam  =  $this->_arrParam; 
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('notice.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('index/notice', true);// views folder
    }
      
}

































