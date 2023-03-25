<?php

$this->searchValue = Session::get('search');

$listUserWithGroupACP = $this->listUserGroupACP;

$arrSelectBox = ['0' => 'Bulk Action', 'delete' => 'Delete', 'action' => 'Active', 'inactive' => 'Inactive', 'ordering' => 'Ordering'];

$selection          = Helper::cmsSelectbox('selectBox', 'form-control custom-select', $arrSelectBox, '0', null, $id = 'selectBox');
$buttonSelection    = Helper::cmsButtonSubmit($type = "submit", $class = 'btn btn-info', $textOutfit = "Apply", $name = "bulk", $value = "bulk", $id = 'bulkApplyCategory');

$listCategory = '';

if (!empty($this->Items)) {
    $i = 0;
    foreach ($this->Items as $key => $value) {

        $id             =  $value['id'];
        $ckb            =  '<input type="checkbox" name="cid[]" value="' . $id . '">';
        $name           = Helper::highLight(@$this->searchValue, $value['name']);

        $row            = ($i % 2 == 0) ? 'odd' : 'even';

        $status         = '';
        //$urlstatus      = URL::createLink('backend','category','list',array('id'=>$id,'status'=>$value['status']),$this->_currentPage);
        //$status         = Helper::cmsStatus($value['status'], $urlstatus ,$id);
        //Ajax Status
        $status         = Helper::cmsStatus($value['status'], URL::createLink('backend', 'category', 'ajaxStatus', array('id' => $id, 'status' => $value['status'])), $id);
        
        $created_by     = '';
        $modified_by    = '';
        
        //$created_by     = $value['created_by'];
        $created        = Helper::formatDate('d-m-Y', $value['created']);

        //$modified_by    = $value['modified_by'];
        $modified       = Helper::formatDate('d-m-Y', $value['modified']);
        
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

        $ordering       = '<input class="text-center" type="text" name="order[' . $id . ']" size="5" value="' . $value['ordering'] . '" class="text-area-order">';

        $editAction     = Helper::showItemAction('backend', 'category', 'form', $id, 'edit');
        $deleteAction   = Helper::showItemAction('backend', 'category', 'delete', $id, $statusAction = 'delete');

        $listCategory       .=
            '<tr class=' . $row . '>
            <td>' . $ckb . '</td>
            <td>' . $id . '</td>
            <td>' . $name . '</td>
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
$addNewUrl    = URL::createLink('backend', 'category', 'form');
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
    require_once 'search-filter/index.php';
    ?>
    <!-- END Search & Filter  -->

    <!-- List -->
    <!-- FORM category -->
    <form action="#" method="get" name="category-list-form" id="category-list-form">

        <input type="hidden" name="module" value="backend">
        <input type="hidden" name="controller" value="category">
        <input type="hidden" name="action" value="list">

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
                            <div class="input-category">
                                <?php
                                echo $selection;
                                ?>
                                <span class="input-category-append">
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
                                <th>Status</th>
                                <th>Ordering</th>
                                <th>Created</th>
                                <th>Modified</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            echo $listCategory;
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