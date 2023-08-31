<?php

// THIS IS FILTER AND SEARCH FOR ALL CONTROLLER

//Filter
$allItem      = @$this->_count['allStatus'];
$activeItem   = @$this->_count['activeStatus'];
$inactiveItem = @$this->_count['inActiveStatus'];

$allButtonClass         = 'btn btn-info';
$activeButtonClass      = 'btn btn-secondary';
$inactiveButtonClass    = 'btn btn-secondary';

//Hidden Value Filter
$hiddenFilter           = ''; 
$hiddenSearch           = '';
$hiddenSelectGroupACP   = '';

//filterSearch
if(isset($this->arrParam['filter'])){
    
    switch ($this->arrParam['filter']){
        case 'active':
            $hiddenFilter = '<input type="hidden" name="filter" value="active">';
            $allButtonClass         = 'btn btn-secondary';
            $activeButtonClass      = 'btn btn-info';
            $inactiveButtonClass    = 'btn btn-secondary';
            break;
        case 'inactive':
            $hiddenFilter = '<input type="hidden" name="filter" value="inactive">';
            $allButtonClass         = 'btn btn-secondary';
            $activeButtonClass      = 'btn btn-secondary';
            $inactiveButtonClass    = 'btn btn-info';
            break;
        case 'all':
            $hiddenFilter = '<input type="hidden" name="filter value="all">';
            break;
    }
}

$buttonSubmit = Helper::cmsButtonSubmit($type='submit',$class='btn btn-info', $textOufit='Search');

//All
$textSpanIconAll  = 'All <span class="badge badge-pill badge-light">'.$allItem.'</span>';
$buttonAll = Helper::cmsButtonSubmit($type='submit',$class = $allButtonClass, $textOufit = $textSpanIconAll, $name='filter', $value='all');

//Active

$textSpanIconActive  = 'Active <span class="badge badge-pill badge-light">'.$activeItem.'</span>';
$buttonActive    = Helper::cmsButtonSubmit($type='submit',$class = $activeButtonClass, $textOufit = $textSpanIconActive,$name='filter',$value='active');

//Inactive
$textSpanIconInactive  = 'Inactive <span class="badge badge-pill badge-light">'.$inactiveItem.'</span>';
$buttonInactive        = Helper::cmsButtonSubmit($type='submit',$clas = $inactiveButtonClass, $textOufit = $textSpanIconInactive,$name='filter',$value='inactive');

$buttonClear           = Helper::cmsButtonSubmit($type='submit',$class='btn btn-danger', $textOufit = 'Clear',$name='clear',$value='clear'); 

if($activeItem    == 0 ) {
    $buttonActive = '';
    if(@$this->arrParam['filter'] == 'active'){
        unset($this->arrParam['module']);
        unset($this->arrParam['controller']);
        unset($this->arrParam['action']);
        $this->arrParam['filter'] = 'all';
        URL::redirect($this->arrParam['module'], $this->arrParam['controller'], $this->arrParam['action'],$params = $this->arrParam);
    }
}
if($inactiveItem  == 0)  {
    $buttonInactive = '';
    if(@$this->arrParam['filter'] == 'inactive'){
        unset($this->arrParam['module']);
        unset($this->arrParam['controller']);
        unset($this->arrParam['action']);
        $this->arrParam['filter'] = 'all';
        URL::redirect($this->arrParam['module'], $this->arrParam['controller'], $this->arrParam['action'],$params = $this->arrParam);
    }
}

//FILTER
$filterButton      = $hiddenFilter.' '. $buttonAll.' '.$buttonActive.' '.$buttonInactive;
                   
//SEARCH
$formSearch        = '<div class="input-group">
						<input type="text" class="form-control" name="search" placeholder="Enter search keyword...." value="'.@$this->arrParam['search'].'">
                        <span class="input-group-append">
                        	<button type="submit" class="btn btn-info">Search</button>
                            '.' '.$buttonClear.'
                        </span>
                    </div>';

