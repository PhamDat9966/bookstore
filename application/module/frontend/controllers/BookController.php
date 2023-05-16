<?php

class BookController extends Controller{
    
    public $_statusReturn;
    protected  $_totalItemsPerPage = 13; //  Đặt số category xuất ra ở listCategory - Ở đây là 15, tạm thời là 5.Cần thêm vào csdl
    
    public function __construct($arrParams)
    {
        $arrParams['totalItemsPerPage'] = $this->_totalItemsPerPage;
        parent::__construct($arrParams);
        $this->setPaginationTotalItemsPerPage($arrParams);
    }
      
    public  function indexAction(){

        $this->_view->_title    = "This is Category";
        
        //Paginator
        $this->_arrParam['count']  = $this->_model->countFilterSearch($this->_arrParam);
        $this->_view->_count       = $this->_arrParam['count'];
        $this->_model->_countParam = $this->_arrParam['count'];
        
        $totalItems                = $this->_arrParam['count']['allStatus'];
        if (isset($this->_arrParam['filter'])) {
            if ($this->_arrParam['filter'] == 'active') $totalItems = $this->_arrParam['count']['activeStatus'];
            if ($this->_arrParam['filter'] == 'inactive') $totalItems = $this->_arrParam['count']['inActiveStatus'];
        }
        
        // CURRENT PAGE
        if (isset($this->_arrParam['page'])) {
            $this->_pagination['currentPage']           = $this->_arrParam['page'];
        }
        
        $this->_paginationResult                         = $this->_model->pagination($totalItems, $this->_pagination ,$arrParam = $this->_arrParam);
        
        $this->_view->Pagination    = $this->_paginationResult;
        
        $this->_view->Items  = $this->_model->listItems($this->_arrParam);
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('category.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('book/index', true);
    }
    
    public  function detailAction(){
        
        $this->_view->_title    = "This is Book";
        
        $this->_view->Pagination    = $this->_paginationResult;
        $this->_view->Book  = $this->_model->detailItem($this->_arrParam,array('task'=>'get-book-info'));
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('detail.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('book/detail', true);
    }
    
    public  function listAction(){

        $this->_view->_title    = "There are Books into one Category";
        
        //Paginator
        $this->_arrParam['count']  = $this->_model->countFilterSearch($this->_arrParam);
        $this->_view->_count       = $this->_arrParam['count'];
        $this->_model->_countParam = $this->_arrParam['count'];
        
        $totalItems                = $this->_arrParam['count']['allStatus'];
        if (isset($this->_arrParam['filter'])) {
            if ($this->_arrParam['filter'] == 'active') $totalItems = $this->_arrParam['count']['activeStatus'];
            if ($this->_arrParam['filter'] == 'inactive') $totalItems = $this->_arrParam['count']['inActiveStatus'];
        }
        
        // CURRENT PAGE
        if (isset($this->_arrParam['page'])) {
            $this->_pagination['currentPage']           = $this->_arrParam['page'];
        }
        $this->_paginationResult                         = $this->_model->pagination($totalItems, $this->_pagination ,$arrParam = $this->_arrParam);
        $this->_view->Pagination    = $this->_paginationResult;
        
        $this->_view->Items         = $this->_model->listItem($this->_arrParam,array('task'=>'book-in-cat'));
        $this->_view->bookSpecial   = $this->_model->listItem($this->_arrParam,array('task'=>'book-special'));
        
        $this->_view->categoryName  = 'TẤT CẢ SÁCH'; 
        if(isset($this->_arrParam['category_id'])){
            $this->_view->categoryName  = $this->_model->detailItem($this->_arrParam,array('task'=>'get-cat-name'));
        }

        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('book_list.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('book/list', true);
    }
    
    public  function quickViewAction(){
        //$return                      =  $this->_model->quickViewItem($this->_arrParam,array('task'=>'quick-view'));
        $return                      =  $this->_model->detailItem($this->_arrParam,array('task'=>'quick-view'));
        $return['picture']           =  UPLOAD_URL .'book' . DS .$return['picture'];
        $return   = json_encode($return);
        echo $return;
    }
    
}

































