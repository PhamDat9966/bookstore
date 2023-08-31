<?php

class IndexController extends Controller{
    
    public $_statusReturn;

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
    }
    
    public function loginAction(){
        
        $userInfo   = array();
        $logged     = '';
        $userInfo   = Session::get('user');
        
        if(!empty($userInfo)){
            if($userInfo['login'] == 'true' && $userInfo['time'] + TIME_LOGIN) // return 'True' or 'False'
            {
                URL::redirect('frontend','user', 'profile');
            }
        }
        
        //session_destroy();
        
        if (isset($this->_arrParam['form']['token'])) {
            if ($this->_arrParam['form']['token'] > 0) {
                
                $email      =   $this->_arrParam['form']['email'];
                $password   =   $this->_arrParam['form']['password'];
                $query      =   "SELECT `id` FROM `user` WHERE `email` = '$email' AND `password` = '$password'";
                
                $validate   =   new Validate($this->_arrParam['form']);
                $validate->addRule('email',     'existRecord', array('database' => $this->_model, 'query' => $query));
                $validate->run();
                
                if ($validate->isValid() == true) {
                    
                    $infoUser           = $this->_model->infoItem($this->_arrParam);
                    
                    $arraySession       = array(
                        'login'     => true,
                        'info'      => $infoUser,
                        'username'  => $infoUser['username'],
                        'status'    => $infoUser['status'],
                        'time'      => time(),
                        'group_acp' => $infoUser['group_acp']
                    );
                    Session::set('user', $arraySession);
                    URL::redirect('frontend', 'user', 'profile', null, null, null,'my-account.html');
                } else {
                    $this->_view->errors    = $validate->showErrors();
                }
            }
        }

        $this->_view->_title        = 'Index: User Login';
        $this->_view->_tag          = 'login'; //for Sidebar
        
        $this->_view->render('index/login', true);// views folder
        
    }

    public  function registerAction(){
        
        $userInfo   = array();
        $logged     = '';
        $userInfo   = Session::get('user');
        
        if(!empty($userInfo)){
            if($userInfo['login'] == 'true' && $userInfo['time'] + TIME_LOGIN) // return 'True' or 'False'
            {
                URL::redirect('frontend','index', 'profile', null , null , null , 'my-account.html');
            }
        }

        if(isset($this->_arrParam['form']['submit'])){
                     
            //URL::checkRefreshPage($this->_arrParam['form']['token'], 'frontend', 'index', 'register');
            
            $queryUserName       = "SELECT `id` FROM `" .TBL_USER. "` WHERE `username`   = '" . $this->_arrParam['form']['username'] . "'";
            $queryEmailName      = "SELECT `id` FROM `" .TBL_USER. "` WHERE `email`      = '" . $this->_arrParam['form']['email'] . "'";
            
            $validate = new Validate($this->_arrParam['form']);
            
            $validate->addRule('username', 'string-notExistRecord',array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25))
            ->addRule('email',    'email-notExistRecord',array('database' => $this->_model, 'query' => $queryEmailName, 'min' => 3, 'max' => 25))
            ->addRule('fullname', 'string',array('min'=>3, 'max'=>255))
            ->addRule('password', 'string',array('min'=>3, 'max'=>255));
            
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            
            if($validate->isValid() == false){
                $this->_view->errors    = $validate->showErrorsPublic();
                
            }else {

                $id      = $this->_model->saveItem($this->_arrParam,array('task'=>'save-register'));
                
                // Set session
                $infoUser           = $this->_model->infoItem($this->_arrParam);
                $arraySession       = array(
                    'login'     => true,
                    'info'      => $infoUser,
                    'username'  => $infoUser['username'],
                    'status'    => $infoUser['status'],
                    'time'      => time(),
                    'group_acp' => $infoUser['group_acp']
                );
                Session::set('user', $arraySession);
                
                $this->phpMailerAction();
                URL::redirect('frontend', 'index', 'notice', array('type'=>'register-success'));
                
            }
        }
        
        $this->_view->arrParam      = $this->_arrParam;
        
        $this->_view->render('index/register', true);
    }
    
    public function indexAction(){

        $this->_view->arrParam  =  $this->_arrParam; 
        
        $this->_view->_title        = 'Book Manager: List';
        $this->_view->bookSpecial         = $this->_model->listItem($this->_arrParam,array('task'=>'book-special'));
        $this->_view->bookCategoryProduct = $this->_model->listItem($this->_arrParam,array('task'=>'book-category-product'));
        $this->_view->categoryShowHome    = $this->_model->categoryShowHome($this->_arrParam,null);
        
        $this->_view->render('index/index', true);// views folder
    }

    public function listAction(){

        $this->_view->arrParam  =  $this->_arrParam; 

        $this->_view->render('index/list', true);// views folder

    }
    
    public function categoryAction(){
        
        $this->_view->arrParam  =  $this->_arrParam;
        
        $this->_view->render('index/category', true);// views folder
        
    }

    
    public  function noticeAction(){
        
        $this->_view->arrParam  =  $this->_arrParam; 
        
        $this->_view->render('index/notice', true);// views folder
    }
    
    public function logoutAction()
    {
        Session::destroy();
        URL::redirect('frontend', 'index', 'index', null , null , null , 'home.html');
    }
      
    public function phpMailerAction(){
        $this->_view->arrParam  =  $this->_arrParam;
        $this->_view->render('index/phpMailer');
    }
    
    public function activeAccountAction(){

        $infoUser  = '';
        $infoUser  = @$_SESSION['user'];
        $message     ='';
        
        if($infoUser == ''){
            $message = 'Tài khoảng chưa đăng nhập, mời bạn đăng nhập để xác nhận thông tin!';
        }
        
        if($infoUser != ''){
            
            if($infoUser['info']['status'] == 1){
                $message = 'Tài khoảng của bạn đã được xác nhận trước đó!';
            }
            
            if($infoUser['info']['status'] == 0){
                
                $idActive = $infoUser['info']['id'];
                
                $query = "UPDATE `user` SET `status` = 1 WHERE `id`=$idActive";
                $this->_model->query($query);
                
                $message = 'Cám ơn bạn đã xác nhận tài khoảng.';
            }
        }
        
        
        $status = @$_SESSION['user']['info']['status'];
        
        $this->_view->message   = $message;
        $this->_view->arrParam  =  $this->_arrParam;
        $this->_view->render('index/activeAccount');
    }
    
}

































