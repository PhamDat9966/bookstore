<?php

class BookModel extends Model
{
    public $_arrParam;
    public $_saveParam = [];
    protected $_tableName = TBL_BOOK;
    public    $_cunrrentPage      = 1;
    private $_userInfo;
    private $_columns = array('id','name','picture','created','created_by','modified','modified_by','status','ordering');
                            
    
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_tableName);
        
    }

    public function listItem($arrParam,$option = NULL){
        if($option['task'] == 'book-in-cat'){

            $queryContent   = [];
            $queryContent[] = "SELECT `b`.`id`,`b`.`name`,`b`.`shortDescription`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,(`b`.`price`-`b`.`price`*`b`.`sale_off`/100) AS `priceReal`,`b`.`category_id`,`b`.`created`,`b`.`created_by`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`special`,`b`.`ordering`,`c`.`name` AS `category_name`";
            $queryContent[] = "FROM `".$this->_tableName."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
            $queryContent[] = "WHERE `b`.`status` = 1";
            
            if(isset($arrParam['category_id'])){
                $queryContent[] = "AND `b`.`category_id` = ".$arrParam['category_id']."";
            }
            if(isset($arrParam['search'])){
                $keyword            = '"%'.$arrParam['search'].'%"';
                $queryContent[]     = "AND (`b`.`name` LIKE $keyword)";
            }
            
            if(@$arrParam['sort'] == 'default'){
                unset($arrParam['sort']);
            }
            
            if(isset($arrParam['sort'])){
                //$priceReal  =                  
                
                if($arrParam['sort'] == 'price_asc'){
                    $queryContent[]     = 'ORDER BY `priceReal` ASC';
                } elseif ($arrParam['sort'] == 'price_desc'){
                    $queryContent[]     = 'ORDER BY `priceReal` DESC';
                }
                
                if($arrParam['sort'] == 'latest'){
                    $queryContent[]     = 'ORDER BY `created` DESC';
                }
                
                
            } else{
                $queryContent[]     = 'ORDER BY `ordering` ASC';
            }
            
            $position           = $this->_arrParam['position'];
            $totalItemsPerPage  = $this->_arrParam['totalItemsPerPage'];
            $queryContent[]     = "LIMIT $position,$totalItemsPerPage";
            
            $queryContent       = implode(" ", $queryContent);
            $result = $this->fetchAll($queryContent);
            return $result;
        }
        
        if($option['task'] == 'book-special'){
            $queryContent   = [];
            $queryContent[] = "SELECT `b`.`id`,`b`.`name`,`b`.`shortDescription`,`b`.`description`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,`b`.`category_id`,`b`.`created`,`b`.`created_by`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`special`,`b`.`ordering`,`c`.`name` AS `category_name`";
            $queryContent[] = "FROM `".$this->_tableName."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
            $queryContent[] = "WHERE `b`.`status` = 1 AND `b`.`special` = 1";
            $queryContent[]     = 'ORDER BY `ordering` ASC';
            
            $queryContent       = implode(" ", $queryContent);
            
            $result = $this->fetchAll($queryContent);
            return $result;
        }
        
    }
    
    
    public function quickViewItem($arrParam, $option = null){
        
        $queryContent   = [];
        $queryContent[] = "SELECT `id`,`name`,`shortDescription`,`description`,`picture`,`sale_off`,`price`";
        $queryContent[] = "FROM `$this->_tableName`";
        $queryContent[] = "WHERE `id` = ".$arrParam['id']."";
        $queryContent = implode(" ", $queryContent);
        $result = $this->fetchRow($queryContent);
        return $result;
        
    }
    
    public function detailItem($arrParam, $option = null){
        if($option == null){
            $queryContent   = [];
            $queryContent[] = "SELECT `id`,`name`,`shortDescription`,`description`,`picture`,`sale_off`,`price`";
            $queryContent[] = "FROM `$this->_tableName`";
            $queryContent[] = "WHERE `id` = ".$arrParam['id']."";
            $queryContent = implode(" ", $queryContent);
            $result = $this->fetchAll($queryContent);
            return $result;
        }
        
        if($option['task'] == 'quick-view'){
            $queryContent   = [];
            $queryContent[] = "SELECT `id`,`name`,`shortDescription`,`description`,`picture`,`sale_off`,`price`";
            $queryContent[] = "FROM `$this->_tableName`";
            $queryContent[] = "WHERE `id` = ".$arrParam['book_id']."";
            $queryContent = implode(" ", $queryContent);
            $result = $this->fetchRow($queryContent);
            return $result;
        }
        
        if($option['task'] == 'get-book-info'){
            $queryContent   = [];
            $queryContent[] = "SELECT `id`,`name`,`shortDescription`,`description`,`picture`,`sale_off`,`price`,`category_id`";
            $queryContent[] = "FROM `$this->_tableName`";
            $queryContent[] = "WHERE `id` = ".$arrParam['book_id']."";
            $queryContent   = implode(" ", $queryContent);
            $result         = $this->fetchRow($queryContent);
            return $result;
        }
        
        if($option['task'] == 'get-cat-name'){
            
            $queryContent   = [];
            $queryContent[] = "SELECT `name`";
            $queryContent[] = "FROM `".TBL_CATEGORY."`";
            $queryContent[] = "WHERE `id` = ".$arrParam['category_id']."";
            $queryContent   = implode(" ", $queryContent);
            $result         = $this->fetchRow($queryContent);
            return $result['name'];
        }
        
    }
    
    public function countFilterSearch($arrParam){
        
        $count          = array();
        $searchQuery    = '';
        
        // STATUS = 1
        $queryContent   = [];
        $queryContent[] = "SELECT COUNT(`id`) AS totalItems";
        $queryContent[] = "FROM `$this->_tableName`";
        $queryContent[] = "WHERE `status` = 1";
        
        if(!empty($arrParam['search'])){
            $keyword                    = '"%'.$arrParam['search'].'%"';
            $queryContent[]    = "AND (`name` LIKE $keyword)";
        }
        
        if(isset($arrParam['category_id'])){
            if($arrParam['category_id'] != '0'){
                $queryContent[]    = "AND `category_id`= '".$arrParam['category_id']."'";
            }
        }
        
        $queryContent = implode(" ", $queryContent);
        $this->query($queryContent);
        $count['totalItem'] = $this->totalItem();

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
        $paginationHTML = $paginator->showPagination(URL::createLink('frontend', 'book', 'list', $arrParam));
        
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


















