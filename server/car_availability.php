<?php
	session_start();
	if(isset($_SESSION["logged_user"]) && $_SESSION["logged_user"] != ""){
		$carNum = $_POST["carNum"];
		$_SESSION["car"]=$carNum;
		require_once("connect.php");
		$sql = "SELECT * FROM booking WHERE carNumber='".$carNum."'";
		$run = mysqli_query($con, $sql);
		$output = "";
		$c = 0;
		while($eb = mysqli_fetch_assoc($run)){
			$c++;
			$output .= '<li class="list-group-item">'.$c.'. '.$eb["bookingTime"]." --- ".$eb["returnTime"].'</li>';
		}
		if(mysqli_num_rows($run) > 0){
			$rdata = array(
				'success' => 1,
				'output' => $output
			);
		}else{
			$rdata = array(
				'success' => 2,
				'output' => ''
			);
		}
		
		echo json_encode($rdata);
		
	}