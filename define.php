<?php
    
    // ======================== PATH ================================//
    define('DS'                 , DIRECTORY_SEPARATOR);
    define('ROOT_PATH'          , dirname(__FILE__));                         
    define('ROOT_URL'           , DS . 'bookstore');                     // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c gá»‘c
    
    define('LIBRARY_PATH'       , ROOT_PATH . DS . 'libs' . DS);              // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c thÆ° viá»‡n
    define('LIBRARY_EXT_PATH'   , LIBRARY_PATH . 'extends' . DS);              // Đường đẫn đến thư mục upload
    
    define('PUBLIC_PATH'        , ROOT_PATH . DS . 'public' . DS);            // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c public	
    define('PUBLIC_URL'         , ROOT_URL . DS . 'public' . DS);             // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n tÆ°Æ¡ng Ä‘á»‘i Ä‘áº¿n thá»±c public  
    
    define('UPLOAD_PATH'        , PUBLIC_PATH . 'files' . DS);                // Đường dẫn đến thư mục upload  
    define('UPLOAD_URL'         , PUBLIC_URL . 'files' . DS);                // Đường dẫn đến thư mục upload  
    
    define('APPLICATION_PATH'   , ROOT_PATH . DS . 'application' . DS);       // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c application	
    define('APPLICATION_URL'    , ROOT_URL . DS . 'application' . DS);  
   
    define ('MODULE_PATH'		, APPLICATION_PATH . 'module' . DS);		  // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c module
    define ('MODULE_URL'        , APPLICATION_URL . 'module' . DS);           // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n tÆ°Æ¡ng Ä‘á»‘i Ä‘áº¿n thÆ° má»¥c module
    
    define ('BLOCK_PATH'		, APPLICATION_PATH . 'block' . DS);		      // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c block
    
    define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);		      // Ä�á»‹nh nghÄ©a Ä‘Æ°á»�ng dáº«n Ä‘áº¿n thÆ° má»¥c template	
    define ('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);	
    
    define('DEFAULT_MODULE'         , 'backend');
    define('DEFAULT_CONTROLLER'     , 'index');
    define('DEFAULT_ACTION'         , 'login');
    
//     define('DEFAULT_MODULE'         , 'backend');
//     define('DEFAULT_CONTROLLER'     , 'dashboard');
//     define('DEFAULT_ACTION'         , 'index');
    
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

    // ======================== CONFIG ================================//
    define('TIME_LOGIN'         , 36000);
   