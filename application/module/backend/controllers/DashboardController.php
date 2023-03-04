<?php

class DashboardController extends Controller
{

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        Session::delete('filter');
        Session::delete('selectGroupACP');
        Session::delete('selectGroup');
        Session::delete('status');
        Session::delete('search');
    }

    public function indexAction()
    {

        $this->_view->_tag  = 'dashboard';

        $this->_view->_arrParam       = $this->_model->countFilterSearch();

        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('dashboard/index', true);
    }


}
