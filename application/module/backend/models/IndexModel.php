<?php

class IndexModel extends Model
{
    protected $_tableGroup = TBL_GROUP;
    protected $_tableUser  = TBL_USER;

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
                                'status',
                                'group_id'
                            );
    
    
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_tableUser);
        
    }
    
    public function infoItem($arrParam,$option = NULL){
        if($option == NULL){
            $username   = $arrParam['form']['username'];
            $password   = $arrParam['form']['password'];
            
            $query[]    =   "SELECT `u`.`id`,`u`.`username`,`u`.`fullname`,`u`.`email`,`u`.`group_id`, `g`.`group_acp`";    
            $query[]    =   "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id` ";
            $query[]    =   "WHERE `username` = '$username' AND `password` = '$password'";
            
            $query      = implode(" ", $query);
            $result     = $this->fetchRow($query);
            return $result;
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
    
    public function saveItem($arrParam, $option = null){
        
        if($option['task'] == 'edit'){
            $arrParam['form']['modified']    = date('Y-m-d h:i:s',time());
            $arrParam['form']['modified_by'] = $_SESSION['user']['info']['username'];
            
            $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->update($data, array(array('id',$arrParam['form']['id'])));
            Session::set('message', array('class' => 'success', 'content' => 'Dữ liệu được lưu thành công!'));
            return $arrParam['form']['id'];
        }

    }
    
}
    

















