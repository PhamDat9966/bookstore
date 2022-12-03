<?php

class DashboardController extends Controller{

    public function indexAction(){
        $this->_view->_tag = 'dashboard';   
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('dashboard/index', true);  
    }

}
















