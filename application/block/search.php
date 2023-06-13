<?php
$searchURL = URL::createLink('frontend', 'book', 'list');
//$searchURL   = 'index.php?module=frontend&controller=book&action=list';
?>
<div id="search-overlay" class="search-overlay">
	<div>
		<span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
		<div class="overlay-content">
			<div class="container">
				<div class="row">
					<div class="col-xl-12">
						<form action="<?php echo $searchURL;?>" method="GET" id="search-form">
							<div class="form-group">
								<input type="hidden" name="module" value="frontend">
                                <input type="hidden" name="controller" value="book">
                                <input type="hidden" name="action" value="list">
								<input type="text" class="form-control" name="search"
									id="search-input" placeholder="Tìm kiếm sách...">
							</div>
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-search"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>