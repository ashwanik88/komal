<?php require_once('includes/startup.php');

addAlert('success', 'Successfully logged out!');

unset($_SESSION['admin_user']);

redirect('index.php');
