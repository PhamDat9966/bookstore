<?php

class DashboardController extends Controller
{

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_view->_tag  = 'dashboard';
        
        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function indexAction()
    {
        $this->_view->_arrParam       = $this->_model->countFilterSearch();

        $this->_view->render('dashboard/index', true);
    }


}
