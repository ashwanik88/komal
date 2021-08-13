<?php 

class user{
	function __construct(){
		echo 'constructor is running! <br>';
	}
	public function add($str){
		echo 'user add<br>';
		
		$this->edit();
		$this->delete();
	}

	protected function edit(){
		echo 'user edit<br>';
	}
	private function delete(){
		echo 'user delete<br>';
	}
	
	function __destruct(){
		echo 'destructor is running! <br>';
	}
}

class product extends user{
	function __construct($param){
		echo $param . '<br>';
	}
	function add($str){
		echo $str .' product add<br>';
		$this->edit();
	}

	// function edit(){
		// echo 'product edit<br>';
	// }
	function delete(){
		echo 'product delete<br>';
	}
}

// user::add();//  static method required

$user = new user;

//$user->add();

// $user->delete();
// $user->edit();

$product = new product('12345');

$product->add('abc');