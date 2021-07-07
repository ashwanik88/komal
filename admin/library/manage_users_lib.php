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

$sort = 'admin_id';
$order = 'DESC';
if(isset($_GET['sort']) && !empty($_GET['sort'])){
	$sort = $_GET['sort'];
}
if(isset($_GET['order']) && !empty($_GET['order'])){
	$order = $_GET['order'];
}
$sorting = 'ORDER BY '. $sort .' ' . $order;
$order = ($order == 'ASC')?'DESC':'ASC';

$page_size = 10;
$sql_total = "SELECT count(*) as total FROM admin_users";
$rs_total = mysqli_query($con, $sql_total);
$rec_total = mysqli_fetch_assoc($rs_total);
$total_pages = ceil($rec_total['total']/$page_size);

$page_index = 0;
$cur_page = 1;
if(isset($_GET['page'])){
	$cur_page = $_GET['page'];
	$page_index = ($cur_page - 1) * $page_size;
}

$sql = "SELECT * FROM admin_users " . $sorting . " LIMIT ". $page_index ."," . $page_size;



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

/*
task 

1) next previous button
2) pagination with sorting
3) add serial number column

*/