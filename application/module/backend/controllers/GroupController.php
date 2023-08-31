<?php

class GroupController extends Controller
{

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_view->_tag          = 'group'; //for Sidebar
        
        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function listAction()
    {        
        ob_start();
        
        // Clear Search
        if(isset($this->_arrParam['clear'])) {
            
            unset($this->_arrParam['search']);
            unset($this->_arrParam['clear']);
            
            URL::redirect('backend', 'group', 'list', $params = $this->_arrParam);
        }
        
        $this->_view->listUserGroupACP  = $this->_model->listUserGroupACP($this->_arrParam);  
        
        //Bulk Action
        if (isset($this->_arrParam['selectBox'])) {
            
            $arrCid  = '';
            if(!empty($this->_arrParam['cid'])){
                foreach ($this->_arrParam['cid'] as $valueCid){
                    $arrCid .= "&cid[]=$valueCid";
                }
            }

            if ($this->_arrParam['selectBox'] == 'delete') {
                URL::redirect('backend', 'group', 'deleteMult',NULL, $arrCid);
            }else
            
            if ($this->_arrParam['selectBox'] == 'action') {
                
                $strRequest = $arrCid.'&statusChoose=1';
                URL::redirect('backend', 'group', 'status', NULL ,$strRequest);
            }else
            
            if ($this->_arrParam['selectBox'] == 'inactive') {
                
                $strRequest = $arrCid.'&statusChoose=0';
                URL::redirect('backend', 'group', 'status', NULL ,$strRequest);
            }

        }

        if(isset($this->_arrParam['selectGroupACP'])){
            if($this->_arrParam['selectGroupACP'] == 'groupACP'){
                unset($this->_arrParam['selectGroupACP']);
            }
        }
        
        // charge active, inactive groupACB and status
        if (isset($_GET['id'])) {

            $this->_arrParam['id'] = $_GET['id'];

            if (isset($_GET['group_acp'])) {
                $this->groupACBAction();
            }

            if (isset($_GET['status'])) {
                $this->statusAction();
            }

            // áº¨n url biáº¿n get cá»§a groupACB vÃ  Status báº±ng cÃ¡ch gá»�i láº¡i liÃªn káº¿t          
            $this->redirec($this->_arrParam['module'], $this->_arrParam['controller'], $this->_arrParam['action'], $this->_arrParam['page']);
        }

        //Odering
        if (isset($_GET['order'])) {
            $this->_model->ordering($this->_arrParam);
        }

        //Paginator
        $this->_arrParam['count']  = $this->_model->countFilterSearch($this->_arrParam);
        $this->_view->_count       = $this->_arrParam['count'];
        $this->_model->_countParam = $this->_arrParam['count'];

        $totalItems                = $this->_arrParam['count']['allStatus'];
        if (isset($this->_arrParam['filter'])) {
            if ($this->_arrParam['filter'] == 'active') $totalItems = $this->_arrParam['count']['activeStatus'];
            if ($this->_arrParam['filter'] == 'inactive') $totalItems = $this->_arrParam['count']['inActiveStatus'];
        }
        
        // CURRENT PAGE
        if (isset($this->_arrParam['page'])) {
            $this->_pagination['currentPage']           = $this->_arrParam['page'];       
        }
        
        $this->_paginationResult                         = $this->_model->pagination($totalItems, $this->_pagination ,$arrParam = $this->_arrParam);                     

        $this->_view->Pagination    = $this->_paginationResult;

        //end Load
        $this->_view->_title        = 'User Groups: List Item';

        $this->_view->Items         = $this->_model->listItems($this->_arrParam);
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;

        $this->_view->render('group/index', true);
        
        ob_end_flush();
    }

    public function groupACBAction()
    {
        $this->_arrParam['group_acp'] = $_GET['group_acp'];
        $this->_groupACBReturn = $this->_model->changeGroupACB($this->_arrParam, array('task' => 'change-groupACP'));

        if (isset($this->_arrParam['page'])) {
            $this->_groupACBReturn['url'] . $this->_arrParam['page'];
            $page = $this->_arrParam['page'];
        }
    }

    public function statusAction()
    {

        $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
        $this->redirec('backend', 'group', 'list');
    }
    
    public function ajaxOrderingAction()
    {
        $return = json_encode($this->_model->changeOrdering($this->_arrParam, $option = array('task' => 'change-ajax-ordering')));
        echo $return;
    }

    public function ajaxGroupACPAction()
    {
        $return = json_encode($this->_model->changeGroupACB($this->_arrParam, $option = array('task' => 'change-ajax-groupACP')));
        echo $return;
    }

    public function ajaxStatusAction()
    {
        $return = json_encode($this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-status')));
        echo $return;
    }

    public function clearAction()
    {
        $this->_view->_tag          = 'group';
        Session::set('search', '');
        Session::set('status', '');
    }

    // ACTION : ADD & EDIT
    public function formAction($option = null)
    {
        
        $this->_view->_title        = 'User Groups: Add';
        $this->_view->task          = 'add'; 
        
        //* _arrParamOld use When is save but have error. _arrParamOld save error*//
        if (isset($this->_arrParam['form'])) {
            $this->_arrParamOld['form'] = $this->_arrParam['form'];
            if (isset($this->_arrParam['form']['id'])) {
                $this->_arrParam['id'] = $this->_arrParam['form']['id'];
            }
        }

        if (isset($this->_arrParam['id'])) {
            $this->_view->_title  = 'User Groups: Edit';
            $this->_view->task    = 'edit';  
            $this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
            if (empty($this->_arrParam['form'])) URL::redirect('backend', 'group', 'list');
        }

        //* use _arrParamOld *//
        if (isset($this->_arrParamOld)) {
            $this->_arrParam['form'] = $this->_arrParamOld['form'];
        }

        if (@$this->_arrParam['form']['token'] > 0) {
            
            $taskAction = 'add';
            $queryName  = "SELECT `id` FROM `" . TBL_GROUP . "` WHERE `name`   = '" . $this->_arrParam['form']['name'] . "'";
            
            if(isset($this->_arrParam['form']['id'])){
                $taskAction      = "edit";
                $queryName  .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
            }
            
            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('name', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryName, 'min' => 3, 'max' => 25))
                     ->addRule('status', 'status', array('deny' => array('default')))
                     ->addRule('group_acp', 'status', array('deny' => array('default')));
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();

            if ($validate->isValid() == false) {
                $this->_view->errors    = $validate->showErrors();
            } else {

                //$task = (isset($this->_arrParam['form']['id']) ? 'edit' : 'add');
                $id = $this->_model->saveItem($this->_arrParam, array('task' => $taskAction));
                $type = $this->_arrParam['type'];
                if ($type == 'save-close') URL::redirect('backend', 'group', 'list');
                //plus
                if ($type == 'save-new') URL::redirect('backend', 'group', 'form');
                if ($type == 'save') URL::redirect('backend', 'group', 'form', array('id', $id));
            }
        }

        $this->_view->_tag          = 'group';
        $this->_view->arrParam      = $this->_arrParam;

        $this->_view->render('group/form', true);
    }

    public function deleteAction()
    {

        if (isset($_GET['id'])) $this->_model->deleteItem($_GET['id']);
        $this->redirec('backend', 'group', 'list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
    }
    
    public function deleteMultAction(){
        
        $this->_model->deleteMultItem($this->_arrParam);
        $this->redirec('backend', 'group', 'list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
    }
    
    public function errorAction(){
        $this->_view->render('error/error', true);
    }
}
