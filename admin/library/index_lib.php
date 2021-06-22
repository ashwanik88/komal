<?php if($_POST){
	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$sql = "SELECT * FROM admin_users WHERE username='". $username ."' AND password='". $password ."'";
		
		$rs = mysqli_query($con, $sql);
		
		if(mysqli_num_rows($rs) > 0){
			
			header('Location: dashboard.php');
			die;
			//echo 'redirect to dashboard';
		}else{
			echo 'error message - incorrect login details';
		}
		die;
	}
}