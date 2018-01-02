<?php
     
        session_start();
	    $_SESSION["na"];
	    if($_SESSION["na"]==""){
           if(isset($_SESSION["logged_user"]) && $_SESSION["logged_user"] != ""){
              $nam = $_POST['name'];
	          $_SESSION["na"]=$nam;
              echo "Booking Time should not less then today(". $nam. ") time";
	  
            }
	    }
?>   