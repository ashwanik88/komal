<?php 
session_start();
require_once('config.php');
require_once('connection.php');
require_once('function.php');

$username = '';
if(isset($_SESSION['admin_user']) && !empty($_SESSION['admin_user'])){
	$username = $_SESSION['admin_user']['username'];
}