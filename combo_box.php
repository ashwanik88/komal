<?php 
session_start();

if($_POST){ 
	if(isset($_POST['btnAdd'])){
		$_SESSION['left_arr'][] = $_POST['txtNew'];
	}
} ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<link href="fontawesome/css/fontawesome.css" rel="stylesheet">
	<link href="fontawesome/css/brands.css" rel="stylesheet">
	<link href="fontawesome/css/solid.css" rel="stylesheet">
	
    <title>Combo Box</title>
  </head>
  <body>
  
<form action="" method="POST">
	<div class="container border my-4">
		<div class="row border pt-3">
			<div class="col-sm-4">
				<div class="input-group mb-3">
				  <input type="text" id="txtNew" name="txtNew" class="form-control" placeholder="Enter New Item" aria-label="Recipient's username" aria-describedby="button-addon2">
				  <button class="btn btn-primary" type="submit" id="btnAdd" name="btnAdd">Add New Item</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5 border py-3 leftBox">
				<?php foreach($_SESSION['left_arr'] as $key=>$val){ ?>
				<div class="form-check"><input class="form-check-input chkLeft" type="checkbox" value="<?php echo $val; ?>" id="chk_left_<?php echo $key; ?>"><label class="form-check-label" for="chk_left_<?php echo $key; ?>"><?php echo $val; ?></label></div>
				<?php } ?>
			</div>
			<div class="col-sm-2 border text-center py-3">
				<div class="mb-3"><a href="#" class="btn btn-info btnRight"><i class="fas fa-chevron-right"></i></a></div>
				<div class="mb-3"><a href="#" class="btn btn-info btnLeft"><i class="fas fa-chevron-left"></i></a></div>
				
				<div class="mb-3"><a href="#" class="btn btn-info btnRight"><i class="fas fa-angle-double-right"></i></a></div>
				<div class="mb-3"><a href="#" class="btn btn-info btnLeft"><i class="fas fa-angle-double-left"></i></a></div>
				
			</div>
			<div class="col-sm-5 border py-3 rightBox">
				
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 py-3">
				<a href="#" class="btn btn-danger float-end">Delete</a>
			</div>
		</div>
	</div>
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">
	// var arr_left = [];
	// var arr_right = [];
	// $('#btnAdd').click(function(){
		// arr_left.push($('#txtNew').val());
		// displayLeft();
	// });
	// function displayLeft(){
		// var html = '';
		// for(var i = 0; i < arr_left.length; i++){
			// html += '<div class="form-check"><input class="form-check-input chkLeft" type="checkbox" value="'+ arr_left[i] +'" id="chk_left_'+ i +'"><label class="form-check-label" for="chk_left_'+ i +'">'+ arr_left[i] +'</label></div>';
		// }
		// $('.leftBox').html(html);
	// }
	
	// $('.btnRight').click(function(){
		// var tmp = [];
		// $('.chkLeft').each(function(){
			// if($(this).is(':checked')){
				// arr_right.push($(this).val());
			// }else{
				// tmp.push($(this).val());
			// }
		// });
		// arr_left = tmp;
		// displayLeft();
		// displayRight();
	// });
	// $('.btnLeft').click(function(){
		// var tmp = [];
		// $('.chkRight').each(function(){
			// if($(this).is(':checked')){
				// arr_left.push($(this).val());
			// }else{
				// tmp.push($(this).val());
			// }
		// });
		// arr_right = tmp;
		// displayLeft();
		// displayRight();
	// });
	// function displayRight(){
		// var html = '';
		// for(var i = 0; i < arr_right.length; i++){
			// html += '<div class="form-check"><input class="form-check-input chkRight" type="checkbox" value="'+ arr_right[i] +'" id="chk_right_'+ i +'"><label class="form-check-label" for="chk_right_'+ i +'">'+ arr_right[i] +'</label></div>';
		// }
		// $('.rightBox').html(html);
	// }
	</script>
  </body>
</html>