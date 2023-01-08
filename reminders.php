<?php
include('include/dbconn.php');
session_start();
error_reporting(0);
include('myFunctions.php');
include('addReminder.php');
if (strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
}
$userId = $_SESSION['id'];
$query = mysqli_query($conn, "select Name from users where Id='$userId'");
$retrive = mysqli_fetch_array($query);
if ($retrive > 0) {
    $userName = $retrive['Name'];
} else {
    $msg = "Invalid Details.";
}
?>
<?php   if (isset($_POST['delete'])) {
        $qurry = 'DELETE FROM reminders WHERE id ='. $_POST["delete"];
        mysqli_query($conn, $qurry);
    }?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Charis+SIL:wght@700&family=Merriweather&family=Open+Sans&family=Roboto+Slab&display=swap" rel="stylesheet"> -->
    <link href="css/googleFonts.css" rel="stylesheet">
    <!-- Font awesome -->
    <script src="JS/fontAwesomeKitConfig.js" crossorigin="anonymous"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <script src="JS/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="JS/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<title>Reminders</title>
    <style>
        body {
            font-family: "open sans", sans-serif;
            margin-top: 0px;
            margin-left: 0px;
            margin-right: 0px;
            background-color: #eaeaea;
        }

        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 3;
            top: 0;
            left: 0;
            width: 200px;
            background-color: #0C0C5A;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            padding-bottom: 10px;
            text-align: start;
        }

        .nav-link-container {
            margin-top: 50px;
            margin-left: 15px;

        }

        .nav-links {
            margin-top: 20px;
            margin-left: 16px;
            display: flex;
            align-items: center;
        }

        .nav-links img {
            height: 15px;
            width: 15px;
        }

        .sidebar a {
            padding-left: 8px;
            text-decoration: none;
            font-size: 1rem;
            color: #F9F7F7;
            text-align: left;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #0c0c5a;
            color: white;
            padding: 10px 15px;
            border: none;
            position: absolute;
            display: inline-block;
            margin: 14.5px 16px;
        }

        .openbtn:hover {
            background-color: #49618d;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
            padding-top: 0px;
            padding-left: 0px;
            padding-right: 0px;
            background-color: #EAEAEA;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidebar {
                padding-top: 15px;
            }

            .sidebar a {
                font-size: 18px;
            }
        }

        @media (min-width:992px) {
            .sidebar {
                width: 200px;
            }

            #main {
                margin-left: 200px;
            }

            .closebtn {
                display: none;

            }

            .openbtn {
                display: none;
            }


            @media (max-width:991px) {


                .openbtn {
                    height: 55px;
                    margin: 0;
                }
            }

        }


        .header {
            background-color: #0C0C5A;
            padding: 0 20px 0 0;
            position: fixed;
            width: 100%;
            z-index: 2;
        }

        .header img {
            height: 67px;
            width: 234px;
            display: block;
            margin: 0 200px 0 auto;
        }

        .nav-heading {
            margin-top: 0px;
            margin-bottom: 0px;
            display: block;
            padding: 24px 18px 24px 0;
            text-align: end;
            color: white;
        }

        .user-prof-back {
            height: 70px;
            width: 70px;
            border-radius: 1000px;
            background-color: #F9F7F7;
            margin: auto;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-prof-back h3 {
            font-family: 'open sans', 'sans-serif';
            font-size: 35px;
            color: #112D4E;
            font-weight: 400;

        }

        .user-name {
            text-align: center;
            font-size: 1.2rem;
            color: #F9F7F7;
            font-family: 'open sans', 'sans-serif';
            margin-block-start: 1em;
            margin-block-end: 1em;
        }


        /* Bootstrap row Modification */
        .dashboard-card-row {
            width: 100%;
            margin-left: 0;
            margin-right: 0;
            padding: 5px;
            padding-top: 50px;
        }

        .dashboard-card-container {
            padding: 5% 5% 0;
        }

        .dashboard-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 16px;
            position: relative;
        }

        .dashboard-card h5 {
            display: inline-block;
            font-size: 1.1rem;
        }

        .dashboard-card a {
            text-decoration: none;
            position: absolute;
            right: 16px;
        }

        .transaction-row {
            border-radius: 4px;
            padding: 0 8px 0 8px;
            position: relative;
            height: 40px;
            margin-bottom: 8px;

        }

        .transaction-row-odd {
            background-color: #DBE2EF;
        }

        .transaction-row-even {
            background-color: #F9F7F7;
        }

        .sortby {
            position: absolute;
            right: 16px;
            top: 16px;
        }

        .imp-upper-str .imp-upper-row {
            display: inline-block;
            font-size: 12px;
            margin-block-end: 0;

        }

        .transaction-row .transaction-date {
            position: absolute;
            right: 8px;
            top: 2.5px;
        }

        .transaction-row .transaction-category {
            position: absolute;
            left: 8px;
            bottom: 2.5px;
        }

        .transaction-row .transaction-wallet {
            position: absolute;
            right: 8px;
            bottom: 2.5px;
        }

        .transaction-wallet a {
            font-size: 0.8em;
            position: static;
            margin-left: 4px;
        }

        .add-transaction-btn {
            height: 40px;
            width: 40px;
            border-radius: 1000px;
            position: absolute;
            right: 16px;
            bottom: 16px;
            background-color: #FFEB59;
            border: #FFEB59;
            font-size: 2em;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .reminder-row {
            height: 100px;
        }

        .add-reminder-btn-row {
            bottom: 8px;
            position: absolute;
            right: 16px;
        }

        .imp-upper-str {
            font-size: 1.2rem;
            font-style: bold;
        }

        .imp-upper-row {

            font-size: 1.2rem;
            font-style: bold;
        }

        .progress-container {
            background-color: rgb(192, 192, 192);
            width: 100%;
            border-radius: 15px;
        }

        .budget-progress {
            background-color: #52C237;
            color: white;
            padding: 5px;
            text-align: right;
            font-size: 20px;
            border-radius: 15px;
            width: 50%;
        }
    </style>
</head>

<body>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" id="close-btn" class="closebtn" onclick="closeNav()">×</a>
        <div class="user-prof-back">
            <h3 id="userIcon"></h3>
        </div>
        <p id="userName" class="user-name"></p>

        <div class="nav-link-container">

            <div class="nav-links">
                <img src="images/icons/dashboards.png" height="20px" width="20px"><a href="dashboard.php">Dashboard</a>
            </div>
            <div class="nav-links">
                <img src="images/icons/rupee.png" height="20px" width="20px"><a href="alltransaction.php">All Transactions</a>
            </div>
            <div class="nav-links">
                <img src="images/icons/analytics.png" height="20px" width="20px"><a href="analysis.php">Analysis</a>
            </div>
            <div class="nav-links">
                <img src="images/icons/bell.png" height="20px" width="20px"><a href="reminders.php">Reminders</a>
            </div>
            <div class="nav-links">
                <img src="images/icons/budget.png" height="20px" width="20px"><a href="budgets.php">Budgets</a>
            </div>
            <div class="nav-links">
                <img src="images/icons/menu.png" height="20px" width="20px"><a href="categories.php">Categories</a>
            </div>
            <div class="nav-links">
                <img src="images/icons/user.png" height="20px" width="20px"><a href="user-profile.php">Edit Profile</a>
            </div>
            <div class="nav-links">
                <img src="images/icons/logout.png" height="20px" width="20px"><a href="logout.php">Log Out</a>
            </div>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <button id="open-btn" class="openbtn" onclick="openNav()">☰</button>

            <img id="logo" src="images/logo_main2.png">
            <!-- <h2 class="nav-heading">Collapsed Sidebar</h2> -->

        </div>
        



        <div class="row dashboard-card-row">

            <div class="col-lg-12 col-md-12 dashboard-card-container">
                <div class="dashboard-card">
                    <h5>Reminders</h5>
                    <?php   
                        // $userId=$id;
                        // $ret = mysqli_query($conn, "select * from reminders where UserId='$userId'");
                        // $row = mysqli_fetch_all($ret);
                        $row = getRemainder();
                        if (isset($row)) {
                            for($i=0; $i<count($row); $i++){
                            echo ' <div class="transaction-row transaction-row-odd reminder-row">
                                    <p>₹'.$row[$i][2] .'&emsp;  '.$row[$i][4].'</p>
                                    <p class="transaction-date" id="date">'.$row[$i][1].'</p>
                                    <p class="transaction-category"><form class="delete-btn" method="post" style="display: inline-block;  position: absolute;
                                    left: 4px;
                                    bottom: 0;""> <button type="submit" style="
                                    border: 0;
                                    background: none;
                                "  name="delete" value="'.$row[$i][0].'"> <img height="15px" width="15px" src="images/icons/delete.png"> </button> </form></p>
                                    <div class="transaction-wallet">
                                    <p>By Wallet<img height="20px" width="20px" src="images/alarm-clock.png"></p>

                                    </div>
                                </div>';      
                            }
                        }
                        else{
                            echo '
                                <center>
                                    <img height="80px" width="80px" src="images/reminder.png">
                                    <h3>No Reminders Set</h3>
                                    <p>Add a reminder to remind you for an expanse later or set recurring reminders for the recurring expenses.</p>
                                </center>   
                                ';
                        }
        
    ?>     
     <?php 
        /*  include('include/dbconn.php');
          function delete(){
        if(isset($_POST['check'])){
            // $query="DELETE FROM reminders WHERE $ReminderId='$id'";
            $ret = mysqli_query($conn, "select * from reminders where UserId='$userId'");
            $row = mysqli_fetch_all($ret);
          }
          if($row>0){
            $query="DELETE FROM reminders WHERE ReminderId='$id'";
          }   
        //   if(){}
    */
    
    
     ?> 

                    <div class="transaction-row" style="margin-top:30px;">
                        <a href="addReminder2.php" style="color: lightskyblue;"><img id="addReminder"style=" height: 40px; width:40px;" src="images/reminder1.png"></a>
                    </div>


                </div>
            </div>
            

        </div>
    </div>
    



    <script>
        document.getElementById('userIcon').innerHTML = "<?php echo substr($userName, 0, 1); ?>"
        document.getElementById('userName').innerHTML = "<?php echo $userName; ?>"
        
       // document.getElementById('amount').innerHTML=""
        //Need Explaination todo:

        function myFunction(x) {
            if (x.matches) { // If media query matches
                document.getElementById("mySidebar").style.width = "200px";
                document.getElementById("close-btn").style.display = "none";
                document.getElementById("main").style.marginLeft = "200px";
                document.getElementById("logo").style.removeProperty("height");
                document.getElementById("logo").style.removeProperty("width");
                document.getElementById("logo").style.marginRight = "200px";
                // document.getElementById("mySidebar").style.removeProperty("display");
            } else {
                // MOBILE PE
                document.getElementById("mySidebar").style.removeProperty("width");
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("open-btn").style.margin = "15px 15px";
                document.getElementById("logo").style.height = "55px";
                document.getElementById("logo").style.width = "193px";
                document.getElementById("logo").style.marginRight = "0";
                document.getElementById("open-btn").style.height = "55px";
                document.getElementById("open-btn").style.margin = "0px";
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
                document.getElementById("close-btn").style.removeProperty("display");
            }
        }

        var x = window.matchMedia("(min-width: 992px)")
        myFunction(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes


        function openNav() {
            document.getElementById("mySidebar").style.width = "200px";
            // document.getElementById("mySidebar").style.display = "block";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }
    </script>

</body>

</html>