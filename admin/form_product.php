<?php 
require_once('includes/startup.php');
require_once('library/form_product_lib.php');
?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
	<form action="" method="POST" enctype="multipart/form-data">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $document_title; ?></h1>
		
		<?php echo displayAlert(); ?>
		
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="manage_products.php" class="btn btn-sm btn-outline-info">Back</a>
            <button type="submit" class="btn btn-sm btn-outline-success">Save</button>
          </div>
        </div>
      </div>
	  
	  
	  <div class="col-sm-12">
		<div class="mb-3 row">
			<label for="model_id" class="col-sm-2 col-form-label">Product Name</label>
			<div class="col-sm-10">
			  <input type="text" name="model_id" id="model_id" class="form-control" value="<?php echo $model_id; ?>">
			</div>
		</div>
		
		
		<div class="mb-3 row">
			<label for="product_image" class="col-sm-2 col-form-label">Product Image</label>
			<div class="col-sm-10">
			<?php if(isset($product_image) && !empty($product_image)){ ?>
			<a href="<?php echo HTTP_UPLOADS . $product_image; ?>" target="_blank"><img src="<?php echo HTTP_UPLOADS . $product_image; ?>" width="100px" /></a>
			<?php } ?>
				
			  <input type="file" name="product_image" id="product_image" class="form-control" >
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="product_name" class="col-sm-2 col-form-label">Fullname</label>
			<div class="col-sm-10">
			  <input type="text" name="product_name" id="product_name" class="form-control" value="<?php echo $product_name; ?>">
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="product_price" class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-10">
			  <input type="product_price" name="product_price" id="product_price" class="form-control" value="<?php echo $product_price; ?>">
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="description" class="col-sm-2 col-form-label">Phone</label>
			<div class="col-sm-10">
			  <input type="text" name="description" id="description" class="form-control" value="<?php echo $description; ?>">
			</div>
		</div>
		
		
		<div class="mb-3 row">
			<label for="description" class="col-sm-2 col-form-label">Assign Category</label>
			<div class="col-sm-10">
				<div style="max-height: 300px; overflow-y: auto;" >
				<table class="table table-sm">
			  <?php echo getCategories(0, '', $category_ids); ?>
			  </table>
			  </div>
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="stock_qty" class="col-sm-2 col-form-label">Stock Qty</label>
			<div class="col-sm-10">
				<input type="text" name="stock_qty" id="stock_qty" class="form-control" value="<?php echo $stock_qty; ?>">
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="status" class="col-sm-2 col-form-label">Status</label>
			<div class="col-sm-10">
				<div class="form-check form-switch">
				  <input class="form-check-input" type="checkbox" id="status" name="status" value="1" <?php echo ($status == 1)?'checked': ''; ?>>
				  <label class="form-check-label" for="status"></label>
				</div>
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="additional_image_1" class="col-sm-2 col-form-label">Additional Image 1</label>
			<div class="col-sm-10">
			  <input type="file" name="additional_image[]" id="additional_image_1" class="form-control" >
			</div>
		</div>
		<div class="mb-3 row">
			<label for="additional_image_2" class="col-sm-2 col-form-label">Additional Image 2</label>
			<div class="col-sm-10">
			  <input type="file" name="additional_image[]" id="additional_image_2" class="form-control" >
			</div>
		</div>
		<div class="mb-3 row">
			<label for="additional_image_3" class="col-sm-2 col-form-label">Additional Image 3</label>
			<div class="col-sm-10">
			  <input type="file" name="additional_image[]" id="additional_image_3" class="form-control" >
			</div>
		</div>
		
		
		<div class="mb-3 row">
			<div class="col-sm-10 offset-sm-2">
				<input type="submit" value="Save" class="btn btn-primary"  />
			</div>
		</div>
		
		
		
	  </div>

     
  
	</form>
	</main>
	

<?php require_once('common/footer_upper.php'); ?>
<?php require_once('common/footer_script.php'); ?>
<?php require_once('common/footer_end.php'); ?>