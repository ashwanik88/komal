<?php 
require_once('includes/startup.php');
require_once('library/form_category_lib.php');
?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
	<form action="" method="POST">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $document_title; ?></h1>
		
		<?php echo displayAlert(); ?>
		
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a href="manage_categories.php" class="btn btn-sm btn-outline-info">Back</a>
            <button type="submit" class="btn btn-sm btn-outline-success">Save</button>
          </div>
        </div>
      </div>
	  
		<div class="mb-3 row">
			<label for="parent_id" class="col-sm-2 col-form-label">Select Parent</label>
			<div class="col-sm-10">
			  <select name="parent_id" id="parent_id" class="form-select">
				<option value=""></option>
				<option value="0">Top Parent</option>
				<?php echo getCategories();?>
			  </select>
			</div>
		</div>
	  
	  <div class="col-sm-12">
		<div class="mb-3 row">
			<label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
			<div class="col-sm-10">
			  <input type="text" name="category_name" id="category_name" class="form-control" value="<?php echo $category_name; ?>">
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