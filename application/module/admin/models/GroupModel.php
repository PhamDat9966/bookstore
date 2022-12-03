<?php

class GroupModel extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->setTable('group_rss');
        
    }

    public function pagination($totalItemsPerPage = 4, $pageRange = 5)
    {
        $resulfPagination = [];
        $this->query("SELECT COUNT(`id`) AS totalItems FROM `group_rss`");
        $totalItems = $this->totalItem();
        $currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
        
        $paginator = new Pagination($totalItems, $totalItemsPerPage, $pageRange, $currentPage);
        $paginationHTML = $paginator->showPagination();
        $position = ($currentPage - 1) * $totalItemsPerPage;
        
        $resulfPagination['position'] = $position;
        $resulfPagination['totalItemsPerPage'] = $totalItemsPerPage;
        $resulfPagination['paginationHTML'] = $paginationHTML;
        
        return $resulfPagination;
    }

    public function listItems($option = null)
    {
        $pagitor = $this->pagination(4, 5);
        $position = $pagitor['position'];
        $totalItemsPerPage = $pagitor['totalItemsPerPage'];
        
        $queryContent = [];
        $queryContent[] = "SELECT `id`,`name`,`link`,`image`,`status`,`ordering`";
        $queryContent[] = "FROM `group_rss`";
        $queryContent[] = "LIMIT $position,$totalItemsPerPage";
        
        $queryContent = implode(" ", $queryContent);
        $result = $this->listRecord($queryContent);
        return $result;
    }
    
    public function listItemId($id){
        $idSelect = $id;
        
        $queryContent   = [];
        $queryContent[] = "SELECT `id`,`name`,`link`,`image`,`status`,`ordering`";
        $queryContent[] = "FROM `group_rss`";
        $queryContent[] = "WHERE `id` = '" . $idSelect . "'";    
        $queryContent = implode(" ", $queryContent);
        
        $result = $this->singleRecord($queryContent);
        return $result;
        
    }
    
    public function deleteItem($id,$option = null)
    {
        $folderImgTemp      = TEMPLATE_PATH . 'admin' . DS . 'main' . DS . 'admin' . DS . 'images' . DS;
        $query      = [];
        $query[]    = "SELECT `id`,`image`";
        $query[]    = "FROM `group_rss`";
        $query[]    = "WHERE `id` = '$id'";
        $query      = implode(" ", $query);
        
        $item       = $this->singleRecord($query);
        $oldImg     = $item['image'];
        
        if(unlink($folderImgTemp . $oldImg)){
            $this->delete(array($id));
        }   

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
        $query[] = "FROM `group_rss`";
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
    
}
    

















