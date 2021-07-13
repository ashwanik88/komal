<?php checkAdminLogin();
$document_title = 'Manage Categories';

if($_GET){
	if(isset($_GET['category_id']) && !empty($_GET['category_id'])){
		$category_id = $_GET['category_id'];
		deleteCategory($category_id);
		redirect('manage_categories.php');
	}
}

if($_POST){
	if(isset($_POST['category_ids']) && !empty($_POST['category_ids'])){
		$category_ids = $_POST['category_ids'];
		foreach($category_ids as $category_id){
			deleteCategory($category_id);
		}
		
		addAlert('success', 'Category Ids('. implode(', ', $category_ids) .') has been deleted successfully!');
		redirect('manage_categories.php');
	}
	
}

$sort = 'category_id';
$order = 'DESC';
$filter_url = '';
$filter_category_id = '';
$filter_category_name = '';
$filter_status = '';

$searching = ' WHERE 1=1 ';
if(isset($_GET['filter_category_id']) && !empty($_GET['filter_category_id'])){
	$filter_category_id = $_GET['filter_category_id'];
	$searching .= " AND category_id='". $filter_category_id ."'";
}
if(isset($_GET['filter_category_name']) && !empty($_GET['filter_category_name'])){
	$filter_category_name = $_GET['filter_category_name'];
	$searching .= " AND category_name LIKE '%". $filter_category_name ."%'";
}
if(isset($_GET['filter_status'])){
	$filter_status = $_GET['filter_status'];
	$searching .= " AND status = '". $filter_status ."'";
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
$sql_total = "SELECT count(*) as total FROM categories" . $searching;
$rs_total = mysqli_query($con, $sql_total);
$rec_total = mysqli_fetch_assoc($rs_total);
$total_pages = ceil($rec_total['total']/$page_size);

$page_index = 0;
$cur_page = 1;
if(isset($_GET['page'])){
	$cur_page = $_GET['page'];
	$page_index = ($cur_page - 1) * $page_size;
}

$sql = "SELECT * FROM categories ". $searching ." " . $sorting . " LIMIT ". $page_index ."," . $page_size;



$rs = mysqli_query($con, $sql);

$rows = array();
if(mysqli_num_rows($rs)){
	while($rec = mysqli_fetch_assoc($rs)){
		$rows[] = $rec;
	}
}

function deleteCategory($category_id){
	global $con;
	if($category_id != $_SESSION['admin_category']['category_id']){
		$sql = "DELETE FROM categories WHERE category_id='". (int)$category_id ."'";
		mysqli_query($con, $sql);
		addAlert('success', 'Category :'. $category_id .' has been deleted successfully!');
	}else{
		addAlert('danger', 'You can\'t delete current category id!');
	}
}
function columnHeading($field, $field_text, $order, $sort){
	$html = '<a href="manage_categories.php?sort='. $field .'&order='. $order .'">' . $field_text;
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