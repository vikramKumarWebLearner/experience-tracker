<?php
session_start();
error_reporting(0);
//database file connect
include('include/dbconn.php');
if (isset($_POST['login'])) {
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $query=mysqli_query($conn,"select Id from users where Email='$email' && Password='$password'");
  $retrive=mysqli_fetch_array($query);
  if($retrive>0)
  {
    $_SESSION['id']=$retrive['Id'];
    header('location:dashboard.php');
  }
  else{
    $msg="Invalid Details.";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
      <link href="css/googleFonts.css" rel="stylesheet">

  <link rel="stylesheet" href="css/master.css">
</head>

<body>
  <div class="center">
    <h1 class="form-head">Log In</h1>
    <!-- error message show php file -->
    <p style="color:red; font-size:16px;"><?php if($msg) {echo $msg;} ?></p>
    <form class="" action="" method="post" name="login">
      <div class="txt_field">
        <input type="text" name="email" value="" required>
        <span></span>
        <label for="">Email-address</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" value="" required>
        <span></span>
        <label for="">Password</label>
      </div>
      <input type="submit" name="login" value="login">
      <div class="singup_link">
        Not a member? <a href="register.php">Signup</a>
      </div>
    </form>
  </div>

</body>

</html>
