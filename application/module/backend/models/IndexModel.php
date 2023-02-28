<?php

class IndexModel extends Model
{
    protected $_tableGroup = TBL_GROUP;
    protected $_tableUser  = TBL_USER;
    
    
    public function infoItem($arrParam,$option = NULL){
        if($option == NULL){
            $username   = $arrParam['form']['username'];
            $password   = $arrParam['form']['password'];
            
            $query[]    =   "SELECT `u`.id`,`u`.`fullname`,`u`.`email`,`g`.`group_id` ";    
            $query[]    =   "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id` ";
            $query[]    =   "WHERE `username` = '$username' AND `password` = '$password'";
            
            $query      = implode(" ", $query);
            $result     = $this->fetchRow($query);
        }
    }
    
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
    

















