<?php if($_POST){
	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$sql = "SELECT * FROM admin_users WHERE username='". $username ."' AND password='". $password ."'";
		
		$rs = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($rs) > 0){
			
			$rec = mysqli_fetch_assoc($rs);
			
			$_SESSION['admin_user'] = $rec;
			
			
			addAlert('success', 'Successfully logged in to admin panel!');
			
			redirect('dashboard.php');
			
			//echo 'redirect to dashboard';
		}else{
			addAlert('danger', 'Incorrect Username/Password!');
		}
		redirect('index.php');
	}
}