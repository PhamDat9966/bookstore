<?php

class IndexController extends Controller
{

    public $_statusReturn;
    public $_arrParamOld;

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);

    }

    public function loginAction()
    {
        if (isset($this->_arrParam['form']['token'])) {
            if ($this->_arrParam['form']['token'] > 0) {

                $validate   =   new Validate($this->_arrParam['form']);
                $username   =   $this->_arrParam['form']['username'];
                $password   =   $this->_arrParam['form']['password'];

                $query      =   "SELECT `id` FROM `user` WHERE `username` = '$username' AND `password` = '$password'";

                $validate->addRule('username', 'existRecord', array('database' => $this->_model, 'query' => $query))
                         ->addRule('password', 'existRecord', array('database' => $this->_model, 'query' => $query));
                $validate->run();

                if ($validate->isValid() == true) {

                    $infoUser           = $this->_model->infoItem($this->_arrParam);

                    $arraySession       = array(
                        'login'     => true,
                        'info'      => $infoUser,
                        'username'  => $infoUser['username'],
                        'time'      => time(),
                        'group_acp' => $infoUser['group_acp']
                    );
                    Session::set('user', $arraySession);
                    URL::redirect('backend', 'index', 'index');
                } else {
                    $this->_view->errors    = $validate->showErrors();
                }
            }
        }

        $this->_view->_title        = 'Index: Admin Login';
        $this->_view->_tag          = 'login'; //for Sidebar

        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('login.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('index/login', true);
    }

    public function indexAction()
    {
        $this->_view->_tag  = 'dashboard';

        $this->_view->_arrParam       = $this->_model->countFilterSearch();

        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('index/index', true);
    }
    
    public function logoutAction()
    {
        Session::destroy();
        URL::redirect('backend', 'index', 'login');
    }
    
    public function profileAction($option = null)
    {
        
        $this->_view->_title        = 'Details';
        $this->_view->_tag          = 'Details';
        
        $userObj    =   Session::get('user');
        $this->_view->arrParam['form'] = $userObj['info'];
        
        if (@$this->_arrParam['form']['token'] > 0) {
            $taskAction          = 'add';
            $queryUserName       = "SELECT `id` FROM `" . TBL_USER . "` WHERE `username`   = '" . $this->_arrParam['form']['username'] . "'";
            $queryEmailName      = "SELECT `id` FROM `" . TBL_USER . "` WHERE `email`      = '" . $this->_arrParam['form']['email'] . "'";
            
            if (isset($this->_arrParam['form']['id'])) {
                $taskAction      = 'edit';
                $queryUserName  .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
                $queryEmailName .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
            }
            
            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('username', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25))
                     ->addRule('email', 'email-notExistRecord', array('database' => $this->_model, 'query' => $queryEmailName, 'min' => 3, 'max' => 25))
                     ->addRule('fullname', 'string', array('min' => 3, 'max' => 255));
            
            $validate->run();
            
            $this->_arrParam['form'] = $validate->getResult();
            
            if ($validate->isValid() == false) {
                $this->_view->errors    = $validate->showErrors();
            } else {
                
                $task = (isset($this->_arrParam['form']['id']) ? 'edit' : 'add');
                if (isset($this->_arrParam['task'])) {
                    $task = $this->_arrParam['task'];
                }
                
                $id      = $this->_model->saveItem($this->_arrParam, array('task' => $task));
                $type    = $this->_arrParam['type'];        
                
                $_SESSION['user']['info']['fullname'] = $this->_arrParam['form']['fullname'];
                
                if ($type == 'save') URL::redirect('backend', 'index', 'profile', array('id', $id));
            }
        }
        
        //$this->_view->_arrParam['form'] = $this->_arrParam['form'];
        
        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('index/profile', true);
    }
    
}
