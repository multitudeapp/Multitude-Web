<?php
	$con = mysqli_connect("localhost","root","temppassword123!","maindb");
	if (mysqli_connect_errno($con)) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
?>