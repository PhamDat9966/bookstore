<?php

class DashboardModel extends Model
{
    protected $_tableGroup = TBL_GROUP;
    protected $_tableUser  = TBL_USER;
    
    public function countFilterSearch(){
        
        $count          = array();
        $searchQuery    = '';
        
        $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableGroup."`");
        $count['group'] = $this->totalItem();
        
        $this->query("SELECT COUNT(`id`) AS totalItems FROM `".$this->_tableUser."`");
        $count['user'] = $this->totalItem();

        return $count;
    }
    
}
    

















