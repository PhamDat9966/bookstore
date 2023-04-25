<?php 
/* BOOK */

// echo "<pre>bookview";
// print_r($this);
// echo "</pre>";

$listBook= '';

//Created selectgroup Array
$selectCategory = $this->slbCategory;

$listUserWithGroupACP = $this->listUserGroupACP;

// Bulk Action
$arrSelectBox       = ['0'=>'Bulk Action','delete'=>'Delete','action'=>'Active','inactive'=>'Inactive'];
$selection          = Helper::cmsSelectbox('selectBoxBook', 'form-control custom-select', $arrSelectBox, '0', null,$id = 'selectBoxBook');
$buttonSelection    = Helper::cmsButtonSubmit($type ="submit", $class = 'btn btn-info' ,$textOutfit = "Apply", $name = "bulk" , $value = "bulk" , $id = 'bulkApplyUser');

if(empty($this->Items)){
    URL::redirect('backend', 'book', 'error');
}

if(!empty($this->Items)){
    $i=0;
    foreach ($this->Items as $key=>$value){
        
        $id             =  $value['id'];
        $ckb            =  '<input type="checkbox" name="cid[]" value="'.$id.'">';
        
        $nameBook         = Helper::highLight(@$this->arrParam['search'], $value['name']);
        $picture        = '<img src="'. UPLOAD_URL . 'book' . DS . $value['picture'] . '" width="150" height="150">' ;
        
        $categoryName     = $value['category_name'];
        
        $price            = $value['price'];
        $saleOff          = $value['sale_off'] . '%';
        
        $created_by     = '';
        $modified_by    = '';
        
        $dataCategoryForBook                    = array();
        $dataCategoryForBook['id']              = $id;
        $dataCategoryForBook['category_id']     = $value['category_id'];
        
        if(in_array($value['created_by'], array_flip($listUserWithGroupACP))){
            $created_by         =   $listUserWithGroupACP[$value['created_by']];
        }
        
        if(in_array($value['modified_by'], array_flip($listUserWithGroupACP))){
            $modified_by         =   $listUserWithGroupACP[$value['modified_by']];
        }
        
        // SELECT CATEGORY  FOR BOOK ---
        /*
         * Mục đích sử dụng Onchange của Selecbox để chuyền value của selecbox về hàm jquery là changeGroupUser có chứa Ajax để 
         * chuyền chuỗi json có chứa id và group_id về controller->_model để Update
         */
        $dataGroupForUser         = array(); // $id and $ground_id, $group_name
        $jsonArrSelectCategoryForBook = array();// tramform $id and $group_id is json

        $k=0;
        foreach ($selectCategory as $keyA=>$valueA){
            $dataCategoryForBook[$k]['id'] = $id;
            $dataCategoryForBook[$k]['category_id'] = $keyA;
            $jsonArrSelectCategoryForBook[json_encode($dataCategoryForBook[$k])] = $valueA;
            $k++;
        }

        $selectCategoryForBook = Helper::cmsSelectboxForBookSelectCategory($name="selectCategoryForBook", $class="form-control custom-select w-auto", $arrValue = $jsonArrSelectCategoryForBook,$keySelect = $value['category_name'], $style = null,$idSelectBox = "selectCategoryForBook-$id",$option = 'onchange=\'changeCategoryForBook(this.value)\'');
        
        $jsonArrSelectCategoryForBook = '';
        $row                = ($i % 2 == 0) ? 'odd' : 'even';
        
        // STATUS
        $status             = '';
        $urlstatus          = URL::createLink('backend','book','ajaxUserStatus',array('id'=>$id,'status'=>$value['status']));
        $status             = Helper::cmsStatusUser($value['status'], $urlstatus ,$id);
        
        // SPECIAL
        $special             = '';
        $urlspecial          = URL::createLink('backend','book','ajaxSpecial',array('id'=>$id,'special'=>$value['special']));
        $special             = Helper::cmsSpecial($value['special'], $urlspecial  ,$id);
        
        // ORDERING
        $ordering       = Helper::cmsInput('number', $id, $value['ordering'],'book-ordering-'.$id.'', null, null, 'style="width: 3em"');
        
        //CREATED:
        // Time create
        $arrCreatedTime = explode(' ', $value['created']);
        
        $created            = '<i class="far fa-user"></i>  '.$created_by.'<br/>';
        $created           .='<i class="far fa-clock"></i>  '.$arrCreatedTime[1].' '.Helper::formatDate('d-m-Y', $arrCreatedTime[0]);
        
        //MODIFIED
        // Time modified
//         $arrModifiedTime    = explode(' ', $value['modified']);
//         $modified           = '<i class="far fa-user"></i>  '.$modified_by.'<br/>';
//         $modified          .='<i class="far fa-clock"></i>  '.$arrModifiedTime[1].' '.Helper::formatDate('d-m-Y', $arrModifiedTime[0]);
        
        //$editAction         = Helper::showItemAction('backend', 'user', 'form', $id, 'edit');
        $editBookLink   = URL::createLink('backend', 'book', 'form', $parram = array('task'=>'edit','id'=>$id));
        $editBook       = Helper::cmsButton($url = $editBookLink, $class = 'btn btn-sm btn-info rounded-circle', $textOufit = '<i class="fas fa-pen"></i>');
        
        $deleteAction       = Helper::showItemAction('backend', 'book', 'delete', $id, $statusAction ='delete');

        
        $listBook     .=
        '<tr id="book-id-'.$id.'">
            <td>'.$ckb.'</td>
            <td>'.$id.'</td>
            <td class="text-left">'.$nameBook.'</td>
            <td>'.$picture.'</td>
            <td>'.$price.'</td>
            <td>'.$saleOff.'</td>
            <td id="selectCategoryForBook">'.$selectCategoryForBook.'</td>
            <td>'.$status.'</td>
            <td>'.$special.'</td>
            <td id="td-oder-'.$id.'">'.$ordering.'</td>    
            <td>
                <p class="mb-0">'.$created.'</p>
            </td>
            <td>
                '.$editBook.'
                '.$deleteAction.'
            </td>
        </tr>';
        $i++;
    }
}

