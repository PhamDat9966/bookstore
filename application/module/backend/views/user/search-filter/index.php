<?php

//Filter
$allItem      = @$this->_count['allStatus'];
$activeItem   = @$this->_count['activeStatus'];
$inactiveItem = @$this->_count['inActiveStatus'];

$allButtonClass         = 'btn btn-info';
$activeButtonClass      = 'btn btn-secondary';
$inactiveButtonClass    = 'btn btn-secondary';

if(isset($_SESSION['filter'])){
    if($_SESSION['filter'] == 'active'){
        $allButtonClass         = 'btn btn-secondary';
        $activeButtonClass      = 'btn btn-info';
        $inactiveButtonClass    = 'btn btn-secondary';
    }
    
    if($_SESSION['filter'] == 'inactive'){
        $allButtonClass         = 'btn btn-secondary';
        $activeButtonClass      = 'btn btn-secondary';
        $inactiveButtonClass    = 'btn btn-info';
    }
}

$buttonSubmit = Helper::cmsButtonSubmit($type='submit',$class='btn btn-info', $textOufit='Search');

//All
$textSpanIconAll  = 'All <span class="badge badge-pill badge-light">'.$allItem.'</span>';
$buttonAll = Helper::cmsButtonSubmit($type='submit',$class = $allButtonClass, $textOufit = $textSpanIconAll, $name='filter', $value='all');

//Active
//<a href="#" class="btn btn-secondary">Active <span class="badge badge-pill badge-light">3</span></a>
$textSpanIconActive  = 'Active <span class="badge badge-pill badge-light">'.$activeItem.'</span>';
$buttonActive    = Helper::cmsButtonSubmit($type='submit',$class = $activeButtonClass, $textOufit = $textSpanIconActive,$name='filter',$value='active');

//<a href="#" class="btn btn-secondary">Inactive <span class="badge badge-pill badge-light">5</span></a>
$textSpanIconInactive  = 'Inactive <span class="badge badge-pill badge-light">'.$inactiveItem.'</span>';
$buttonInactive        = Helper::cmsButtonSubmit($type='submit',$clas = $inactiveButtonClass, $textOufit = $textSpanIconInactive,$name='filter',$value='inactive');

$buttonClear           = Helper::cmsButtonSubmit($type='submit',$class='btn btn-danger', $textOufit = 'Clear',$name='clear',$value='clear'); 

//FILTER
$formFiler         = '<form action="" method="GET">
                        <input type="hidden" name="module" value="backend">
                        <input type="hidden" name="controller" value="user">
                        <input type="hidden" name="action" value="list">
                        '. $buttonAll.' '.$buttonActive.' '.$buttonInactive.'                      
                      </form>';
                   
//SEARCH

$this->searchValue = Session::get('search');

$formSearch        = '<form action="" method="GET">
                            <input type="hidden" name="module" value="backend">
                            <input type="hidden" name="controller" value="user">
                            <input type="hidden" name="action" value="list">

                            <div class="input-group">
    							<input type="text" class="form-control" name="search" placeholder="Enter search keyword...." value="' . @$this->searchValue . '">
                                <span class="input-group-append">
                                	<button type="submit" class="btn btn-info">Search</button>
                                    '.' '.$buttonClear.'
                                </span>
                            </div>

                        </form>';

// filter Group ACP

$selectGroupFirst = '0';
$arrGroup         = array('0'=>'- Select Group -'); 
if(isset($_SESSION['selectGroup'])){
    $selectGroupFirst  = $_SESSION['selectGroup'];
}

//Created selectgroup Array
$selectGroupFilter = [];
foreach ($this->groupNameData as $keyGroup=>$valueGroup){
    $selectGroupFilter[$valueGroup['id']] = $valueGroup['name'];
}

$arrGroup        = array_merge($arrGroup,$selectGroupFilter);

$selectGroupBox     = Helper::cmsSelectbox('selectGroup', 'form-control custom-select',$arrValue = $arrGroup , $keySelect = $selectGroupFirst, null,$id = 'selectGroup');
$formGroup          = '<form action="" method="GET" name="filterGroupForUser" id="filterGroupForUser">
                            <input type="hidden" name="module" value="backend">
                            <input type="hidden" name="controller" value="user">
                            <input type="hidden" name="action" value="list">
                             '.$selectGroupBox.'            
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
            <div class="row justify-content-between align-items-center">
                <div class="area-filter-status mb-2">
					<?php 
					   echo $formFiler; 
					?>
                </div>
                
                <div class="area-filter-status mb-2">
					<?php 
					   echo $formGroup ; 
					?>
                </div>
                
                <div class="area-search mb-2">
                
<!--                     <form action="index.php?module=backend&controller=group&action=list" method="GET"> -->
<!--                         <div class="input-group"> -->
                        	<!-- Search Input -->
<!--                             <input type="text" class="form-control" name="search" placeholder="Enter search keyword...." value="'.@$this->searchValue.'"> -->
<!--                             <span class="input-group-append"> -->
<!--                             	<button type="submit" class="btn btn-info">Search</button> -->
                                <?php 
//                                     //echo $buttonSubmit;
//                                 ?>
<!--                                 <a href="#" class="btn btn-btn btn-danger">Clear</a> -->
<!--                             </span> -->
<!--                         </div> -->
<!--                     </form> -->

					<?php 
					   echo $formSearch;
					?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>










