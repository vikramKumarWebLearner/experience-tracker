<?php
session_start();
//-----------------------------------------------<!		Inser Transactions	!>---------------------------------------
	function insertTransaction($uid,$date,$amount,$type,$category,$wallet,$note){
		$budgetMsg = checkBudgetValidation($type,$amount);
		if ($budgetMsg == 1) {
			include 'include/dbconn.php';
			if ($date > date('Y-m-d') ) {
				return "Invalid Transaction Date !";
			}
			$sql = "INSERT INTO `transaction`(`date`, `amount`, `type`, `category`, `wallet`, `note`, `uid`) 
					VALUES ('$date','$amount','$type','$category','$wallet','$note','$uid')";
			$ref = mysqli_query($conn,$sql);
          	// header('location:dashboard.php');
          	mysqli_close($conn);
          	// echo 'Data  Successfully  Insert  !';
          	return 1;
		}
		else 
		{
			return $budgetMsg;
		}
	}
//-----------------------------------------------<!		Insert Reminders	!>---------------------------------------
	function insertReminder($date,$amount,$type,$category,$time,$note,$uid){
		include 'include/dbconn.php';
		$sql = "INSERT INTO `reminders`(`date`, `amount`, `type`, `category`, `time`, `note`, `uid`) 
				VALUES ('$date','$amount','$type','$category','$time','$note','$uid')";
		$ref = mysqli_query($conn,$sql);
        header('location:dashboard.php');
		mysqli_close($conn);
	}
//-----------------------------------------------<!    Get Data according to YOU    !>----------------------------------------
	function getData(){
		$uid = $_SESSION['id'];
		include('include/dbconn.php');
		$sql = "SELECT * FROM transaction WHERE `transaction`.`uid` =$uid" ;
		$ref = mysqli_query($conn, $sql);		//	$ref is a data object 
		// $row = mysqli_fetch_all($ref);			//	mysqli_fetch_array() function fetches all result rows and returns the
		$i =0 ;
		$data = null;
		while($row = mysqli_fetch_array($ref)){
			$data[$i]=$row;
			$i++;
		}
		$item=1;								//	associative array, a numeric array, or both.
		//	0 ='id';	1 = 'date';	2 = 'amount';	3 = 'type';	4 = 'category';	5 = 'note';	6 = 'wellat';
		mysqli_close($conn);
		return $data;
	}
//--------------------------------------------------------------------------------------------------------------------------
	function getUserInformation(){
		include 'include/dbconn.php';
		$uid = $_SESSION['id'];
		// $uid = 9;
		$sql = "SELECT * FROM `users` WHERE `Id`=$uid";
		$ref = mysqli_query($conn , $sql);
		// $data = mysqli_fetch_all($ref);
		
		$i =0 ;
		while($row = mysqli_fetch_array($ref)){
			$data[$i]=$row;
			$i++;
		}

		mysqli_close($conn);
		return $data[0];
	}
	// $data = getUserInformation();
	// echo '<pre>';
	// print_r($data);	
//--------------------------------------------------------------------------------------------------------------------------
	function setUserInformation($name, $emailId, $password, $mobileNumber){
		include 'include/dbconn.php';
		$sql = "INSERT INTO `users`(`name`, `email`, `mobileNumber`, `password`) 
				VALUES ('$name','$emailId','$password','$mobileNumber')";
		$row = mysqli_query($conn,$sql);
		mysqli_close($conn);
		return 1;	
	}
//--------------------------------------------------------------------------------------------------------------------------
	function updateUserInformation($name,$mobileNumber){
		include 'include/dbconn.php';
		$sql = "UPDATE users SET name = '$name', mobileNumber ='$mobileNumber' WHERE  id = '$uid'";
		mysqli_query($conn,$sql);
		mysqli_close($conn);
		return 1;
	}
