<?php

class ErrorController extends Controller{
    
    public function __construct(){
        //parent::__construct();
        echo '<h3>' .__METHOD__. '</h3>';
        
    }
    
    public function indexAction(){
        echo '<h3>' .__METHOD__. '</h3>';
        $this->_view->data  = 'This is indexAction!';     
        
        echo "<pre>";
        print_r($this);
        echo "</pre>";
        
        //$this->_view->render($this->_arrParam['module'],'error/index');
        $this->_view->render('error/index');
    }
    
}