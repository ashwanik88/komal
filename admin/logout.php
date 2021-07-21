<?php require_once('includes/startup.php');

addAlert('success', 'Successfully logged out!');

unset($_SESSION['admin_user']);

setcookie('USERNAME', $username, time() - 60 * 60 * 24 * 30);
setcookie('PASSWORD', $password, time() - 60 * 60 * 24 * 30);

redirect('index.php');
