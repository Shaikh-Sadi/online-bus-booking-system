<?php
session_start();
if (isset($_POST["book"])) {
    $destination      = $_POST["destination"];
    $car_number       = $_POST["car_number"];
    $booking_time     = $_POST["booking_time"];
    $return_time      = $_POST["return_time"];
    $pu_destination   = $_POST["pu_destination"];
    $passengers       = $_POST["passengers"];
    $user_book_time   = strtotime($booking_time);
    $user_return_time = strtotime($return_time);
    $bookingid        = $_SESSION["bookingid"];
    
    //Get the user id
    require_once("connect.php");
    $sql1 = "SELECT userid FROM users WHERE email='" . $_SESSION["logged_user"] . "' LIMIT 1";
    $run1 = mysqli_query($con, $sql1);
    if ($userid = mysqli_fetch_assoc($run1)) {
        $userid = $userid["userid"];
    }
    
    
    
    $today = date("Y-m-d");
    if ($user_book_time >= $today && $user_return_time > $user_book_time && $destination != $pu_destination) {
        $c            = 0;
        //Check car availability
        $sql2         = "SELECT * FROM booking WHERE carNumber='" . $car_number . "'";
        $run2         = mysqli_query($con, $sql2);
        $availability = "no";
        if (mysqli_num_rows($run2) > 0) {
            while ($eb1 = mysqli_fetch_assoc($run2)) {
                if ($_REQUEST["book"] == "Book A Bus") {
                    $user_book_time   = strtotime($booking_time);
                    $user_return_time = strtotime($return_time);
                    
                    $db_book_time   = strtotime($eb1["bookingTime"]);
                    $db_return_time = strtotime($eb1["returnTime"]);
                    
                    if ($user_return_time < $db_book_time || $user_book_time > $db_return_time) {
                        $availability = "yes";
                    } else {
                        $availability = "no";
                        if ($availability == "no")
                            break;
                    }
                    
                    
                }
            }
        } else {
            $availability = "yes";
        }
        
        if ($_REQUEST["book"] == "Book A Bus") {
            if ($availability == "yes") {
                $sql = "INSERT INTO booking(destination, carNumber, bookingTime, returnTime, pickupFrom, passengers, userid) VALUES('" . $destination . "', '" . $car_number . "', '" . $booking_time . "', '" . $return_time . "', '" . $pu_destination . "', '" . $passengers . "', '" . $userid . "') ";
                
                
                $run = mysqli_query($con, $sql);
                
                if ($run == true) {
                    $_SESSION["result"] = 1;
                    header("location: show_bookings.php");
                } else {
                    include("dashboard.php");
                }
            } else {
                $_SESSION["result"] = 3;
                include("dashboard.php");
            }
        }
        if ($_REQUEST["book"] == "update") {
            $sql3 = "SELECT * FROM booking WHERE bookingid='" . $bookingid . "'";
            $run3 = mysqli_query($con, $sql3);
            if ($eb2 = mysqli_fetch_assoc($run3)) {
                $user_book_time   = strtotime($booking_time);
                $user_return_time = strtotime($return_time);
                //Db times
                
                $db_book_time   = strtotime($eb2["bookingTime"]);
                $db_return_time = strtotime($eb2["returnTime"]);
                if ($db_return_time == $user_return_time && $db_book_time == $user_book_time) {
                    $availability = "yes";
                } else {
                    $sql2 = "SELECT * FROM booking WHERE carNumber='" . $car_number . "'";
                    $run2 = mysqli_query($con, $sql2);
                    while ($eb1 = mysqli_fetch_assoc($run2)) {
                        $user_book_time   = strtotime($booking_time);
                        $user_return_time = strtotime($return_time);
                        $db_book_time     = strtotime($eb1["bookingTime"]);
                        $db_return_time   = strtotime($eb1["returnTime"]);
                        if ($eb1["bookingid"] != $bookingid) {
                            
                            if ($user_return_time < $db_book_time || $user_book_time > $db_return_time) {
                                $availability = "yes";
                            } else {
                                $availability = "no";
                                if ($availability == "no")
                                    break;
                            }
                        } else {
                            $availability = "yes";
                        }
                    }
                }
            }
            if ($availability == "yes") {
                $sql = "UPDATE booking SET destination='" . $destination . "', carNumber='" . $car_number . "', bookingTime='" . $booking_time . "', returnTime='" . $return_time . "', pickupFrom='" . $pu_destination . "', passengers='" . $passengers . "' WHERE bookingid='" . $bookingid . "' ";
                
                $run = mysqli_query($con, $sql);
                
                if ($run == true) {
                    $_SESSION["result"] = 7;
                    header("location: show_bookings.php");
                } else {
                    include("update_dashbord_book.php");
                }
            } else {
                $_SESSION["result"] = 3;
                include("update_dashbord_book.php");
            }
        }
        
        
    } else {
        if ($_REQUEST["book"] == "update") {
            $_SESSION["result"] = 8;
            if ($user_return_time < $user_book_time) {
                $_SESSION["result"] = 9;
            }
            if ($destination == $pu_destination) {
                $_SESSION["result"] = 10;
            }
            include("update_dashbord_book.php");
        }
        $_SESSION["result"] = 4;
        if ($user_return_time < $user_book_time) {
            $_SESSION["result"] = 5;
        }
        if ($destination == $pu_destination) {
            $_SESSION["result"] = 6;
        }
        include("dashboard.php");
    }
    
    
}