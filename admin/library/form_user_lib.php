<?php checkAdminLogin();
$document_title = 'Add New User';

$username = '';
$password = '';
$cpassword = '';
$fullname = '';
$email = '';
$phone = '';
$status = '1';

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
			
			$sql = "SELECT * FROM admin_users WHERE username='". $username ."'";
			$rs = mysqli_query($con, $sql);
			
			if(!mysqli_num_rows($rs)){
			
				$sql = "INSERT INTO admin_users SET username='". $username ."', password='". md5($password) ."', fullname='". $fullname ."', email='". $email ."', phone='". $phone ."', status='". (int)$status ."', date_added=NOW()";
				
				mysqli_query($con, $sql);
				
				addAlert('success', 'User has been added successfully');
				redirect('manage_users.php');
		
			}else{
				addAlert('danger', 'Username already exists!');	
			}
		}else{
			addAlert('danger', 'Confirm password not matched!');
		}
	}
}