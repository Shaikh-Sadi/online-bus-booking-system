
<?php
	session_start();
	if(isset($_POST["book"])){
		$destination = $_POST["destination"];
		$car_number = $_POST["car_number"];
		$booking_time = $_POST["booking_time"];
		$return_time = $_POST["return_time"];
		$pu_destination = $_POST["pu_destination"];
		$passengers = $_POST["passengers"];
		$user_book_time = strtotime("$booking_time");
		$user_return_time = strtotime($return_time);
		$_SESSION["time"]=$user_book_time;
		$_SESSION["time2"]=$booking_time;
		
		
		//Get the user id
		require_once("connect.php");
		$sql = "SELECT userid FROM users WHERE email='".$_SESSION["logged_user"]."' LIMIT 1";
		$run = mysqli_query($con, $sql);
		if($userid = mysqli_fetch_assoc($run)){
			$userid = $userid["userid"];
		}
		
		 $d= $_SESSION["na"];
		 $today_data=strtotime($d);
		 //echo "$data";
		if($user_book_time >= $today_data && $user_return_time > $user_book_time && $destination!=$pu_destination){
			$c = 0;
			//Check car availability
			$sql = "SELECT * FROM booking WHERE carNumber='".$car_number."'";
			$run = mysqli_query($con, $sql);
			$availability = "no";
			if(mysqli_num_rows($run) > 0){
				while($eb = mysqli_fetch_assoc($run)){
					$user_book_time = strtotime($booking_time);
					$user_return_time = strtotime($return_time);
					//Db times
					$db_book_time = strtotime($eb["bookingTime"]);
					$db_return_time = strtotime($eb["returnTime"]);
					
					
					/* if(($user_book_time >= $db_book_time && $user_return_time <= $db_return_time) || ($user_book_time <= $db_return_time && $user_return_time >= $db_book_time)){
						$availability = false;
					} */
					
					/* if(($user_book_time >= $db_book_time && $user_book_time <= $db_return_time) || ($user_return_time >= $db_book_time && $user_return_time <= $db_return_time) || ($user_book_time <= $db_book_time && $user_return_time >= $db_return_time)){
						$availability = false;
					} */
					
					
					if($user_return_time < $db_book_time || $user_book_time > $db_return_time){
						$availability = "yes";
					}
				}
			}else{
				$availability = "yes";
			}
			
			
			if($availability == "yes"){
				$sql = "INSERT INTO booking(destination, carNumber, bookingTime, returnTime, pickupFrom, passengers, userid) VALUES('".$destination."', '".$car_number."', '".$booking_time."', '".$return_time."', '".$pu_destination."', '".$passengers."', '".$userid."')";
				
				
				$run = mysqli_query($con, $sql);
				
				if($run == true){
					$_SESSION["result"] = 1;
					header("location: show_bookings.php");
				}else{
					include("dashboard.php");
				}
			}else{
				$_SESSION["result"] = 3;
				include("dashboard.php");
			}
		}else{
			$_SESSION["result"] = 4;
			if($user_return_time < $user_book_time){
				$_SESSION["result"] = 5;
			}
			if($destination == $pu_destination){
				$_SESSION["result"] = 6;
			}
			include("dashboard.php");
		}
		
		
	}