<?php

class CategoryController extends Controller
{
    
    public function __construct($arrParams)
    {
        parent::__construct($arrParams);
        $this->_view->_tag          = 'category'; //for Sidebar
        
        $this->_templateObj->setFolderTemplate('backend/admin/admin_template/');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();

    }

    public function listAction()
    {    

        ob_start();
        
        // Clear Search
        if(isset($this->_arrParam['clear'])) {
            
            unset($this->_arrParam['search']);
            unset($this->_arrParam['clear']);
            
            URL::redirect('backend', 'group', 'list', $params = $this->_arrParam);
        }
        
        $this->_view->listUserGroupACP  = $this->_model->listUserGroupACP($this->_arrParam);     
        // Dành cho Ajax modified, modified_by
        $this->_model->listUserGroupACP = $this->_model->listUserGroupACP($this->_arrParam);     
        
        // page for bulk action
        if(isset($this->_arrParam['page'])){
            Session::set('page', $this->_arrParam['page']);
        }
        
        //Bulk Action
        if (isset($this->_arrParam['selectBoxCatagory'])) {
            
            $arrCid  = '';
            if(!empty($this->_arrParam['cid'])){
                foreach ($this->_arrParam['cid'] as $valueCid){
                    $arrCid .= "&cid[]=$valueCid";
                }
            }
            
            switch ($this->_arrParam['selectBoxCatagory']){
                case 'delete':
                    URL::redirect('backend', 'category', 'deleteMult', NULL , $arrCid);
                    break;
                case 'active':
                    $strRequest = $arrCid.'&statusChoose=1';
                    URL::redirect('backend', 'category', 'status', NULL ,$strRequest);
                    break;
                case 'inactive':
                    $strRequest = $arrCid.'&statusChoose=0';
                    URL::redirect('backend', 'category', 'status', NULL ,$strRequest);
                    break;
            }
       }

        //Odering
        if (isset($_GET['order'])) {
            $this->_model->ordering($this->_arrParam);
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
        
        $this->_view->_title        = 'Catagorys: List Item';
        $this->_view->Items         = $this->_model->listItems($this->_arrParam);
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;

        $this->_view->render('category/index', true);
        
        ob_end_flush();
    }

    public function statusAction()
    {

        if(!empty($_SESSION['page'])){
            $this->_arrParam['page'] = session::get('page');
            session::delete('page');
        }
        
        $this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
        $this->redirec('backend', 'category', 'list',$page=$this->_arrParam['page']);
    }

    public function ajaxStatusAction()
    {
        $return = json_encode($this->_model->changeStatus($this->_arrParam, $option = array('task' => 'change-ajax-status')));
        echo $return;
    }
    
    public function ajaxOrderingAction()
    {
         $return = json_encode($this->_model->changeOrdering($this->_arrParam, $option = array('task' => 'change-ajax-ordering')));
         echo $return;
    }

    public function clearAction()
    {
        $this->_view->_tag          = 'category';
        Session::set('search', '');
        Session::set('status', '');
    }

    // ACTION : ADD & EDIT
    public function formAction($option = null)
    {
        
        $this->_view->_title        = 'Categorys: Add';
        $this->_view->task          = 'add'; 
               
        if(!empty($_FILES['picture']['name'])){
            
            $this->_arrParam['form']['picture_temp'] = $_FILES['picture']['name'];
            
            $tempFileUpload = UPLOAD_PATH . 'category' . DS .'temp' . DS . $_FILES['picture']['name'];
            copy($_FILES['picture']['tmp_name'], $tempFileUpload);
        }

        // Edit
        if (isset($this->_arrParam['id'])) {
            
            $this->_view->_title  = 'Categorys: Edit';
            $this->_view->task    = 'edit';  
            
            $token        = 0;
            $picture      = ''; 
            $pictureTemp  = '';
            
            //Loading cho Input trong trường hợp đã Submit trước đó nhưng không thành công do lôĩ
            if(isset($this->_arrParam['form']['name'])){
                $name           = $this->_arrParam['form']['name'];
            }
            
            if(isset($this->_arrParam['form']['status'])){
                $status         = $this->_arrParam['form']['status'];
            }
            
            if(isset($this->_arrParam['form']['token'])){
                $token          = $this->_arrParam['form']['token'];
            }
            
            if(isset($this->_arrParam['form']['picture'])){
                $picture  = $this->_arrParam['form']['picture'];
            }
            
            if(isset($this->_arrParam['form']['picture_temp'])){
                $pictureTemp  = $this->_arrParam['form']['picture_temp'];
            }
            
            /*  Callback - Từ phiên làm trước đã submit rồi, phiên hiện tại chưa submit 
             *   trên edit nhưng cần giá trị để xuất dữ liệu ra input  */
            
            // Khi infoItem được gọi ở đây từ csdl thì đối tượng $this->_arrParam['form'] sẽ bị dữ liệu từ csdl ghi đè
            $this->_arrParam['form']                = $this->_model->infoItem($this->_arrParam);
            $this->_arrParam['form']['picture_old'] = $this->_arrParam['form']['picture'];  
            
            // CallBack
            if(!empty($picture)){
                $this->_arrParam['form']['picture'] = $picture;
            }
            
            if(!empty($pictureTemp)){
                unset($this->_arrParam['form']['picture']);
                $this->_arrParam['form']['picture_temp'] = $pictureTemp;
            }
            
            // Reload lại những giá trị đã nhập trên input trong trường hợp đã submit
            if(isset($name)) $this->_arrParam['form']['name']       = $name;
            if(isset($status)) $this->_arrParam['form']['status']   = $status;
            $this->_arrParam['form']['token']          = $token;

            if (empty($this->_arrParam['form'])) URL::redirect('backend', 'category', 'list');
        }
        
        
        /* LẤY THÔNG TIN ẢNH CÓ SẴN LÀ picture_temp */
        /* --- Hàm getImageInfoAction sẽ lấy thông số từ image để validate --- */
        require_once LIBRARY_EXT_PATH . 'Upload.php';
        $uploadObj = new Upload();
        /* --- Trong  getImageInfoAction nếu trường hợp có $this->picture_temp thì nó sẽ chọn picture_temp để lấy thông tin--- */
        $imageInfo = $uploadObj->getImageInfoAction($this->_arrParam, NULL);
        
        $this->_arrParam['form']['picture'] = array();
        $this->_arrParam['form']['picture']['name'] = $imageInfo['basename'];
        $this->_arrParam['form']['picture']['size'] = $imageInfo['size'];
        
        /* -- Ghi đè thông tin ảnh trong trường hợp có up file mới --*/
        if(!empty($_FILES['picture']['name'])){
            $this->_arrParam['form']['picture'] = $_FILES['picture'];
        }

        if (@$this->_arrParam['form']['token'] > 0) { 
            $this->_arrParam['form']['name'] = mysqli_real_escape_string($this->_model->connect,$this->_arrParam['form']['name']);
            $queryName  = "SELECT `id` FROM `" . TBL_CATEGORY . "` WHERE `name`   = '" . $this->_arrParam['form']['name'] . "'";
            
            if(isset($this->_arrParam['form']['id'])){
                //$taskAction      = "edit";
                $queryName      .= " AND `id` != '" . $this->_arrParam['form']['id'] . "'";
            }
            
            $validate = new Validate($this->_arrParam['form']);
            
            $validate->addRule('name', 'string-notExistRecord', array('database' => $this->_model, 'query' => $queryName, 'min' => 3, 'max' => 250))
                     ->addRule('status', 'status', array('deny' => array('default')))
                     ->addRule('picture', 'file', array('min' => 100, 'max' => 1000000, 'extension'=>array('jpg','png','jpeg')), false);
            
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            
            if ($validate->isValid() == false) {
                $this->_view->errors    = $validate->showErrors();
            } else {

                $taskAction = (isset($this->_arrParam['form']['id']) ? 'edit' : 'add');
                $id = $this->_model->saveItem($this->_arrParam, array('task' => $taskAction));
                
                /* Giai phong temp */
                require_once LIBRARY_EXT_PATH . 'Upload.php';
                $uploadObj = new Upload();
                $uploadObj->deleteAllTempFile($this->_arrParam);
                
                $type = $this->_arrParam['type'];
                
                if ($type == 'save-close') URL::redirect('backend', 'category', 'list');
                //plus
                if ($type == 'save-new') URL::redirect('backend', 'category', 'form');
                if ($type == 'save') URL::redirect('backend', 'category', 'form', array('id', $id));
            }
        }

        $this->_view->arrParam      = $this->_arrParam;

        $this->_view->render('category/form', true);
    }
    
    public function cancelAction(){
        /* Giai phong temp */
        require_once LIBRARY_EXT_PATH . 'Upload.php';
        $uploadObj = new Upload();
        $uploadObj->deleteAllTempFile($this->_arrParam);
        
        URL::redirect('backend', 'category', 'list');
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
        $this->redirec('backend', 'category', 'list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
    }
    
    public function deleteMultAction(){
        
        $this->_model->deleteMultItem($this->_arrParam);
        $this->redirec('backend', 'category', 'list');
        $this->_view->_currentPage  = $this->_model->_cunrrentPage;
        
    }
    
    public function errorAction(){
        $this->_view->render('error/error', true);
    }
}
