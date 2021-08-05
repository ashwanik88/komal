<?php checkAdminLogin();
$document_title = 'Manage Products';

if($_GET){
	if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
		$product_id = $_GET['product_id'];
		deleteProduct($product_id);
		redirect('manage_products.php');
	}
}

if($_POST){
	if(isset($_POST['product_ids']) && !empty($_POST['product_ids'])){
		$product_ids = $_POST['product_ids'];
		foreach($product_ids as $product_id){
			deleteProduct($product_id);
		}
		
		addAlert('success', 'Product Ids('. implode(', ', $product_ids) .') has been deleted successfully!');
		redirect('manage_products.php');
	}
	
}

$sort = 'product_id';
$order = 'DESC';
$filter_url = '';
$filter_product_id = '';
$filter_model_id = '';
$filter_date_added = '';
$filter_status = '';

$searching = ' WHERE 1=1 ';
if(isset($_GET['filter_product_id']) && !empty($_GET['filter_product_id'])){
	$filter_product_id = $_GET['filter_product_id'];
	$searching .= " AND product_id='". $filter_product_id ."'";
}
if(isset($_GET['filter_model_id']) && !empty($_GET['filter_model_id'])){
	$filter_model_id = $_GET['filter_model_id'];
	$searching .= " AND model_id LIKE '%". $filter_model_id ."%'";
}
if(isset($_GET['filter_date_added'])){
	$filter_date_added = $_GET['filter_date_added'];
	$searching .= " AND ( date_added>='". $filter_date_added ." 00:00:00' AND date_added <= '". $filter_date_added ." 23:59:59' )";
	//SELECT * FROM `products` WHERE date_added>='2021-07-06 00:00:00' AND date_added <= '2021-07-06 23:59:59' 
	//SELECT * FROM `products` WHERE date_added BETWEEN '2021-07-06' AND '2021-07-07' 
	
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
$sql_total = "SELECT count(*) as total FROM products" . $searching;
$rs_total = mysqli_query($con, $sql_total);
$rec_total = mysqli_fetch_assoc($rs_total);
$total_pages = ceil($rec_total['total']/$page_size);

$page_index = 0;
$cur_page = 1;
if(isset($_GET['page'])){
	$cur_page = $_GET['page'];
	$page_index = ($cur_page - 1) * $page_size;
}

$sql = "SELECT * FROM products ". $searching ." " . $sorting . " LIMIT ". $page_index ."," . $page_size;



$rs = mysqli_query($con, $sql);

$rows = array();
if(mysqli_num_rows($rs)){
	while($rec = mysqli_fetch_assoc($rs)){
		$rows[] = $rec;
	}
}

function deleteProduct($product_id){
	global $con;
	if($product_id != $_SESSION['admin_product']['product_id']){
		$sql = "DELETE FROM products WHERE product_id='". (int)$product_id ."'";
		mysqli_query($con, $sql);
		addAlert('success', 'Product :'. $product_id .' has been deleted successfully!');
	}else{
		addAlert('danger', 'You can\'t delete current product id!');
	}
}
function columnHeading($field, $field_text, $order, $sort){
	$html = '<a href="manage_products.php?sort='. $field .'&order='. $order .'">' . $field_text;
	if($sort == $field){
	$html .= ' <i class="bi bi-caret-';
	$html .= ($order == 'ASC')?'down':'up';
	$html .= '-fill"></i>';
	} 
	$html .= '</a>';
	return $html;
}