//--------------------------------------------------------------------------------------------------------------------------
	function checkBudgetValidation($type,$amount){
		$uid = $_SESSION['id'];
		// $uid = 9;
		$BDC = getUserInformation();
		$budget = $BDC['budget'];
		$debt = $BDC['debt'];
		$credit = $BDC['credit'];
		// $budget =0;
		// $debt =0;
		// $credit =0;

		// $data = null;
		// $data = getData();
		// if ($data != null) {
		// 	$categoryAmount = totle($data,3);
		// 	$expense = $categoryAmount['expense'];
		// 	$income = $categoryAmount['income'];
		// 	$borrow = $categoryAmount['borrow'];
		// 	$lend = $categoryAmount['lend'];

		// 	$budget = ($income + $borrow) - ($expense - $lend) ;
		// 	$debt = $borrow;
		// 	$credit = $lend;
		// }
		if ($type == 'expense') {
			if ($budget != null) {
				if ($budget >= $amount) {
					$budget = $budget - $amount;
				}
				else{
					return 'Your Budget Is Low !';
				}
			}
			else {
				return 'Your Budget Is Low';
			}
		}
		elseif ($type == 'income') {
			$budget = $budget + $amount;
		}
		elseif ($type == 'borrow') {
			$budget = $budget + $amount;
			$debt   = $debt + $amount;
		}
		elseif ($type == 'lend'){
			if ($budget >= $amount) {
				$budget = $budget - $amount;
				$credit = $credit + $amount;
			}
			else{
				return 'Your Budget Is Low !';
			}
		}
		else{
			return 'Invalid Type  !';
		}
		include 'include/dbconn.php';
		$sql = "UPDATE users SET budget = '$budget', debt ='$debt', credit ='$credit' WHERE  id = '$uid'";
		$row = mysqli_query($conn,$sql);
		mysqli_close($conn);
		return 1;
	}
		// 	$data = getData();
		// $categoryAmount = totle($data,3);
		// echo '<pre>';
		// print_r($categoryAmount);
//--------------------------------------------------------------------------------------------------------------------------
	function checked($check){
		include 'include/dbconn.php';
		$uid = $_SESSION['id'];
		$qurry = "SELECT * FROM transaction WHERE `transaction`.`id` = $check";
	    $ref = mysqli_query($conn, $qurry);
	    $checkedData = mysqli_fetch_array($ref);
	    $checkedAmount = $checkedData['amount'];
	    $checkedType = $checkedData['type'];

	    $userInformation = getUserInformation();
	    $budget = $userInformation['budget'];
	    $debt = $userInformation['debt'];
	    $credit = $userInformation['credit'];
	    
	    if ($checkedType == 'borrow' ) {
	        if ($checkedAmount <= $budget) {	        	
		        $budget = $budget - $checkedAmount;
		        $debt = $debt - $checkedAmount;
	        }
	        else{
	        	return 'Your Budget Is Low !';
	        }
	    }
	    else{
	        $budget = $budget + $checkedAmount;
	        $credit = $credit - $checkedAmount;
	    }
	    $sql = "UPDATE users SET budget = '$budget', debt ='$debt', credit ='$credit' WHERE  id = '$uid'";
		mysqli_query($conn,$sql);
	    $qurry = 'DELETE FROM transaction WHERE `transaction`.`id` ='. $check;
	    mysqli_query($conn, $qurry);
	    mysqli_close($conn);
        return 1;
	}
//--------------------------------------------------------------------------------------------------------------------------
function getRemainder(){
	include('include/dbconn.php');
	$uid = $_SESSION['id'];
	$sql = "SELECT * FROM reminders WHERE `reminders`.`uid` =".$uid ;
	$ref = mysqli_query($conn, $sql);
	// $row = mysqli_fetch_all($ref);
	$i = 0 ;
	$data =null;
	while($row = mysqli_fetch_array($ref)){
		$data[$i]=$row;
		$i++;
	}
	$item=2;
	mysqli_close($conn);
	$data = sort_data_1($data,$item);
	return $data;
}
//----------------------------------------------------------------------------------------------------------------------------------
function getCategory($type){
	include 'include/dbconn.php';
	$uid = $_SESSION['id'];
	$sql = "SELECT * FROM $type";
	$ref = mysqli_query($conn,$sql);
	// $row = mysqli_fetch_all($ref);
	$i =0 ;
	$data = null;
	while($row = mysqli_fetch_array($ref)){
		$data[$i]=$row;
		$i++;
	}
	mysqli_close($conn);
	$category = null;
	$j = 0;
	// echo '<pre>';
	// print_r($row);xs
	if ($data != null) {
		for ($i=0; $i < count($data) ; $i++) { 
			if ($data[$i]['uid'] == 0) {
				$category[$j] = $data[$i];
				$j++; 
			}
			elseif ($data[$i]['uid'] == $uid) {
				$category[$j] = $data[$i];
				$j++;
			}
		}
		return $category;
	}
	return null;	
}
// echo "<pre>";
// print_r(getCategory('expense'));


