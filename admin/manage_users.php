<?php 
require_once('includes/startup.php');
require_once('library/manage_users_lib.php');
?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $document_title; ?></h1>
		
		<?php echo displayAlert(); ?>
		
		
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
            <a class="btn btn-sm btn-outline-primary" href="form_user.php">Add New User</a>
          </div>
        </div>
      </div>

     
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th><input type="checkbox" onclick="$('.chk').attr('checked', $(this).is(':checked'));" /></th>
              <th>#</th>
              <th>Username</th>
              <th>Fullname</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Date Added</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
			<?php if(sizeof($rows)){ ?>
				<?php foreach($rows as $row){ ?>
					<tr>
						<td><input type="checkbox" name="user_ids[]" class="chk" value="<?php echo $row['admin_id']; ?>" /></td>
						<td><?php echo $row['admin_id']; ?></td>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['fullname']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phone']; ?></td>
						<td><?php echo ($row['status'])?'Active':'Inactive'; ?></td>
						<td><?php echo $row['date_added']; ?></td>
						<td>Edit</td>
					</tr>
				<?php } ?>
			<?php }else{ ?>
				<tr><td colspan="8" class="text-center text-danger">No record found!</td></tr>
			<?php } ?>
          </tbody>
        </table>
      </div>
    </main>
	

<?php require_once('common/footer_upper.php'); ?>
<?php require_once('common/footer_script.php'); ?>
<?php require_once('common/footer_end.php'); ?>