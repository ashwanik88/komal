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
$filter_url = '';
$filter_admin_id = '';
$filter_username = '';

$searching = ' WHERE 1=1 ';
if(isset($_GET['filter_admin_id']) && !empty($_GET['filter_admin_id'])){
	$filter_admin_id = $_GET['filter_admin_id'];
	$searching .= " AND admin_id='". $filter_admin_id ."'";
}
if(isset($_GET['filter_username']) && !empty($_GET['filter_username'])){
	$filter_username = $_GET['filter_username'];
	$searching .= " AND username LIKE '%". $filter_username ."%'";
}


if(isset($_GET['sort']) && !empty($_GET['sort'])){
	$sort = $_GET['sort'];
	$filter_url .= '&sort=' . $sort;
}
if(isset($_GET['order']) && !empty($_GET['order'])){
	$order = $_GET['order'];
	$filter_url .= '&order=' . $order;
}
$sorting = 'ORDER BY '. $sort .' ' . $order;
$order = ($order == 'ASC')?'DESC':'ASC';

$page_size = 10;
$sql_total = "SELECT count(*) as total FROM admin_users" . $searching;
$rs_total = mysqli_query($con, $sql_total);
$rec_total = mysqli_fetch_assoc($rs_total);
$total_pages = ceil($rec_total['total']/$page_size);

$page_index = 0;
$cur_page = 1;
if(isset($_GET['page'])){
	$cur_page = $_GET['page'];
	$page_index = ($cur_page - 1) * $page_size;
}

$sql = "SELECT * FROM admin_users ". $searching ." " . $sorting . " LIMIT ". $page_index ."," . $page_size;



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
function columnHeading($field, $field_text, $order, $sort){
	$html = '<a href="manage_users.php?sort='. $field .'&order='. $order .'">' . $field_text;
	if($sort == $field){
	$html .= ' <i class="bi bi-caret-';
	$html .= ($order == 'ASC')?'down':'up';
	$html .= '-fill"></i>';
	} 
	$html .= '</a>';
	return $html;
}

/*
task 

1) next previous button
2) pagination with sorting
3) add serial number column

*/