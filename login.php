<?php
	$name = $pwd = "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$name = test_input($_POST["username"]);
		$pwd = test_input($_POST["password"]);
	}

	$con = mysqli_connect("localhost", "root", "pwd");
	if(!$con){
		die('Could not connect: ' . mysql_error());
	}

	mysqli_select_db($con, "library");

	$sql = "SELECT password FROM admin
		WHERE username = $name";

	$result = mysqli_query($con, $sql);

	$sqlpwd = mysqli_fetch_array($result)['password'];
	if(!$sqlpwd){
		echo "no this man!";
	}
	else if($sqlpwd != $pwd){
		echo "wrong!";
	}
	else if($sqlpwd == $pwd){
		echo "yeah!";
	}

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>