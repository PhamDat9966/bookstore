<?php

class UserModel extends Model
{
    public $_arrParam;
    public $_saveParam = [];
    protected $_tableName = TBL_USER;
    public    $_cunrrentPage      = 1;
    private  $_userInfo;
    
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
                                'register_date',
                                'register_ip',
                                'status',
                                'ordering',
                                'group_id');
    
    
    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->_tableName);
        
        $userObj         = Session::get('user');
        $this->_userInfo = $userObj['info'];
        
    }
    
    public function infoItem($arrParam,$option = NULL){
        if($option == NULL){
            $email   = $arrParam['form']['email'];
            $password   = $arrParam['form']['password'];
            
            $query[]    =   "SELECT `u`.`id`,`u`.`username`,`u`.`fullname`,`u`.`email`,`u`.`group_id`, `g`.`group_acp`";
            $query[]    =   "FROM `user` AS `u` LEFT JOIN `group` AS `g` ON `u`.`group_id` = `g`.`id` ";
            $query[]    =   "WHERE `email` = '$email' AND `password` = '$password'";
            
            $query      = implode(" ", $query);
            $result     = $this->fetchRow($query);
            return $result;
        }
    }
    
    public function saveItem($arrParam, $option = null){
        
        if($option['task'] == 'save-register'){
            
            $arrParam['form']['register_date']  =   date("Y-m-d H:m:s",time());
            $arrParam['form']['register_ip']    =   $_SERVER['REMOTE_ADDR'];
            $arrParam['form']['status']         =   0;
            
            $data   = array_intersect_key($arrParam['form'], array_flip($this->_columns));
            $this->insert($data);
            Session::set('message', array('class' => 'success', 'content' => 'Đã thêm dữ liệu thành công!'));
            return $this->lastID();
        }
        
        if($option['task'] == 'submit-cart'){
            
            $id         = $this->randomString(7);
            $username   = $this->_userInfo['username'];
            $books      = json_encode($arrParam['form']['book_id']);
            $prices     = json_encode($arrParam['form']['price']);
            $quantities = json_encode($arrParam['form']['quantity']);
            $names      = json_encode($arrParam['form']['name']);
            $pictures   = json_encode($arrParam['form']['picture']);
            $date       = date('Y-m-d H:i:s', time());
            
            $status     = 0;
            
            $query = "INSERT INTO `".TBL_CART."` (`id`,`username`,`books`,`prices`,`quantities`,`names`,`pictures`,`status`,`date`)
                      VALUES ('$id','$username','$books','$prices','$quantities','$names','$pictures','$status','$date')";
            $this->query($query);
        }
    }
    
    private function randomString($length = 5)
    {
        
        $arrCharacter = array_merge( range('a', 'z'), range(0, 9), range('A', 'Z'));
        $arrCharacter = implode('', $arrCharacter);
        $arrCharacter = str_shuffle($arrCharacter);
        
        $result        = substr($arrCharacter, 0, $length);
        return $result;
    }
    
    
    public function cartItem($arrParam, $option = null){
        $strCart = '';
        foreach ($arrParam['cartKEY'] as $value){
            $strCart .=$value.',';
        }
        
        $strCart = substr_replace($strCart ,"",-1);
        
        if($option == null){
            $queryContent   = [];
            $queryContent[] = "SELECT `id`,`name`,`picture`,`price`,`sale_off`";
            $queryContent[] = "FROM `".TBL_BOOK."`";
            $queryContent[] = "WHERE `id` IN(".$strCart.")";
            $queryContent       = implode(" ", $queryContent);
            $result = $this->fetchAll($queryContent);
            return $result;
        }
    }
    
    public function listItem($arrParam,$option = NULL){
        if($option['task'] == 'book-in-cart'){
            
            $cart   = Session::get('cart');
            $result = array();   
            
            if(!empty($cart)){
                
                $ids    = "(";
                foreach ($cart['quantity'] as $key=>$value) $ids .= "'$key', ";
                $ids   .= "'0')"; 
                
                $queryContent   = [];
                $queryContent[] = "SELECT `id`,`name`,`picture`";
                $queryContent[] = "FROM `" . TBL_BOOK . "`";
                $queryContent[] = "WHERE `status` = 1 AND `id` IN $ids";
                $queryContent[] = "ORDER BY `ordering` ASC";
                $queryContent = implode(" ", $queryContent);
                
                $result = $this->fetchAll($queryContent);
                
                foreach ($result as $key=>$value){
                    $result[$key]['quantity']       = $cart['quantity'][$value['id']];
                    $result[$key]['totalprice']     = $cart['price'][$value['id']];
                    $result[$key]['price']          = $result[$key]['totalprice']/$result[$key]['quantity'];
                }

            }
            
            return $result;
        }
        
        if($option['task'] == 'history-cart'){
            
            $username       = $this->_userInfo['username'];
            
            $queryContent   = [];
            $queryContent[] = "SELECT `id`,`username`,`books`,`prices`,`quantities`,`names`,`pictures`,`status`,`date`";
            $queryContent[] = "FROM `" . TBL_CART . "`";
            $queryContent[] = "WHERE `username` = '$username'";
            $queryContent[] = "ORDER BY `date` DESC";
            $queryContent   = implode(" ", $queryContent);
            
            $result = $this->fetchAll($queryContent);
            return $result;
        }
    }    
    
}


















