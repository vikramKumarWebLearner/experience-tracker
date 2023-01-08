<?php  
	session_start();
	error_reporting(0);

	include 'myFunctions.php';
	
	if (isset($_POST['submit'])) {
		insertCategory('wallet',$_POST['wallet']);
		header('location:allWallets.php');
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  	<link rel="stylesheet" href="css/addCategory.css">
</head>

<body>
    <div class="center">
    	<h2 class="form-head">Wallet</h2> 
        <form method="post">
        	<div class="txt_field">
        		<input type="text" name="wallet" required />
            	<label>Add Wallet</label>
        	</div>
        	<input type="submit" name="submit" value="ADD" style="margin-bottom: 10px;" />
        	<center><h3><a href="#">Cancel</a></h3></center>
        </form>
    </div>
</body>

</html>