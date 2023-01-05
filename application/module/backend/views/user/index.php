<?php 

$this->searchValue = Session::get('search');
$listUser = '';

//Created selectgroup Array
$selectGroup = [];
foreach ($this->groupNameData as $keyGroup=>$valueGroup){
    $selectGroup[$valueGroup['id']] = $valueGroup['name'];
}

// Bulk Action
$arrSelectBox = ['0'=>'Bulk Action','delete'=>'Delete','action'=>'Active','inactive'=>'Inactive'];
$selection          = Helper::cmsSelectbox('selectBoxUser', 'form-control custom-select', $arrSelectBox, '0', null,$id = 'selectBoxUser');
$buttonSelection    = Helper::cmsButtonSubmit($type ="submit", $class = 'btn btn-info' ,$textOutfit = "Apply", $name = "bulk" , $value = "bulk" , $id = 'bulkApplyUser');

if(!empty($this->Items)){
    $i=0;
    foreach ($this->Items as $key=>$value){
        
        $id             =  $value['id'];
        $ckb            =  '<input type="checkbox" name="cid[]" value="'.$id.'">';
        
        $name           = Helper::highLight(@$this->searchValue, $value['username']);
        //$fullName       = Helper::highLight(@$this->searchValue, $value['fullname']);
        //$email          = Helper::highLight(@$this->searchValue, $value['email']);
        
        $fullName       = $value['fullname'];
        $email          = $value['email'];
        
        $info           = '<p class="mb-0 text-left">
                            <b>Username: </b>'.$name.'<br/>
                            <b>FullName: </b>'.$fullName.'<br/>
                            <b>Email: </b>'.$email.'<br/>
                          </p>';
           
        $nameGroup      = $value['group_name'];
        
        $created_by     = '';
        $modified_by    = '';
        
        $group          = '<select class="-control custom-select w-auto';
        // Get seletgroup array Get $created_by value and $modified_by value
        foreach ($selectGroup as $keyselect=>$valueSelect){
            if($value['created_by'] == $keyselect){
                $created_by = $valueSelect;
            }
            
            if($value['modified_by'] == $keyselect){
                $modified_by = $valueSelect;
            }
            
            if($nameGroup == $valueSelect){
                $group .= '<option selected="">'.$valueSelect.'</option>';
            }
            $group .= '<option>'.$valueSelect.'</option>';
        }
        $group         .= '</select>';
        
        $row            = ($i % 2 == 0) ? 'odd' : 'even';
        
        
        //<a href="#" class="btn btn-success rounded-circle btn-sm"><i class="fas fa-check"></i></a>
        $status         = '';
        $urlstatus      = URL::createLink('backend','user','list',array('id'=>$id,'status'=>$value['status']),$this->_currentPage);
        $status         = Helper::cmsStatus($value['status'], $urlstatus ,$id);
        
        //CREATED:
        // Time create
        $arrCreatedTime = explode(' ', $value['created']);
        
        $created        = '<i class="far fa-user"></i>  '.$created_by.'<br/>';
        $created       .='<i class="far fa-clock"></i>  '.$arrCreatedTime[1].' '.Helper::formatDate('d-m-Y', $arrCreatedTime[0]);
        
        //MODIFIED
        
        // Time modified
        $arrModifiedTime = explode(' ', $value['created']);
        
        //$modified      = Helper::formatDate('d-m-Y', $value['modified']);
        $modified        = '<i class="far fa-user"></i>  '.$modified_by.'<br/>';
        $modified       .='<i class="far fa-clock"></i>  '.$arrModifiedTime[1].' '.Helper::formatDate('d-m-Y', $arrModifiedTime[0]);
        
        $editAction     = Helper::showItemAction('backend', 'user', 'form', $id, 'edit');
        $deleteAction   = Helper::showItemAction('backend', 'user', 'delete', $id, $statusAction ='delete');
        
        //General Password
        $generatePassLink   = URL::createLink('backend', 'user', 'form', $parram = array('task'=>'generatepass','id'=>$id));
        $generatePassword   = Helper::cmsButton($url = $generatePassLink, $class = 'btn btn-secondary btn-sm rounded-circle', $textOufit = '<i class="fas fa-key"></i>');
        
        $listUser      .=
        '<tr>
            <td>'.$ckb.'</td>
            <td>'.$id.'</td>
            <td>'.$info.'</td>
            <td>'.$group.'</td>
            <td>'.$status.'</td>
            <td>
                <p class="mb-0">'.$created.'</p>
            </td>
            <td>
                <p class="mb-0">'.$modified.'</p>
            </td>
            <td>
                '.$generatePassword.'
                '.$editAction.'
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
			<div class="col-12">
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
                
                <!--                 //////////////////////// -->
<!-- 				<div class="card card-outline card-info"> -->
<!-- 					<div class="card-header"> -->
<!-- 						<h3 class="card-title">Search & Filter</h3> -->

<!-- 						<div class="card-tools"> -->
<!-- 							<button type="button" class="btn btn-tool" -->
<!-- 								data-card-widget="collapse"> -->
<!-- 								<i class="fas fa-minus"></i> -->
<!-- 							</button> -->
<!-- 						</div> -->
<!-- 					</div> -->
<!-- 					<div class="card-body"> -->
<!-- 						<div class="container-fluid"> -->
<!-- 							<div class="row justify-content-between align-items-center"> -->
<!-- 								<div class="area-filter-status mb-2"> -->
<!-- 									<a href="#" class="btn btn-info">All <span -->
<!-- 										class="badge badge-pill badge-light">8</span></a> <a href="#" -->
<!-- 										class="btn btn-secondary">Active <span -->
<!-- 										class="badge badge-pill badge-light">3</span></a> <a href="#" -->
<!-- 										class="btn btn-secondary">Inactive <span -->
<!-- 										class="badge badge-pill badge-light">5</span></a> -->
<!-- 								</div> -->
<!-- 								<div class="area-filter-attribute mb-2"> -->
<!-- 									<select class="form-control custom-select"> -->
<!-- 										<option>- Select Group -</option> -->
<!-- 										<option>Admin</option> -->
<!-- 										<option>Manager</option> -->
<!-- 										<option>Member</option> -->
<!-- 										<option>Register</option> -->
<!-- 									</select> -->
<!-- 								</div> -->
<!-- 								<div class="area-search mb-2"> -->
<!-- 									<form action="" method="GET"> -->
<!-- 										<div class="input-group"> -->
<!-- 											<input type="text" class="form-control"> <span -->
<!-- 												class="input-group-append"> -->
<!-- 												<button type="submit" class="btn btn-info">Search</button> <a -->
<!-- 												href="#" class="btn btn-danger">Clear</a> -->
<!-- 											</span> -->
<!-- 										</div> -->
<!-- 									</form> -->
<!-- 								</div> -->
<!-- 							</div> -->
<!-- 						</div> -->
<!-- 					</div> -->
					<!-- /.card-body -->
<!-- 				</div> -->
				<!--                 //////////////////////// -->
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
										<?php echo $selection;?>
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