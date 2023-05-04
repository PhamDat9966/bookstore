<?php

class CategoryModel extends Model
{
    public $_arrParam;
    public $_saveParam = [];
    protected $_tableName = TBL_CATEGORY;
    public    $_cunrrentPage      = 1;
    private $_userInfo;
    private $_columns = array('id','name','picture','created','created_by','modified','modified_by','status','ordering');
                            
    
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_tableName);
        
    }
    
    public function listItems($arrParam,$option = null)
    {
        //$totalItemsCount = $arrParam['count']['allStatus'];
        
        $queryContent   = [];
        $queryContent[] = "SELECT `id`,`name`,`picture`";
        $queryContent[] = "FROM `$this->_tableName`";
        $queryContent[] = "WHERE `status`  = 1";
        
        $position           = $this->_arrParam['position'];
        $totalItemsPerPage  = $this->_arrParam['totalItemsPerPage'];
        
        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        $queryContent = implode(" ", $queryContent);
        $result = $this->fetchAll($queryContent);
        return $result;
    }
    
    public function infoItem($arrParam,$option = NULL){
        $queryContent   = [];
        $queryContent[] = "SELECT `b`.`id`,`b`.`name`,`b`.`shortDescription`,`b`.`description`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,`b`.`category_id`,`b`.`created`,`b`.`created_by`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`special`,`b`.`ordering`,`c`.`name` AS `category_name`";
        $queryContent[] = "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".$this->_tableName."` AS `c` ON `b`.`category_id` = `c`.`id`";
        $queryContent[] = "WHERE `b`.`id` > 0";
        $queryContent[] = "AND `b`.`category_id` = ".$arrParam['category_id']."";
        
        $position           = $this->_arrParam['position'];
        $totalItemsPerPage  = $this->_arrParam['totalItemsPerPage'];
        
        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchAll($queryContent);
        return $result;
    }
    
    public function saveItem($arrParam, $option = null){
        
        if($option['task'] == 'save-register'){
            
            $arrParam['form']['register_date']  =   date("Y-m-d H:m:s",time());
            $arrParam['form']['register_ip']    =   $_SERVER['REMOTE_ADDR'];
            $arrParam['form']['status']         =   0;
            
            $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Đã thêm dữ liệu thành công!'));
            return $this->lastID();
        }
    }
    
    public function countFilterSearch($arrParam){
        
        $count          = array();
        $searchQuery    = '';
        
        // ALL STATUS
        $queryContentallStatus   = [];
        $queryContentallStatus[] = "SELECT COUNT(`id`) AS totalItems";
        $queryContentallStatus[] = "FROM `$this->_tableName`";
        $queryContentallStatus[] = "WHERE `id` > 0";
        
        if(!empty($arrParam['search'])){
            $keyword            = '"%'.$arrParam['search'].'%"';
            $queryContentallStatus[]     = "AND (`name` LIKE $keyword)";
        }
        
        if(isset($arrParam['selectCategory'])){
            if($arrParam['selectCategory'] != '0'){
                $queryContentallStatus[]    = "AND `category_id`= '".$arrParam['selectCategory']."'";
            }
        }
        
        if(isset($arrParam['selectSpecial'])){
            if($arrParam['selectSpecial'] == 1)     $queryContentallStatus[]    = 'AND `special`= 1';
            if($arrParam['selectSpecial'] == 0)     $queryContentallStatus[]    = 'AND `special`= 0';
        }
        
        $queryContentallStatus = implode(" ", $queryContentallStatus);
        $this->query($queryContentallStatus);
        $count['allStatus'] = $this->totalItem();
        
        // ACTIVE
        $queryContentActive   = [];
        $queryContentActive[] = "SELECT COUNT(`id`) AS totalItems";
        $queryContentActive[] = "FROM `$this->_tableName`";
        $queryContentActive[] = "WHERE `id` > 0";
        
        if(!empty($arrParam['search'])){
            $keyword            = '"%'.$arrParam['search'].'%"';
            $queryContentActive[]     = "AND (`name` LIKE $keyword)";
        }
        
        $queryContentActive[]    = 'AND `status`= 1';
        
        if(isset($arrParam['selectCategory'])){
            if($arrParam['selectCategory'] != '0'){
                $queryContentActive[]    = "AND `category_id`= '".$arrParam['selectCategory']."'";
            }
        }
        
        if(isset($arrParam['selectSpecial'])){
            if($arrParam['selectSpecial'] == 1)     $queryContentActive[]    = 'AND `special`= 1';
            if($arrParam['selectSpecial'] == 0)     $queryContentActive[]    = 'AND `special`= 0';
        }
        
        $queryContentActive = implode(" ", $queryContentActive);
        $this->query($queryContentActive);
        $count['activeStatus'] = $this->totalItem();
        
        // INACTIVE
        $queryContentInActive   = [];
        $queryContentInActive[] = "SELECT COUNT(`id`) AS totalItems";
        $queryContentInActive[] = "FROM `$this->_tableName`";
        $queryContentInActive[] = "WHERE `id` > 0";
        
        if(!empty($arrParam['search'])){
            $keyword            = '"%'.$arrParam['search'].'%"';
            $queryContentInActive[]     = "AND (`name` LIKE $keyword)";
        }
        
        $queryContentInActive[]    = 'AND `status`= 0';
        
        if(isset($arrParam['selectCategory'])){
            if($arrParam['selectCategory'] != '0'){
                $queryContentInActive[]    = "AND `category_id`= '".$arrParam['selectCategory']."'";
            }
        }
        
        if(isset($arrParam['selectSpecial'])){
            if($arrParam['selectSpecial'] == 1)     $queryContentInActive[]    = 'AND `special`= 1';
            if($arrParam['selectSpecial'] == 0)     $queryContentInActive[]    = 'AND `special`= 0';
        }
        
        $queryContentInActive = implode(" ", $queryContentInActive);
        $this->query($queryContentInActive);
        $count['inActiveStatus'] = $this->totalItem();
        
        return $count;
    }
    
    public function pagination($totalItems, $pagination, $arrParam)
    {
        unset($arrParam['module']);
        unset($arrParam['controller']);
        unset($arrParam['action']);
        
        $resulfPagination = [];
        $currentPage = (isset($arrParam['page'])) ? $arrParam['page'] : 1;
        $this->_cunrrentPage = $currentPage;
        
        $paginator = new Pagination($totalItems, $pagination);
        $paginationHTML = $paginator->showPagination(URL::createLink('frontend', 'category', 'index', $arrParam));
        
        $position = ($currentPage - 1) * $pagination['totalItemsPerPage'];
        $resulfPagination['position'] = $position;
        $resulfPagination['totalItemsPerPage'] = $pagination['totalItemsPerPage'];
        $resulfPagination['paginationHTML'] = $paginationHTML;
        
        // Send for 'public function listItems'
        $this->_arrParam['position']             = $resulfPagination['position'];
        $this->_arrParam['totalItemsPerPage']    = $resulfPagination['totalItemsPerPage'];
        
        return $resulfPagination;
    }
}


















