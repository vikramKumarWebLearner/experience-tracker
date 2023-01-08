<?php  
 session_start();
 error_reporting(0);
 include('include/dbconn.php');
 $id = $_SESSION['id'];
 if (strlen($_SESSION['id']) == 0) {
  header('location:logout.php');
 }
 else{
      if(isset($_POST['submit'])){
        $userid=$id;
        $monthlyBudget=$_POST['monthlyBudget'];
        $query=mysqli_query($conn,"update users set monthlyBudget='$monthlyBudget' where id='$userid'");
      
        if($query){
              $_SESSION['monthlyBudget'] = $monthlyBudget;
          header('location:dashboard.php');
        }
      }
      
      
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/addCategory.css">
  

   
</head>

<body>
 

    <div class="center">
        <h1 class="form-head">Add Monthly Monthly Budget</h1>
        <form class="" action="" method="post">
          <div class="txt_field">
            <input type="numb" name="monthlyBudget" value="" required>
            <span></span>
            <label for="">Monthly Budget Money</label>
          </div>
          
          <input type="submit" name="submit" value="Add" style="margin-bottom: 10px;">
          <center><h3><a href="dashboard.php">Cancel</a></h3></center>
        </form>
      </div>
</body>

</html>