// filter and search with Select Box 
$selectBoxFilterSearch = '';

/*---------group----------*/
if($this->arrParam['controller'] == 'group'){
    $selectGroupACP = 'selectGroupACP';
    if(isset($this->arrParam['selectGroupACP'])){
        $selectGroupACP = $this->arrParam['selectGroupACP'];
    }
    $arrGroupACP        = ['groupACP'=>'- Select Group ACP -','0'=>'No','1'=>'Yes'];
    $selectBoxFilterSearch     = Helper::cmsSelectbox('selectGroupACP', 'form-control custom-select', $arrGroupACP , $selectGroupACP, null,$id = 'selectGroupACP');
}else 

/*---------user----------*/
if($this->arrParam['controller'] == 'user'){
    
    // filter Group ACP
    $selectGroupFirst = '0';
    $arrGroup         = array('0'=>'- Select Group -');
    if(isset($this->arrParam['selectGroup'])){
        $selectGroupFirst  = $this->arrParam['selectGroup'];
    }
    
    //Created selectgroup Array
    $selectGroupFilter          = $this->slbGroup;
    //$arrGroup                   = array_merge($arrGroup,$selectGroupFilter);
    foreach ($selectGroupFilter as $keyGroup=>$valueGroup){
        $arrGroup[$keyGroup] = $valueGroup;
    }
    $selectBoxFilterSearch      = Helper::cmsSelectbox('selectGroup', 'form-control custom-select',$arrValue = $arrGroup , $keySelect = $selectGroupFirst, null,$id = 'selectGroup');
}else 

/*---------book----------*/
if($this->arrParam['controller'] == 'book'){
    
    /* filter Category */
    $selectCategoryFirst = '0';
    $arrCategory         = array('0'=>'- Select Category -');
    if(isset($this->arrParam['selectCategory'])){
        $selectCategoryFirst  = $this->arrParam['selectCategory'];
    }
    
    // Mảng Category làm dữ liệu lọc
    $selectCategoryFilter          = $this->slbCategory;
    
    foreach ($selectCategoryFilter as $keyCategory=>$valueCategory){
        $arrCategory[$keyCategory] = $valueCategory;
    }
    $categoryFilter = Helper::cmsSelectbox('selectCategory', 'form-control custom-select',$arrValue = $arrCategory , $keySelect = $selectCategoryFirst, null,$id = 'selectCategory');

    /* filter Special */
    $selectSpecial = '- Select Special -';
    if(isset($this->arrParam['selectSpecial'])){
        $selectSpecial = $this->arrParam['selectSpecial'];
    }
    $arrSpecial        = ['selectSpecial'=>'- Select Special -','0'=>'No','1'=>'Yes'];
    
    $selectBoxFilterSearch     = Helper::cmsSelectbox('selectSpecial', 'form-control custom-select', $arrSpecial ,  $keySelect = $selectSpecial, null,$id = 'selectSpecial');
    /* end filter Special*/
    
    $selectBoxFilterSearch      = '<div class="row">
                                        <div class="col-6">'.$categoryFilter.'</div>
                                        <div class="col-6">'.$selectBoxFilterSearch.'</div>
                                   </div>';
}

$refreshPage = '<input type="hidden" name="page" value="1">';
?>

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Search and Filter</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
        
        <form action="#" method="POST" name="formFilterAndSearch" id="formFilterAndSearch">     
            <div class="row justify-content-between align-items-center">
            	<?php echo $refreshPage;?>
                <div class="area-filter-status mb-2">
					<?php 
					   echo $filterButton; 
					?>
                </div>
                <div class="area-filter-status mb-2">
					<?php 
					   echo $selectBoxFilterSearch; 
					?>
                </div>
                
                <div class="area-search mb-2">
					<?php 
					   echo $formSearch;
					   //echo $hiddenSearch;
					?>
                </div>
            </div>
        </form>    
        </div>
    </div>
    <!-- /.card-body -->
</div>










