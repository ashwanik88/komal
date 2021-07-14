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

$sql = "SELECT * FROM categories WHERE parent_id=0 ORDER BY category_name ASC";
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

function getCategories($parent_id = 0, $sep = '', $selected_id = 0){
	global $con;
	$sql = "SELECT * FROM categories WHERE parent_id='". (int)$parent_id ."'";
	$rs = mysqli_query($con, $sql);
	$html = '';
	if(mysqli_num_rows($rs)){
		while($row = mysqli_fetch_assoc($rs)){
			$html .= '<tr>';
			$html .= '<td><input type="checkbox" name="category_ids[]" class="chk" value="'. $row['category_id'].'" /></td>';
			$html .= '<td>'. $row['category_id'].'</td>';
			$html .= '<td>'. $row['category_name'].'</td>';
			$html .= '<td>'. $row['parent_id'].'</td>';
			$html .= '<td>'. (($row['status'])?'Active':'Inactive') .'</td>';
			$html .= '<td>';
			$html .= '<a href="manage_categories.php?category_id='. $row['category_id'].'" onclick="return confirm(\'Are you sure want to delete ?\')">Delete</a>';
			$html .= ' | ';
			$html .= '<a href="form_category.php?category_id='. $row['category_id'].'">Edit</a>';
			$html .= '</td></tr>';
			
			$html .= getCategories($row['category_id'], $sep. '----', $selected_id);	// recursion
		}
	}
	
	return $html;
}