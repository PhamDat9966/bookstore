<?php
// IMAGE
$adminLTELogo   = '<img src="'.$this->_urlImg .'/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8>';
$userImage      = '<img src="'.$this->_urlImg .'/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">';

$sidebar        = array(
                    'dashboard'=>
                    array(
                       'name'   =>'Dashboard',   
                        'href'  =>URL::createLink('backend','dashboard','index'),
                        'icon'  =>'<i class="nav-icon fas fa-tachometer-alt"></i>'
                    ),
                    'group'=>
                    array(
                        'name'=>'Group',
                        'href'=>'#',
                        'icon'  =>'<i class="nav-icon fa fa-users"></i>',
                        'tree'=>array(
                                        array(
                                            'name'=>'List',
                                            'href'=>URL::createLink('backend','group','list')
                                            //'href'=>'index.php?module=backend&controller=group&action=list'  
                                        ),
                                        array(
                                            'name'=>'Add',
                                            'href'=>URL::createLink('backend','group','form')
                                            //'href'=>'index.php?module=backend&controller=group&action=form'
                                        )
                        )
                    ),
                    'user'=>
                    array(
                        'name'=>'User',
                        'href'=>'#',
                        'icon'  =>'<i class="nav-icon fa fa-user"></i>',
                        'tree'=>array(
                            array(
                                'name'=>'List',
                                'href'=>URL::createLink('backend','user','list')
                                //'href'=>'index.php?module=backend&controller=user&action=list'
                            ),
                            array(
                                'name'=>'Add',
                                'href'=>URL::createLink('backend','user','form')
                                //'href'=>'index.php?module=backend&controller=user&action=form'
                            )
                        )
                    ),
                    'catagory'=>
                    array(
                        'name'=>'Catagory',
                        'href'=>'#',
                        'icon'  =>'<i class="<i nav-icon fa fa-tags"></i>',
                        'tree'=>array(
                            array(
                                'name'=>'List',
                                'href'=>'#'
                            ),
                            array(
                                'name'=>'Add',
                                'href'=>'#'
                            )
                        )
                    ),
                    'book'=>
                    array(
                        'name'=>'Book',
                        'href'=>'#',
                        'icon'  =>'<i class="nav-icon fa fa-book"></i>',
                        'tree'=>array(
                            array(
                                'name'=>'List',
                                'href'=>'#'
                            ),
                            array(
                                'name'=>'Add',
                                'href'=>'#'
                            )
                        )
                    ),
              );
$xhtm  = '';
$xhtm .= '<nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
            foreach ($sidebar as $tagKey=>$tagValue){
                    $xhtm .= '<li class="nav-item">';
                    
                    $tagActive      = '';
                    $iconAngleLeft  = '';
                        if($this->_tag == $tagKey) {
                            $tagActive      =   'active';
                            $iconAngleLeft  =   '<i class="fas fa-angle-left right"></i>';  
                        }
                        if(isset($tagValue['tree'])){          
                            $xhtm .=    '<a href="'.$tagValue['href'].'" class="nav-link '.$tagActive.'">
                                        '.$tagValue['icon'].'
                                        <p>
                                            '.$tagValue['name'].'
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>';
                            foreach ($tagValue['tree'] as $treeKey=>$treeValue){         
                            $xhtm .='<ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="'.$treeValue['href'].'" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>'.$treeValue['name'].'</p>
                                            </a>
                                        </li>
                                    </ul>'; 
                            }
                       }else {   
                                $xhtm .=    '<a href="'.$tagValue['href'].'" class="nav-link '.$tagActive.'">
                                                '.$tagValue['icon'].'
                                                <p>
                                                    '.$tagValue['name'].'
                                                </p>
                                            </a>';
                            }
                    
                       $xhtm .= '   </p>
                                </a>';
                  $xhtm .=  '</li>';
            }         
$xhtm .= '  </ul>
          </nav>';
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <?php echo $adminLTELogo;?>	
      <span class="brand-text font-weight-light">Admin Control Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php echo $userImage;?>
        </div>
        <div class="info">
          <a href="#" class="d-block">ZendVN</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php 
        echo $xhtm;
      ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    
</aside>










