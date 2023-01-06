<?php 
    echo "<h3 style='color:red;'>".__FILE__."</h3>";
    
    $groupCount = $this->_arrParam['group'];
    $userCount  = $this->_arrParam['user'];
    
    $groupUrl   = URL::createLink('backend', 'group', 'list'); 
    $groupLink  = Helper::cmsButton($url = $groupUrl, $class = "small-box-footer", $textOufit = 'More info <i class="fas fa-arrow-circle-right"></i>');
    
    $userUrl   = URL::createLink('backend', 'user', 'list');
    $userLink  = Helper::cmsButton($url = $userUrl, $class = "small-box-footer", $textOufit = 'More info <i class="fas fa-arrow-circle-right"></i>');
?>
<div class="row">
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
				<div class="inner">
					<h3>
						<?php echo $groupCount;?>
					</h3>

					<p>Group</p>
				</div>
				<div class="icon">
					<i class="ion ion-ios-people"></i>
				</div>
				<?php
				    echo $groupLink;
				?>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
				<div class="inner">
					<h3>
						<?php echo $userCount;?>
					</h3>

					<p>User</p>
				</div>
				<div class="icon">
					<i class="ion ion-ios-person"></i>
				</div>
				<?php 
				    echo $userLink;
				?>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
				<div class="inner">
					<h3>10</h3>

					<p>Catagory</p>
				</div>
				<div class="icon">
					<i class="ion ion-ios-folder"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i
					class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
				<div class="inner">
					<h3>30</h3>

					<p>Catagory</p>
				</div>
				<div class="icon">
					<i class="ion ion-ios-book"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i
					class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>

	</div>