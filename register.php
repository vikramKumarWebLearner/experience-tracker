<?php
session_start();
error_reporting(0);
include('include/dbconn.php');
if(isset($_POST['submit']))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $number=$_POST['number'];
  $password=md5($_POST['password']);
  $query=mysqli_query($conn,"select Email from users where Email='$email' ");
  $result=mysqli_fetch_array($query);
  $msg = 0;
  if($result>0)
  {
    $msg="This email associated with another account";
    $msgColor = 'red';
  }
  else {
    $query=mysqli_query($conn,"insert into users(Name,Email,MobileNumber,Password) value('$name','$email','$number','$password')");
    if ($query) {
      $msg="You have successfully registered";
      $msgColor = 'green';
      // header('location:login.php');
    }
    else {
        $msg="Something Went Wrong. Please try again";
    }
  }
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
   <!--  <link href="https://fonts.googleapis.com/css2?family=Charis+SIL:wght@700&family=Merriweather&family=Open+Sans&family=Roboto+Slab&display=swap" rel="stylesheet"> -->
    <link href="css/googleFonts.css" rel="stylesheet">
   
<link rel="stylesheet" href="css/master.css">
<!-- password match  krne ke javascript -->
<script type="text/javascript">
  function check(){
    if (document.singup.password.value!=document.singup.repetpassword.value) {
     alert('Password and Repeat Password field does not match');
     document.singup.repetpassword.focus();
     return false;
    }
    return true;
  }
</script>
  </head>
  <body>
    <div class="center">
      <h1 class="form-head">Sign Up</h1>
      <form class="" action="" name="singup" method="post" onsubmit="return check();" autocomplete="on">
      <!-- error msg ko show krega php me  -->
        <?php 
          if ($msg != 0) {
            echo '<p style="font-size:16px; color:'.$msgColor.'"> '.$msg.' </p>';
          }  
        ?>
        <div class="txt_field">
          <input type="text" name="name" value="" required>
            <span></span>
          <label for="">Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="email" value="" required>
            <span></span>
          <label for="">Email-address</label>
        </div>
        <div class="txt_field">
          <input type="numb" name="number" value="" maxlength="10"  required>
            <span></span>
          <label for="">Mobile-Number</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" value="" required>
          <span></span>
          <label for="">Password</label>
        </div>
        <div class="txt_field">
          <input type="password" name="repetpassword" value=""  required>
            <span></span>
          <label for="">Repeat Password</label>
        </div>
        <input type="submit" name="submit" value="Sign Up">
        <div class="singup_link">
          Already have an account? <a href="login.php">Login</a>
        </div>
      </form>
    </div>
    </body>
</html>
