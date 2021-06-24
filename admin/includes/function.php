<?php 
function checkAdminLogin(){
	if(!isset($_SESSION['admin_user']) || empty($_SESSION['admin_user'])){
		redirect('index.php');
	}
}
function redirect($link){
	header('Location: ' . $link);
	die;
}

function addAlert($type, $msg){
	$_SESSION['alert']['type'] = $type;
	$_SESSION['alert']['msg'] = $msg;
}

function displayAlert(){
	$html = '';
	if(isset($_SESSION['alert']) && !empty($_SESSION['alert'])){
		$type = $_SESSION['alert']['type'];
		$msg = $_SESSION['alert']['msg'];
		$html = '<div class="alert alert-'. $type .' alert-dismissible fade show" role="alert">'. $msg .'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		unset($_SESSION['alert']);
	}
	return $html;
}