<?php
$first_number = '';
$second_number = '';
$result = '';
if($_GET){
if(isset($_GET['first_number']) && !empty($_GET['first_number']) 
	&& isset($_GET['second_number']) && !empty($_GET['second_number'])){
		
	$first_number = $_GET['first_number'];
	$second_number = $_GET['second_number'];

	$result = $first_number + $second_number;
	
}else{
	echo 'Error: incomplete form data!';
	die;
}
}

?>
<!doctype html>
<html>
<head>
	<title>PHP start</title>
</head>
<body>

<form action="" method="GET">
<table width="400" cellpadding="10" cellspacing="0" border="1"><tbody>
	<tr><td>Enter First Number</td><td><input type="text" name="first_number"value="<?php echo $first_number; ?>" /></td></tr>
	<tr><td>Enter Second Number</td><td><input type="text" name="second_number" value="<?php echo $second_number; ?>" /></td></tr>
	<tr><td>Result</td><td><?php echo $result; ?></td></tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Add Number" /></td>
	</tr>
</table>
</form>

</body>
</html>
 