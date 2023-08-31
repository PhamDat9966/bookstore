<?php

class CategoryController extends Controller{
    
    public $_statusReturn;
    protected  $_totalItemsPerPage = 5; 
    
    public function __construct($arrParams)
    {
        $arrParams['totalItemsPerPage'] = $this->_totalItemsPerPage;
        parent::__construct($arrParams);
        $this->setPaginationTotalItemsPerPage($arrParams);
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
      
    public  function indexAction(){

        $this->_view->_title    = "This is Category";
        
        //Created Paginator
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
        $this->_view->render('category/index', true);
    }
    
}

































