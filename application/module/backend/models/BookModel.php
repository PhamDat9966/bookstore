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
        $queryContent[] = "SELECT `b`.`id`,`b`.`name`,`b`.`picture`,`b`.`price`,`b`.`sale_off`,`b`.`category_id`,`b`.`created`,`b`.`created_by`,`b`.`modified`,`b`.`modified_by`,`b`.`status`,`b`.`ordering`,`c`.`name` AS `category_name`";             
        $queryContent[] = "FROM `$this->_tableName` AS `b` LEFT JOIN `".TBL_CATEGORY."` AS `c` ON `b`.`category_id` = `c`.`id`";
        $queryContent[] = "WHERE `b`.`id` > 0";
        
        if(!empty($arrParam['search'])){
            $keyword            = '"%'.$arrParam['search'].'%"';
            $queryContent[]     = "AND (`name` LIKE $keyword)";
        }
        
        if(isset($arrParam['filter'])){
            if($arrParam['filter'] == 'active') $queryContent[]    = 'AND `u`.`status`= 1';
            if($arrParam['filter'] == 'inactive') $queryContent[]    = 'AND `u`.`status`= 0';
        }
        
        if(isset($arrParam['selectGroup'])){
            if($arrParam['selectGroup'] != '0'){
                $queryContent[]    = "AND `u`.`group_id`= '".$arrParam['selectGroup']."'";
            }
        }
        
        $queryContent[]     = 'ORDER BY `id` ASC';
        
        $position           = $this->_arrParam['position'];
        $totalItemsPerPage  = $this->_arrParam['totalItemsPerPage'];
        
        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchAll($queryContent);
        return $result;
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
            $query       = implode(" ", $query);
            $result      = $this->fetchPairs($query);
            return $result;
        }
    }
    
    public function changeCategoryForBook($arrParam, $option = null){
        
        $modified_by = $this->_userInfo['info']['id'];
        $modified    = date('Y-m-d h:i:s',time());
        
        if($option['task'] == 'change-ajax-category'){

            $categoryForBook    = $arrParam['category_id'];
            $id                 = $arrParam['id'];
            $query          = "UPDATE `$this->_tableName` SET `category_id` = '$categoryForBook' WHERE `id` = '".$id."'";
            
            
            // Nếu đổi category thành công thì cập nhật modified_by và modified
            if($this->query($query)){
                
                $arrParam['form']['modified']    = date('Y-m-d h:i:s',time());
                $arrParam['form']['modified_by'] = $modified_by;

                $queryModified = "UPDATE `$this->_tableName` SET `modified_by` = '$modified_by',`modified`='$modified' WHERE `id` = '".$id."'";
                $this->query($queryModified);

//                 $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
//                 $this->update($data, array(array('id',$arrParam['form']['id'])));
            }
            
            return array('id'=>$id,'message', array('class' => 'success', 'content' => 'Trạng thái Group của User đã được cập nhật'));
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
    
    public function countFilterSearch(){
        
        $count          = array();
        $searchQuery    = '';
        
        if((!empty($arrParam['search'])) && (!empty(is_numeric($arrParam['selectGroupACP'])))){
            $varGroupACP = $arrParam['selectGroupACP'];
            
            $searchQuery = "`name` LIKE '%".$arrParam['search']."%'";
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `group_acp` = $varGroupACP");
            $count['allStatus'] = $this->totalItem();
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `status` = 1 AND `group_acp` = $varGroupACP");
            $count['activeStatus'] = $this->totalItem();
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `status` = 0 AND `group_acp` = $varGroupACP");
            $count['inActiveStatus'] = $this->totalItem();
            
            return $count;
        }
        
        if(@!empty(is_numeric($arrParam['selectGroupACP']))){
            $varGroupACP = $arrParam['selectGroupACP'];
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE `group_acp` = ".$varGroupACP."");
            $count['allStatus'] = $this->totalItem();
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE `status` = 1 AND `group_acp` = ".$varGroupACP."");
            $count['activeStatus'] = $this->totalItem();
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE `status` = 0 AND `group_acp` = ".$varGroupACP."");
            $count['inActiveStatus'] = $this->totalItem();
            
            return $count;
            
        }
        
        if(!empty($arrParam['search'])){
            $searchQuery = "`name` LIKE '%".$arrParam['search']."%'";
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery");
            $count['allStatus'] = $this->totalItem();
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `status` = 1");
            $count['activeStatus'] = $this->totalItem();
            
            $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `status` = 0 ");
            $count['inActiveStatus'] = $this->totalItem();
            
            return $count;
        }
        
        
        
        $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."`");
        $count['allStatus'] = $this->totalItem();
        
        $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE `status` = 1");
        $count['activeStatus'] = $this->totalItem();
        
        $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE  `status` = 0");
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
            $queryContent[] = "SELECT `id`,`username`,`email`,`fullname`,`password`,`status`,`group_id`";
            $queryContent[] = "FROM `$this->_tableName`";
            $queryContent[] = "WHERE `id` = '" . $arrParam['id'] . "'";
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


















