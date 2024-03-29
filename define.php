<?php
    
    // ======================== PATH ================================//
    define('DS'                 , '/');
    define('ROOT_PATH'          , dirname(__FILE__));                         
    define('ROOT_URL'           , DS . 'bookstore');                     // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c gá»‘c
    
    define('LIBRARY_PATH'       , ROOT_PATH . DS . 'libs' . DS);              // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c thÆ° viá»‡n
    define('LIBRARY_EXT_PATH'   , LIBRARY_PATH . 'extends' . DS);              // Đường đẫn đến thư mục upload
    
    define('PUBLIC_PATH'        , ROOT_PATH . DS . 'public' . DS);            // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c public	
    define('PUBLIC_URL'         , ROOT_URL . DS . 'public' . DS);             // Đường dẫn tương đối đến thư mục public  
    
    define('UPLOAD_PATH'        , PUBLIC_PATH . 'files' . DS);                // Đường dẫn đến thư mục upload  
    define('UPLOAD_URL'         , PUBLIC_URL . 'files' . DS);                 // Đường dẫn đến thư mục upload 
    
    define('SCRIPT_PATH'        , PUBLIC_PATH . 'script' . DS);               // Đường dẫn đến thư mục scripts
    
    define('APPLICATION_PATH'   , ROOT_PATH . DS . 'application' . DS);       // Đường dẫn đến thư mục application	
    define('APPLICATION_URL'    , ROOT_URL . DS . 'application' . DS);        // Đường dẫn tương đối đến thư mục application	
   
    define ('MODULE_PATH'		, APPLICATION_PATH . 'module' . DS);		  // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c module
    define ('MODULE_URL'        , APPLICATION_URL . 'module' . DS);           // Đường dẫn tương đối đến thư mục module
    
    define ('BLOCK_PATH'		, APPLICATION_PATH . 'block' . DS);		      // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c block
    
    define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);		      // Đường dẫn tương đối đến thư mục template	
    define ('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);	
    
    define('DEFAULT_MODULE'         , 'backend');
    define('DEFAULT_CONTROLLER'     , 'index');
    define('DEFAULT_ACTION'         , 'login');
    
    // ======================== DATABASE ================================//
    define('DB_HOST'            , 'localhost');
    define('DB_USER'            , 'root');
    define('DB_PASS'            , '');
    define('DB_NAME'            , 'bookstore');
    define('DB_TABLE'           , 'group');
    
    // ======================== DATABASE TABLE ================================//
    define('TBL_GROUP'          , 'group');
    define('TBL_USER'           , 'user');
    define('TBL_PRIVILEGE'      , 'privilege');
    define('TBL_CATEGORY'       , 'category');
    define('TBL_BOOK'           , 'book');
    define('TBL_CART'           , 'cart');

    // ======================== CONFIG ================================//
    define('TIME_LOGIN'         , 36000);
   