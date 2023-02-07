<?php

class UserController extends Controller{
    
    public $_statusReturn;

    public function __construct(){ 
        //parent::__construct();
          
    }
    
    public function listAction(){

        $this->_view->slbGroup= $this->_model->itemInSelectbox($this->_arrParam,$numberGroup = 6);
  
        //Bulk Action
        if(isset($_GET['selectBoxUser'])){

            if($_GET['selectBoxUser'] == 'delete'){
                $this->_model->deleteMultItem($this->_arrParam);                   
            }
            
            if($_GET['selectBoxUser'] == 'action'){
                $this->_arrParam['type'] = 1;
                $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
            }
            
            if($_GET['selectBoxUser'] == 'inactive'){
                $this->_arrParam['type'] = 0;
                $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
            }

        }
        
        // filter and search
        if(isset($_GET['filter']) || isset($_GET['search']) || isset($_GET['clear']) || isset($_GET['selectGroup'])){
            $this->filterAndSearchAction();
        } 

        // charge active, inactive userACB and status
        if(isset($_GET['id'])){
            
            $this->_arrParam['id'] = $_GET['id'];
            
            if(isset($_GET['status'])){
                $this->statusAction();
            }
            
            // Ẩn url biến get của groupACB và Status bằng cách gọi lại liên kết          
            $this->redirec($this->_arrParam['module'],$this->_arrParam['controller'],$this->_arrParam['action'],$this->_arrParam['page']);
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
        $this->_view->_title        = 'User Manager: List';
        $this->_view->_tag          = 'user'; //for Sidebar
        $this->_view->Items         = $this->_model->listItems($this->_arrParam);       
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('user-list.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/index', true);
    }

    public function statusAction(){
        $this->_arrParam['status'] = $_GET['status'];
        $this->_statusReturn = $this->_model->changeStatus($this->_arrParam);
        
        $this->_statusReturn['url'].$this->_arrParam['page'];
        $page = $this->_arrParam['page']; 
    }
    
    public function filterAndSearchAction(){
        
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
        
        if(isset($_GET['selectGroup'])){
            $status  = trim($_GET['selectGroup']);
            Session::set('selectGroup',$status);
            $this->_view->_arrParam = $this->_arrParam;
            if($_GET['selectGroup'] == 0){
                Session::delete('selectGroup');
            }
        }
        
    }
    
    public function clearAction(){
        $this->_view->_tag          = 'group';
        Session::set('search','');
        Session::set('status','');
        
    }
    
    // ACTION : ADD & EDIT
    public function formAction($option = null){
        
        // SelectGroup for User
        $setNumberGroupLimitControl  = 6;
        $this->_view->slbGroup= $this->_model->createdAndModified($this->_arrParam,$option = $setNumberGroupLimitControl);
        
        $this->_view->_title        = 'User: Add';
        
        // _arrParamOld use When save have error. _arrParamOld save error
        if(isset($this->_arrParam['form'])){
            $this->_arrParamOld['form'] = $this->_arrParam['form'];
            if(isset($this->_arrParam['form']['id'])){
                $this->_arrParam['id'] = $this->_arrParam['form']['id'];
            } 
        }
        
        if(isset($this->_arrParam['id'])){
            $this->_view->_title  = 'User: Edit';
            
            // For Case Save-close with Password = empty
            if(isset($this->_arrParam['form']['id'])){
                $this->_arrParam['id'] = $this->_arrParam['form']['id'];
            }
            
            $this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);

            // GeneratePassword
            if(isset($this->_arrParam['task'])){
                if($this->_arrParam['task'] == 'generatepass'){

                    $this->_view->_title                    = 'User: Change Password';
                    $this->_arrParam['form']['task']        = 'generatepass';
                    $this->_view->arrParam['form']['task']  = 'generatepass';
                    $this->_view->arrParam                  = $this->_arrParam;

                    require_once LIBRARY_PATH. DS ."functions.php";
                    $this->_arrParam['form']['password'] = randomString($length = 12);
                    // Call Again
                    $this->_arrParam['task'] == 'generatepass';
                    $this->_view->_title      = 'User: Change Password';

                }
            }
            
            if(empty($this->_arrParam['form'])) URL::redirect(URL::createLink('backend', 'user', 'list'));
        }
        

        if(isset($this->_arrParamOld)){
            $this->_arrParam['form'] = $this->_arrParamOld['form'];
        }
          
        if(@$this->_arrParam['form']['token'] > 0){
            $taskAction          = 'add';
            $queryUserName       = "SELECT `id` FROM `" .TBL_USER. "` WHERE `username`   = '" . $this->_arrParam['form']['username'] . "'";
            $queryEmailName      = "SELECT `id` FROM `" .TBL_USER. "` WHERE `email`      = '" . $this->_arrParam['form']['email'] . "'";
            
            if(isset($this->_arrParam['form']['id'])){
                $taskAction      = 'edit';
                $queryUserName  .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
                $queryEmailName .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
            }

            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('username', 'string-notExistRecord',array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25))
                     ->addRule('password', 'string',array('min'=>3, 'max'=>255))
                     ->addRule('email', 'email-notExistRecord',array('database' => $this->_model, 'query' => $queryEmailName, 'min' => 3, 'max' => 25))
                     ->addRule('fullname', 'string',array('min'=>3, 'max'=>255))
                     ->addRule('status','status',array('deny'=>array('default')))
                     ->addRule('group_id','status',array('deny'=>array('default')));
            
            $validate->run();
            
            $this->_arrParam['form'] = $validate->getResult();
            
            if($validate->isValid() == false){
                $this->_view->errors    = $validate->showErrors();
                
                // When it's show Error but it have generatePassword when refresh
                if(@$this->_arrParam['task'] == 'generatepass'){
                    $this->_arrParam['form']['password'] = randomString($length = 12);
                }
                
            } else {

                $task = (isset($this->_arrParam['form']['id']) ? 'edit':'add');
                if(isset($this->_arrParam['task'])){
                        $task = $this->_arrParam['task'];
                }
                
                $id      = $this->_model->saveItem($this->_arrParam,array('task'=>$task));
                $type    = $this->_arrParam['type'];
                
                if($type == 'save-close') URL::redirect(URL::createLink('backend', 'user', 'list'));
                //plus
                if($type == 'save-new') URL::redirect(URL::createLink('backend', 'user', 'form'));
                if($type == 'save') URL::redirect(URL::createLink('backend', 'user', 'form',array('id', $id)));
                
            }
            
        }
        
        $this->_view->_tag          = 'user';
        $this->_view->arrParam      = $this->_arrParam;
        
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('user-form.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/form', true);
    }
    
    public function generatePasswordAction(){
        
        require_once LIBRARY_PATH. DS ."functions.php";
        $this->_arrParam['form']['password'] = randomString($length = 12);      
        $this->_templateObj->setFolderTemplate('admin/admin_template/');
        $this->_templateObj->setFileTemplate('user-form.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/form', true);
        
    }
    
    public function deleteAction()
    {
        
        if(isset($_GET['id'])) $this->_model->deleteItem($_GET['id']);
        $this->redirec('backend','group','list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
    }
    
    
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function selectGroupForUserAction(){

        
        $arrSelectGroupForUser          = json_decode($this->_arrParam['selectGroup'], true);
        $this->_arrParam['id']          = $arrSelectGroupForUser['id'];
        $this->_arrParam['group_id']    = $arrSelectGroupForUser['group_id'];
        
        $result = $this->_model->changeGroupForUser($this->_arrParam,array('task'=>'change-ajax-group'));
        echo json_encode($result);
    }
      
}

































