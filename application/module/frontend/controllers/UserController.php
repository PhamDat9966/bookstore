<?php

class UserController extends Controller{
    
    public $_statusReturn;

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        
    }
      
    public  function indexAction(){
        $this->_view->_title = "This is User: IndexAction";
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('user-index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/index', true);
    }
    
    public  function cartAction(){
        $this->_view->_title = "My Cart";
        
        $cart = Session::get('cart');

        if(!empty($cart['quantity'])){
            foreach ($cart['quantity'] as $keyCart=>$valueCart){
                if($valueCart == 0){
                    unset($cart['quantity'][$keyCart]);
                    unset($cart['price'][$keyCart]);
                }
            }
        }
        
        Session::set('cart', $cart);
        
        $this->_view->Items = $this->_model->listItem($this->_arrParam,array('task'=>'book-in-cart'));
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('user-cart.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/cart', true);
    }
    
    public  function orderAction(){
        $this->_view->_title = "This is User: Order";
        $cart   = Session::get('cart');
        $bookID = $this->_arrParam['book_id'];
        $price  = $this->_arrParam['price'];
        
        if(empty($cart)){
            $cart['quatity'][$bookID]   = 1;
            $cart['price'][$bookID]     = $price;
        }else{
            if(key_exists($bookID, $cart['quatity'])){
                $cart['quatity'][$bookID]     += 1;
                $cart['price'][$bookID]        = $price * $cart['quatity'][$bookID]; 
            }else {
                $cart['quatity'][$bookID]   = 1;
                $cart['price'][$bookID]     = $price;
            }
        }
        
        Session::set('cart', $cart);
        URL::redirect('frontend', 'book', 'detail', array('book_id'=>$bookID));
    }   
    
    public  function ajaxDeleteItemOrderAction(){
//         echo "<pre>";
//         print_r($this->_arrParam);
//         echo "</pre>";
        $return = array();
        $quantity = 0;

        $cart = Session::get('cart');
        $totalQuantity = array_sum($cart['quantity']);
        
        if(isset($this->_arrParam['id'])){
            
           $id       = $this->_arrParam['id'];
           $quantity = $cart['quantity'][$id];
           unset($_SESSION['cart']['quantity'][$id]);
           unset($_SESSION['cart']['price'][$id]);
           
           $totalQuantity = $totalQuantity - $quantity;
           
           $return['id']                = $id;
           $return['totalQuantity']     = $totalQuantity;
           $return['totalPriceAllItem'] = array_sum($_SESSION['cart']['price']);
        }
        echo json_encode($return);
        
    } 
    
    public  function ajaxOrderAction(){

        $quantity = 0;
        if(isset($this->_arrParam['quantity'])){
            $quantity = $this->_arrParam['quantity'];    
        }
        
        $cart   = Session::get('cart');
        $bookID = $this->_arrParam['book_id'];
        $price  = $this->_arrParam['price'];
        
        if(empty($cart)){
            $cart['quantity'][$bookID]   = $quantity;
            $cart['price'][$bookID]     = $price*$quantity;
        }else{
            if(key_exists($bookID, $cart['quantity'])){
                $cart['quantity'][$bookID]     += $quantity;
                $cart['price'][$bookID]        = $price * $cart['quantity'][$bookID];
            }else {
                $cart['quantity'][$bookID]   = $quantity;
                $cart['price'][$bookID]     = $price*$cart['quantity'][$bookID];
            }
        }
        
        Session::set('cart', $cart);
        echo json_encode($cart);
        
    } 
    
    public  function ajaxQuantityAction(){
//         echo "<pre>";
//         print_r($this->_arrParam);
//         echo "</pre>";

        $ojectQuantity  = json_decode($this->_arrParam['paramQuantity']);
        
        $id             = $ojectQuantity->id;
        $quantity       = $ojectQuantity->value;
        
        $queryContent = "SELECT `id`,`price`,`sale_off` FROM `".TBL_BOOK."` WHERE `id`=$id";
        $result = $this->_model->fetchRow($queryContent);
        
        $totalPriceItem     = ($result['price'] - $result['price']*$result['sale_off']/100)*$quantity;      
        
        $_SESSION['cart']['quantity'][$id]  = $quantity;
        $_SESSION['cart']['price'][$id]     = $totalPriceItem;
        
        $totalPriceAllItem  = array_sum($_SESSION['cart']['price']);
        $allQuantity        = array_sum($_SESSION['cart']['quantity']);
        $return = json_encode(array('id'=>$id,'quantity'=>$quantity,'allQuantity'=>$allQuantity,'totalPriceItem'=>$totalPriceItem,'totalPriceAllItem'=>$totalPriceAllItem));
        echo $return;
    } 
    
    public function unOrderAction(){
        
        Session::delete('cart');
        
    } 
    
    public function buyAction(){
        $this->_model->saveItem($this->_arrParam,array('task'=>'submit-cart'));
        Session::delete('cart');
        URL::redirect('frontend', 'user', 'history');
    } 
    
    public function profileAction(){
        
        $this->_view->_title        = 'Profile';
        
        $this->_view->arrParam  =  $this->_arrParam;
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('profile.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/profile', true);// views folder
        
    }
    
    public function historyAction(){
        
        $this->_view->_title        = 'History';
        
        $this->_view->arrParam  =  $this->_arrParam;
        $this->_view->Items = $this->_model->listItem($this->_arrParam,array('task'=>'history-cart'));
        
        $this->_templateObj->setFolderTemplate('frontend/frontend_main/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('user/history', true);// views folder
        
    }
}

































