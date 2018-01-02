<?php
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$email = $_POST["email"];
		$password = $_POST["password"];
		
		require_once("connect.php");
		$sql = "SELECT * FROM users WHERE email='".$email."' and password='".md5($password)."' LIMIT 1";
		$run = mysqli_query($con, $sql);
		if(mysqli_num_rows($run) == 1){
			$_SESSION["logged_user"] = $email;
			header("location: dashboard.php");
		}else{
			echo "Email or password may be incorrect.";
			echo"<li><a href='../index.php'>please try again</a></li>";
			//header("location: ../index.php");
		}
			
	}else{
		echo"something wrong";
		header("location: ../index.php");
	}
