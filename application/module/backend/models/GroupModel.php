<?php

class GroupModel extends Model
{
    public $_arrParam;
    public $_saveParam = [];
    protected $_tableName = TBL_GROUP;
    public    $_cunrrentPage      = 1;       
    private $_columns = array('id','name','group_acp','created','created_by','modified','modified_by','status','ordering');
    
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
        $queryContent[] = "SELECT `id`,`name`,`group_acp`,`status`,`ordering`,`created`,`created_by`,`modified`,`modified_by`";
        $queryContent[] = "FROM `$this->_tableName`";
        $queryContent[] = "WHERE `id` > 0";
        
        if(!empty($arrParam['search'])){
            $queryContent[]     = "AND `name` LIKE '%". $arrParam['search']."%'";
        }
        
        if(isset($arrParam['filter'])){
            if($arrParam['filter'] == 'active') $queryContent[]    = 'AND `status`= 1';
            if($arrParam['filter'] == 'inactive') $queryContent[]    = 'AND `status`= 0';
        }
        
        if(isset($arrParam['selectGroupACP'])){
            if($arrParam['selectGroupACP'] == '1') $queryContent[]    = 'AND `group_acp`= 1';
            if($arrParam['selectGroupACP'] == '0') $queryContent[]    = 'AND `group_acp`= 0';
        } 
        
        $queryContent[]     = 'ORDER BY `ordering` ASC';
        
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
            $queryContent[]     = "AND `name` LIKE '%". $arrParam['search']."%'";
        }
        
        if(isset($arrParam['filter'])){
            if($arrParam['filter'] == 'active') $queryContent[]    = 'AND `status`= 1';
            if($arrParam['filter'] == 'inactive') $queryContent[]    = 'AND `status`= 0';
        }
        
        if(isset($arrParam['selectGroupACP'])){
            if($arrParam['selectGroupACP'] == '1') $queryContent[]    = 'AND `group_acp`= 1';
            if($arrParam['selectGroupACP'] == '0') $queryContent[]    = 'AND `group_acp`= 0';
        }
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchAll($queryContent);
        return $result;
    }
    
    public function changeGroupACB($arrParam, $option = null){
        
        if($option['task'] == 'change-ajax-groupACP'){
            $GroupACB = ($arrParam['group_acp'] == 0) ? 1 : 0 ;
            $id       = $arrParam['id'];
            $query    = "UPDATE `$this->_tableName` SET `group_acp` = $GroupACB WHERE `id` = '".$id."'";
            $this->query($query);    

            return array('id'=>$id,'group_acb'=>$GroupACB,'url'=>URL::createLink('backend','group','ajaxGroupACP',array('id'=>$id,'group_acp'=>$GroupACB)));
        }   
        
        if($option['task'] == 'change-groupACP'){
            $GroupACB = ($arrParam['group_acp'] == 0) ? 1 : 0 ;
            $id       = $arrParam['id'];
            $query    = "UPDATE `$this->_tableName` SET `group_acp` = $GroupACB WHERE `id` = '".$id."'";
            $this->query($query);
            
            Session::set('message', array('class' => 'success', 'content' => 'Trạng thái GroupACB được cập nhật'));
            return array('id'=>$id,'group_acb'=>$GroupACB,'url'=>URL::createLink('backend','group','list',array('id'=>$id,'group_acp'=>$GroupACB)));
        } 
    }
       
    public function changeStatus($arrParam, $option = null){
        
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
        
        if($option['task'] == 'change-ajax-status'){
  
            $Status = ($arrParam['status'] == 0) ? 1 : 0 ;
            $id       = $arrParam['id'];
            $query    = "UPDATE `$this->_tableName` SET `status` = $Status WHERE `id` = '".$id."'";
            $this->query($query);

            return array('id'=>$id,'status'=>$Status,'url'=>URL::createLink('backend','group','ajaxStatus',array('id'=>$id,'status'=>$Status)));
        }
        
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
        $paginationHTML = $paginator->showPagination(URL::createLink('backend', 'group', 'list', $arrParam));
        
        $position = ($currentPage - 1) * $pagination['totalItemsPerPage'];
        $resulfPagination['position'] = $position;
        $resulfPagination['totalItemsPerPage'] = $pagination['totalItemsPerPage'];
        $resulfPagination['paginationHTML'] = $paginationHTML;
        
        return $resulfPagination;
    }
    
    public function countFilterSearch($arrParam){
        
        if(isset($arrParam['selectGroupACP'])){
            if($arrParam['selectGroupACP'] == 'groupACP'){
                unset($arrParam['selectGroupACP']);
            }
        }
        
        $count          = array();
        $searchQuery    = '';
        
        if(!empty($arrParam['search']) && (isset($arrParam['selectGroupACP']))){
            $varGroupACP = is_numeric($arrParam['selectGroupACP']);
            
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
        $queryContent   = [];
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
             
        $result = $this->fetchRow($queryContent);

        return $result['total'];
    }
    
    public function listItemId($id){
        $idSelect = $id;
        
        $queryContent   = [];
        $queryContent[] = "SELECT `id`,`name`,`link`,`image`,`status`,`ordering`";
        $queryContent[] = "FROM `$this->_tableName`";
        $queryContent[] = "WHERE `id` = '" . $idSelect . "'";    
        $queryContent   = implode(" ", $queryContent);
        
        $result = $this->fetchRow($queryContent);
        return $result;
        
    }
    
    public function infoItem($arrParam,$option = null){
        if($option == null){
            $queryContent   = [];
            $queryContent[] = "SELECT `id`,`name`,`group_acp`,`status`";
            $queryContent[] = "FROM `$this->_tableName`";
            $queryContent[] = "WHERE `id` = '" . $arrParam['id'] . "'";
            $queryContent   = implode(" ", $queryContent);
            $result         = $this->fetchRow($queryContent);
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
                    if(!empty($ordering)){
                        $query    = "UPDATE `$this->_tableName` SET `ordering` = $ordering WHERE `id` = '".$id."'";
                        $this->query($query);
                    }    
                }
            }
        }
        
    }
    
    public function listItemsFiter($option = null)
    {

        $queryContent[] = "SELECT `id`,`name`,`group_acp`,`status`,`ordering`,`created`,`created_by`,`modified`,`modified_by`";
        $queryContent[] = "FROM `$this->_tableName`";
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->fetchAll($queryContent);
        return $result;
    }
    
    
    public function search($searchValue = null){
        $query = "SELECT * FROM `$this->table` ";
        if($searchValue != '') $query .= "WHERE `name` LIKE '%$searchValue%'";
        $result = $this->fetchAll($query);
        return $result;
    }
    
    public function filter($filter = null){
        $query = "SELECT * FROM `$this->table` ";
        if($filter != '') $query .= "WHERE `status` = '$filter'";
        $result = $this->fetchAll($query);
        return $result;
    }
    
    public function listUserGroupACP($arrParam,$option = null)
    {
        $queryContent   = [];
        
        if($option == null){
            
            $queryContent[] = "SELECT `id`,`username` AS `name`";
            $queryContent[] = "FROM `". TBL_USER ."`";
            $queryContent   = implode(" ", $queryContent);
            $result         = $this->fetchPairs($queryContent);
            return $result;
        }
        
    }
    
}
    

















