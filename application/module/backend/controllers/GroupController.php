<?php

class GroupController extends Controller{
    
    public function __construct(){ 
        //parent::__construct();
          
    }
    
    public function listAction(){

        //Bulk Action
        if(isset($_GET['selectBox'])){


            if($_GET['selectBox'] == 'delete'){
                $this->_model->deleteMultItem($this->_arrParam);                   
            }
            
            if($_GET['selectBox'] == 'action'){
                $this->_arrParam['type'] = 1;
                $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
            }
            
            if($_GET['selectBox'] == 'inactive'){
                $this->_arrParam['type'] = 0;
                $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
                //URL::redirect(URL::createLink('admin', 'group', 'index'));
            }

        }
        
        // filter and search
        if(isset($_GET['filter']) || isset($_GET['search']) || isset($_GET['clear']) || isset($_GET['selectGroupACP'])){
            $this->filterAndSearch();
        }    

        // charge active, inactive groupACB and status
        if(isset($_GET['id'])){
            
            $this->_arrParam['id'] = $_GET['id'];
            
            if(isset($_GET['group_acp'])){
                $this->groupACBAction();
            }
            
            if(isset($_GET['status'])){
                $this->statusAction();
            }
            
            // Ẩn url biến get của groupACB và Status bằng cách gọi lại liên kết          
            $this->redirec($this->_arrParam['module'],$this->_arrParam['controller'],$this->_arrParam['action'],$this->_arrParam['page']);
        }
        
        //Odering
        if(isset($_GET['order'])){
            $this->_model->ordering($this->_arrParam);
        }      

        //Paginator
        $this->_arrParam['count']  = $this->_model->countFilterSearch();
        $this->_view->_count       = $this->_arrParam['count'];        
        $this->_model->_countParam = $this->_arrParam['count'];

        $totalItems                = $this->_arrParam['count']['allStatus'];
        if(isset($_SESSION['filter'])) {
            if($_SESSION['filter'] == 'active') $totalItems = $this->_arrParam['count']['activeStatus'];
            if($_SESSION['filter'] == 'inactive') $totalItems = $this->_arrParam['count']['inActiveStatus'];
        }
        
        $currentPage               = 1;
        $totalItemsPerPage         = 5;
        $pageRange                 = 3;
        
        if(isset($_GET['page'])){
            $currentPage           = $_GET['page'];
        }
        
        $this->_pagination                               = $this->_model->pagination($totalItems,$totalItemsPerPage,$pageRange,$currentPage);
        $this->_model->_arrParam['position']             = $this->_pagination['position'];
        $this->_model->_arrParam['totalItemsPerPage']    = $this->_pagination['totalItemsPerPage'];
        
        $this->_view->Pagination    = $this->_pagination;  
            
        //end Load
        $this->_view->_title        = 'User Groups: List Item';
        $this->_view->_tag          = 'group'; //for Sidebar
        $this->_view->Items         = $this->_model->listItems($this->_arrParam);       
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('group-list.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('group/index', true);
    }
    
    public function groupACBAction(){
        $this->_arrParam['group_acp'] = $_GET['group_acp'];
        $this->_groupACBReturn = $this->_model->changeGroupACB($this->_arrParam);
        // $this->_arrParam['page'] lấy từ Paginator
        if (isset($this->_arrParam['page'])){
            $this->_groupACBReturn['url'].$this->_arrParam['page'];
            $page = $this->_arrParam['page'];
        }    
    }
    
    public function statusAction(){
        $this->_arrParam['status'] = $_GET['status'];
        $this->_statusReturn = $this->_model->changeStatus($this->_arrParam);
        
        $this->_statusReturn['url'].$this->_arrParam['page'];
        $page = $this->_arrParam['page']; 
    }
    
    public function filterAndSearch(){
        
        if(@$_GET['clear'] !=''){
            Session::delete('search');
            $_GET['search'] = '';
        }
        if(@$_GET['filter'] == 'all'){
            Session::set('filter','');
        }
        
        if(isset($_GET['search'])){
            $search  = trim($_GET['search']);
            Session::set('search',$search);
        }
        
        if(isset($_GET['filter'])){
            $status  = trim($_GET['filter']);
            Session::set('filter',$status);
        }
        
        if(isset($_GET['selectGroupACP'])){
            $status  = trim($_GET['selectGroupACP']);
            Session::set('selectGroupACP',$status);
            $this->_view->_arrParam = $this->_arrParam;
        }
        
    }
    
//     public function countAction(){
//         $count          = [];
//         $queryCount     = [];
        
//         $flagWhere      = false;
//         $searchQuery    = '';    
//         if(isset($_SESSION['search'])){
//             $searchQuery = "`name` LIKE '%".$_SESSION['search']."%'";
            
//             $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE $searchQuery");
//             $count['allStatus'] = $this->_model->totalItem();
            
//             $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE $searchQuery AND `status` = 1");
//             $count['activeStatus'] = $this->_model->totalItem();
            
//             $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE $searchQuery AND `status` = 0 ");
//             $count['inActiveStatus'] = $this->_model->totalItem();
            
//             return $count;
//         }
        
//         $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."`");
//         $count['allStatus'] = $this->_model->totalItem();
        
//         $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE `status` = 1");
//         $count['activeStatus'] = $this->_model->totalItem();
        
//         $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE  `status` = 0");
//         $count['inActiveStatus'] = $this->_model->totalItem();
        
//         return $count;
//     }
    
    public function clearAction(){
        $this->_view->_tag          = 'group';   
        Session::set('search','');
        Session::set('status','');

    }
    
    // ACTION : ADD & EDIT
    public function formAction($option = null){
        
        $this->_view->_title        = 'User Groups: Add';
        
        if(isset($this->_arrParam['id'])){
            $this->_view->_title  = 'User Groups: Edit';
            $this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
            if(empty($this->_arrParam['form'])) URL::redirect(URL::createLink('backend', 'group', 'list'));
        }

        if(@$this->_arrParam['form']['token'] > 0){
            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('name', 'string',array('min'=>3, 'max'=>255))
                     ->addRule('status','status',array('deny'=>array('default')))
                     ->addRule('group_acp','status',array('deny'=>array('default')));   
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            
            if($validate->isValid() == false){
                $this->_view->errors    = $validate->showErrors();
            } else {

                $task = (isset($this->_arrParam['form']['id']) ? 'edit':'add');
                $id = $this->_model->saveItem($this->_arrParam,array('task'=>$task));
                $type = $this->_arrParam['type'];
                if($type == 'save-close') URL::redirect(URL::createLink('backend', 'group', 'list'));
                //plus
                if($type == 'save-new') URL::redirect(URL::createLink('backend', 'group', 'form'));
                if($type == 'save') URL::redirect(URL::createLink('backend', 'group', 'form',array('id', $id)));
                
            }

        }
        
        $this->_view->_tag          = 'group'; 
        $this->_view->arrParam      = $this->_arrParam;    
            
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('group-form.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();   
        
        $this->_view->render('group/form', true);
    }
    
    public function deleteAction()
    {
            
        if(isset($_GET['id'])) $this->_model->deleteItem($_GET['id']);
        $this->redirec('backend','group','list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
    }
    
}
















