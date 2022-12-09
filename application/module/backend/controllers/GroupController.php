<?php

class GroupController extends Controller{
    
    public function __construct(){ 
        //parent::__construct();
        Session::ini();
    }
    
    public function viewTemplateAction(){
        
        $this->_view->_tag          = 'group'; //for Sidebar
        $this->_view->Items         = $this->_model->listItems($this->_arrParam);
        $this->_view->Pagination    = $this->_model->pagination(4,3);
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;       
        
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('group-list.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('group/index', true);
    }
    

    public function listAction(){
        //Đếm số phần tử lọc
//         $this->_view->_count        = $this->countAction();
//         $this->_model->_count       = $this->_view->_count;
        $this->_arrParam['count']       = $this->countAction();
        
        $count = $this->_model->countItem($this->_arrParam);
        
        $this->_view->_count            = $this->_arrParam['count'];
            
        if(isset($_GET['filter']) || isset($_GET['search']) || isset($_GET['clear'])){
            $this->filterAndSearch();
        }    
        
        if(isset($_GET['id'])){
            
            $this->_arrParam['id'] = $_GET['id'];
            
            if(isset($_GET['group_acp'])){
                $this->_arrParam['group_acp'] = $_GET['group_acp'];
                $this->_groupACBReturn = $this->_model->changeGroupACB($this->_arrParam);
                
                $this->_groupACBReturn['url'].$this->_arrParam['page'];
                $page = $this->_arrParam['page'];
             }
            
            if(isset($_GET['status'])){

                $this->_arrParam['status'] = $_GET['status'];
                $this->_statusReturn = $this->_model->changeStatus($this->_arrParam);
                
                $this->_statusReturn['url'].$this->_arrParam['page'];
                $page = $this->_arrParam['page'];   
            }
            
            $this->redirec($this->_arrParam['module'],$this->_arrParam['controller'],$this->_arrParam['action'],$this->_arrParam['page']);
        }
        
        // Gọi view và Template
        $this->viewTemplateAction();
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
        $this->viewTemplateAction();
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
















