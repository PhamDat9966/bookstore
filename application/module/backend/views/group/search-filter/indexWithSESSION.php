<?php

echo "<pre>";
print_r($this->arrParam);
echo "</pre>";

//Filter
$allItem      = @$this->_count['allStatus'];
$activeItem   = @$this->_count['activeStatus'];
$inactiveItem = @$this->_count['inActiveStatus'];

$allButtonClass         = 'btn btn-info';
$activeButtonClass      = 'btn btn-secondary';
$inactiveButtonClass    = 'btn btn-secondary';

//Hidden Value Filter
$hiddenFilter          = ''; 

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

//Inactive
$textSpanIconInactive  = 'Inactive <span class="badge badge-pill badge-light">'.$inactiveItem.'</span>';
$buttonInactive        = Helper::cmsButtonSubmit($type='submit',$clas = $inactiveButtonClass, $textOufit = $textSpanIconInactive,$name='filter',$value='inactive');

$buttonClear           = Helper::cmsButtonSubmit($type='submit',$class='btn btn-danger', $textOufit = 'Clear',$name='clear',$value='clear'); 


//FILTER
$formFiler         = '<form action="" method="GET">
                        <input type="hidden" name="module" value="backend">
                        <input type="hidden" name="controller" value="group">
                        <input type="hidden" name="action" value="list">
                        '. $buttonAll.' '.$buttonActive.' '.$buttonInactive.'                      
                      </form>';
                   
//SEARCH

$this->searchValue = Session::get('search');

$formSearch        = '<form action="" method="GET">
                            <input type="hidden" name="module" value="backend">
                            <input type="hidden" name="controller" value="group">
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

$selectGroupACP = 'selectGroupACP';
if(isset($_SESSION['selectGroupACP'])){
    $selectGroupACP = $_SESSION['selectGroupACP'];
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
            <div class="row justify-content-between align-items-center">
                <div class="area-filter-status mb-2">
					<?php 
					   echo $formFiler; 
					?>
                </div>
                
                <div class="area-filter-status mb-2">
					<?php 
					   echo $formGroupACP ; 
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










