<?php

class GroupController extends Controller{
    
    public function __construct(){ 
        //parent::__construct();
        Session::ini();
    }
    
    public function listAction(){
        
        if(isset($_GET['filter']) || isset($_GET['search']) || isset($_GET['clear'])){
            $this->filterAndSearch();
        }    
        
        if(isset($_GET['id'])){
            
            $this->_arrParam['id'] = $_GET['id'];
            
            if(isset($_GET['group_acp'])){
                $this->groupACBAction();
            }
            
            if(isset($_GET['status'])){
                $this->statusAction();
            }
            
            $this->redirec($this->_arrParam['module'],$this->_arrParam['controller'],$this->_arrParam['action'],$this->_arrParam['page']);
        }

        //Paginator
        $this->_arrParam['count']  = $this->_model->countAll();
        $this->_view->_count       = $this->_arrParam['count'];        
        $this->_model->_countParam = $this->_arrParam['count'];

        $totalItems                = $this->_arrParam['count']['allStatus'];
        if(isset($_SESSION['filter'])) {
            if($_SESSION['filter'] == 'active') $totalItems = $this->_arrParam['count']['activeStatus'];
            if($_SESSION['filter'] == 'inactive') $totalItems = $this->_arrParam['count']['inActiveStatus'];
        }
        
        $currentPage               = 1;
        $totalItemsPerPage         = 4;
        $pageRange                 = 3;
        
        if(isset($_GET['page'])){
            $currentPage           = $_GET['page']; 
        }
        
        $this->_pagination                               = $this->_model->pagination($totalItems,$totalItemsPerPage,$pageRange,$currentPage);
        $this->_model->_arrParam['position']             = $this->_pagination['position'];
        $this->_model->_arrParam['totalItemsPerPage']    = $this->_pagination['totalItemsPerPage'];
        
        $this->_view->Pagination    = $this->_pagination;  
            
        //end Load
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
        
        $this->_groupACBReturn['url'].$this->_arrParam['page'];
        $page = $this->_arrParam['page'];
    }
    
    public function statusAction(){
        $this->_arrParam['status'] = $_GET['status'];
        $this->_statusReturn = $this->_model->changeStatus($this->_arrParam);
        
        $this->_statusReturn['url'].$this->_arrParam['page'];
        $page = $this->_arrParam['page']; 
    }
    
    public function filterAndSearch(){
        
        if(@$_GET['clear'] !=''){
            $_GET['search'] = '';
            Session::set('search','');
        }
        
        if(@$_GET['filter'] == 'all'){
            Session::set('filter','');
        }
        
        if(isset($_GET['search'])){
            $search  = trim($_GET['search']);
            Session::set('search',$search);
        }
        
        if(Session::get('search') != ''){
            $this->_view->searchValue   = Session::get('search');
        }
        
        if(isset($_GET['filter'])){
            $status  = trim($_GET['filter']);
            Session::set('filter',$status);
        }
        
    }
    
    public function countAction(){
        $count          = [];
        
        $searchQuery    = '';    
        if(isset($_SESSION['search'])){
            $searchQuery = "`name` LIKE '%".$_SESSION['search']."%'";
            
            $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE $searchQuery");
            $count['allStatus'] = $this->_model->totalItem();
            
            $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE $searchQuery AND `status` = 1");
            $count['activeStatus'] = $this->_model->totalItem();
            
            $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE $searchQuery AND `status` = 0 ");
            $count['inActiveStatus'] = $this->_model->totalItem();
            
            return $count;
        }
        
        $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."`");
        $count['allStatus'] = $this->_model->totalItem();
        
        $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE `status` = 1");
        $count['activeStatus'] = $this->_model->totalItem();
        
        $this->_model->query("SELECT COUNT(`id`) AS totalItems FROM `".TBL_GROUP."` WHERE  `status` = 0");
        $count['inActiveStatus'] = $this->_model->totalItem();
        
        //$this->_arrParam['count'] = $count;

        return $count;
    }
    
    public function clearAction(){
        $this->_view->_tag          = 'group';   
        Session::set('search','');
        Session::set('status','');

    }
    
    public function formAction($option = null){
        $this->_view->_tag          = 'group';   
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('group-form.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();   
        
        $this->_view->render('user/formInfo', true);
    }
    
    public function deleteAction()
    {
            
        if(isset($_GET['id'])) $this->_model->deleteItem($_GET['id']);
        $this->redirec('backend','group','list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
    }
    
    
    public function value_newAction(){
        echo '<h3>'.__METHOD__.'</h3>';
        
        echo "<pre>GEt";
        print_r($this->_arrParam);
        echo "</pre>";
        
        echo "<pre>GEt";
        print_r($_GET);
        echo "</pre>";
    }
    
}
















