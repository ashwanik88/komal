<?php

$first_number = '';
$second_number = '';
$result = '';
if($_POST){
// sleep(2);
if(isset($_POST['first_number']) && !empty($_POST['first_number']) 
	&& isset($_POST['second_number']) && !empty($_POST['second_number'])){
		
	$first_number = $_POST['first_number'];
	$second_number = $_POST['second_number'];

	$result = $first_number + $second_number;
	
	$arr = array('result' => $result, 'msg' => 'hello world', 'abc' => 'xyz');
	echo json_encode($arr);
	// echo $result;
	die;
	
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

<form action="" method="POST" id="frm">
<table width="400" cellpadding="10" cellspacing="0" border="1"><tbody>
	<tr><td>Enter First Number</td><td><input type="text" name="first_number"value="<?php echo $first_number; ?>" /></td></tr>
	<tr><td>Enter Second Number</td><td><input type="text" name="second_number" value="<?php echo $second_number; ?>" /></td></tr>
	<tr><td>Result</td><td class="result"><?php echo $result; ?></td></tr>
	<tr>
		<td></td>
		<td><input type="submit" value="Add Number" /><img src="spinner.gif" width="24" id="loading" style="display: none;" /></td>
	</tr>
</table>
</form>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
$('#frm').submit(function(){
	$.ajax({
		type: 'POST',
		url: 'add_numbers_ajax.php',
		dataType: 'JSON',	// json | html
		data: {
			first_number: $('input[name="first_number"]').val(),
			second_number: $('input[name="second_number"]').val(),
		},
		success: function(j){
			$('.result').html(j.result);
			alert(j.msg);
			//$('#loading').hide();
			// console.log(html);
			console.log(j);
		},
		beforeSend: function(){
			$('#loading').show();
		},
		complete: function(){
			$('#loading').hide();
		}
	});
	
	
	return false;
});
</script>
</body>
</html>
 