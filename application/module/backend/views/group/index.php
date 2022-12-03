<?php 

$arrSelectBox = ['0'=>'Bulk Action','delete'=>'Delete','action'=>'Active','inactive'=>'Inactive'];

$selection = Helper::cmsSelectbox('selectBox', 'form-control custom-select', $arrSelectBox, '0', null);
$buttonSubmit = '<button type="submit" name="submit" value="OK" class="btn btn-info">Apply</button>';

$listGroup = '';

if(!empty($this->Items)){
    $i=0;
    foreach ($this->Items as $key=>$value){
        
        $id             =  $value['id'];
        $ckb            =  '<input type="checkbox" name="cid[]" value="'.$id.'">';
        $name           = Helper::highLight(@$this->searchValue, $value['name']);
  
        $row            = ($i % 2 == 0) ? 'odd' : 'even';
        
        $groupACP       = '';
        $groupACP       = Helper::cmsGroupACP($value['group_acp'], URL::createLink('backend','group','list',array('id'=>$id,'group_acp'=>$value['group_acp']),$this->_currentPage),$id);
        
        $status         = '';
        $urlstatus      = URL::createLink('backend','group','list',array('id'=>$id,'status'=>$value['status']),$this->_currentPage);
        $status         = Helper::cmsStatus($value['status'], $urlstatus ,$id);
        
        $created_by     = '';
        $created_by     = ($value['created_by'] == 1) ? 'Admin' : 'Manager';
        
        $created        = Helper::formatDate('d-m-Y', $value['created']);
        
        $modified_by    = '';
        $modified_by    = ($value['modified_by'] == 1) ? 'Admin' : 'Manager';
        
        $modified       = Helper::formatDate('d-m-Y', $value['modified']);
        
        $ordering       = '<input class="text-center" type="text" name="order['.$id.']" size="5" value="'.$value['ordering'].'" class="text-area-order">';
        
        $editAction     = Helper::showItemAction('backend', 'group', 'form', $id, 'edit');
        $deleteAction   = Helper::showItemAction('backend', 'group', 'delete', $id, 'delete');
        
        $listGroup         .=
        '<tr class='.$row.'>
            <td>'.$ckb.'</td>
            <td>'.$id.'</td>
            <td>'.$name.'</td>
            <td>'.$groupACP.'</td>
            <td>'.$status.'</td>
            <td>'.$ordering.'</td>
            <td>
                <p class="mb-0"><i class="far fa-user"></i> '.$created_by.'</p>
                <p class="mb-0"><i class="far fa-clock"></i> '.$created.'</p>
            </td>
            <td>
                <p class="mb-0"><i class="far fa-user"></i> '.$modified_by.'</p>
                <p class="mb-0"><i class="far fa-clock"></i> '.$modified.'</p>
            </td>
            <td>
                '.$editAction.'
                '.$deleteAction.'
            </td>
        </tr>';
        $i++;
    }
}

?>
<div class="col-12">
	<?php 
        echo '<h3>'.__FILE__.'</h3>';
    ?>
    <!-- Search & Filter -->
    <?php 
        require_once 'search-filter/index.php';
    ?>
    <!-- END Search & Filter  -->
    
    <!-- List -->
    <!-- FORM GROUP -->
   	<form action="index.php?module=backend&controller=group&action=value_new" method="post" name="group-list-form" id="group-list-form">

        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">List</h3>
        
                <div class="card-tools">
                    <a href="#" class="btn btn-tool" data-card-widget="refresh">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
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
                                    <?php echo $buttonSubmit;?>
                                </span>
                            </div>
                        </div>
                        <div>
                            <a href="index.php?module=backend&controller=group&action=form" class="btn btn-info"><i class="fas fa-plus"></i> Add New</a>
                        </div>
                    </div>
                </div>
        
                <div class="table-responsive">
                    <table class="table align-middle text-center table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="checkall-toggle"></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Group ACP</th>
                                <th>Status</th>
                                <th>Ordering</th>
                                <th>Created</th>
                                <th>Modified</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php 
                           
                        ?>
                        
                        <tbody>
                        <?php 
                            echo $listGroup;
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        
            
            <div class="card-footer clearfix">
                <ul class="pagination m-0 float-right">
                   	<?php echo $this->Pagination['paginationHTML'];?>
                </ul>
            </div>
        </div>
	</form>
    <!-- END FORM -->
    
</div>        