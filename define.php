<?php
    
    // ======================== PATH ================================//
    define('DS'                 , DIRECTORY_SEPARATOR);
    define('ROOT_PATH'          , dirname(__FILE__));                         // Định nghĩa đường dẫn đến thư mục gốc
    define('ROOT_URL'           , DS . 'bookstore-nop' . DS);
    
    define('LIBRARY_PATH'       , ROOT_PATH . DS . 'libs' . DS);              // Định nghĩa đường dẫn đến thư mục thư viện
    
    define('PUBLIC_PATH'        , ROOT_PATH . DS . 'public' . DS);            // Định nghĩa đường dẫn đến thư mục public	
    define('PUBLIC_URL'         , ROOT_URL . DS . 'public' . DS);  
    
    define('APPLICATION_PATH'   , ROOT_PATH . DS . 'application' . DS);       // Định nghĩa đường dẫn đến thư mục application	
    define('APPLICATION_URL'    , ROOT_URL . DS . 'application' . DS);  
   
    define ('MODULE_PATH'		, APPLICATION_PATH . 'module' . DS);		// Định nghĩa đường dẫn đến thư mục module
    define ('MODULE_URL'        , APPLICATION_URL . 'module' . DS); 
    
    define ('TEMPLATE_PATH'		, PUBLIC_PATH . 'template' . DS);		      // Định nghĩa đường dẫn đến thư mục template	
    define ('TEMPLATE_URL'		, PUBLIC_URL . 'template' . DS);	
    
    define('DEFAULT_MODULE'         , 'backend');
    define('DEFAULT_CONTROLLER'     , 'dashboard');
    define('DEFAULT_ACTION'         , 'index');
    
    // ======================== DATABASE ================================//
    define('DB_HOST'            , 'localhost');
    define('DB_USER'            , 'root');
    define('DB_PASS'            , '');
    define('DB_NAME'            , 'bookstore');
    define('DB_TABLE'           , 'group');
    
    // ======================== DATABASE TABLE ================================//
    define('TBL_GROUP'          , 'group');

   