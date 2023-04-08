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
    if($this->arrParam['filter'] == 'active'){
        
        $hiddenFilter = '<input type="hidden" name="filter" value="active">';
        $allButtonClass         = 'btn btn-secondary';
        $activeButtonClass      = 'btn btn-info';
        $inactiveButtonClass    = 'btn btn-secondary';
    }
    if($this->arrParam['filter'] == 'inactive'){
        $hiddenFilter = '<input type="hidden" name="filter" value="inactive">';
        $allButtonClass         = 'btn btn-secondary';
        $activeButtonClass      = 'btn btn-secondary';
        $inactiveButtonClass    = 'btn btn-info';
    }
    if($this->arrParam['filter'] == 'all'){
        $hiddenFilter = '<input type="hidden" name="filter value="all">';
    }
}

//if(isset($this->arrParam['search'])) $hiddenSearch = '<input type="hidden" name="search" value="'.$this->arrParam['search'].'">';

$buttonSubmit = Helper::cmsButtonSubmit($type='submit',$class='btn btn-info', $textOufit='Search');

//All
$textSpanIconAll  = 'All <span class="badge badge-pill badge-light">'.$allItem.'</span>';
$buttonAll = Helper::cmsButtonSubmit($type='submit',$class = $allButtonClass, $textOufit = $textSpanIconAll, $name='filter', $value='all');

//Active
//<a href="#" class="btn btn-secondary">Active <span class="badge badge-pill badge-light">3</span></a>
$textSpanIconActive  = 'Active <span class="badge badge-pill badge-light">'.$activeItem.'</span>';
$buttonActive    = Helper::cmsButtonSubmit($type='submit',$class = $activeButtonClass, $textOufit = $textSpanIconActive,$name='filter',$value='active');

//Inactive
$textSpanIconInactive  = 'Inactive <span class="badge badge-pill badge-light">'.$inactiveItem.'</span>';
$buttonInactive        = Helper::cmsButtonSubmit($type='submit',$clas = $inactiveButtonClass, $textOufit = $textSpanIconInactive,$name='filter',$value='inactive');

$buttonClear           = Helper::cmsButtonSubmit($type='submit',$class='btn btn-danger', $textOufit = 'Clear',$name='clear',$value='clear'); 

if($activeItem    == 0 ) {
    $buttonActive = '';
    if($this->arrParam['filter'] == 'active'){
        unset($this->arrParam['module']);
        unset($this->arrParam['controller']);
        unset($this->arrParam['action']);
        $this->arrParam['filter'] = 'all';
        URL::redirect($this->arrParam['module'], $this->arrParam['controller'], $this->arrParam['action'],$params = $this->arrParam);
    }
}
if($inactiveItem  == 0)  {
    $buttonInactive = '';
    if($this->arrParam['filter'] == 'inactive'){
        unset($this->arrParam['module']);
        unset($this->arrParam['controller']);
        unset($this->arrParam['action']);
        $this->arrParam['filter'] = 'all';
        URL::redirect($this->arrParam['module'], $this->arrParam['controller'], $this->arrParam['action'],$params = $this->arrParam);
    }
}

//FILTER
$filterButton          = $hiddenFilter.' '. $buttonAll.' '.$buttonActive.' '.$buttonInactive;
                   
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
if($this->_tag == 'group'){
    $selectGroupACP = 'selectGroupACP';
    if(isset($this->arrParam['selectGroupACP'])){
        $selectGroupACP = $this->arrParam['selectGroupACP'];
    }
    $arrGroupACP        = ['groupACP'=>'- Select Group ACP -','0'=>'No','1'=>'Yes'];
    $selectBoxFilterSearch     = Helper::cmsSelectbox('selectGroupACP', 'form-control custom-select', $arrGroupACP , $selectGroupACP, null,$id = 'selectGroupACP');
}

/*---------user----------*/
if($this->_tag == 'user'){
    
    // filter Group ACP
    $selectGroupFirst = '0';
    $arrGroup         = array('0'=>'- Select Group -');
    if(isset($this->arrParam['selectGroup'])){
        $selectGroupFirst  = $this->arrParam['selectGroup'];
    }
    
    //Created selectgroup Array
    $selectGroupFilter          = $this->slbGroup;
    $arrGroup                   = array_merge($arrGroup,$selectGroupFilter);
    $selectBoxFilterSearch      = Helper::cmsSelectbox('selectGroup', 'form-control custom-select',$arrValue = $arrGroup , $keySelect = $selectGroupFirst, null,$id = 'selectGroup');
}

// Để tránh các lỗi phát sinh do quá trình lọc không ra giá trị rỗng, Mỗi lần lọc với các tác vụ bất kỳ
// $refresh sẽ tự đưa về page = 1
//$refreshPage = Helper::cmsInput($type = "hidden", $name="page", $value="1");
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










