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
    
    public function pagination($totalItems = 0,$totalItemsPerPage = 4, $pageRange = 3)
    {   
        //echo 'pagination: '.$totalItems;
        $resulfPagination = [];
//         $this->query("SELECT COUNT(`id`) AS totalItems FROM `$this->_tableName`");
//         echo $totalItems = $this->totalItem();

        
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $this->_cunrrentPage = $currentPage; 
        
        $paginator = new Pagination($totalItems = 3, $totalItemsPerPage, $pageRange, $currentPage);
        $paginationHTML = $paginator->showPagination();
        $position = ($currentPage - 1) * $totalItemsPerPage;
        
        $resulfPagination['position'] = $position;
        $resulfPagination['totalItemsPerPage'] = $totalItemsPerPage;
        $resulfPagination['paginationHTML'] = $paginationHTML;
        
        return $resulfPagination;
    }

    public function listItems($arrParam,$option = null)
    {  
        
        $totalItemsCount = $arrParam['count']['allStatus'];
        
        $queryContent = [];     
        $queryContent[] = "SELECT `id`,`name`,`group_acp`,`status`,`ordering`,`created`,`created_by`,`modified`,`modified_by`";
        $queryContent[] = "FROM `$this->_tableName`";
        
        
//         if(!empty($_SESSION['search']) && !empty($_SESSION['filter'])){
//             $queryContent[] = "WHERE `name` LIKE '%".$_SESSION['search']."%'";
//             if($_SESSION['filter']  == 'active') {
//                 $queryContent[]     =  "AND `status`=1";
//                 $totalItems         =  $arrParam['count']['activeStatus'];
//             }
//             if($_SESSION['filter' ] == 'inactive') {
//                 $queryContent[] = "AND `status`= 0";
//                 $totalItems         =  $arrParam['count']['inActiveStatus'];
//             }
//         }else if(!empty($_SESSION['search'])){
//             $queryContent[] = "WHERE `name` LIKE '%".$_SESSION['search']."%'";
//             $totalItems     = $arrParam['count']['allStatus'];
//         }else if(!empty($_SESSION['filter'])){
//             if($_SESSION['filter']  == 'active') {
//                 $queryContent[] = "WHERE `status`='1'";
//                 $totalItems         =  $arrParam['count']['activeStatus'];
//             }
//             if($_SESSION['filter' ] == 'inactive') {
//                 $queryContent[]     = "WHERE `status`='0'";
//                 $totalItems         =  $arrParam['count']['inActiveStatus'];
//             }
//         }
        
        
//         echo $totalItems;
//         $pagitor = $this->pagination($totalItems,4, 3);
        
        
        
        
        if(!empty($_SESSION['search']) && !empty($_SESSION['filter'])){
            $queryContent[] = "WHERE `name` LIKE '%".$_SESSION['search']."%'";
            if($_SESSION['filter']  == 'active') $queryContent[] = "AND `status`=1";
            if($_SESSION['filter' ] == 'inactive') $queryContent[] = "AND `status`= 0";
        }else if(!empty($_SESSION['search'])){
            $queryContent[] = "WHERE `name` LIKE '%".$_SESSION['search']."%'";
        }else if(!empty($_SESSION['filter'])){
            if($_SESSION['filter']  == 'active') $queryContent[] = "WHERE `status`='1'";
            if($_SESSION['filter' ] == 'inactive') $queryContent[] = "WHERE `status`='0'";
        }
        
        $pagitor = $this->pagination($totalItems = $totalItemsCount, $totalItemsPerPage = 4, $pageRange = 3);
        $position = $pagitor['position'];
        $totalItemsPerPage = $pagitor['totalItemsPerPage'];
        
        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->listRecord($queryContent);
        return $result;
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
        
        $filter = '';
        
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
    

















