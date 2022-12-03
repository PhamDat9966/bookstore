<?php

//Filter
$allItem      = 0;
$activeItem   = 0;
$inactiveItem = 0;

// foreach ($this->Items as $key=>$value){
    
//     if($value['status'] == 1){
//         $activeItem++;
//     }
    
//     if($value['status'] == 0){
//         $inactiveItem++;
//     }
    
//     $allItem++;
// }

// foreach ($this->ItemsFilter as $key=>$value){
    
//     if($value['status'] == 1){
//         $activeItem++;
//     }
    
//     if($value['status'] == 0){
//         $inactiveItem++;
//     }
    
//     $allItem++;
// }

$buttonSubmit = Helper::cmsButton($type='submit',$class='default', $textOufit='Search');

//All
$textSpanIconAll  = 'All <span class="badge badge-pill badge-light">'.$allItem.'</span>';
$buttonAll = Helper::cmsButton($type='submit',$class='default', $textOufit = $textSpanIconAll);

//Active
//<a href="#" class="btn btn-secondary">Active <span class="badge badge-pill badge-light">3</span></a>
$textSpanIconActive  = 'Active <span class="badge badge-pill badge-light">'.$activeItem.'</span>';
$buttonActive    = Helper::cmsButton($type='submit',$class='secondary', $textOufit = $textSpanIconActive,$name='status',$value='active');

//<a href="#" class="btn btn-secondary">Inactive <span class="badge badge-pill badge-light">5</span></a>
$textSpanIconInactive  = 'Inactive <span class="badge badge-pill badge-light">'.$inactiveItem.'</span>';
$buttonInactive        = Helper::cmsButton($type='submit',$class='secondary', $textOufit = $textSpanIconInactive,$name='status',$value='inactive');

$formFiler         = '<form action="" method="GET">
                        <input type="hidden" name="module" value="backend">
                        <input type="hidden" name="controller" value="group">
                        <input type="hidden" name="action" value="list">
                        '. $buttonAll.' '.$buttonActive.' '.$buttonInactive.'                      
                      </form>';
                   
//SEARCH
$formSearch        = '<form action="" method="GET">
                            <input type="hidden" name="module" value="backend">
                            <input type="hidden" name="controller" value="group">
                            <input type="hidden" name="action" value="list">

                            <div class="input-group">
    							<input type="text" class="form-control" name="search" placeholder="Enter search keyword...." value="' . @$this->searchValue . '">
                                <span class="input-group-append">
                                	<button type="submit" class="btn btn-info">Search</button>
                                    <a href="#" class="btn btn-danger" name="clear" value="clear">Clear</a>
                                </span>
                            </div>

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
<!--                                 <a href="#" class="btn btn-danger">Clear</a> -->
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