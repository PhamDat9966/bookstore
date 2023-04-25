<?php

class BookModel extends Model
{
    public $_arrParam;
    public $_saveParam = [];
    protected $_tableName = TBL_BOOK;
    public    $_cunrrentPage      = 1;
    private $_userInfo;
    private $_columns = array(
                                'id',
                                'name',
                                'price',
                                'sale_off',
                                'picture',
                                'created',
                                'created_by',
                                'modified',
                                'modified_by',
                                'status',
                                'category_id'
                        );
    
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_tableName);
        $this->_userInfo = Session::get('user');
        
    }
    
    public function listItems($arrParam,$option = null)
    {
        //$totalItemsCount = $arrParam['count']['allStatus'];
        
        $queryContent   = [];
        $queryContent[] = "SELECT `b`.`id`,`b`.`name`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,`b`.`category_id`,`b`.`created`,`b`.`created_by`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`special`,`b`.`ordering`,`c`.`name` AS `category_name`";             
        $queryContent[] = "FROM `$this->_tableName` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
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
    
        $position           = $this->_arrParam['position'];
        $totalItemsPerPage  = $this->_arrParam['totalItemsPerPage'];
        
        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchAll($queryContent);
        return $result;
    }
    
    public function changeOrdering($arrParam, $option = null){
        
        $modified_by        = $this->_userInfo['info']['id'];
        $nameModified_by    = $this->_userInfo['info']['username'];
        $modified           = date('Y-m-d h:i:s',time());
        $modifiedAjax       = date('h:i:s d-m-Y',time());
        
        if($option['task'] == 'change-ajax-ordering'){
            $ojectOrdering = json_decode($arrParam['paramOrdering']);
            
            $id             = $ojectOrdering->id;
            $valueOrdering  = $ojectOrdering->value;
            $query    = "UPDATE `$this->_tableName` SET `ordering` = $valueOrdering, `modified_by` = '$modified_by',`modified`='$modified' WHERE `id` = '".$id."'";
            $this->query($query);
            
            return array('id'=>$id,'modi'=>array('modified'=>$modifiedAjax,'modified_by'=>$nameModified_by),'ordering'=>$valueOrdering,'url'=>URL::createLink('backend','category','ajaxOrdering',array('id'=>$id,'ordering'=>$valueOrdering)));
        }
        
    }
    
    public function countItemsPaginator($arrParam,$option = null)
    {
        //$totalItemsCount = $arrParam['count']['allStatus'];
        
        $queryContent   = [];
        $queryContent[] = "SELECT `id`,COUNT(`id`) AS `count`";
        $queryContent[] = "FROM `$this->_tableName`";
        $queryContent[] = "WHERE `id` > 0";
        
        if(!empty($arrParam['search'])){
            $queryContent[]     = "AND `username` LIKE '%". $arrParam['search']."%'";
        }
        
        if(isset($arrParam['filter'])){
            if($arrParam['filter'] == 'active') $queryContent[]    = 'AND `status`= 1';
            if($arrParam['filter'] == 'inactive') $queryContent[]    = 'AND `status`= 0';
        }
        
        if(isset($arrParam['selectGroup'])){
            if($arrParam['selectGroup'] != '0'){
                $queryContent[]    = "AND `group_id`= '".$arrParam['selectGroup']."'";
            }
        }
        
        echo $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchAll($queryContent);
        return $result;
    }
    
    public function saveItem($arrParam, $option = null){
        
        $created_by  = $this->_userInfo['info']['id'];
        $modified_by = $this->_userInfo['info']['id'];
        
        if($option['task'] == 'add'){
            $arrParam['form']['created']    = date('Y-m-d h:i:s',time());
            $arrParam['form']['created_by'] = $created_by;
            
            $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Đã thêm dữ liệu thành công!'));
            return $this->lastID();
        }
        
        if($option['task'] == 'edit'){
            $arrParam['form']['modified']    = date('Y-m-d h:i:s',time());
            $arrParam['form']['modified_by'] = $modified_by;
            
            $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            
            $this->update($data, array(array('id',$arrParam['form']['id'])));
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $arrParam['form']['id'];
        }
        
        if($option['task'] == 'generatepass'){
            $arrParam['form']['modified']    = date('Y-m-d h:i:s',time());
            $arrParam['form']['modified_by'] = $modified_by;
            
            $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id',$arrParam['form']['password'])));
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $arrParam['form']['id'];
        }
    }
    
    public function createdAndModified($arrParam, $option = null){
        
        $queryContent   = [];
        $queryContent[] = "SELECT `id`,`name`";
        $queryContent[] = "FROM `".TBL_GROUP."`";
        if($option != null){
            $queryContent[] = "LIMIT 0,".$option."";
        }
        $queryContent = implode(" ", $queryContent);
        $result = $this->fetchAll($queryContent);
        return $result;
    }
    
    public function categoryInSelectbox($arrParam,$numberGroup = null ,$option = null){
        if($option == null){
            $query       = [];
            $query[]     = "SELECT `id`,`name`";
            $query[]     = "FROM `".TBL_CATEGORY."`";
            if(!empty($numberGroup)){
                $query[] = "LIMIT 0,".$numberGroup."";
            }
            $query[]     = 'ORDER BY `ordering` ASC';
            $query       = implode(" ", $query);
            $result      = $this->fetchPairs($query);
            return $result;
        }
    }
    
    public function changeCategoryForBook($arrParam, $option = null){
        
        $modified_by        = $this->_userInfo['info']['id'];
        $nameModified_by    = $this->_userInfo['info']['username'];
        $modified    = date('Y-m-d h:i:s',time());
        
        if($option['task'] == 'change-ajax-category'){

            $categoryForBook    = $arrParam['category_id'];
            $id                 = $arrParam['id'];
            $query          = "UPDATE `$this->_tableName` SET `category_id` = '$categoryForBook',`modified_by` = '$modified_by',`modified`='$modified' WHERE `id` = '".$id."'";
            if($this->query($query)){
                return array('id'=>$id,'modi'=>array('modified'=>$modified,'modified_by'=>$nameModified_by),'message', array('class' => 'success', 'content' => 'Trạng thái Category của Book đã được cập nhật'));
            }
        }
    }
    
    public function changeStatus($arrParam, $option = null){
        
        $modified_by = $this->_userInfo['info']['id'];
        $modified    = date('Y-m-d h:i:s',time());
        
        if($option['task'] == 'change-status'){
            $status 	= $arrParam['statusChoose'];
            if(!empty($arrParam['cid'])){
                $i=0;
                $ids = '';
                if(!empty($arrParam['cid'])){
                    foreach($arrParam['cid'] as $id) {
                        $ids .= "'" . $id . "', ";
                        $i++;
                    }
                    $ids     .= "'0'";
                }
                
                $query		= "UPDATE `$this->table` SET `status` = $status,`modified_by` = $modified_by,`modified` = '$modified' WHERE `id` IN ($ids)";
                $this->query($query);
                
                Session::set('message', array('class' => 'success', 'content' => 'Có ' . $i . ' phần tử được thay đổi trạng thái!'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muỗn thay đổi trạng thái!'));
            }
        }
        
        if($option['task'] == null){
            
            $status = ($arrParam['status'] == 0) ? 1 : 0 ;
            $id       = $arrParam['id'];
            $query    = "UPDATE `$this->_tableName` SET `status` = $status WHERE `id` = '".$id."'";
            $this->query($query);
            
            Session::set('message', array('class' => 'success', 'content' => 'Trạng thái Status được cập nhật'));
            return array('id'=>$id,'status'=>$status,'url'=>URL::createLink('backend','group','list',array('id'=>$id,'status'=>$status)));
        }
        
        if($option['task'] == 'change-ajax-user-status'){
            $status = ($arrParam['status'] == 0) ? 1 : 0 ;
            $id       = $arrParam['id'];
            $query    = "UPDATE `$this->table` SET `status` = $status,`modified_by` = $modified_by,`modified` = '$modified' WHERE `id`= $id";
            $this->query($query);
            
            return array('id'=>$id,'status'=>$status,'url'=>URL::createLink('backend','group','ajaxStatus',array('id'=>$id,'status'=>$status)));
        }
    }
    
    public function changeSpecial($arrParam, $option = null){
        
        $modified_by = $this->_userInfo['info']['id'];
        $modified    = date('Y-m-d h:i:s',time());
        
        if($option['task'] == 'change-ajax-special'){
            $special  = ($arrParam['special'] == 0) ? 1 : 0 ;
            $id       = $arrParam['id'];
            $query    = "UPDATE `$this->table` SET `special` = $special,`modified_by` = $modified_by,`modified` = '$modified' WHERE `id`= $id";
            $this->query($query);
            
            return array('id'=>$id,'special'=>$special,'url'=>URL::createLink('backend','book','ajaxSpecial',array('id'=>$id,'special'=>$special)));
        }
    }
    
    
    public function pagination($totalItems, $pagination,$arrParam)
    {
        unset($arrParam['module']);
        unset($arrParam['controller']);
        unset($arrParam['action']);
        
        $resulfPagination = [];
        $currentPage = (isset($arrParam['page'])) ? $arrParam['page'] : 1;
        $this->_cunrrentPage = $currentPage;
        
        $paginator = new Pagination($totalItems, $pagination);
        $paginationHTML = $paginator->showPagination(URL::createLink('backend', 'book', 'list', $arrParam));
        
        $position = ($currentPage - 1) * $pagination['totalItemsPerPage'];
        $resulfPagination['position'] = $position;
        $resulfPagination['totalItemsPerPage'] = $pagination['totalItemsPerPage'];
        $resulfPagination['paginationHTML'] = $paginationHTML;
        
        // Send for 'public function listItems'
        $this->_arrParam['position']             = $resulfPagination['position'];
        $this->_arrParam['totalItemsPerPage']    = $resulfPagination['totalItemsPerPage'];
        
        return $resulfPagination;
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
    
    
    public function countItem($arrParam,$option = null)
    {
        $queryContent = [];
        $queryContent[] = "SELECT COUNT(`id`) AS total";
        $queryContent[] = "FROM `$this->_tableName`";
        
        $flagWhere      = false;
        
        if(!empty($_SESSION['search'])){
            $queryContent[]     = "WHERE `username` LIKE '%".$_SESSION['search']."%'";
            $flagWhere          = true;
        }
        
        if(isset($_SESSION['filter'])){
            if($flagWhere == true){
                if($_SESSION['filter'] == 'active') $queryContent[]    = 'AND `status`= 1';
                if($_SESSION['filter'] == 'inactive') $queryContent[]    = 'AND `status`= 0';
            }
            
            if($flagWhere == false){
                if($_SESSION['filter'] == 'active') $queryContent[]    = 'WHERE `status` = 1';
                if($_SESSION['filter'] == 'inactive') $queryContent[]    = 'WHERE `status`= 0';
            }
        }
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchRow($queryContent);
        
        return $result['total'];
    }
    
    public function listItemId($id){
        $idSelect = $id;
        
        $queryContent   = [];
        $queryContent[] = "SELECT `id`,`username`,`link`,`image`,`status`,`ordering`";
        $queryContent[] = "FROM `$this->_tableName`";
        $queryContent[] = "WHERE `id` = '" . $idSelect . "'";
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchRow($queryContent);
        return $result;
        
    }
    
    public function infoItem($arrParam,$option = null){
        if($option == null){
            $queryContent   = [];
            $queryContent[] = "SELECT `b`.`id`,`b`.`name`,`b`.`shortDescription`,`b`.`description`,`b`.`price`,`b`.`sale_off`,`b`.`picture`,`b`.`status`,`b`.`category_id`,`c`.`name` AS `category_name`";
            $queryContent[] = "FROM `$this->_tableName` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
            $queryContent[] = "WHERE `b`.`id` > 0";
            $queryContent = implode(" ", $queryContent);
            
            $result = $this->fetchRow($queryContent);
            return $result;
        }
    }
    
    public function deleteItem($id,$option = null)
    {
        $this->delete([$id]);
        Session::set('message', array('class' => 'success', 'content' => 'Xóa thành công!'));
    }
    
    public function deleteMultItem($arrParam,$option = null)
    {
        
        if($option == null){
            if(!empty($arrParam['cid'])){
                $ids		= $this->createWhereDeleteSQL($arrParam['cid']);
                $query		= "DELETE FROM `$this->table` WHERE `id` IN ($ids)";
                $this->query($query);
                Session::set('message', array('class' => 'success', 'content' => 'Có ' . $this->affectedRows(). ' phần tử được xóa!'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muốn xóa!'));
            }
        }
        
    }
    
    public function ordering($arrParam,$option = null)
    {
        if($option == null){
            if(!empty($arrParam['order'])){
                foreach ($arrParam['order'] as $id=>$ordering){
                    $query    = "UPDATE `$this->_tableName` SET `ordering` = $ordering WHERE `id` = '".$id."'";
                    $this->query($query);
                }
            }
        }
        
    }
    
    public function listUserGroupACP($arrParam,$option = null)
    {
        $queryContent   = [];
        
        if($option == null){
            
            $queryContent[] = "SELECT `id`,`username` as `name`";
            $queryContent[] = "FROM `".TBL_USER."`";
            $queryContent   = implode(" ", $queryContent);
            $result         = $this->fetchPairs($queryContent);
            return $result;
        }
        
    }

}


















