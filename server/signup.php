<?php
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$email = $_POST["email"];
		$password = $_POST["password"];
		
		require_once("connect.php");
		$sql = "INSERT INTO users(email, password) VALUES('".$email."','".md5($password)."')";
		$run = mysqli_query($con, $sql);
		if($run){
			header("location: ../index.php");
		}else{
			$err = "Something went wrong.";
			include("../index.php");
		}
			
	}else{
		include("../index.php");
	}
