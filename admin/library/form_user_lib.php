<?php checkAdminLogin();
$document_title = 'Add New User';

$admin_id = '';
$username = '';
$password = '';
$cpassword = '';
$fullname = '';
$email = '';
$phone = '';
$status = '1';

if($_GET){
	if(isset($_GET['admin_id']) && !empty($_GET['admin_id'])){
		$admin_id = $_GET['admin_id'];
		$document_title = 'Edit User | ' . $admin_id;
		$data = getUser($admin_id);
		
		$username = $data['username'];
		$fullname = $data['fullname'];
		$email = $data['email'];
		$phone = $data['phone'];
		$status = $data['status'];
		
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
		$status = (isset($_POST['status']))?1:0;
		
		if($password == $cpassword){
			
			if(!alreadyExists($username, $admin_id)){
				
				if($admin_id){
					$sql = "UPDATE admin_users SET username='". $username ."', fullname='". $fullname ."', email='". $email ."', phone='". $phone ."', status='". (int)$status ."', date_modified=NOW() WHERE admin_id='". (int)$admin_id ."'";
					mysqli_query($con, $sql);
					addAlert('success', 'User has been updated successfully');
					
					if(!empty($password)){
						$sql_pass = "UPDATE admin_users SET password='". md5($password) ."' WHERE admin_id='". (int)$admin_id ."'";
						mysqli_query($con, $sql_pass);
					}
				}else{
					$sql = "INSERT INTO admin_users SET username='". $username ."', password='". md5($password) ."', fullname='". $fullname ."', email='". $email ."', phone='". $phone ."', status='". (int)$status ."', date_added=NOW()";
					mysqli_query($con, $sql);
					addAlert('success', 'User has been added successfully');
					$admin_id = mysqli_insert_id($con);
				}
				
				
				redirect('form_user.php?admin_id=' . $admin_id);
				
				//redirect('manage_users.php');
		
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