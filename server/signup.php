<?php
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$email = $_POST["email"];
		$password = $_POST["password"];
		
		require_once("connect.php");
		$sql = "INSERT INTO users(email, password) VALUES('".$email."','".md5($password)."')";
		$run = mysqli_query($con, $sql);
		if($run){
			//header("location: ../index.php");
			echo "Register successfully.";
			echo"<li><a href='../index.php'>Click here for login</a></li>";
		}else{
			//$err = "Something went wrong.";
			echo "Something went wrong.";
			echo"<li><a href='../index.php'>please try again</a></li>";
		}
			
	}else{
		include("../index.php");
	}
