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
        $this->_view->_title = "This is User: IndexAction";
        
        $cart = Session::get('cart');
        
        $this->_arrParam['cartKEY'] = array_keys($cart['quatity']);
        
        $this->_view->arrParam['cartList'] = $this->_model->cartItem($this->_arrParam);
        $this->_view->arrParam['cart']  = $cart;
        
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
    
    public  function ajaxOrderAction(){

//         echo "<pre>";
//         print_r($this->_arrParam);
//         echo "</pre>";
        
        $quatity = 0;
        if(isset($this->_arrParam['quatity'])){
            $quatity = $this->_arrParam['quatity'];    
        }
        
        $cart   = Session::get('cart');
        $bookID = $this->_arrParam['book_id'];
        $price  = $this->_arrParam['price'];
        
        if(empty($cart)){
            $cart['quatity'][$bookID]   = $quatity;
            $cart['price'][$bookID]     = $price*$quatity;
        }else{
            if(key_exists($bookID, $cart['quatity'])){
                $cart['quatity'][$bookID]     += $quatity;
                $cart['price'][$bookID]        = $price * $cart['quatity'][$bookID];
            }else {
                $cart['quatity'][$bookID]   = $quatity;
                $cart['price'][$bookID]     = $price*$cart['quatity'][$bookID];
            }
        }
        
        Session::set('cart', $cart);
        echo json_encode($cart);
        
    } 
    
    public  function unOrderAction(){
        
        Session::delete('cart');
        
    } 
}

































