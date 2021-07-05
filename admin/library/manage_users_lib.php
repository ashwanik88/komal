<?php checkAdminLogin();
$document_title = 'Manage Users';

if($_GET){
	if(isset($_GET['admin_id']) && !empty($_GET['admin_id'])){
		$admin_id = $_GET['admin_id'];
		deleteUser($admin_id);
		redirect('manage_users.php');
	}
}

if($_POST){
	if(isset($_POST['user_ids']) && !empty($_POST['user_ids'])){
		$user_ids = $_POST['user_ids'];
		foreach($user_ids as $user_id){
			deleteUser($user_id);
		}
		
		addAlert('success', 'User Ids('. implode(', ', $user_ids) .') has been deleted successfully!');
		redirect('manage_users.php');
	}
	
}


$sql = "SELECT * FROM admin_users";

$rs = mysqli_query($con, $sql);

$rows = array();
if(mysqli_num_rows($rs)){
	while($rec = mysqli_fetch_assoc($rs)){
		$rows[] = $rec;
	}
}

function deleteUser($user_id){
	global $con;
	if($user_id != $_SESSION['admin_user']['admin_id']){
		$sql = "DELETE FROM admin_users WHERE admin_id='". (int)$user_id ."'";
		mysqli_query($con, $sql);
		addAlert('success', 'User :'. $user_id .' has been deleted successfully!');
	}else{
		addAlert('danger', 'You can\'t delete current user id!');
	}
}