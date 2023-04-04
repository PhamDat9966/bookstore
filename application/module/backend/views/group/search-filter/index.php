<?php

if(isset($this->arrParam['clear'])) $this->arrParam['search'] = NULL;

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

if($activeItem    == 0 ) $buttonActive = '';
if($inactiveItem  == 0)  $buttonInactive = '';

//FILTER
$filterButton          = $hiddenFilter.' '. $buttonAll.' '.$buttonActive.' '.$buttonInactive;
                   
//SEARCH

//$this->searchValue = Session::get('search');

$formSearch        = '<div class="input-group">
						<input type="text" class="form-control" name="search" placeholder="Enter search keyword...." value="'.@$this->arrParam['search'].'">
                        <span class="input-group-append">
                        	<button type="submit" class="btn btn-info">Search</button>
                            '.' '.$buttonClear.'
                        </span>
                    </div>';

// filter Group ACP

$selectGroupACP = 'selectGroupACP';
if(isset($this->arrParam['selectGroupACP'])){
    $selectGroupACP = $this->arrParam['selectGroupACP'];
}
$arrGroupACP        = ['groupACP'=>'- Select Group ACP -','0'=>'No','1'=>'Yes'];
$selectGroupACP     = Helper::cmsSelectbox('selectGroupACP', 'form-control custom-select', $arrGroupACP , $selectGroupACP, null,$id = 'selectGroupACP');

$formGroupACP       = '<form action="" method="GET" name="formGroupACP" id="formGroupACP">
                            <input type="hidden" name="module" value="backend">
                            <input type="hidden" name="controller" value="group">
                            <input type="hidden" name="action" value="list">
                             '.$selectGroupACP.'            
                        </form>';

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
        
        <form action="#" method="POST" name="formGroupACP" id="formGroupACP">
<!--         	<input type="hidden" name="module" value="backend"> -->
<!--             <input type="hidden" name="controller" value="group"> -->
<!--             <input type="hidden" name="action" value="list"> -->
            
            <div class="row justify-content-between align-items-center">
                <div class="area-filter-status mb-2">
					<?php 
					   echo $filterButton; 
					?>
                </div>
                <div class="area-filter-status mb-2">
					<?php 
					   echo $formGroupACP ; 
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










