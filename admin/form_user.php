<?php 
require_once('includes/startup.php');
require_once('library/form_user_lib.php');
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
            <a href="manage_users.php" class="btn btn-sm btn-outline-info">Back</a>
            <button type="submit" class="btn btn-sm btn-outline-success">Save</button>
          </div>
        </div>
      </div>
	  
	  
	  <div class="col-sm-12">
		<div class="mb-3 row">
			<label for="username" class="col-sm-2 col-form-label">Username</label>
			<div class="col-sm-10">
			  <input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>">
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="password" class="col-sm-2 col-form-label">Password</label>
			<div class="col-sm-10">
			  <input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>">
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="cpassword" class="col-sm-2 col-form-label">Confirm Password</label>
			<div class="col-sm-10">
			  <input type="password" name="cpassword" id="cpassword" class="form-control" value="<?php echo $cpassword; ?>">
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="fullname" class="col-sm-2 col-form-label">Fullname</label>
			<div class="col-sm-10">
			  <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $fullname; ?>">
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="email" class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-10">
			  <input type="email" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
			</div>
		</div>
		
		<div class="mb-3 row">
			<label for="phone" class="col-sm-2 col-form-label">Phone</label>
			<div class="col-sm-10">
			  <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>">
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