<?php

class UserController extends Controller{
    
    public $_statusReturn;

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        
    }
    
    
    public  function indexAction(){
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/index', true);
    }
    
    public  function registerAction(){
        
        if(isset($this->_arrParam['form']['submit'])){
            
            URL::checkRefreshPage($this->_arrParam['form']['token'], 'frontend', 'user', 'register');
            
            $queryUserName       = "SELECT `id` FROM `" .TBL_USER. "` WHERE `username`   = '" . $this->_arrParam['form']['username'] . "'";
            $queryEmailName      = "SELECT `id` FROM `" .TBL_USER. "` WHERE `email`      = '" . $this->_arrParam['form']['email'] . "'";
            
            $validate = new Validate($this->_arrParam['form']);

            $validate->addRule('username', 'string-notExistRecord',array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25))  
                     ->addRule('email',    'email-notExistRecord',array('database' => $this->_model, 'query' => $queryEmailName, 'min' => 3, 'max' => 25))
                     ->addRule('fullname', 'string',array('min'=>3, 'max'=>255))
                     ->addRule('password', 'string',array('min'=>3, 'max'=>255));
                     //->addRule('password', 'password',array('action'->'add'));
                     
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            
            if($validate->isValid() == false){
                $this->_view->errors    = $validate->showErrorsPublic();
                
            }else {
        
                $id      = $this->_model->saveItem($this->_arrParam,array('task'=>'save-register'));
                URL::redirect('frontend', 'index', 'notice', array('type'=>'register-success'));

            }
        }
        
        $this->_view->arrParam      = $this->_arrParam;
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('register.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/register', true);
    }
    
    public function loginAction(){
        
        echo "<pre>";
         print_r($this->_arrParam);
        echo "</pre>";
        
        echo "<pre>Session";
         print_r($_SESSION);
        echo "</pre>";
        
        //session_destroy();
        
        
        if (isset($this->_arrParam['form']['token'])) {
            if ($this->_arrParam['form']['token'] > 0) {
                        
                $email      =   $this->_arrParam['form']['email'];
                $password   =   $this->_arrParam['form']['password'];
                echo $query      =   "SELECT `id` FROM `user` WHERE `email` = '$email' AND `password` = '$password'";

                $validate   =   new Validate($this->_arrParam['form']);
                $validate->addRule('email',     'existRecord', array('database' => $this->_model, 'query' => $query))
                         ->addRule('password',  'existRecord', array('database' => $this->_model, 'query' => $query));
                $validate->run();
                
                if ($validate->isValid() == true) {
                    
                    $infoUser           = $this->_model->infoItem($this->_arrParam);
                    
                    $arraySession       = array(
                        'login'     => true,
                        'info'      => $infoUser,
                        'time'      => time(),
                        'group_acp' => $infoUser['group_acp']
                    );
                    Session::set('user', $arraySession);
                    URL::redirect('frontend', 'user', 'login');
                } else {
                    $this->_view->errors    = $validate->showErrors();
                }
            }
        }
        
        $this->_view->arrParam  =  $this->_arrParam; 
        
        $this->_view->_title        = 'Index: Admin Login';
        $this->_view->_tag          = 'login'; //for Sidebar
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('login.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/login', true);// views folder
        
    }
    
}

































