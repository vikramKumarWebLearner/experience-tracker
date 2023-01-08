
<?php
error_reporting(0);
	//database connection
	$conn=mysqli_connect("localhost", "root", "", "expense_tracker","3308");
	if(mysqli_connect_errno()){
		echo "Connection Fail".mysqli_connect_error();
	}
?>
