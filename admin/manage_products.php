<?php 
require_once('includes/startup.php');
require_once('library/manage_products_lib.php');
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
            <a class="btn btn-sm btn-outline-primary" href="form_product.php">Add New Product</a>
          </div>
        </div>
      </div>

     
      <div class="table-responsive conTable"></div>
	  


    </form>
    </main>
	

<?php require_once('common/footer_upper.php'); ?>
<?php require_once('common/footer_script.php'); ?>
<script type="text/javascript">
// $('.conTable').load('http://localhost/komal/admin/manage_products_ajax.php?page=1');
loadListing('manage_products_ajax.php');
function loadListing(url){
	$.ajax({
	url : url,
	type: 'GET',
	dataType: 'HTML',
	data:{},
	success: function(html){
		$('.conTable').html(html);
	}
});
}

$('#btnFliter').click(function(){
	var url = 'manage_products.php?';
	
	var filter_product_id = $('#filter_product_id').val();
	if(filter_product_id != ''){
		url += '&filter_product_id=' + filter_product_id;
	}
	
	var filter_model_id = $('#filter_model_id').val();
	if(filter_model_id != ''){
		url += '&filter_model_id=' + filter_model_id;
	}
	
	var filter_stock_qty = $('#filter_stock_qty').val();
	if(filter_stock_qty != ''){
		url += '&filter_stock_qty=' + filter_stock_qty;
	}

	var filter_date_added = $('#filter_date_added').val();
	if(filter_date_added != ''){
		url += '&filter_date_added=' + filter_date_added;
	}
	
	var filter_status = $('#filter_status').val();
	if(filter_status != ''){
		url += '&filter_status=' + filter_status;
	}
	
	window.location.href = url;
});
</script>
<?php require_once('common/footer_end.php'); ?>