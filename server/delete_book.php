<?php
	session_start();
	if(isset($_GET["bookingid"])){
		require_once("connect.php");
		
		$bookingid = mysqli_real_escape_string($con, $_GET["bookingid"]);
		$sql = "DELETE FROM booking WHERE bookingid='".$bookingid."' LIMIT 1";
		
		$run = mysqli_query($con, $sql);
		if($run){
			$_SESSION["result"] = 2;
			header("location: show_bookings.php");
		}else{
			header("location: show_bookings.php");
		}
	}else{
		header("location: show_bookings.php");
	}