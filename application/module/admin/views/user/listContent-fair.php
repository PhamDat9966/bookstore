<?php 
echo "<pre>VVVVVVVVVVVVVVVVVVVVV";
print_r($this);
echo "</pre>";

$checkbox             = @$_POST['checkbox'];
$paginationViewHTML = $this->_paginationHTML;

$i = 0;
$xhtml = '';

if (!empty($this->_item)) {
    foreach ($this->_item as $value) {

        $name = $value['name'];
        $link = $value['link'];
        $ordering = $value['ordering'];
        
        $id = $value['id'];
        $bottonEdit = '<a href="index.php?module=admin&controller=group&action=form&id=' . $id . '" class="btn btn-sm btn-warning">Edit</a>';
        $buttonDel  = '<a href="javascript:deleteItem( '.$id.' )" class="btn btn-sm btn-danger btn-delete">Delete</a>';
        
        $row =  ($i % 2 == 0) ? 'odd' : 'even';
        $status = ($value['status'] == 0) ? 'inactive' : 'active';
        
        $botton = 'btn-danger';
        if ($status == 'active') $botton = 'btn-success';
        
        $img     = $value['image'];
        
        $fileImg =  $this->_urlImg . DS . $img;
        
        $xhtml .= '
            <tr id="item-'.$id.'">
                <td>
                    <p class="no">
                         <input type="checkbox" name="checkbox[]" value="' . $id . '">
                    </p>
                </td>
                <td>' . $id . '</td>
                <td>
                    <p class="content">
                     <a class="font-weight-bold text-primary" href="index.php?module=admin&controller=group&action=showcase&link=' . $link . '">' . $name . '</a><br/>' . $link .
                     '</p>
                </td>
                         
                <td>
                    <p class="img"><img class="border border-info" src=' . $fileImg . ' alt="Girl in a jacket" width="100" height="80"></p>
                </td>
                        
                <td>
                      <a href="change-status.php?id=1&status=' . $status . '" class="btn btn-sm ' . $botton . '"><i
                      class="fas fa-check"></i></a>
                </td>
                <td>' . $ordering . '</td>
                <td>
                    ' . $bottonEdit . '
                    ' . $buttonDel . '
                </td>
            </tr>';
        
        $i++;
    }
}


?>
<script type="text/javascript">

    $(document).ready(function(){
    	$('#cancel-button').click(function(){
    		window.location = 'index.php';
    	});
    	
    	$('#multy-delete').click(function(){
    		$('#main-form').submit();
    	});
    	
    	$('#check-all').change(function(){
    		var checkStatus = this.checked;
    		$('#main-form').find(':checkbox').each(function(){
    			this.checked = checkStatus;
    		});
    	});
    	
    	$('.success, .notice, .error').click(function() {
    		 $(this).toggle("slow");
    	});
    	
    	$('#custom-select').addClass("w-25 select--no-search ");
    });

</script> 

<div class="container pt-5">
	<h3>Content-1234</h3>
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between">
            <a href="index.php?module=admin&controller=user&action=login" class="btn btn-primary m-0">Back to website</a>
            <!-- Logout -->
            <a href="index.php?module=admincontroller=user&action=logout" class="btn btn-info m-0">Logout</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Enter search keyword...."
                        value="">
                    <div class="input-group-append">
                        <button type="submit"
                            class="btn btn-md btn-outline-primary m-0 px-3 py-2 z-depth-0 waves-effect"
                            type="button">Search</button>
                        <a href="list.php"
                            class="btn btn-md btn-outline-danger m-0 px-3 py-2 z-depth-0 waves-effect"
                            type="button">Clear</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="m-0">RSS List</h4>
            <div>
            	<a href="index.php?module=admin&controller=group&action=form" class="btn btn-success m-15">Add Group</a>
            	<a id="multy-delete" href="#" class="btn btn-danger m-15">Del Group</a>
            </div>	
        </div>
        <div class="card-body">
            <table class="table table-striped btn-table">
        		<thead>
                    <tr>
                        <th scope="col">
                            <p class="no"><input type="checkbox" name="check-all" id="check-all" /></p>
                        </th>
                        <th scope="col">
                            <p class="id font-weight-bold">ID</p>
                        </th>
                        <th scope="col">
                            <p class="content font-weight-bold">Content</p>
                        </th>
                        <th scope="col">
                            <p class="img font-weight-bold">Image</p>
                        </th>
                        <th scope="col">
                            <p class="size font-weight-bold">Status</p>
                        </th>
                        <th scope="col">
                            <p class="size font-weight-bold">Ordering</p>
                        </th>
                        <th scope="col">
                            <p class="action font-weight-bold">Action</p>
                        </th>
                    </tr>
                </thead>
             <tbody>

                <?php 
                    echo $xhtml;
                ?>
                
             </tbody>

            </table>
        </div>        
    </div>
    <div id="pagination">
       	<?php 
    	   echo $paginationViewHTML['paginationHTML'];
        ?>
    </div>
</div>