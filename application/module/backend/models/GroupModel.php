<?php

class GroupModel extends Model
{
    public $saveParam = [];
    protected $_tableName = TBL_GROUP;
    public    $_cunrrentPage      = 1;                      
    
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_tableName);
        
    }
    
    public function changeGroupACB($arrParam, $option = null){
        
        $GroupACB = ($arrParam['group_acp'] == 0) ? 1 : 0 ;
        $id       = $arrParam['id'];
        $query    = "UPDATE `$this->_tableName` SET `group_acp` = $GroupACB WHERE `id` = '".$id."'";
        $this->query($query);    
        
        return array('id'=>$id,'group_acb'=>$GroupACB,'url'=>URL::createLink('backend','group','list',array('id'=>$id,'group_acp'=>$GroupACB)));
    }
       
    public function changeStatus($arrParam, $option = null){
        
        $Status = ($arrParam['status'] == 0) ? 1 : 0 ;
        $id       = $arrParam['id'];
        $query    = "UPDATE `$this->_tableName` SET `status` = $Status WHERE `id` = '".$id."'";
        $this->query($query);
        
        return array('id'=>$id,'status'=>$Status,'url'=>URL::createLink('backend','group','list',array('id'=>$id,'status'=>$Status)));
    }
    
    public function pagination($totalItemsPerPage = 4, $pageRange = 3)
    {
        $resulfPagination = [];
        $this->query("SELECT COUNT(`id`) AS totalItems FROM `$this->_tableName`");
        $totalItems = $this->totalItem();
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $this->_cunrrentPage = $currentPage; 
        
        $paginator = new Pagination($totalItems, $totalItemsPerPage, $pageRange, $currentPage);
        $paginationHTML = $paginator->showPagination();
        $position = ($currentPage - 1) * $totalItemsPerPage;
        
        $resulfPagination['position'] = $position;
        $resulfPagination['totalItemsPerPage'] = $totalItemsPerPage;
        $resulfPagination['paginationHTML'] = $paginationHTML;
        
        return $resulfPagination;
    }

    public function listItems($arrParam,$option = null)
    {  
        
        $pagitor = $this->pagination(4, 3);
        $position = $pagitor['position'];
        $totalItemsPerPage = $pagitor['totalItemsPerPage'];
        
        $queryContent = [];
        //$queryContent[] = "SELECT `id`,`name`,`link`,`image`,`status`,`ordering`";
        
        $queryContent[] = "SELECT `id`,`name`,`group_acp`,`status`,`ordering`,`created`,`created_by`,`modified`,`modified_by`";
        $queryContent[] = "FROM `$this->_tableName`";
        
        //if(isset($arrParam['search'])) $queryContent[] = "WHERE `name` LIKE '%".$arrParam['search']."%'";
        
        if(isset($_SESSION['search']) && isset($_SESSION['status'])){
            $queryContent[] = "WHERE `name` LIKE '%".$_SESSION['search']."%'";
            if($_SESSION['status']  == 'active') $queryContent[] = "AND `status`='1'";
            if($_SESSION['status' ] == 'inactive') $queryContent[] = "AND `status`='0'";
        }else if(isset($_SESSION['search'])){
            $queryContent[] = "WHERE `name` LIKE '%".$_SESSION['search']."%'";
        }else if(isset($_SESSION['status'])){
            if($_SESSION['status']  == 'active') $queryContent[] = "WHERE `status`='1'";
            if($_SESSION['status' ] == 'inactive') $queryContent[] = "WHERE `status`='0'";
        }
       
        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        echo $queryContent = implode(" ", $queryContent);
        
        $result = $this->listRecord($queryContent);
        return $result;
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
    
    public function deleteItem($id,$option = null)
    {
        $this->delete([$id]);
    }
    
    public function deleteMultItem($checkbox,$option = null)
    {
        $folderImgTemp      = TEMPLATE_PATH . 'admin' . DS . 'main' . DS . 'admin' . DS . 'images' . DS;
        $where    = '';
        foreach ($checkbox as $id) {
            $where .= " `id` = '$id' ";
            $where .= "OR";
        }
        $where = rtrim($where, "OR");
        
        $query  = [];
        $query[] = "SELECT `id`,`name`,`link`,`image`";
        $query[] = "FROM `$this->_tableName`";
        $query[] = "WHERE $where";
        
        $query  = implode(" ", $query);
        
        $item = $this->listRecord($query);
        
        $total = $this->delete($checkbox);
        
        if ($total > 0) {
            foreach ($item as $value) {
                $oldImg     = $value['image'];
                $fileImg    = $folderImgTemp . $oldImg;
                @unlink($fileImg);
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
    

















