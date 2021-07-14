<?php checkAdminLogin();
$document_title = 'Add New Category';

$category_id = '';
$category_name = '';
$parent_id = '';
$status = '1';

if($_GET){
	if(isset($_GET['category_id']) && !empty($_GET['category_id'])){
		$category_id = $_GET['category_id'];
		$document_title = 'Edit Category | ' . $category_id;
		$data = getCategory($category_id);
		
		$category_name = $data['category_name'];
		$parent_id = $data['parent_id'];
		$status = $data['status'];

	}
}


if($_POST){
	
	if(isset($_POST['category_name']) && !empty($_POST['category_name'])){
		$category_name = $_POST['category_name'];
		$parent_id = $_POST['parent_id'];
		$status = (isset($_POST['status']))?1:0;

	if($category_id){
		$sql = "UPDATE categories SET category_name='". $category_name ."', parent_id='". $parent_id ."', status='". (int)$status ."' WHERE category_id='". (int)$category_id ."'";
		mysqli_query($con, $sql);
		addAlert('success', 'Category has been updated successfully');
	
	}else{
		$sql = "INSERT INTO categories SET category_name='". $category_name ."', parent_id='". $parent_id ."', status='". (int)$status ."'";
		mysqli_query($con, $sql);
		addAlert('success', 'Category has been added successfully');
		$category_id = mysqli_insert_id($con);
	}
	
	redirect('manage_categories.php');		
	}
}


function getCategory($category_id){
	global $con;
	$sql = "SELECT * FROM categories WHERE category_id='". (int)$category_id ."'";
	$rs = mysqli_query($con, $sql);
	if(mysqli_num_rows($rs)){
		$rec = mysqli_fetch_assoc($rs);
	}
	return $rec;
}

function getCategories($parent_id = 0, $sep = '', $selected_id = 0){
	global $con;
	$sql = "SELECT * FROM categories WHERE parent_id='". (int)$parent_id ."'";
	$rs = mysqli_query($con, $sql);
	$html = '';
	if(mysqli_num_rows($rs)){
		while($rec = mysqli_fetch_assoc($rs)){
			$html .= '<option '. (($selected_id == $rec['category_id'])?'selected="selected"':'') .' value="'. $rec['category_id'] .'">'. $sep . $rec['category_name'] .'</option>';
			$html .= getCategories($rec['category_id'], $sep. '----', $selected_id);	// recursion
		}
	}
	
	return $html;
}