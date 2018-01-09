<?php
session_start();
$_SESSION["logged_user"] = "";
if($_SESSION["logged_user"] == ""){
	header("location: ../index.php");
}else{
	header("location: dashboard.php");
}

?>