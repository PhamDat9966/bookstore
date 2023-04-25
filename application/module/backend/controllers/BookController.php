<?php

class BookController extends Controller
{

    public $_statusReturn;

    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_view->_tag          = 'book'; //for Sidebar
        
    }

    public function listAction()
    {            
        ob_start();

        // Clear Search
        if(isset($this->_arrParam['clear'])) {
            
            unset($this->_arrParam['search']);
            unset($this->_arrParam['clear']);
            
            URL::redirect('backend', 'user', 'list', $params = $this->_arrParam);
        }
        
        $this->_view->slbCategory          = $this->_model->categoryInSelectbox($this->_arrParam, $numberGroup = null);
        // For created_by modufied_by
        $this->_view->listUserGroupACP     = $this->_model->listUserGroupACP($this->_arrParam);
        // Dành cho Ajax modified, modified_by
        //$this->_model->listUserGroupACP    = $this->_model->listUserGroupACP($this->_arrParam);  

        //Bulk Action
        if (isset($this->_arrParam['selectBoxBook'])) {
            
            $arrCid  = ''; 
            if(!empty($this->_arrParam['cid'])){
                foreach ($this->_arrParam['cid'] as $valueCid){
                    $arrCid .= "&cid[]=$valueCid";
                }
            }
            
            if ($this->_arrParam['selectBoxBook'] == 'delete') {
                URL::redirect('backend', 'book', 'deleteMult',NULL, $arrCid);
            }

            if ($this->_arrParam['selectBoxBook'] == 'action') {

                $strRequest = $arrCid.'&statusChoose=1';                
                URL::redirect('backend', 'book', 'status', NULL ,$strRequest);
            }

            if ($this->_arrParam['selectBoxBook'] == 'inactive') {

                $strRequest = $arrCid.'&statusChoose=0';
                URL::redirect('backend', 'book', 'status', NULL ,$strRequest);
            }
        }

        // filter and search
//         if (isset($_GET['filter']) || isset($_GET['search']) || isset($_GET['clear']) || isset($_GET['selectGroup'])) {
//             $this->filterAndSearchAction();
//         }

        // charge active, inactive userACB and status
        if (isset($this->_arrParam['id'])) {

            $this->_arrParam['id'] = $this->_arrParam['id'];

            if (isset($this->_arrParam['status'])) {
                $this->statusAction();
            }

            // áº¨n url biáº¿n get cá»§a groupACB vÃ  Status báº±ng cÃ¡ch gá»�i láº¡i liÃªn káº¿t          
            $this->redirec($this->_arrParam['module'], $this->_arrParam['controller'], $this->_arrParam['action'], $this->_arrParam['page']);
        }
        
        //Special
        if(isset($this->_arrParam['selectSpecial'])){
            if($this->_arrParam['selectSpecial'] == 'selectSpecial'){
                unset($this->_arrParam['selectSpecial']);
            }
        }
        
        //Paginator
        $this->_arrParam['count']  = $this->_model->countFilterSearch($this->_arrParam);
        $this->_view->_count       = $this->_arrParam['count'];
        $this->_model->_countParam = $this->_arrParam['count'];
        
        $totalItems                = $this->_arrParam['count']['allStatus'];
        if (isset($this->_arrParam['filter'])) {
            if ($this->_arrParam['filter'] == 'active') $totalItems = $this->_arrParam['count']['activeStatus'];
            if ($this->_arrParam['filter'] == 'inactive') $totalItems = $this->_arrParam['count']['inActiveStatus'];
        }
        
        // CURRENT PAGE
        if (isset($this->_arrParam['page'])) {
            $this->_pagination['currentPage']           = $this->_arrParam['page'];
        }
        
        $this->_paginationResult                         = $this->_model->pagination($totalItems, $this->_pagination ,$arrParam = $this->_arrParam);
        
        $this->_view->Pagination    = $this->_paginationResult;
        
        //end Load
        $this->_view->_title        = 'Book Manager: List';

        $this->_view->Items         = $this->_model->listItems($this->_arrParam);
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;

        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('book-list.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('book/index', true);
        ob_end_flush();
    }
    
    public function ajaxOrderingAction()
    {
        $return = json_encode($this->_model->changeOrdering($this->_arrParam, $option = array('task' => 'change-ajax-ordering')));
        echo $return;
    }

    public function statusAction()
    {
      
        $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));       
        $this->redirec('backend', 'book', 'list');
        
    }
    
    public function ajaxUserStatusAction()
    {
        $return = json_encode($this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-user-status')));
        echo $return;
    }
    
    public function ajaxSpecialAction()
    {
        $return = json_encode($this->_model->changeSpecial($this->_arrParam, $option = array('task' => 'change-ajax-special')));
        echo $return;
    }

    public function filterAndSearchAction()
    {

        if (@$_GET['clear'] != '') {
            Session::delete('search');
            $_GET['search'] = '';
        }
        if (@$_GET['filter'] == 'all') {
            Session::set('filter', '');
        }

        if (isset($_GET['search'])) {
            $search  = trim($_GET['search']);
            Session::set('search', $search);
        }

        if (isset($_GET['filter'])) {
            $status  = trim($_GET['filter']);
            Session::set('filter', $status);
        }

        if (isset($_GET['selectGroup'])) {
            $status  = trim($_GET['selectGroup']);
            Session::set('selectGroup', $status);
            $this->_view->_arrParam = $this->_arrParam;
            if ($_GET['selectGroup'] == 0) {
                Session::delete('selectGroup');
            }
        }
    }

    public function clearAction()
    {
        $this->_view->_tag          = 'group';
        Session::set('search', '');
        Session::set('status', '');
    }
    
    public function gdfixAction()
    {
        
        if (version_compare(PHP_VERSION, '5.6.0') >= 0) {
            echo ' [OK] PHP version is newer than 5.6: '.phpversion();
        } else {
            echo ' [ERROR] Your PHP version is too old for CKFinder 3.x.';
        }
        
        if (!function_exists('gd_info')) {
            echo ' [ERROR] GD extension is NOT enabled.';
        } else {
            echo ' [OK] GD extension is enabled.';
        }
        
        if (!function_exists('finfo_file')) {
            echo ' [ERROR] Fileinfo extension is NOT enabled.';
        } else {
            echo ' [OK] Fileinfo extension is enabled.';
        }
        
        /*
         * Nếu có báo "[ERROR] GD extension is NOT enabled"
         *  
         *  Vào php.ini file
            tìm cụm ;extension=gd
            xóa ; rồi restart lại Apachi
         */
    }
    
    // ACTION : ADD & EDIT
    public function formAction($option = null)
    {
    
//         echo "<pre>";
//         print_r($_FILES);
//         echo "</pre>";
        
        if(!empty($_FILES['picture']['name'])){

            $this->_arrParam['form']['picture_temp'] = $_FILES['picture']['name'];

            $tempFileUpload = UPLOAD_PATH . 'book' . DS .'temp' . DS . $_FILES['picture']['name'];
            copy($_FILES['picture']['tmp_name'], $tempFileUpload);
        }
        
//         echo "<pre>";
//         print_r($this->_arrParam);
//         echo "</pre>";  
        
        // SelectGroup for User
        $setNumberGroupLimitControl  = 6;
        $this->_view->slbCategory          = $this->_model->categoryInSelectbox($this->_arrParam, $numberGroup = null);
        
        $this->_view->_title        = 'Book: Add a book';

        // _arrParamOld use When save have error. _arrParamOld save error
        if (isset($this->_arrParam['form'])) {
            $this->_arrParamOld['form'] = $this->_arrParam['form'];
            if (isset($this->_arrParam['form']['id'])) {
                $this->_arrParam['id'] = $this->_arrParam['form']['id'];
            }
        }

        if (isset($this->_arrParam['id'])) {
            $this->_view->_title  = 'Book: Edit';

            // For Case Save-close with Password = empty
            if (isset($this->_arrParam['form']['id'])) {
                $this->_arrParam['id'] = $this->_arrParam['form']['id'];
            }
            //Load cho Input trong trường hợp đã Submit trước đó nhưng không thành công do lôĩ vào các biến tạm
            if(isset($this->_arrParam['form']['name'])){
                $name               = $this->_arrParam['form']['name'];
            }
            
            if(isset($this->_arrParam['form']['shortDescription'])){
                $shortDescription   = $this->_arrParam['form']['shortDescription'];
            }
            
            if(isset($this->_arrParam['form']['description'])){
                $description        = $this->_arrParam['form']['description'];
            }
            
            if(isset($this->_arrParam['form']['price'])){
                $price              = $this->_arrParam['form']['price'];
            }
            
            if(isset($this->_arrParam['form']['sale_off'])){
                $sale_off           = $this->_arrParam['form']['sale_off'];
            }

            if(isset($this->_arrParam['form']['status'])){
                $status             = $this->_arrParam['form']['status'];
            }
            
            if(isset($this->_arrParam['form']['category_id'])){
                $category_id        = $this->_arrParam['form']['category_id'];
            }
            
            if(isset($this->_arrParam['form']['token'])){
                $token              = $this->_arrParam['form']['token'];
            }
            
            if(isset($this->_arrParam['form']['picture'])){
                $picture            = $this->_arrParam['form']['picture'];
            }
            
            if(isset($this->_arrParam['form']['picture_temp'])){
                $pictureTemp        = $this->_arrParam['form']['picture_temp'];
            }
            
            /*  Callback - Từ phiên làm trước đã submit rồi, phiên hiện tại chưa submit
             *   trên edit nhưng cần giá trị để xuất dữ liệu ra input  */
            
            // Khi infoItem được gọi ở đây từ csdl thì đối tượng $this->_arrParam['form'] sẽ bị dữ liệu từ csdl ghi đè
            $this->_arrParam['form'] = $this->_model->infoItem($this->_arrParam);
            $this->_arrParam['form']['picture_old'] = $this->_arrParam['form']['picture'];
            
            // CallBack lại trường hợp có biến tạm
            if(!empty($picture)){
                $this->_arrParam['form']['picture'] = $picture;
            }
            
            if(!empty($pictureTemp)){
                unset($this->_arrParam['form']['picture']);
                $this->_arrParam['form']['picture_temp'] = $pictureTemp;
            }
            
            
            // Image
            $imageInfo = $this->getImageInfoAction($this->_arrParam['form']['picture'], null);
            if(isset($this->_arrParam['form']['picture_temp'])){
                $imageInfo = $this->getImageInfoAction($this->_arrParam['form']['picture_temp'], 'temp');
            }
            
            $this->_arrParam['form']['picture'] = array();
            $this->_arrParam['form']['picture']['name'] = $imageInfo['basename'];
            $this->_arrParam['form']['picture']['size'] = $imageInfo['size'];
            
            // Reload lại những giá trị đã nhập trên input trong trường hợp đã submit
            if(isset($name))             $this->_arrParam['form']['name']             = $name;
            if(isset($shortDescription)) $this->_arrParam['form']['shortDescription'] = $shortDescription;
            if(isset($description))      $this->_arrParam['form']['description']      = $description;
            if(isset($price))            $this->_arrParam['form']['price']            = $price;
            if(isset($sale_off))         $this->_arrParam['form']['sale_off']         = $sale_off;
            if(isset($status))           $this->_arrParam['form']['status']           = $status;
            if(isset($category_id))      $this->_arrParam['form']['category_id']      = $category_id;
            
            $this->_arrParam['form']['token']          = $token;
            
            if (empty($this->_arrParam['form'])) URL::redirect('backend', 'book', 'list');
        }
        
        /* -- Ghi đè trong trường hợp có up file mới --*/
        if(!empty($_FILES['picture']['name'])){
            $this->_arrParam['form']['picture'] = $_FILES['picture'];
        }
        
        /*Tiép tuc ơ dây*/
        if (@$this->_arrParam['form']['token'] > 0) {
            $taskAction          = 'add';
            $queryUserName       = "SELECT `id` FROM `" . TBL_USER . "` WHERE `username`   = '" . $this->_arrParam['form']['username'] . "'";
            $queryEmailName      = "SELECT `id` FROM `" . TBL_USER . "` WHERE `email`      = '" . $this->_arrParam['form']['email'] . "'";

            if (isset($this->_arrParam['form']['id'])) {
                $taskAction      = 'edit';
                $queryUserName  .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
                $queryEmailName .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
            }
            
            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('username', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25))
                    ->addRule('password', 'string', array('min' => 3, 'max' => 255))
                    ->addRule('email', 'email-notExistRecord', array('database' => $this->_model, 'query' => $queryEmailName, 'min' => 3, 'max' => 25))
                    ->addRule('fullname', 'string', array('min' => 3, 'max' => 255))
                    ->addRule('status', 'status', array('deny' => array('default')))
                    ->addRule('group_id', 'status', array('deny' => array('default')));

            $validate->run();

            $this->_arrParam['form'] = $validate->getResult();

            if ($validate->isValid() == false) {
                $this->_view->errors    = $validate->showErrors();

                // When it's show Error but it have generatePassword when refresh
                if (@$this->_arrParam['task'] == 'generatepass') {
                    $this->_arrParam['form']['password'] = randomString($length = 12);
                }
            } else {

                $task = (isset($this->_arrParam['form']['id']) ? 'edit' : 'add');
                if (isset($this->_arrParam['task'])) {
                    $task = $this->_arrParam['task'];
                }

                $id      = $this->_model->saveItem($this->_arrParam, array('task' => $task));
                $type    = $this->_arrParam['type'];

                if ($type == 'save-close') URL::redirect('backend', 'book', 'list');
                //plus
                if ($type == 'save-new') URL::redirect('backend', 'book', 'form');
                if ($type == 'save') URL::redirect('backend', 'book', 'form', array('id', $id));
            }
        }

        $this->_view->_tag          = 'user';
        $this->_view->arrParam      = $this->_arrParam;

        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('book-form.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

        $this->_view->render('book/form', true);
    }
    
    public function getImageInfoAction($imageName, $option = null){
        if($option == null){
            $pathImage          = UPLOAD_PATH .'category'. DS . $imageName;
            $imageInfo          = pathinfo($pathImage);
            $imageInfo['size']  = filesize($pathImage);
            return $imageInfo;
        }
        if($option == 'temp'){
            
            $pathImage          = UPLOAD_PATH .'category'. DS . 'temp' . DS .$imageName;
            $imageInfo          = pathinfo($pathImage);
            $imageInfo['size']  = filesize($pathImage);
            return $imageInfo;
        }
    }

    public function deleteAction()
    {

        if (isset($_GET['id'])) $this->_model->deleteItem($_GET['id']);
        $this->redirec('backend', 'group', 'list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
    }

    public function deleteMultAction(){
        
        $this->_model->deleteMultItem($this->_arrParam);
        $this->redirec('backend', 'user', 'list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
    }
    
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function selectCategoryForBookAction()
    {
        $arrCategoryForBook             = json_decode($this->_arrParam['selectGroup'], true);
        $this->_arrParam['id']          = $arrCategoryForBook['id'];
        $this->_arrParam['category_id']    = $arrCategoryForBook['category_id'];

        $result = $this->_model->changeCategoryForBook($this->_arrParam, array('task' => 'change-ajax-category'));
        echo json_encode($result);
        
    }
    
    public function errorAction(){

        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('error.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
        
        $this->_view->render('error/error', true);
    }
    
    public function cancelAction(){
        /* Giai phong temp */
        require_once LIBRARY_EXT_PATH . 'Upload.php';
        $uploadObj = new Upload();
        $uploadObj->deleteAllTempFile($this->_arrParam);
        
        URL::redirect('backend', 'book', 'list');
    }
}