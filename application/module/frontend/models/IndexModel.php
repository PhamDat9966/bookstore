<?php

class IndexModel extends Model
{
    public $_arrParam;
    public $_saveParam = [];
    protected $_tableName = TBL_USER;
    public    $_cunrrentPage      = 1;
    
    private $_columns = array(
                                'id',
                                'username',
                                'password',
                                'email',
                                'fullname',
                                'created',
                                'created_by',
                                'modified',
                                'modified_by',
                                'register_date',
                                'register_ip',
                                'status',
                                'ordering',
                                'group_id');
    
    
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_tableName);
        
    }
    
    public function listBooks($arrParam,$option = null)
    {
        //$totalItemsCount = $arrParam['count']['allStatus'];
        
        $queryContent   = [];
        $queryContent[] = "SELECT `b`.`id`,`b`.`name`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,`b`.`category_id`,`b`.`created`,`b`.`created_by`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`special`,`b`.`ordering`,`c`.`name` AS `category_name`";
        $queryContent[] = "FROM `".TBL_BOOK."` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
        $queryContent[] = "WHERE `b`.`id` > 0";
        
        if(!empty($arrParam['search'])){
            $keyword            = '"%'.$arrParam['search'].'%"';
            $queryContent[]     = "AND (`b`.`name` LIKE $keyword)";
        }
        
        if(isset($arrParam['filter'])){
            if($arrParam['filter'] == 'active')     $queryContent[]    = 'AND `b`.`status`= 1';
            if($arrParam['filter'] == 'inactive')   $queryContent[]    = 'AND `b`.`status`= 0';
        }
        
        if(isset($arrParam['selectCategory'])){
            if($arrParam['selectCategory'] != '0'){
                $queryContent[]    = "AND `b`.`category_id`= '".$arrParam['selectCategory']."'";
            }
        }
        
        if(isset($arrParam['selectSpecial'])){
            if($arrParam['selectSpecial'] == 1)     $queryContent[]    = 'AND `b`.`special`= 1';
            if($arrParam['selectSpecial'] == 0)     $queryContent[]    = 'AND `b`.`special`= 0';
        }
        
        $queryContent[]     = 'ORDER BY `ordering` ASC';
        
//         $position           = $this->_arrParam['position'];
//         $totalItemsPerPage  = $this->_arrParam['totalItemsPerPage'];
        
//        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchAll($queryContent);
        return $result;
    }
    
    public function infoItem($arrParam,$option = NULL){
        if($option == NULL){
            $email   = $arrParam['form']['email'];
            $password   = $arrParam['form']['password'];
            
            $query[]    =   "SELECT `u`.`id`,`u`.`username`,`u`.`fullname`,`u`.`email`,`u`.`group_id`, `g`.`group_acp`";
            $query[]    =   "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id` ";
            $query[]    =   "WHERE `email` = '$email' AND `password` = '$password'";
            
            $query      = implode(" ", $query);
            $result     = $this->fetchRow($query);
            return $result;
        }
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
    
}


















