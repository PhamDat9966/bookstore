<?php

class UserController extends Controller{
    
    public function __construct(){
        //parent::__construct();
        echo '<h3>' .__METHOD__. '</h3>';       
    }
    
    public function indexAction(){
        echo '<h3>' .__METHOD__. '</h3>';       
         $this->loadModel('admin', 'index');
         $this->_model->listItem();
         $this->_view->data = array('PHP','joomla');
         $this->_view->render('user/index');   

    }
    
    public function addAction(){
        echo '<h3>' .__METHOD__. '</h3>';
        echo '<pre>';
        print_r($this);
        echo '<pre>';
        
    }
    
}