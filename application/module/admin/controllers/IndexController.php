<?php

class IndexController extends Controller{
    
    public function __construct(){
       // parent::__construct();
        echo '<h3>' .__METHOD__. '</h3>';
        
    }
    
    public function indexAction(){
        echo '<h3>' .__METHOD__. '</h3>';
        
        $this->loadModel('admin', 'index');
        $this->_model->listItem();
        $this->_view->render('index/index');  
    }
    
    public function addAction(){
        echo '<h3>' .__METHOD__. '</h3>';
        $this->_view->render('index/index');  
    }
}