function insertCategory($table, $category){
	include 'include/dbconn.php';
	$uid = $_SESSION['id'];
	$sql = "INSERT INTO $table (`uid`, `name`) VALUES ('$uid', '$category')";
	$row = mysqli_query($conn, $sql);
	mysqli_close($conn);
}
// echo "<pre>";
// $type = getTypes('borrow');
// print_r($type);
//----------------------------------------------------------------------------------------------------------------------------------
function getMonthlyData($month){
	$data=getData();
	$data = sort_data_1($data,1);
	$j=0;
	$d = null;
	if ($data!=null) {
		for ($i=0; $i < count($data); $i++) { 
			$date = $data[$i][1];
			if (substr($date, 5,2)==$month) {
				$d[$j] = $data[$i];
				$j++;
			}
		}
	}
	return $d;
}
// $data = getData();
// sort_data_1	($data,1);
// 	echo "<pre>";
// 	print_r( $data );
//------------------------------------------------<!	new data shorting	!>--------------bubble sorting-----				
function sort_data_1($data,$item){
	// $data = getData();
	if($data != null){
		while(true){
			$flag = 0;
			for ($i=0; $i < count($data)-1; $i++) { 
				if ($data[$i][$item]>$data[$i+1][$item]) {
					$temp = $data[$i];
					$data[$i] = $data[$i+1];
					$data[$i+1] = $temp;
					$flag = 1;
				}
			}
			if($flag == 0)
				break;
		}
		return $data;
	}
}
// echo '<pre>';
// print_r(sort_data(getData(),1));
//------------------------------------------------<!	data shorting	!>-------------------				
	function sort_data($data, $item){
		if ($data!=null) {
			for ($i=0; $i <count($data); $i++) { 
				for($j=$i+1; $j <count($data);$j++) { 
					if($data[$j][$item]<$data[$i][$item]){
						$temp=$data[$i];
						$data[$i]=$data[$j];
						$data[$j]=$temp;
						// echo '<pre>';
						// print_r($data);
					}
				}
			}
			return($data);
		}
	}
	// 
//------------------------------------------------<!   how much money transfer in one day		!>----------------	
	function count_transactions_money($data,$item){
		// $data = sort_data_1($data,$item);
		if ($data!=null) {
			for ($i=0; $i <	count($data) ; $i++) { 
				$j=$i+1;
				while ($j<count($data)) {
					if ($data[$i][$item] == $data[$j][$item]) {
						$data[$i][2] =  $data[$i][2] + $data[$j][2];		//	sum of money those expansed in one day
						array_splice($data,$j,1);							//	deleting 
					}
					else{	
						$j++;	
					}
				}
			}
			return($data);
		}
	}
//----------------------------------------------------------------------------------------------------------------------------
	function find_all($data,$item){
		$dd = count_transactions_money($data,$item);
		if ($data!=null) {
			for ($i=0; $i < count($dd) ; $i++) { 
				$dat[$i] = $dd[$i][$item];
			}
			return $dat;
		}
	}
//------------------------------------------------------------------------------------------------------------------------------
	function totle($data,$item){
		$it = find_all($data,$item);
		for ($i=0; $i < count($it); $i++) { 
			$amount[$it[$i]]=0;
		}
		for ($i=0; $i < count($data); $i++) { 
			// $amount[$data[$i][$item]]=0;
			$amount[$data[$i][$item]] =$amount[$data[$i][$item]] + $data[$i][2];
		}
		return $amount;
	}
	// $data = getMonthlyData(06);
	// echo "<pre>";
	// print_r($data);
	// print_r(totle($data,5));
//------------------------------------------------------------------------------------------------------------------------------
	function amountAccordingDateType($data){
		// $income = [ 'Salary','Sold Items','Coupons','Pocket Money' ];
		// $expanse =['Food And Dining','Shopping','Travelling','Entertainment','Medical','Personal Care','Education','Bills And Utilities','Investments','Rent','Texes','Insurance','Gifts And Donation'];
		
		for ($i=0; $i < count($data); $i++) { 
			if (!isset($amount[$data[$i]['date']][$data[$i]['type']])) {
				$amount[$data[$i]['date']][$data[$i]['type']]=$data[$i]['amount'];
			}
			else{
				$amount[$data[$i]['date']][$data[$i]['type']]=$amount[$data[$i]['date']][$data[$i]['type']]+$data[$i]['amount'];
			}
		}
		return $amount;
	}
	//-------------------------------------------------------------------------------------------------------------------------
	function getDataPoints($data,$item)
	{	
		$label = find_all($data,$item);
		$amount = count_transactions_money($data,$item);
		$i=0;
		if ($data!=null) {
			while($i<count($label)){
				$dataPoints1[$i] = array("label" => $label[$i], "y" => $amount[$i][2]); 
				$i++;
			}
			return $dataPoints1;
		}
	}
//----------------------------------------------------------------------------------------------------------------------------
?>