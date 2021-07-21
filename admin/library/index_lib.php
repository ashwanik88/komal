<?php 

if(isset($_COOKIE['USERNAME']) && !empty($_COOKIE['USERNAME']) && isset($_COOKIE['PASSWORD']) && !empty($_COOKIE['PASSWORD'])){
		$username = $_COOKIE['USERNAME'];
		$password = $_COOKIE['PASSWORD'];
		
		checkUser($username, $password);
		
}


if($_POST){
	if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		checkUser($username, $password);
		
	}
}


function checkUser($username, $password){
	global $con;
	$sql = "SELECT * FROM admin_users WHERE username='". $username ."' AND password='". $password ."' AND status=1";
		
	$rs = mysqli_query($con, $sql);
	
	if(mysqli_num_rows($rs) > 0){
		
		$rec = mysqli_fetch_assoc($rs);
		
		$_SESSION['admin_user'] = $rec;
		
		if(isset($_POST['remember_me']) && !empty($_POST['remember_me'])){
			setcookie('USERNAME', $username, time() + 60 * 60 * 24 * 30);
			setcookie('PASSWORD', $password, time() + 60 * 60 * 24 * 30);
		}
		
		addAlert('success', 'Successfully logged in to admin panel!');
		redirect('dashboard.php');
		
	}else{
		addAlert('danger', 'Incorrect Username/Password!');
		redirect('index.php');
	}
}