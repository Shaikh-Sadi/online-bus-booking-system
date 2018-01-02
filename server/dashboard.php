<?php
if(!session_id()){
session_start();
$_SESSION["na"];
}
//$_SESSION["logged_user"] = "";
if($_SESSION["logged_user"] == ""){
	header("location: ../index.php");
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>New Booking</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.css" />
	<link rel="stylesheet" href="../mycss.css" />
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/moment.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
</head>
<body>
	<div class="container dashboard-cont">
		<section class="header">
			<div class="row ">
				<div class="col-xs-6 col-sm-6 col-md-6">
					<h1>Bus Booking</h1>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 text-right">
					<span class="user"><?php echo $_SESSION["logged_user"];?></span><a href="logout.php" class="btn btn-link">Logout</a>
				</div>
			</div>
		</section>
		
		<section class="main-form">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-8">
					<?php if(isset($_SESSION["result"]) && $_SESSION["result"] == 3){ ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Warning!</strong> Slot is not available.
					</div>
					<?php }elseif(isset($_SESSION["result"]) && $_SESSION["result"] == 4){ ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Warning!</strong> Booking date should not be less than today.
					</div>
					<?php }elseif(isset($_SESSION["result"]) && $_SESSION["result"] == 5){ ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Warning!</strong> Return date should not less then booking date.
					</div>
					<?php }elseif(isset($_SESSION["result"]) && $_SESSION["result"] == 6){ ?>
					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Warning!</strong> Pickup destination should not equal to destination
					</div>
					<?php } $_SESSION["result"] = ""; ?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4">
					<a href="show_bookings.php" class="btn btn-info pull-right">Manage Bookings</a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<form action="request_booking.php" class="form-horizontal" method="POST">
						<div class="form-group">
							<label for="destination">Destination</label>
							<select name="destination" id="destination" class="form-control required" required>
								<option value="">Select Destination</option>
								<option value="1" <?php if(isset($destination) && $destination == 1){echo " selected ";} ?>>Comilla</option>
								<option value="2" <?php if(isset($destination) && $destination == 2){echo " selected ";} ?>>Dhaka</option>
								<option value="3" <?php if(isset($destination) && $destination == 3){echo " selected ";} ?>>Madaripur</option>
							</select>
						</div>
						<div class="form-group">
							<label for="car_number">Car Number</label>
							<select name="car_number" id="car_number" class="form-control required" required>
								<option value="">Select Car Number</option>
								<option value="1" <?php if(isset($car_number) && $car_number == 1){echo " selected ";} ?>>S-3456</option>
								<option value="2" <?php if(isset($car_number) && $car_number == 2){echo " selected ";} ?>>E-6798</option>
								<option value="3" <?php if(isset($car_number) && $car_number == 3){echo " selected ";} ?>>G-4325</option>
							</select>
						</div>
						<div class="booked-infos hidden">
							<span class="label label-info">The car already booked in...</span>
							<ul class="list-group" id="already-booked-slots"></ul>
						</div>
						
						<div class="form-group">
							<label for="booking_time">Booking Time</label>
							<div class="input-group date" id="datetimepicker1">
								<input type="text" name="booking_time" id="name" class="form-control required" value="<?php if(isset($booking_time)){echo $booking_time;} ?>" required />
								<span class="input-group-addon" id="sk">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
							<script type="text/javascript">
								$(function () {
									$('#datetimepicker1').datetimepicker();
								});
							</script>
							<script type = "text/javascript" language = "javascript">
                              $(document).ready(function() {
                                $("#sk").click(function(event){
                                    var name = $("#name").val();
                                    $("#stage").load('http://localhost/form/server/Ajax.php', {"name":name} );
                                  });
                                });
                            </script>
							
						</div>
						<div>
                         
		
                         <div id = "stage" style = "background-color:cc0;">
                         
                        </div>
		
                         <!--input type = "button" id = "driver" value = "Show Result" /-->
						</div>
						
						<div class="form-group">
							<label for="return_time">Return Time</label>
							<div class="input-group date" id="datetimepicker2">
								<input type="text" name="return_time" id="return_time" class="form-control required" value="<?php if(isset($return_time)){echo $return_time;} ?>" required />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
							<script type="text/javascript">
								$(function () {
									$('#datetimepicker2').datetimepicker();
								});
							</script>
						</div>
						<div class="form-group">
							<label for="pu_destination">Pick Up Destination</label>
							<select name="pu_destination" id="pu_destination" class="form-control required" required>
								<option value="">Select Destination</option>
								<option value="1" <?php if(isset($pu_destination) && $pu_destination == 1){echo " selected ";} ?>>Comilla</option>
								<option value="2" <?php if(isset($pu_destination) && $pu_destination == 2){echo " selected ";} ?>>Dhaka</option>
								<option value="3" <?php if(isset($pu_destination) && $pu_destination == 3){echo " selected ";} ?>>Madaripur</option>
							</select>
						</div>
						<div class="form-group">
							<label for="passengers">Passengers</label>
							<input type="number" name="passengers" id="passengers" class="form-control required" value="<?php if(isset($pu_destination)){echo $passengers;} ?>" required />
						</div>
						<input type="submit" value="Book A Bus" name="book" class="btn btn-success" />
					</form>
				</div>
			</div>
		</section>
		
		<div class="footer">
			<div class="row ">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<p class="text-center">&copy; <?php echo date("Y");?> All rights reserved.</p>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>