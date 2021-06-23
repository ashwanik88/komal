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