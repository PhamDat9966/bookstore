<?php

class UserController extends Controller{
    
    public $_statusReturn;

    public function __construct(){ 
        //parent::__construct();    
    }
    
    public  function indexAction(){
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/index', true);
    }

    public  function registerAction(){
//         echo "<pre>register";
//          print_r($this->_arrParam);
//         echo "</pre>";
        
        if(isset($this->_arrParam['form']['submit'])){
            if(Session::get('token') == $this->_arrParam['form']['token']){
                Session::delete('token');
                URL::redirect('frontend', 'user', 'register');
            }else{
                Session::set('token', $this->_arrParam['form']['token']);
            }
            
            $queryUserName       = "SELECT `id` FROM `" .TBL_USER. "` WHERE `username`   = '" . $this->_arrParam['form']['username'] . "'";
            $queryEmailName      = "SELECT `id` FROM `" .TBL_USER. "` WHERE `email`      = '" . $this->_arrParam['form']['email'] . "'";
            
            $validate = new Validate($this->_arrParam['form']);

            $validate->addRule('username', 'string-notExistRecord',array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25))  
                     ->addRule('email',    'email-notExistRecord',array('database' => $this->_model, 'query' => $queryEmailName, 'min' => 3, 'max' => 25))
                     ->addRule('password', 'string',array('min'=>3, 'max'=>255));
                     //->addRule('password', 'password',array('action'->'add'));
                     
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            
            if($validate->isValid() == false){
                $this->_view->errors    = $validate->showErrorsPublic();
                
            }else {
                
//                 die('DIE');
                
//                 $id      = $this->_model->saveItem($this->_arrParam,array('task'=>$task));
                   $type    = $this->_arrParam['type'];
                
                if($type == 'save-close') URL::redirect('backend', 'user', 'list');
                //plus
                if($type == 'save-new') URL::redirect('backend', 'user', 'form');
                if($type == 'save') URL::redirect('backend', 'user', 'form',array('id', $id));
                
            }
        }
        
        $this->_view->arrParam      = $this->_arrParam;
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('register.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/register', true);
    }
      
}

































