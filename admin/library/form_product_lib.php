<?php checkAdminLogin();
$document_title = 'Add New Product';

$product_id = '';
$model_id = '';
$password = '';
$stock_qty = '';
$cpassword = '';
$product_name = '';
$product_image = '';
$product_price = '';
$description = '';
$status = '1';
$category_ids = array();
if($_GET){
	if(isset($_GET['product_id']) && !empty($_GET['product_id'])){
		$product_id = $_GET['product_id'];
		$document_title = 'Edit Product | ' . $product_id;
		$data = getProduct($product_id);
		
		$model_id = $data['model_id'];
		$product_name = $data['product_name'];
		$product_image = $data['product_image'];
		$product_price = $data['product_price'];
		$stock_qty = $data['stock_qty'];
		$description = $data['description'];
		$status = $data['status'];
		
		$category_ids = getProductCategory($product_id);
	
		// foreach($data as $key => $val){
			// $$key = $val;
		// }
		
		$password = '';
		$cpassword = '';
	}
}


if($_POST){
	

	if(isset($_POST['model_id']) && !empty($_POST['model_id'])){
		$model_id = $_POST['model_id'];
		$password = $_POST['password'];
		$cpassword =$_POST['cpassword'];
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$description = $_POST['description'];
		$stock_qty = $_POST['stock_qty'];
		$status = (isset($_POST['status']))?1:0;
		
		if($password == $cpassword){
			
			if(!alreadyExists($model_id, $product_id)){
				
				if($product_id){
					$sql = "UPDATE products SET model_id='". $model_id ."', product_name='". $product_name ."', product_price='". $product_price ."', description='". $description ."', status='". (int)$status ."', stock_qty='". $stock_qty ."', date_modified=NOW() WHERE product_id='". (int)$product_id ."'";
					mysqli_query($con, $sql);
					addAlert('success', 'Product has been updated successfully');
					
				}else{
					$sql = "INSERT INTO products SET model_id='". $model_id ."', product_name='". $product_name ."', product_price='". $product_price ."', description='". $description ."', stock_qty='". $stock_qty ."', status='". (int)$status ."', date_added=NOW()";
					
					mysqli_query($con, $sql);
					addAlert('success', 'Product has been added successfully');
					$product_id = mysqli_insert_id($con);
				}
				
				mysqli_query($con, "DELETE FROM product_category WHERE product_id='". (int)$product_id ."'");
				if(isset($_POST['category_ids']) && !empty($_POST['category_ids'])){
					foreach($_POST['category_ids'] as $category_id){
						$sql = "INSERT INTO product_category SET product_id='". (int)$product_id ."' , category_id='". (int)$category_id ."'";
						mysqli_query($con, $sql);
					}
				}
				
				if(isset($_FILES['product_image']['name']) && !empty($_FILES['product_image']['name'])){
					$filename = 'products/' . time().'_'.$_FILES['product_image']['name'];
					$dest = DIR_UPLOADS.$filename;
					$src = $_FILES['product_image']['tmp_name'];
	
					move_uploaded_file($src, $dest); // copy()
					
					$sql = "UPDATE products SET product_image='". $filename ."' WHERE product_id='". $product_id ."'";
					mysqli_query($con, $sql);
				}
				
				
				
				// redirect('form_product.php?product_id=' . $product_id);
				
				redirect('manage_products.php');
		
			}else{
				addAlert('danger', 'Product Name already exists!');	
			}
		}else{
			addAlert('danger', 'Confirm password not matched!');
		}
	}
}

function alreadyExists($model_id, $product_id){
	global $con;
	$sql = "SELECT * FROM products WHERE model_id='". $model_id ."' AND product_id!='". (int)$product_id ."'";
	$rs = mysqli_query($con, $sql);
	if(mysqli_num_rows($rs)){
		return true;
	}else{
		return false;
	}
}

function getProduct($product_id){
	global $con;
	$sql = "SELECT * FROM products WHERE product_id='". (int)$product_id ."'";
	$rs = mysqli_query($con, $sql);
	if(mysqli_num_rows($rs)){
		$rec = mysqli_fetch_assoc($rs);
		//$rec = mysqli_fetch_array($rs);
		//$rec = mysqli_fetch_row($rs);
		//$rec = mysqli_fetch_object($rs);
	}
	return $rec;
}

function getCategories($parent_id = 0, $sep = '', $selected_id = 0){
	global $con;
	$sql = "SELECT * FROM categories WHERE parent_id='". (int)$parent_id ."'";
	$rs = mysqli_query($con, $sql);
	$html = '';
	if(mysqli_num_rows($rs)){
		while($row = mysqli_fetch_assoc($rs)){
			$html .= '<tr>';
			
			$html .= '<td><input type="checkbox" name="category_ids[]" class="chk" value="'. $row['category_id'].'" '. ((in_array($row['category_id'], $selected_id) !== false)?'checked':'') .' /></td>';
			$html .= '<td>'. getParents($row['parent_id']) . $row['category_name'].'</td>';
			
			$html .= '</tr>';
			
			$html .= getCategories($row['category_id'], $sep. '----', $selected_id);	// recursion
		}
	}
	
	return $html;
}

function getProductCategory($product_id){
	global $con;
	$sql = "SELECT * FROM product_category WHERE product_id='". $product_id ."'";
	$rs = mysqli_query($con, $sql);
	$data = array();
	if(mysqli_num_rows($rs)){
		while($row = mysqli_fetch_assoc($rs)){
			$data[] = $row['category_id'];
		}
	}
	return $data;
}