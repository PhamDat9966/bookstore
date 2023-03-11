<?php 

$this->searchValue = Session::get('search');
$listUser = '';

//Created selectgroup Array
$selectGroup = $this->slbGroup;

$listUserWithGroupACP = $this->listUserGroupACP;

// Bulk Action
$arrSelectBox       = ['0'=>'Bulk Action','delete'=>'Delete','action'=>'Active','inactive'=>'Inactive'];
$selection          = Helper::cmsSelectbox('selectBoxUser', 'form-control custom-select', $arrSelectBox, '0', null,$id = 'selectBoxUser');
$buttonSelection    = Helper::cmsButtonSubmit($type ="submit", $class = 'btn btn-info' ,$textOutfit = "Apply", $name = "bulk" , $value = "bulk" , $id = 'bulkApplyUser');

if(!empty($this->Items)){
    $i=0;
    foreach ($this->Items as $key=>$value){
        
        $id             =  $value['id'];
        $ckb            =  '<input type="checkbox" name="cid[]" value="'.$id.'">';
        
        $name           = Helper::highLight(@$this->searchValue, $value['username']);
        $fullName       = Helper::highLight(@$this->searchValue, $value['fullname']);
        $email          = Helper::highLight(@$this->searchValue, $value['email']);
        
        $info           = '<p class="mb-0 text-left">
                            <b>Username: </b>'.$name.'<br/>
                            <b>FullName: </b>'.$fullName.'<br/>
                            <b>Email: </b>'.$email.'<br/>
                          </p>';
           
        $nameGroup      = $value['group_name'];
        
        $created_by     = '';
        $modified_by    = '';
        
        $dataGroupForUser               = array();
        $dataGroupForUser['id']         = $id;
        $dataGroupForUser['group_id']   = $value['group_id'];
        
//         $created_by     = $value['created_by'];
//         $modified_by    = $value['modified_by'];
        
        // Tìm theo id với group_acp = 1
        // Trong trường có thay đổi username hệ thống sẽ tự động cập nhật
        
        foreach ($listUserWithGroupACP as $valueUserGroupACP){

            // 1 --- For Created_by and Modified_by
            if($value['created_by'] ==  $valueUserGroupACP['id']){
                $created_by         =   $valueUserGroupACP['username'];
            }
            
            if($value['modified_by'] == $valueUserGroupACP['id']){
                $modified_by         = $valueUserGroupACP['username'];
            }
                        
        }
        
        
        // SELECT GROUP  FOR USER ---
        /*
         * Mục đích sử dụng Onchange của Selecbox để chuyền value của selecbox về hàm jquery là changeGroupUser có chứa Ajax để 
         * chuyền chuỗi json có chứa id và group_id về controller->_model để Update
         */
        $dataGroupForUser         = array(); // $id and $ground_id, $group_name
        $jsonArrSelectGroupForUser = array();// tramform $id and $group_id is json

        $k=0;
        foreach ($selectGroup as $keyA=>$valueA){
            $dataGroupForUser[$k]['id'] = $id;
            $dataGroupForUser[$k]['group_id'] = $keyA;
            $jsonArrSelectGroupForUser[json_encode($dataGroupForUser[$k])] = $valueA;
            $k++;
        }
        
        $selectGroupForUser     = Helper::cmsSelectboxForUserSelectGroup($name="selectGroupForUser", $class="form-control custom-select w-auto", $arrValue = $jsonArrSelectGroupForUser,$keySelect = $value['group_name'], $style = null,$idSelectBox = "selectGroupForUser",$option = 'onchange=\'changeGroupUser(this.value)\'');
        $jsonArrSelectGroupForUser = '';
        $row                = ($i % 2 == 0) ? 'odd' : 'even';
        
        
        //<a href="#" class="btn btn-success rounded-circle btn-sm"><i class="fas fa-check"></i></a>
        $status             = '';
        //$groupACP       = Helper::cmsGroupACP($value['group_acp'], URL::createLink('backend','group','ajaxGroupACP',array('id'=>$id,'group_acp'=>$value['group_acp'])),$id);
        //
        
        $urlstatus          = URL::createLink('backend','user','ajaxUserStatus',array('id'=>$id,'status'=>$value['status']));
        $status             = Helper::cmsStatusUser($value['status'], $urlstatus ,$id);
        
        //CREATED:
        // Time create
        $arrCreatedTime = explode(' ', $value['created']);
        
        $created            = '<i class="far fa-user"></i>  '.$created_by.'<br/>';
        $created           .='<i class="far fa-clock"></i>  '.$arrCreatedTime[1].' '.Helper::formatDate('d-m-Y', $arrCreatedTime[0]);
        
        //MODIFIED
        // Time modified
        $arrModifiedTime    = explode(' ', $value['modified']);
        
        //$modified      = Helper::formatDate('d-m-Y', $value['modified']);
        $modified           = '<i class="far fa-user"></i>  '.$modified_by.'<br/>';
        $modified          .='<i class="far fa-clock"></i>  '.$arrModifiedTime[1].' '.Helper::formatDate('d-m-Y', $arrModifiedTime[0]);
        
        //$editAction         = Helper::showItemAction('backend', 'user', 'form', $id, 'edit');
        $editPassLink   = URL::createLink('backend', 'user', 'form', $parram = array('task'=>'edit','id'=>$id));
        $editPassword   = Helper::cmsButton($url = $editPassLink, $class = 'btn btn-sm btn-info rounded-circle', $textOufit = '<i class="fas fa-pen"></i>');
        
        $deleteAction       = Helper::showItemAction('backend', 'user', 'delete', $id, $statusAction ='delete');
        
        //General Password
        $generatePassLink   = URL::createLink('backend', 'user', 'form', $parram = array('task'=>'generatepass','id'=>$id));
        $generatePassword   = Helper::cmsButton($url = $generatePassLink, $class = 'btn btn-secondary btn-sm rounded-circle', $textOufit = '<i class="fas fa-key"></i>');
        
        $listUser      .=
        '<tr>
            <td>'.$ckb.'</td>
            <td>'.$id.'</td>
            <td>'.$info.'</td>
            <td>'.$selectGroupForUser.'</td>
            <td>'.$status.'</td>
            <td>
                <p class="mb-0">'.$created.'</p>
            </td>
            <td>
                <p class="mb-0">'.$modified.'</p>
            </td>
            <td>
                '.$generatePassword.'
                '.$editPassword.'
                '.$deleteAction.'
            </td>
        </tr>';
        $i++;
    }
}

$addNewUrl    = URL::createLink('backend', 'user', 'form');
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
                    require_once 'search-filter/index.php';
                ?>
                
			<form action="#" method="get" name="user-list-form" id="user-list-form">	
				<input type="hidden" name="module" value="backend">
                <input type="hidden" name="controller" value="user">
                <input type="hidden" name="action" value="list">
			
				<!-- List -->
				<div class="card card-outline card-info">
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
										<th><input type="checkbox"></th>
										<th>ID</th>
										<th class="text-left">Info</th>
										<th>Group</th>
										<th>Status</th>
										<th>Created</th>
										<th>Modified</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php echo $listUser;?>
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