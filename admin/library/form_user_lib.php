<?php checkAdminLogin();
$document_title = 'Add New User';

$admin_id = '';
$username = '';
$password = '';
$gender = '';
$cpassword = '';
$fullname = '';
$profile_image = '';
$email = '';
$phone = '';
$status = '1';
$category_ids = array();
if($_GET){
	if(isset($_GET['admin_id']) && !empty($_GET['admin_id'])){
		$admin_id = $_GET['admin_id'];
		$document_title = 'Edit User | ' . $admin_id;
		$data = getUser($admin_id);
		
		$username = $data['username'];
		$fullname = $data['fullname'];
		$profile_image = $data['profile_image'];
		$email = $data['email'];
		$gender = $data['gender'];
		$phone = $data['phone'];
		$status = $data['status'];
		
		$category_ids = getProductCategory($admin_id);
	
		// foreach($data as $key => $val){
			// $$key = $val;
		// }
		
		$password = '';
		$cpassword = '';
	}
}


if($_POST){
	

	if(isset($_POST['username']) && !empty($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$cpassword =$_POST['cpassword'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$gender = $_POST['gender'];
		$status = (isset($_POST['status']))?1:0;
		
		if($password == $cpassword){
			
			if(!alreadyExists($username, $admin_id)){
				
				if($admin_id){
					$sql = "UPDATE admin_users SET username='". $username ."', fullname='". $fullname ."', email='". $email ."', phone='". $phone ."', status='". (int)$status ."', gender='". $gender ."', date_modified=NOW() WHERE admin_id='". (int)$admin_id ."'";
					mysqli_query($con, $sql);
					addAlert('success', 'User has been updated successfully');
					
					if(!empty($password)){
						$sql_pass = "UPDATE admin_users SET password='". md5($password) ."' WHERE admin_id='". (int)$admin_id ."'";
						mysqli_query($con, $sql_pass);
					}
				}else{
					$sql = "INSERT INTO admin_users SET username='". $username ."', password='". md5($password) ."', fullname='". $fullname ."', email='". $email ."', phone='". $phone ."', gender='". $gender ."', status='". (int)$status ."', date_added=NOW()";
					
					mysqli_query($con, $sql);
					addAlert('success', 'User has been added successfully');
					$admin_id = mysqli_insert_id($con);
				}
				
				mysqli_query($con, "DELETE FROM product_category WHERE admin_id='". (int)$admin_id ."'");
				if(isset($_POST['category_ids']) && !empty($_POST['category_ids'])){
					foreach($_POST['category_ids'] as $category_id){
						$sql = "INSERT INTO product_category SET admin_id='". (int)$admin_id ."' , category_id='". (int)$category_id ."'";
						mysqli_query($con, $sql);
					}
				}
				
				if(isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])){
					$filename = 'users/' . time().'_'.$_FILES['profile_image']['name'];
					$dest = DIR_UPLOADS.$filename;
					$src = $_FILES['profile_image']['tmp_name'];
	
					move_uploaded_file($src, $dest); // copy()
					
					$sql = "UPDATE admin_users SET profile_image='". $filename ."' WHERE admin_id='". $admin_id ."'";
					mysqli_query($con, $sql);
				}
				
				
				
				// redirect('form_user.php?admin_id=' . $admin_id);
				
				redirect('manage_users.php');
		
			}else{
				addAlert('danger', 'Username already exists!');	
			}
		}else{
			addAlert('danger', 'Confirm password not matched!');
		}
	}
}

function alreadyExists($username, $admin_id){
	global $con;
	$sql = "SELECT * FROM admin_users WHERE username='". $username ."' AND admin_id!='". (int)$admin_id ."'";
	$rs = mysqli_query($con, $sql);
	if(mysqli_num_rows($rs)){
		return true;
	}else{
		return false;
	}
}

function getUser($admin_id){
	global $con;
	$sql = "SELECT * FROM admin_users WHERE admin_id='". (int)$admin_id ."'";
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

function getProductCategory($admin_id){
	global $con;
	$sql = "SELECT * FROM product_category WHERE admin_id='". $admin_id ."'";
	$rs = mysqli_query($con, $sql);
	$data = array();
	if(mysqli_num_rows($rs)){
		while($row = mysqli_fetch_assoc($rs)){
			$data[] = $row['category_id'];
		}
	}
	return $data;
}