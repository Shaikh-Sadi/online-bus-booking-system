<?php
session_start();
//$_SESSION["logged_user"] = "";
if($_SESSION["logged_user"] == ""){
	header("location: ../index.php");
}

?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../mycss.css" />
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container booking-cont">
		<section class="header">
			<div class="row ">
				<div class="col-md-6">
					<h1>Bus Booking</h1>
				</div>
				<div class="col-md-6 text-right">
					<span class="user"><?php echo $_SESSION["logged_user"];?></span><a href="logout.php" class="btn btn-link">Logout</a>
				</div>
			</div>
		</section>
		<?php
	
		/*
		date_default_timezone_set("Asia/Dhaka");
        $today= date("m/d/Y h:i:sa ");
		$todaTime2=strtotime("$today");
		$todaTime=strtotime("now");
		
		$tim= int strtotime ( string $today [, int $now = time() ] );
		*/
		?>

		<section class="show-bookings">
			<div class="row">
				<div class="col-md-8">
					<?php if(isset($_SESSION["result"]) && $_SESSION["result"] == 1){ ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> New booking added.
					</div>
					<?php }elseif(isset($_SESSION["result"]) && $_SESSION["result"] == 2){ ?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> Booking deleted.
					</div>
					<?php } $_SESSION["result"]="";?>
				</div>
				<div class="col-md-4">
					<a href="dashboard.php" class="btn btn-info pull-right">Book New Car</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-container">
						<table class="table table-stripped table-responsive">
							<thead>
								<tr>
									<th>ID</th>
									<th>Destination</th>
									<th>Car Number</th>
									<th>Booking Time</th>
									<th>Return Time</th>
									<th>Pick Up Destination</th>
									<th>Passengers</th>
									<th>Actions</th>
								</tr>
							</thead>
							
							
							<?php
							
								$dest = array(
									"1" => "Comilla",
									"2" => "Dhaka",
									"3" => "Madaripur"
								);
								
								$cn = array(
									"1" => "S-3456",
									"2" => "E-6798",
									"3" => "G-4325"
								);
							
							?>
							
							
							
							<tbody>
								<?php
									require_once("connect.php");
									//Get the logged userid
									$sql = "SELECT userid FROM users WHERE email='".$_SESSION["logged_user"]."' LIMIT 1";
									$run = mysqli_query($con, $sql);
									if($userid = mysqli_fetch_assoc($run)){
										$userid = $userid["userid"];
									}
									$sql = "SELECT * FROM booking WHERE userid='".$userid."'";
									$run = mysqli_query($con, $sql);
									while($ab = mysqli_fetch_assoc($run)){
								?>
								<tr>
									<td><?php echo $ab["bookingid"];?></td>
									<td><?php echo $dest[$ab["destination"]];?></td>
									<td><?php echo $cn[$ab["carNumber"]];?></td>
									<td><?php echo $ab["bookingTime"];?></td>
									<td><?php echo $ab["returnTime"];?></td>
									<td><?php echo $dest[$ab["pickupFrom"]];?></td>
									<td><?php echo $ab["passengers"];?></td>
									<td>
										<!--a href="#">Edit</a-->
										<a href="delete_book.php?bookingid=<?php echo $ab["bookingid"];?>">Delete</a>
									</td>
								</tr>
									<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</section>

		<div class="footer">
			<div class="row ">
				<div class="col-md-12">
					<p class="text-center">&copy;
						<?php echo date("Y");?> All rights reserved.</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>