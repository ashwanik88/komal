<?php 
require_once('includes/startup.php');
require_once('library/manage_products_ajax_lib.php');
?>
<table class="table table-striped table-sm">
  <thead>
	<tr>
	  <th><input type="checkbox" onclick="$('.chk').prop('checked', $(this).is(':checked'));" /></th>
	  <th><?php echo columnHeading('product_id', '#', $order, $sort); ?></th>
	  <th><?php echo columnHeading('product_image', 'Product Image', $order, $sort); ?></th>
	  <th><?php echo columnHeading('model_id', 'Model ID', $order, $sort); ?></th>
	  <th><?php echo columnHeading('product_name', 'Product Name', $order, $sort); ?></th>
	  <th><?php echo columnHeading('product_price', 'Price', $order, $sort); ?></th>
	  <th><?php echo columnHeading('stock_qty', 'Qty', $order, $sort); ?></th>
	  <th><?php echo columnHeading('status', 'Status', $order, $sort); ?></th>
	  <th><?php echo columnHeading('date_added', 'Date Added', $order, $sort); ?></th>
	  <th>Action</th>
	</tr>
	<tr>
		<th></th>
		<th>
			<input type="text" name="filter_product_id" id="filter_product_id" value="<?php echo $filter_product_id; ?>"  size="1" />
		</th>
		<th></th>
		<th>
			<input type="text" name="filter_model_id" id="filter_model_id" value="<?php echo $filter_model_id; ?>" size="8" />
		</th>
		<th>
			<input type="text" name="filter_product_name" id="filter_product_name" value="" size="8" />
		</th>
		<th>
			<input type="text" name="filter_product_price" id="filter_product_price" value="" size="8" />
		</th>
		<th>
			<input type="text" name="filter_stock_qty" id="filter_stock_qty" value="" size="8" />
		</th>
		<th>
			<select name="filter_status" id="filter_status">
				<option value=""></option>
				<option value="1" <?php echo ($filter_status == 1)?'selected="selected"':''; ?>>Active</option>
				<option value="0" <?php echo ($filter_status === '0')?'selected="selected"':''; ?>>Inactive</option>
			</select>
		</th>
		<th>
			<input type="date" name="filter_date_added" id="filter_date_added" value="<?php echo $filter_date_added; ?>" size="12"/>
		</th>
		<th><input type="button" id="btnFliter" class="btn btn-info btn-sm" value="Filter" /></th>
	</tr>
  </thead>
  <tbody>
	<?php if(sizeof($rows)){ ?>
		<?php foreach($rows as $row){ ?>
			<tr>
				<td><input type="checkbox" name="product_ids[]" class="chk" value="<?php echo $row['product_id']; ?>" /></td>
				<td><?php echo $row['product_id']; ?></td>
				<td><?php if(isset($row['product_image']) && !empty($row['product_image'])){ ?>
				<a href="<?php echo HTTP_UPLOADS . $row['product_image']; ?>" target="_blank"><img src="<?php echo HTTP_UPLOADS . $row['product_image']; ?>" width="100px" /></a>
				<?php }  ?></td>
				<td><?php echo $row['model_id']; ?></td>
				<td><?php echo $row['product_name']; ?></td>
				<td><?php echo $row['product_price']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td><?php echo ($row['status'])?'Active':'Inactive'; ?></td>
				<td><?php echo changeDateFormat($row['date_added']); ?></td>
				<td>
					
					<a href="manage_products.php?product_id=<?php echo $row['product_id']; ?>" onclick="return confirm('Are you sure want to delete ?')">Delete</a> |
					<a href="form_product.php?product_id=<?php echo $row['product_id']; ?>">Edit</a>
				
				
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
	<li class="page-item"><a class="page-link" href="manage_products_ajax.php?page=<?php echo $i; ?><?php echo $filter_url; ?>"><?php echo $i; ?></a></li>	
	<?php } ?>
	<?php } ?>
	
	
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>

<script type="text/javascript">
$('.pagination a, .btnSort').click(function(){
	var href = $(this).attr('href');
	loadListing(href);
	return false;
});

</script>