<?php
session_start();
error_reporting(0);
include('include/dbconn.php');
$id = $_SESSION['id'];
if (strlen($id)==0) {
    header('location:logout.php');
}
// include('addReminder.php');
include 'myFunctions.php';

$query = mysqli_query($conn, "select Name from users where Id='$id'");
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
            <link href="css/googleFonts.css" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <script src="JS/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="JS/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        <!-- Bootstrap -->
            <script src="JS/ChartJS.lib.js"></script>
        <script src="JS/show.js"></script>
        <title>Dashboard</title>
        <style>
            body {
                font-family: "open sans", sans-serif;
                margin-top: 0px;
                margin-left: 0px;
                margin-right: 0px;
            background-color:#EAEAEA ;

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
                height: 285px;
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

            .transaction-row p {
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

            .add-transaction-btn {
                height: 40px;
                width: 40px;
                border-radius: 1000px;
                position: absolute;
                right: 4px;
                background-color: #FFEB59;
                border: #FFEB59;
                font-size: 2em;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .analysis-card {
                height: 240px;
                width: 100%;
                display: block;
                justify-content: center;
                align-items: center;
            }

            .display-analysis {
                height: 100%;
                width: 100%;
            }

            .budget-progress-info {
                display: inline-block;
                background-color: #DBE2EF;
                width: 100%;
                padding: 8px;
                border-radius: 8px;
                height: auto;
            }

            .wallet-balance {
                display: inline-block;
                width: 40%;
                margin: auto;
                padding: 8px;

            }

            .budget-wallet-container {
                position: relative;
                display: flex;
                height: 65%;
                margin-top: 15px;
                align-items: stretch;
            }

            .progress-container {
                background-color: rgb(192, 192, 192);
                width: 100%;
                border-radius: 15px;
                margin-top: 20px;
            }

            .budget-progress {
                background-color: #52C237;
                color: white;
                padding: 8px;
                text-align: right;
                font-size: 20px;
                border-radius: 15px;
                width: 50%;
            }

            .reminder-row {
                height: 35%;
            }

            .add-reminder-btn-row {
                bottom: 8px;
                position: absolute;
                right: 16px;
            }
            #addReminder{
                margin-top: -3px;
                margin-right: 8px;
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

            <!------------------------  Transaction      -------------------------------------------------------------->
            <div class="row dashboard-card-row">
                <div class="col-lg-6 col-md-6 dashboard-card-container">
                    <div class="dashboard-card">
                        <h5>Transactions</h5>
                        <a href="alltransaction.php">View All</a>
                        <div id="recent">
                        <?php 
                            $month = date('m');
                            $data=getMonthlyData( $month );
                            if ($data==null) {
                                echo '
                                    <center>
                                        <img height="140px" width="140px" src="images/no transactions.png">
                                        <h4>No Transactions</h4>
                                    </center>
                                    ';
                            }
                            else{
                                for ($i=count($data)-1; $i >= 0; $i--) {
                                    if(count($data)-5==$i)
                                        break;
                                    if ($i % 2 == 0) {
                                        $c = 'odd';
                                    }else{
                                        $c = 'even';
                                    }
                                    if($data[$i][3]=='borrow' || $data[$i][3]=='lend'){
                                        $icon = $data[$i]['type'];
                                    }else{
                                        $icon = $data[$i]['category'];
                                    }
                                    echo '<div style="display:flex;">
                                    <img height="40px" width="40px" src="images/category/'.$icon.'.png"> 
                                        <div class="transaction-row transaction-row-'.$c.'" style="width:100%;">
                                            <p><b>'.$data[$i]['amount'].'₹&emsp;</b></p> 
                                            <p class="transaction-date">'.$data[$i]['date'].'</p> 
                                            <p class="transaction-category">Note : '.$data[$i]['note'].'</p> 
                                            <div class="transaction-wallet"> 
                                                <img height="20px" width="20px" src="images/icons/'.$data[$i]['wallet'].'.png"> 
                                            </div> 
                                        </div>
                                    </div>
                                    '; 
                                }
                            }
                        ?>
                        </div>
                        <div class="transaction-row" style="margin-bottom: 0;">
                            <a class="nav-link add-transaction-btn" href="addTransaction.php">+</a>
                        </div>
                    </div>
                </div>
                <!--------------------------    Monthly Analysis      ------------------------------------------------------->
                <div class="col-lg-6 col-md-6 dashboard-card-container" id="MonthlyAnalysis"> 
                    <div class="dashboard-card "> 
                        <h5>Monthly Analysis</h5> 
                        <a href="analysis.php">View Details</a>
                        <div id="myChart">
                            <?php
                                // include "show.php";
                                $data = getMonthlyData(date('m'));
                                if (isset($data)) {
                                    $item = 4;      //  0 ='id';    1 = 'date'; 2 = 'amount';   3 = 'type'; 4 = 'category'; 5 = 'note'; 6 = 'paymentMode';
                                    $dataPoints1 = getDataPoints($data,$item);
                                    echo '
                                        <script type="text/javascript"> 
                                            var dataPoints1 = '. json_encode($dataPoints1, JSON_NUMERIC_CHECK).'; 
                                            var dataSeries1 ={
                                                name :"Amount", 
                                                type :"doughnut", 
                                                dataPoints:dataPoints1 
                                            }; 
                                            var data = [dataSeries1]; 
                                            mychart(220,id ="myChart"); 
                                        </script>';
                                }
                                else{
                                    echo '
                                        <center>
                                            <img height="140px" width="140px" src="images/no transactions.png">
                                            <h4>No Transactions</h4>
                                        </center>
                                        ';
                                }
                            ?>
                        </div>
                    </div> 
                </div>        
                <!---------------   Monthly Budget    ---------------------------------------------------------------->
                <?php 
                    $userInformation = getUserInformation();
                    $budget = $userInformation['budget'];
                    $monthlyBudget = $userInformation['monthlyBudget']; 
                ?>     
                <div class="col-lg-6 col-md-6 dashboard-card-container">
                    <div class="dashboard-card">
                        <div class="card-top">
                            <h5>Monthly Budget</h5>
                            <a href="addbudgetForm.php">Edit Budget</a>
                        </div>
                        <p id="budget-amt"><?php echo $monthlyBudget; ?> ₹</p>
                        <div class="budget-wallet-container">
                            <div class="budget-progress-info">
                                <?php 
                                    if($budget != null){
                                        if ($monthlyBudget != null) {
                                            $review="";
                                            $data = getMonthlyData(date('m'));
                                            if(isset($data)){
                                                $amount = totle($data,3);
                                                $expense = $amount['expense'];
                                                $cross = 0;    // It is an indicator used to store the day of the month when monthly expenses will exceed the monthly budget.
                                                $crossAmount = $expanse; 
                                                $preDayExpense = $expense / date('d');
                                                for ($i=date('d'); $i <= date('t'); $i++) { 
                                                    $crossAmount = $crossAmount +$preDayExpense ;
                                                    if ($crossAmount >= $monthlyBudget) {
                                                        $cross = $i;
                                                        break;
                                                    }
                                                }
                                                echo '<p>Available Budget : '. $budget.'    ₹</p>';
                                                    $budgetLeftPer = ($expense/$monthlyBudget)*100;
                                                    if($budgetLeftPer >= 100){
                                                        $budgetLeftPer = 100;
                                                        $review="You have already crossed your Limit by  ₹  ".($expense-$monthlyBudget);
                                                        $color = "red";
                                                    }elseif ($cross <= date('t') && $cross > 0 ) {
                                                        $review = "<b>! WARNING !</b> If you continue spending at this rate, you will <b>exceed </b>the limit on <b>".$cross."th</b> of this month.";
                                                        $color = "orange";
                                                    }else{
                                                        $review = "You are ₹  ".($monthlyBudget-$expense)." under the Limit.";
                                                        $color = "green";
                                                    }

                                                echo '
                                                    <div class="progress-container">
                                                        <div class="budget-progress" style="width:'.$budgetLeftPer.'%; background-color:'.$color.';">
                                                        </div>
                                                    </div><br>
                                                    <p style="color: '.$color.';">'. $review.'</p>'; 
                                            }
                                            else{
                                                // echo '<h2>Add Transactions to view budget !</h2>';
                                                echo '<p>Available Budget : '. $budget.'    ₹</p>';
                                                echo '<div class="progress-container">
                                                <div class="budget-progress" id="budgetProgress"></div>
                                            </div><script>
                                            document.getElementById("budgetProgress").style.width ="0%";</script>
                                            <p style="color:'.$color.';">'. $review.'</p>';
                                            }
                                        }else{
                                            echo '<p>Available Budget : '. $budget.'    ₹</p>';
                                            echo '<div class="progress-container">
                                                    <div class="budget-progress" style="width:0%;">
                                                    </div>
                                                </div><br>
                                                <p style="color: ;">Monthly Budget not set !</p>';
                                        }
                                   }
                                   else{
                                        echo '<p>Available Budget :  0   ₹</p>';
                                        echo '
                                            <div class="progress-container">
                                                <div class="budget-progress" style="width:0%;">
                                                </div>
                                            </div><br>
                                            <p style="color: ;">Monthly Budget not set !</p>';

                                   }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!---------------   Upcoming Reminders  ------------------------------------------------------------------>
                <div class="col-lg-6 col-md-6 dashboard-card-container">
                    <div class="dashboard-card">
                        <h5>Upcoming Reminders</h5>
                        <a href="reminders.php">View All</a>
                        <?php   
                            $row = getRemainder();
                            if (isset($row)) {
                                for($i=0; $i<count($row); $i++){
                                    if($i==2){
                                        break;
                                    }
                                    echo ' 
                                        <div class="transaction-row transaction-row-odd reminder-row"> 
                                            <p>₹'.$row[$i]['amount'].'&emsp;  '.$row[$i]['category'].'</p> 
                                            <p class="transaction-date" id="date">'.$row[$i]['date'].'</p> 

                                            
                                                <form class="delete-btn" method="post" style="display: inline-block; position: absolute; left: 4px; bottom: 0;"> 
                                                    <button type="submit"  name="delete" style="border: 0; background: none; " value="'.$row[$i]['id'].'"> 
                                                        <img height="15px" width="15px" src="images/icons/delete.png"> 
                                                    </button> 
                                                </form>
                                            <div class="transaction-wallet"> 
                                                <p>
                                                    By Wallet
                                                    <img height="20px" width="20px" src="images/alarm-clock.png">
                                                </p> 
                                            </div> 
                                        </div>
                                    ';
                                }
                            }
                            else{
                                echo '
                                    <center>
                                        <img height="75px" width="80px" src="images/reminder.png">
                                        <h4>No Reminders Set</h4>
                                        <p>Add a reminder to remind you for an expanse later or set recurring reminders for the recurring expenses.</p>
                                    </center>
                                    ';

                            }
                        ?>
                        <div class="transaction-row" style="margin-bottom: 0;">
                          <a href="addReminder2.php" style="color: lightskyblue;"><img id="addReminder" height="15px" width="15px" src="images/add-reminder.png">Add a reminder</a>
                        </div>
                    </div>
                </div>
            </div>
            <!------------------------------------------------------------------------------>
        </div>
    <script>

        document.getElementById('userIcon').innerHTML = "<?php echo substr($userName, 0, 1); ?>";

        document.getElementById('userName').innerHTML = "<?php echo $userName; ?>";
       
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
