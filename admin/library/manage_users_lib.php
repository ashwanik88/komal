<?php checkAdminLogin();
$document_title = 'Manage Users';

$sql = "SELECT * FROM admin_users";

$rs = mysqli_query($con, $sql);

$rows = array();
if(mysqli_num_rows($rs)){
	while($rec = mysqli_fetch_assoc($rs)){
		$rows[] = $rec;
	}
}