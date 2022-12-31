<?php

class UserModel extends Model
{
    public $_arrParam;
    public $_saveParam = [];
    protected $_tableName = TBL_USER;
    public    $_cunrrentPage      = 1;
    private $_columns = array('id','username','password','email','fullname','created','created_by','modified','modified_by','status','group_id');
    
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_tableName);
        
    }
    
    public function listItems($arrParam,$option = null)
    {
        //$totalItemsCount = $arrParam['count']['allStatus'];
        
        $queryContent = [];
        $queryContent[] = "SELECT `u`.`id`,`u`.`username`,`u`.`email`,`u`.`fullname`,`u`.`password`,`u`.`created`,`u`.`created_by`,`u`.`modified`,`u`.`modified_by`,`u`.`status`,`u`.`ordering`,`u`.`group_id`,`g`.`name` AS `group_name`";             
        $queryContent[] = "FROM `$this->_tableName` AS `u`, `".TBL_GROUP."` AS `g`";
        $queryContent[] = "WHERE `u`.`group_id` = `g`.`id`";
        
        if(!empty($_SESSION['search'])){
            $queryContent[]     = "AND `name` LIKE '%".$_SESSION['search']."%'";
        }
        
        if(isset($_SESSION['filter'])){
                if($_SESSION['filter'] == 'active') $queryContent[]    = 'AND `status`= 1';
                if($_SESSION['filter'] == 'inactive') $queryContent[]    = 'AND `status`= 0';     
        }
        
        if(isset($_SESSION['selectGroupACP'])){
                if($_SESSION['selectGroupACP'] == '1') $queryContent[]    = 'AND `group_acp`= 1';
                if($_SESSION['selectGroupACP'] == '0') $queryContent[]    = 'AND `group_acp`= 0';
        }
        
        $position           = $this->_arrParam['position'];
        $totalItemsPerPage  = $this->_arrParam['totalItemsPerPage'];
        
        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->listRecord($queryContent);
        return $result;
    }
    
    public function createdAndModified($arrParam, $option = null){
        
        $queryContent = [];
        $queryContent[] = "SELECT `id`,`name`";
        $queryContent[] = "FROM `".TBL_GROUP."`";
        if($option != null){
            $queryContent[] = "LIMIT 0,".$option."";
        }    
        $queryContent = implode(" ", $queryContent);
        $result = $this->listRecord($queryContent);
        return $result;
    }
    
    public function changeGroupACB($arrParam, $option = null){
        
        $GroupACB = ($arrParam['group_acp'] == 0) ? 1 : 0 ;
        $id       = $arrParam['id'];
        $query    = "UPDATE `$this->_tableName` SET `group_acp` = $GroupACB WHERE `id` = '".$id."'";
        $this->query($query);
        
        Session::set('message', array('class' => 'success', 'content' => 'Trạng thái GroupACB được cập nhật'));
        return array('id'=>$id,'group_acb'=>$GroupACB,'url'=>URL::createLink('backend','group','list',array('id'=>$id,'group_acp'=>$GroupACB)));
    }
    
    public function changeStatus($arrParam, $option = null){
        
        if($option['task'] == 'change-status'){
            $status 	= $arrParam['type'];
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
                
                $query		= "UPDATE `$this->table` SET `status` = $status WHERE `id` IN ($ids)";
                $this->query($query);
                
                Session::set('message', array('class' => 'success', 'content' => 'Có ' . $i . ' phần tử được thay đổi trạng thái!'));
            }else{
                Session::set('message', array('class' => 'error', 'content' => 'Vui lòng chọn vào phần tử muỗn thay đổi trạng thái!'));
            }
        }
        
        if($option['task'] == null){
            
            $Status = ($arrParam['status'] == 0) ? 1 : 0 ;
            $id       = $arrParam['id'];
            $query    = "UPDATE `$this->_tableName` SET `status` = $Status WHERE `id` = '".$id."'";
            $this->query($query);
            
            Session::set('message', array('class' => 'success', 'content' => 'Trạng thái Status được cập nhật'));
            return array('id'=>$id,'status'=>$Status,'url'=>URL::createLink('backend','group','list',array('id'=>$id,'status'=>$Status)));
        }
        
    }
    
    public function saveItem($arrParam, $option = null){
        
        echo "<pre>";
        print_r($arrParam);
        echo "</pre>";
        
        if($option['task'] == 'add'){
            $arrParam['form']['created']    = date('Y-m-d',time());
            $arrParam['form']['created_by'] = 1;
            
            $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Đã thêm dữ liệu thành công!'));
            return $this->lastID();
        }
        
        if($option['task'] == 'edit'){
            $arrParam['form']['modified']    = date('Y-m-d',time());
            $arrParam['form']['modified_by'] = 10;
            
            $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id',$arrParam['form']['id'])));
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $arrParam['form']['id'];
        }
    }
    
    public function pagination($totalItems,$totalItemsPerPage,$pageRange)
    {
        
        $resulfPagination = [];
        
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $this->_cunrrentPage = $currentPage;
        
        $paginator = new Pagination($totalItems, $totalItemsPerPage, $pageRange , $currentPage);
        $paginationHTML = $paginator->showPagination(URL::createLink('backend', 'user', 'list'));
        $position = ($currentPage - 1) * $totalItemsPerPage;
        
        $resulfPagination['position'] = $position;
        $resulfPagination['totalItemsPerPage'] = $totalItemsPerPage;
        $resulfPagination['paginationHTML'] = $paginationHTML;
        
        return $resulfPagination;
    }
    
    public function countFilterSearch(){
        
        $count          = array();
        $searchQuery    = '';
        
//         if((!empty($_SESSION['search'])) && (!empty(is_numeric(@$_SESSION['selectGroupACP'])))){
//             $varGroupACP = @$_SESSION['selectGroupACP'];
            
//             $searchQuery = "`name` LIKE '%".$_SESSION['search']."%'";
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `group_acp` = $varGroupACP");
//             $count['allStatus'] = $this->totalItem();
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `status` = 1 AND `group_acp` = $varGroupACP");
//             $count['activeStatus'] = $this->totalItem();
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `status` = 0 AND `group_acp` = $varGroupACP");
//             $count['inActiveStatus'] = $this->totalItem();
            
//             return $count;
//         }
        
//         if(!empty(is_numeric(@$_SESSION['selectGroupACP']))){
//             $varGroupACP = @$_SESSION['selectGroupACP'];
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE `group_acp` = ".$varGroupACP."");
//             $count['allStatus'] = $this->totalItem();
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE `status` = 1 AND `group_acp` = ".$varGroupACP."");
//             $count['activeStatus'] = $this->totalItem();
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE `status` = 0 AND `group_acp` = ".$varGroupACP."");
//             $count['inActiveStatus'] = $this->totalItem();
            
//             return $count;
            
//         }
        
//         if(!empty($_SESSION['search'])){
//             $searchQuery = "`name` LIKE '%".$_SESSION['search']."%'";
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery");
//             $count['allStatus'] = $this->totalItem();
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `status` = 1");
//             $count['activeStatus'] = $this->totalItem();
            
//             $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableName."` WHERE $searchQuery AND `status` = 0 ");
//             $count['inActiveStatus'] = $this->totalItem();
            
//             return $count;
//         }
        
        
        
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
            $queryContent[]     = "WHERE `name` LIKE '%".$_SESSION['search']."%'";
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
        
        $result = $this->singleRecord($queryContent);
        
        return $result['total'];
    }
    
    public function listItemId($id){
        $idSelect = $id;
        
        $queryContent   = [];
        $queryContent[] = "SELECT `id`,`name`,`link`,`image`,`status`,`ordering`";
        $queryContent[] = "FROM `$this->_tableName`";
        $queryContent[] = "WHERE `id` = '" . $idSelect . "'";
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->singleRecord($queryContent);
        return $result;
        
    }
    
    public function infoItem($arrParam,$option = null){
        if($option == null){
            $queryContent   = [];
            $queryContent[] = "SELECT `id`,`username`,`email`,fullname,`password`,`status`,`group_id`";
            $queryContent[] = "FROM `$this->_tableName`";
            $queryContent[] = "WHERE `id` = '" . $arrParam['id'] . "'";
            $queryContent = implode(" ", $queryContent);
            $result = $this->singleRecord($queryContent);
            return $result;
        }
    }
    
    public function deleteItem($id,$option = null)
    {
        $this->delete([$id]);
        Session::set('message', array('class' => 'success', 'content' => 'Xóa thành công!'));
    }
    
    public function multActiveStatus($checkbox,$option = null){
        echo '<h3>this is multActiveStatus</h3>';
        die();
    }
    
    public function multInactiveStatus($checkbox,$option = null){
        echo '<h3>this is multInactiveStatus</h3>';
        die();
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
    
    public function listItemsFiter($option = null)
    {
        
        $queryContent[] = "SELECT `id`,`name`,`group_acp`,`status`,`ordering`,`created`,`created_by`,`modified`,`modified_by`";
        $queryContent[] = "FROM `$this->_tableName`";
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->listRecord($queryContent);
        return $result;
    }
    
    
    public function search($searchValue = null){
        $query = "SELECT * FROM `$this->table` ";
        if($searchValue != '') $query .= "WHERE `name` LIKE '%$searchValue%'";
        $result = $this->listRecord($query);
        return $result;
    }
    
    public function filter($filter = null){
        $query = "SELECT * FROM `$this->table` ";
        if($filter != '') $query .= "WHERE `status` = '$filter'";
        $result = $this->listRecord($query);
        return $result;
    }
    
}


















