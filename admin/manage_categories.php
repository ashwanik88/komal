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
			  <th>Category ID</th>
			  <th>Category Name</th>
			  <th>Parent ID</th>
			  <th>Status</th>
			  <th>Action</th>
            </tr>
          </thead>
          <tbody>
			<?php if(sizeof($rows)){ ?>
				<?php echo getCategories(0);?>
			<?php }else{ ?>
				<tr><td colspan="8" class="text-center text-danger">No record found!</td></tr>
			<?php } ?>
          </tbody>
        </table>
		


      </div>
    </form>
    </main>
	

<?php require_once('common/footer_upper.php'); ?>
<?php require_once('common/footer_script.php'); ?>

<?php require_once('common/footer_end.php'); ?>