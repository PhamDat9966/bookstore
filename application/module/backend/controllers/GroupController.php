<?php

class GroupController extends Controller{

    public function listAction(){
        
        echo "<pre>Parramttt";
        print_r($this->_arrParam);
        echo "</pre>";
        
        //$this->_view->_title        = 'User Manager: User Group';
        $this->_view->Items         = $this->_model->listItems($this->_arrParam);
        $this->_view->Pagination    = $this->_model->pagination(4,3);
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
        //$this->_view->ItemsFilter   = $this->_model->listItemsFiter();
        
        if(isset($_GET['search'])){
            $search  = trim($_GET['search']);
            $this->_view->searchValue       = trim($_GET['search']);;
        }
        
//         if(isset($_GET['status'])){
//             $this->_arrParam['status']  = trim($_GET['status']);
//             $this->_view->Items         = $this->_model->listItems($arrParam = $this->_arrParam['status']);
//         }
        
        
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
        
              
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('group-list.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('group/index', true);
   
    }
    
    public function formAction($option = null){
        
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
















