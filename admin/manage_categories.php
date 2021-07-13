<?php 
require_once('includes/startup.php');
require_once('library/manage_categories_lib.php');
?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
		<form method="POST" action="" id="frm">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $document_title; ?></h1>
		
		<?php echo displayAlert(); ?>
		
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="(confirm('Are you sure want to delete ?'))?$('#frm').submit():''">Delete</button>
            <a class="btn btn-sm btn-outline-primary" href="form_category.php">Add New Category</a>
          </div>
        </div>
      </div>

     
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th><input type="checkbox" onclick="$('.chk').prop('checked', $(this).is(':checked'));" /></th>
              <th><?php echo columnHeading('category_id', '#', $order, $sort); ?></th>
              <th><?php echo columnHeading('category_name', 'Category Name', $order, $sort); ?></th>
              <th><?php echo columnHeading('parent_id', 'Parent', $order, $sort); ?></th>
              <th><?php echo columnHeading('status', 'Status', $order, $sort); ?></th>
              <th>Action</th>
            </tr>
			<tr>
				<th></th>
				<th>
					<input type="text" name="filter_category_id" id="filter_category_id" value="<?php echo $filter_category_id; ?>"  size="1" />
				</th>
				<th>
					<input type="text" name="filter_category_name" id="filter_category_name" value="<?php echo $filter_category_name; ?>" size="8" />
				</th>
				<th>
					<input type="text" name="filter_parent_id" id="filter_parent_id" value="" size="8" />
				</th>
				<th>
					<select name="filter_status" id="filter_status">
						<option value=""></option>
						<option value="1" <?php echo ($filter_status == 1)?'selected="selected"':''; ?>>Active</option>
						<option value="0" <?php echo ($filter_status === '0')?'selected="selected"':''; ?>>Inactive</option>
					</select>
				</th>
				<th><input type="button" id="btnFliter" class="btn btn-info btn-sm" value="Filter" /></th>
			</tr>
          </thead>
          <tbody>
			<?php if(sizeof($rows)){ ?>
				<?php foreach($rows as $row){ ?>
					<tr>
						<td><input type="checkbox" name="category_ids[]" class="chk" value="<?php echo $row['category_id']; ?>" /></td>
						<td><?php echo $row['category_id']; ?></td>
						<td><?php echo $row['category_name']; ?></td>
						<td><?php echo $row['parent_id']; ?></td>
						<td><?php echo ($row['status'])?'Active':'Inactive'; ?></td>
						<td>
							
							<a href="manage_categories.php?category_id=<?php echo $row['category_id']; ?>" onclick="return confirm('Are you sure want to delete ?')">Delete</a> |
							<a href="form_category.php?category_id=<?php echo $row['category_id']; ?>">Edit</a>
						
						
						</td>
					</tr>
				<?php } ?>
			<?php }else{ ?>
				<tr><td colspan="8" class="text-center text-danger">No record found!</td></tr>
			<?php } ?>
          </tbody>
        </table>
		
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
	
	
    <?php for($i = 1; $i <= $total_pages; $i++){ ?>
	<?php if($i == $cur_page){ ?>
	<li class="page-item active" aria-current="page">
      <span class="page-link"><?php echo $i; ?></span>
    </li>
	<?php }else{ ?>
	<li class="page-item"><a class="page-link" href="manage_categories.php?page=<?php echo $i; ?><?php echo $filter_url; ?>"><?php echo $i; ?></a></li>	
	<?php } ?>
	<?php } ?>
	
	
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>

      </div>
    </form>
    </main>
	

<?php require_once('common/footer_upper.php'); ?>
<?php require_once('common/footer_script.php'); ?>
<script type="text/javascript">

$('#btnFliter').click(function(){
	var url = 'manage_categories.php?';
	
	var filter_category_id = $('#filter_category_id').val();
	if(filter_category_id != ''){
		url += '&filter_category_id=' + filter_category_id;
	}
	
	var filter_category_name = $('#filter_category_name').val();
	if(filter_category_name != ''){
		url += '&filter_category_name=' + filter_category_name;
	}
	var filter_status = $('#filter_status').val();
	if(filter_status != ''){
		url += '&filter_status=' + filter_status;
	}
	
	window.location.href = url;
});
</script>
<?php require_once('common/footer_end.php'); ?>