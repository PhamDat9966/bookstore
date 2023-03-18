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
            
            $query[]    =   "SELECT `u`.`id`,`u`.`username`,`u`.`fullname`,`u`.`email`,`u`.`group_id`, `g`.`group_acp`, `g`.`privilege_id`";    
            $query[]    =   "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id` ";
            $query[]    =   "WHERE `username` = '$username' AND `password` = '$password'";
            
            $query      = implode(" ", $query);
            $result     = $this->fetchRow($query);
            
            if($result['group_acp'] == 1){
                $arrPrivilege = explode(',', $result['privilege_id']);
                
                $strPrililegeID = '';
                foreach ($arrPrivilege as $privilegeID) $strPrililegeID .= "'$privilegeID', ";
              
                $queryP     = array();
                $queryP[]   = "SELECT `id`,CONCAT(`module`,'-',`controller`,'-',`action`) AS name";
                $queryP[]   = "FROM `".TBL_PRIVILEGE."` AS p";
                $queryP[]   = "WHERE id IN ($strPrililegeID'0')"; // Thêm 1 phần tử '0' phía sau vì chuỗi $strPrivilegeID thừa ra dấu ',' 
                
                $queryP                 = implode(' ', $queryP);
                $result['privilege']    = $this->fetchPairs($queryP);
                
            }

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
    

















