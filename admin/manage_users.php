<?php 
require_once('includes/startup.php');
require_once('library/manage_users_lib.php');
?>
<?php require_once('common/header.php'); ?>
<?php require_once('common/sidebar.php'); ?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
		<form method="POST" action="">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $document_title; ?></h1>
		
		<?php echo displayAlert(); ?>
		
		
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure want to delete ?')">Delete</button>
            <a class="btn btn-sm btn-outline-primary" href="form_user.php">Add New User</a>
          </div>
        </div>
      </div>

     
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th><input type="checkbox" onclick="$('.chk').prop('checked', $(this).is(':checked'));" /></th>
              <th><a href="manage_users.php?sort=admin_id&order=<?php echo $order; ?>">#</a></th>
              <th><a href="manage_users.php?sort=username&order=<?php echo $order; ?>">Username</a></th>
              <th><a href="manage_users.php?sort=fullname&order=<?php echo $order; ?>">Fullname</a></th>
              <th><a href="manage_users.php?sort=email&order=<?php echo $order; ?>">Email</a></th>
              <th><a href="manage_users.php?sort=phone&order=<?php echo $order; ?>">Phone</a></th>
              <th><a href="manage_users.php?sort=status&order=<?php echo $order; ?>">Status</a></th>
              <th><a href="manage_users.php?sort=date_added&order=<?php echo $order; ?>">Date Added</a></th>
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
						<td><?php echo changeDateFormat($row['date_added']); ?></td>
						<td>
							
							<a href="manage_users.php?admin_id=<?php echo $row['admin_id']; ?>" onclick="return confirm('Are you sure want to delete ?')">Delete</a> |
							<a href="form_user.php?admin_id=<?php echo $row['admin_id']; ?>">Edit</a>
						
						
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
	<li class="page-item"><a class="page-link" href="manage_users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>	
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
<?php require_once('common/footer_end.php'); ?>