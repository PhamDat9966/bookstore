<?php
/* GROUP */

$listUserWithGroupACP = $this->listUserGroupACP;
if(isset($this->arrParam['clear'])) $this->arrParam['search'] = NULL;

$arrSelectBox = ['0' => 'Bulk Action', 'delete' => 'Delete', 'action' => 'Active', 'inactive' => 'Inactive', 'ordering' => 'Ordering'];

$selection          = Helper::cmsSelectbox('selectBox', 'form-control custom-select', $arrSelectBox, '0', null, $id = 'selectBox');
$buttonSelection    = Helper::cmsButtonSubmit($type = "submit", $class = 'btn btn-info', $textOutfit = "Apply", $name = "bulk", $value = "bulk", $id = 'bulkApplyGroup');

$listGroup = '';

if(empty($this->Items)){
    URL::redirect('backend', 'group', 'error');
}

if (!empty($this->Items)) {
    $i = 0;
    foreach ($this->Items as $key => $value) {

        $id             =  $value['id'];
        $ckb            =  '<input type="checkbox" name="cid[]" value="' . $id . '">';
        $name           = Helper::highLight(@$this->arrParam['search'], $value['name']);

        $row            = ($i % 2 == 0) ? 'odd' : 'even';

        $groupACP       = '';
        //$groupACP       = Helper::cmsGroupACP($value['group_acp'], URL::createLink('backend','group','list',array('id'=>$id,'group_acp'=>$value['group_acp']),$this->_currentPage),$id);
        //Ajax groupACP
        $groupACP       = Helper::cmsGroupACP($value['group_acp'], URL::createLink('backend', 'group', 'ajaxGroupACP', array('id' => $id, 'group_acp' => $value['group_acp'])), $id);

        $status         = '';
        //$urlstatus      = URL::createLink('backend','group','list',array('id'=>$id,'status'=>$value['status']),$this->_currentPage);
        //$status         = Helper::cmsStatus($value['status'], $urlstatus ,$id);
        //Ajax Status
        $status         = Helper::cmsStatus($value['status'], URL::createLink('backend', 'group', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);

        $created        = Helper::formatDate('d-m-Y', $value['created']);
        $modified       = Helper::formatDate('d-m-Y', $value['modified']);
        
        $created_by     = '';
        $modified_by    = '';
        
        if(in_array($value['created_by'], array_flip($listUserWithGroupACP))){
            $created_by = $listUserWithGroupACP[$value['created_by']];
        }

        if(in_array($value['modified_by'], array_flip($listUserWithGroupACP))){
            $modified_by = $listUserWithGroupACP[$value['modified_by']];
        }
        
        //$ordering       = '<input class="text-center" type="text" name="order[' . $id . ']" size="5" value="' . $value['ordering'] . '" class="text-area-order">';
        $ordering       = Helper::cmsInput('number', $id, $value['ordering'],'group-ordering-'.$id.'', null, null, 'style="width: 3em"');
        
        $editAction     = Helper::showItemAction('backend', 'group', 'form', $id, 'edit');
        $deleteAction   = Helper::showItemAction('backend', 'group', 'delete', $id, $statusAction = 'delete');

        $listGroup         .=
            '<tr class=' . $row . '>
                <td>' . $ckb . '</td>
                <td>' . $id . '</td>
                <td>' . $name . '</td>
                <td>' . $groupACP . '</td>
                <td>' . $status . '</td>
                <td>' . $ordering . '</td>
                <td>
                    <p class="mb-0"><i class="far fa-user"></i> ' . $created_by . '</p>
                    <p class="mb-0"><i class="far fa-clock"></i> ' . $created . '</p>
                </td>
                <td>
                    <p class="mb-0"><i class="far fa-user"></i> ' . $modified_by . '</p>
                    <p class="mb-0"><i class="far fa-clock"></i> ' . $modified . '</p>
                </td>
                <td>
                    ' . $editAction . '
                    ' . $deleteAction . '
                </td>
            </tr>';
        $i++;
    }
}
$addNewUrl    = URL::createLink('backend', 'group', 'form');
$addNewButton = Helper::cmsButton($url = $addNewUrl, $class = 'btn btn-info', $textOufit = '<i class="fas fa-plus"></i> Add New');

?>
<div class="col-12">
    <?php
        require_once 'messageBox/index.php';
    ?>
    <?php
        echo '<h3>' . __FILE__ . '</h3>';
    ?>
    <!-- Search & Filter -->
    <?php
        require_once MODULE_PATH .'backend'. DS . 'views' . DS . 'search-filter' . DS .'index.php';
    ?>
    <!-- END Search & Filter  -->

    <!-- List -->
    <!-- FORM GROUP -->
    <form action="#" method="post" name="group-list-form" id="group-list-form">

<!--         <input type="hidden" name="module" value="backend"> -->
<!--         <input type="hidden" name="controller" value="group"> -->
<!--         <input type="hidden" name="action" value="list"> -->

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
                                    <?php echo $buttonSelection; ?>
                                </span>
                            </div>
                        </div>
                        <div>
                            <?= $addNewButton; ?>
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
                    <?php echo $this->Pagination['paginationHTML']; ?>
                </ul>
            </div>
        </div>
    </form>
    <!-- END FORM -->

</div>