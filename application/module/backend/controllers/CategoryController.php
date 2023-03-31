<?php

class CategoryController extends Controller
{

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_view->_tag          = 'category'; //for Sidebar

    }

    public function listAction()
    {
        
        $this->_view->listUserGroupACP  = $this->_model->listUserGroupACP($this->_arrParam);     
        
        //Bulk Action
        if (isset($this->_arrParam['selectBoxCatagory'])) {
            
            $arrCid  = '';
            if(!empty($this->_arrParam['cid'])){
                foreach ($this->_arrParam['cid'] as $valueCid){
                    $arrCid .= "&cid[]=$valueCid";
                }
            }

            if ($this->_arrParam['selectBoxCatagory'] == 'delete') {
                URL::redirect('backend', 'category', 'deleteMult', NULL , $arrCid);
            }

            if ($this->_arrParam['selectBoxCatagory'] == 'action') {
                
                $strRequest = $arrCid.'&statusChoose=1';
                URL::redirect('backend', 'category', 'status', NULL ,$strRequest);
                
            }

            if ($this->_arrParam['selectBoxCatagory'] == 'inactive') {
                $this->_arrParam['type'] = 0;
                $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
            }
       }

        // filter and search
//         if (isset($_GET['filter']) || isset($_GET['search']) || isset($_GET['clear']) || isset($_GET['selectCatagoryACP'])) {
//             $this->filterAndSearchAction();
//         }

        //Odering
        if (isset($_GET['order'])) {
            $this->_model->ordering($this->_arrParam);
        }

        //Paginator
        $this->_arrParam['count']  = $this->_model->countFilterSearch();
        $this->_view->_count       = $this->_arrParam['count'];
        $this->_model->_countParam = $this->_arrParam['count'];

        $totalItems                = $this->_arrParam['count']['allStatus'];
        if (isset($_SESSION['filter'])) {
            if ($_SESSION['filter'] == 'active') $totalItems = $this->_arrParam['count']['activeStatus'];
            if ($_SESSION['filter'] == 'inactive') $totalItems = $this->_arrParam['count']['inActiveStatus'];
        }

        $currentPage               = 1;
        $totalItemsPerPage         = 5;
        $pageRange                 = 3;

        if (isset($_GET['page'])) {
            $currentPage           = $_GET['page'];
        }

        $this->_pagination                               = $this->_model->pagination($totalItems, $totalItemsPerPage, $pageRange, $currentPage);
        $this->_model->_arrParam['position']             = $this->_pagination['position'];
        $this->_model->_arrParam['totalItemsPerPage']    = $this->_pagination['totalItemsPerPage'];

        $this->_view->Pagination    = $this->_pagination;

        //end Load
        $this->_view->_title        = 'Catagorys: List Item';
        $this->_view->Items         = $this->_model->listItems($this->_arrParam);
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;

        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('category-list.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('category/index', true);
    }

    public function statusAction()
    {
        $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
        $this->redirec('backend', 'category', 'list');
    }

    public function ajaxStatusAction()
    {
        $return = json_encode($this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-status')));
        echo $return;
    }

    public function filterAndSearchAction()
    {

        if (@$_GET['clear'] != '') {
            Session::delete('search');
            $_GET['search'] = '';
        }
        if (@$_GET['filter'] == 'all') {
            Session::set('filter', '');
        }

        if (isset($_GET['search'])) {
            $search  = trim($_GET['search']);
            Session::set('search', $search);
        }

        if (isset($_GET['filter'])) {
            $status  = trim($_GET['filter']);
            Session::set('filter', $status);
        }

    }


    public function clearAction()
    {
        $this->_view->_tag          = 'category';
        Session::set('search', '');
        Session::set('status', '');
    }

    // ACTION : ADD & EDIT
    public function formAction($option = null)
    {
        
        $this->_view->_title        = 'User Categorys: Add';
        $this->_view->task          = 'add'; 

        if (isset($this->_arrParam['id'])) {
            $this->_view->_title  = 'User Categorys: Edit';
            $this->_view->task    = 'edit';  
            
            $token          = 0;
            $pictureHidden  = '';
            if(isset($this->_arrParam['form']['token'])){
                $token          = $this->_arrParam['form']['token'];
            }
            if(isset($this->_arrParam['form']['picture_hidden'])){
                $pictureHidden  = $this->_arrParam['form']['picture_hidden'];
            }
            
            $this->_arrParam['form']          = $this->_model->infoItem($this->_arrParam);
            // Reload Old Form value
            $this->_arrParam['form']['token']          = $token;
            $this->_arrParam['form']['picture_hidden'] = $pictureHidden;
            
            if (empty($this->_arrParam['form'])) URL::redirect('backend', 'category', 'list');
        }
        
        if(!empty($_FILES)) $this->_arrParam['form']['picture'] = $_FILES['picture'];

        
        if ($this->_arrParam['form']['token'] > 0) {
            
            $taskAction = 'add';
            $queryName  = "SELECT `id` FROM `" . TBL_CATEGORY . "` WHERE `name`   = '" . $this->_arrParam['form']['name'] . "'";
            
            if(isset($this->_arrParam['form']['id'])){
                $taskAction      = "edit";
                $queryName      .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
            }
            
            $validate = new Validate($this->_arrParam['form']);
            
            $validate->addRule('name', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryName, 'min' => 3, 'max' => 250))
                     ->addRule('status', 'status', array('deny' => array('default')))
                     ->addRule('picture', 'file', array('min' => 100, 'max' => 1000000, 'extension'=>array('jpg','png','jpeg')), false);
            
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            
            if ($validate->isValid() == false) {
                $this->_view->errors    = $validate->showErrors();
            } else {

                //$task = (isset($this->_arrParam['form']['id']) ? 'edit' : 'add');
                $id = $this->_model->saveItem($this->_arrParam, array('task' => $taskAction));
                $type = $this->_arrParam['type'];
                if ($type == 'save-close') URL::redirect('backend', 'category', 'list');
                //plus
                if ($type == 'save-new') URL::redirect('backend', 'category', 'form');
                if ($type == 'save') URL::redirect('backend', 'category', 'form', array('id', $id));
            }
        }

        $this->_view->arrParam      = $this->_arrParam;

        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('category-form.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('category/form', true);
    }

    public function deleteAction()
    {

        if (isset($_GET['id'])) $this->_model->deleteItem($_GET['id']);
        $this->redirec('backend', 'category', 'list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
    }
    
    public function deleteMultAction(){
        
        $this->_model->deleteMultItem($this->_arrParam);
        $this->redirec('backend', 'category', 'list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
    }
}
