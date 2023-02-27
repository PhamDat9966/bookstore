<?php 
	
    echo "<h3 style='color:red;'>".__FILE__."</h3>";
    
    $groupCount = $this->_arrParam['group'];
    $userCount  = $this->_arrParam['user'];
    
    $groupUrl   = URL::createLink('backend', 'group', 'list'); 
    $groupLink  = Helper::cmsButton($url = $groupUrl, $class = "small-box-footer", $textOufit = 'More info <i class="fas fa-arrow-circle-right"></i>');
    
    $userUrl   = URL::createLink('backend', 'user', 'list');
    $userLink  = Helper::cmsButton($url = $userUrl, $class = "small-box-footer", $textOufit = 'More info <i class="fas fa-arrow-circle-right"></i>');
    
    $arrMenu   = array(
                            array('link'=>URL::createLink('backend', 'group', 'list'),      'name'=>'group',    'image'=>'<i class="ion ion-ios-people"></i>', 'count'=>$this->_arrParam['group']),
                            array('link'=>URL::createLink('backend', 'user', 'list'),       'name'=>'user',     'image'=>'<i class="ion ion-ios-person"></i>', 'count'=>$this->_arrParam['user']),
                            array('link'=>URL::createLink('backend', 'category', 'list'),   'name'=>'category', 'image'=>'<i class="ion ion-ios-folder"></i>', 'count'=>10),
                            array('link'=>URL::createLink('backend', 'category', 'list'),   'name'=>'book',     'image'=>'<i class="ion ion-ios-book"></i>',   'count'=>30)
        
                        );
    $xhtml     = '';
    foreach ($arrMenu as $key=>$value){
        $xhtml .='<div class="col-lg-3 col-6">
            			<div class="small-box bg-info">
            				<div class="inner">
            					<h3>'.$value['count'].'</h3>
            
            					<p>'.$value['name'].'</p>
            				</div>
            				<div class="icon">
            					'.$value['image'].'
            				</div>
            				<a href="'.$value['link'].'" class="small-box-footer">More info <i
            					class="fas fa-arrow-circle-right"></i></a>
            			</div>
            		</div>';
    }
?>
<div class="row">
	<?php echo $xhtml;?>
</div>


