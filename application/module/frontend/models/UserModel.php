<?php

class UserModel extends Model
{
    public $_arrParam;
    public $_saveParam = [];
    protected $_tableName = TBL_USER;
    public    $_cunrrentPage      = 1;
    
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
    }    
    
}


















