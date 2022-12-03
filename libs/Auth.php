<?php
class Auth{
    
    public static function checkLogin(){
    
        Session::ini();
        if(Session::get('loggedIn') == false){
            header('location: index.php?controller=user&action=login');
            exit();
    
        };
    
    }
}