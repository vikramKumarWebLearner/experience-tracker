<?php 
    session_start();
    error_reporting(0);
    include('include/dbconn.php');
    include 'myFunctions.php';
    $id = $_SESSION['id'];

    if (strlen($id)==0) {
        header('location:logout.php');
    }

    $query = mysqli_query($conn, "select Name from users where Id='$id'");
    $retrive = mysqli_fetch_array($query);
    if ($retrive > 0) {
        $userName = $retrive['Name'];
    } else {
        $msg = "Invalid Details.";
    }
    $budget = 500;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/googleFonts.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <script src="JS/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="JS/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <title>Categories</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <script type="text/javascript" src="JS/ChartJS.lib.js"></script>
    <!-- <script type="text/javascript" src="JS/show.js"></script> -->
    <script type="text/javascript">
    function mychart(height,id) {
    //-------------------------------------------------------!    TOOL TIP   !------------------------------------------------
        var toolTip = {
            enabled:true,
            shared: true,                   // it allows you to show all data in one toolTip    
            borderColor:"black",
            borderThickness:1,
            cornerRadius:10,
            backgroundColor:"white",
            fontWeight:"bold",
            //fontColor:"red",
            fontSize:22,
            fontFamily:"serif"
        };
    //-------------------------------------------------------!    AXIS-X     !------------------------------------------------
    var axisX = {
        title:"Days (<?php echo date('F');?>)",
        minimum:0,
        // maximum:31,
        interval:1
    };
    //-------------------------------------------------------!    AXIS-Y     !------------------------------------------------
    var axisY = {
        title:"Amount",
        minimum:0,
        // maximum:<?php echo $budget;?>,
        // interval:500
    };
    //-------------------------------------------------------!   ANY VAR     !------------------------------------------------
        var Any_var = {
            // title,
            // width,
            axisX,
            axisY,
            height,
            // theme:"dark1",
            toolTip,
            // interactivityEnabled:false,
            animationEnabled:true,          // it allows you to show animation
            animationDuration:1500,
            data    //data also must be an array
        };
    //----------------------------------------------------!   FUNCTION ONCLICK  !---------------------------------------------
            var chart = new CanvasJS.Chart(id,Any_var);
            chart.render();
    //----------------------------------------------------!         END         !---------------------------------------------
    }
</script>
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
                <div class="dashboard-card" style="height: 600px;">
                    <div class="analysis-card" id="showChart"> 
                    <?php
                        $userInformation = getUserInformation();
                        $monthlyBudget = $userInformation['monthlyBudget'];
                        echo '
                            <script type="text/javascript">;
                            var dataSeries = {
                                name :"expexse", 
                                type :"line", 
                                dataPoints:[ ';
                        if (isset($_POST['month'])) {
                            $month = $_POST['month'];
                        }else{
                            $month = date('m');
                        }
                        $monthlydata = getMonthlyData($month);
                        if ($monthlydata) {                        
                            $dalyData = amountAccordingDateType($monthlydata);
                            $totle = totle($monthlydata,3);     // this function returns totle amount according to type 
                        }                                       //  here 3  is index number which indecats to Type;

                        $daysInCurrentMonth = date('t');
                        $currentDay = date('d');
                        $startExpense = 0;
//  To Find Average in a month  --------------------------------------------------------------//
                        $breakPoint = 0;    //  break point is a indecator which is used to indecats when we will crossed our 
                                            //  monthly budget limit.
                        $totleExpense = $totle['expense'];
                        for ($i=0; $i <= $daysInCurrentMonth ; $i++) { 
                            $preDayTransactionAmount = round(($totleExpense / $currentDay),2); 
                            $averageExpenseInMonth =  $preDayTransactionAmount * $daysInCurrentMonth;
                            // print_r($averageExpenseInMonth);
//--------------------------------------------------------------------------------------------//
//  To  Creat Data Points ------------------------------------------------------------------------------------------//
                            if ($i<10) {
                                $date = date('Y-m-0').$i;   
                            }else{
                                $date = date('Y-m-').$i;   
                            }
                            $preDayExpense = 0;
                            if ($dalyData[$date]['expense']) {
                                $preDayExpense = $dalyData[$date]['expense'];
                            }
                            elseif($i > $currentDay){
                                $preDayExpense = $preDayTransactionAmount;
                            }
                            $startExpense = $startExpense + $preDayExpense;
                            if ($monthlyBudget == null || $monthlyBudget == 0) {
                                $color = 'blue';
                                $indexLabel = '';
                                $lineColor = 'blue';
                                $lineDashType = 'dot';
                                $toolTipContent = '';
                                $indexLabelFontColor ='blue';
                                $markerType = '';
                                $markerColor = 'blue';    
                            }
                            elseif($breakPoint == 1){
                                $color = 'blue';
                                $indexLabel = '';
                                $lineColor = 'blue';
                                $lineDashType = 'dot';
                                $toolTipContent = '';
                                $indexLabelFontColor ='blue';
                                $markerType = '';
                                $markerColor = 'blue';
                            }
                            elseif ($startExpense >= $monthlyBudget && $breakPoint ==0) {
                                if ($i <= date('d')) {
                                    $color = 'red';
                                    $indexLabel = 'You have already crossed your Limit by ₹ '.$startExpense - $monthlyBudget;
                                    $lineColor = 'red';
                                    $lineDashType = 'dot';
                                    $toolTipContent = '';
                                    $indexLabelFontColor ='red';
                                    $markerType = 'cross';
                                    $markerColor = 'red';
                                }else{
                                    $color = 'orange';
                                    $indexLabel = 'You will cross your monthlyBudget limit at this point';
                                    $lineColor = 'blue';
                                    $lineDashType = 'dot';
                                    $toolTipContent = '! WARNING ! If you continue spending at this rate, you will <b>exceed </b>the limit('.$monthlyBudget.') on <b> {x} th</b> of this month.';
                                    $indexLabelFontColor ='orange';
                                    $markerType = 'triangle';
                                    $markerColor = 'orange';
                                }
                                $breakPoint = 1;
                            }
                            else{
                                if ($i < date('d')) {
                                    $color = 'green';
                                    $indexLabel = '';
                                    $lineColor = 'green';
                                    $lineDashType = '';
                                    $toolTipContent = '';
                                    $indexLabelFontColor ='green';
                                    $markerType = '';
                                    $markerColor = 'green';
                                }else{
                                    $color = 'blue';
                                    $indexLabel = '';
                                    $lineColor = 'blue';
                                    $lineDashType = 'dot';
                                    $toolTipContent = '';
                                    $indexLabelFontColor ='blue';
                                    $markerType = '';
                                    $markerColor = 'blue';
                                }
                            }
                             $dataPoint= array(
                                                'label' => $i , 
                                                'y' => $startExpense ,
                                                'color' => $color,
                                                'indexLabel' =>$indexLabel, 
                                                'lineColor' => $lineColor,
                                                'lineDashType' => $lineDashType, 
                                                'toolTipContent' => $toolTipContent ,
                                                'indexLabelFontColor' => $indexLabelFontColor,
                                                'markerType' => $markerType,
                                                'markerColor' => $markerColor
                                            );
                            $dataPoint = json_encode($dataPoint,JSON_NUMERIC_CHECK);
                            echo $dataPoint.',';
                            
                        }
                        echo '
                            ]}; 
                            var data = [dataSeries]; 
                            mychart(height=530,id ="showChart"); 
                        </script>';
                    ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('userIcon').innerHTML = "<?php echo substr($userName, 0, 1); ?>"

        document.getElementById('userName').innerHTML = "<?php echo $userName; ?>"
       
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