$addNewUrl    = URL::createLink('backend', 'book', 'form');
$addNewButton = Helper::cmsButton($url = $addNewUrl, $class = 'btn btn-info', $textOufit = '<i class="fas fa-plus"></i> Add New');


?>
<!-- Main content -->
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12" id="alert">
				<?php 
            	   require_once 'messageBox/index.php';
            	?>
            	<?php 
                    echo '<h3>'.__FILE__.'</h3>';
                ?>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- Search & Filter -->
                <?php
                    require_once MODULE_PATH .'backend'. DS . 'views' . DS . 'search-filter' . DS .'index.php';
                ?>
                
			<form action="#" method="post" name="book-list-form" id="book-list-form">	
<!-- 				<input type="hidden" name="module" value="backend"> -->
<!--                 <input type="hidden" name="controller" value="user"> -->
<!--                 <input type="hidden" name="action" value="list"> -->
			
				<!-- List -->
				<div class="card card-outline card-info" id="card-list">
					<div class="card-header">
						<h3 class="card-title">List</h3>

						<div class="card-tools">
							<a href="#" class="btn btn-tool" data-card-widget="refresh"> <i
								class="fas fa-sync-alt"></i>
							</a>
							<button type="button" class="btn btn-tool"
								data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="container-fluid">
							<div class="row align-items-center justify-content-between mb-2">
								<div>
									<div class="input-group">
										<?php 
										  echo $selection;
										?>
										<span class="input-group-append">
											<?php echo $buttonSelection;?>
										</span>
									</div>
								</div>
								<div>
									<?php echo $addNewButton;?>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table align-middle text-center table-bordered">
								<thead>
									<tr>
										<th><input type="checkbox" name="checkall-toggle"></th>
										<th>ID</th>
										<th class="text-left">Book Name</th>
										<th>Picture</th>
										<th>Price</th>
										<th>Sale Off</th>
										<th>Category</th>
										<th>Status</th>
										<th>Special</th>
										<th>Ordering</th>
										<th>Created</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php echo $listBook;?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer clearfix">
						<div class ="pagination m-0 float-right">
							<?php echo $this->Pagination['paginationHTML'];?>
						</div>
					</div>
				</div>
			</form>
				
			</div>
		</div>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /.content -->