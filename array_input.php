<?php
$first_number = '';
$second_number = '';
$result = '';

if($_POST){
	echo '<pre>';
	print_r($_POST);
	
	echo implode(', ', $_POST['qual']);
	die;
}

?>
<!doctype html>
<html>
<head>
	<title>PHP start</title>
</head>
<body>

<form action="" method="POST">
<table width="400" cellpadding="10" cellspacing="0" border="1"><tbody>
	<tr><td>Enter First Number</td><td><input type="text" name="number[]"value="<?php echo $first_number; ?>" /></td></tr>
	<tr><td>Enter Second Number</td><td><input type="text" name="number[]" value="<?php echo $second_number; ?>" /></td></tr>
	<tr><td>Qualification</td><td>
	<label><input type="checkbox" name="qual[]" value="10th" /> 10th</label> <br>
	<label><input type="checkbox" name="qual[]" value="12th" /> 12th</label> <br>
	<label><input type="checkbox" name="qual[]" value="B.Tech" /> B.Tech</label> <br>
	<label><input type="checkbox" name="qual[]" value="M.Tech" /> M.Tech</label> <br>
	
	</td></tr>
	<tr><td>Result</td><td><?php echo $result; ?></td></tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Add Number" /></td>
	</tr>
</table>
</form>

</body>
</html>
 