<?php
    session_start();
    error_reporting(0);
    $id=$_SESSION['id'];
    $types = ['expense','income','borrow','lend'];
    for ($i=0; $i < 4; $i++) {   
        if(isset($_POST[$types[$i]])){
            $showCategory = $_POST[$types[$i]];
            $type = $types[$i];
            $_SESSION['type'] = $type;
            $_SESSION['category'] = $showCategory;
            break;
        } 
        else{
            $showCategory = 'Food And Dining';
            $type = 'expense';
        }
    }
    if (strlen($_SESSION['id']) == 0) {
        header('location:logout.php');
    } 
    else{
        include 'myFunctions.php';
        if (isset($_POST['submit'])){
            $uid = $_SESSION['id'];
            // $uid = 0;
            $time = $_POST["time"];
            $date = $_POST["date"];
            $amount = $_POST["amount"];
            $type = $type;
            $category = $showCategory;
            $note = $_POST["note"];
            insertReminder($date,$amount,$type,$category,$time,$note,$uid);
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!--  <link href="https://fonts.googleapis.com/css2?family=Charis+SIL:wght@700&family=Merriweather&family=Open+Sans&family=Roboto+Slab&display=swap" rel="stylesheet"> -->
    <link href="css/googleFonts.css" rel="stylesheet">
   <title>Prectice2</title>
  <link rel="stylesheet" href="css/addCategory.css">
</head>

<body>
    <div class="center" style="width: 500px;">
        <h2 class="form-head">Add Reminder</h2> 
        <form method="post">
            <div>
                <div style="display: flex;">
                    <form>
                    </form>
                    <?php 
                        // include 'myFunctions.php';
                        $types = ['expense','income','borrow','lend'];
                        $locations = ['allExpenseCategorys.php','allIncomeCategorys.php','allborrowCategorys.php','allLendCategorys.php'];
                        for ($j=0; $j < count($types); $j++) { 
                            echo '
                                <div class="dropdown" >
                                    <p style="margin: 10px;">'.$types[$j].'</p>
                                    <div class="dropdown-content">
                                ';
                        
                            $category = getCategory($types[$j]);
                            // echo '<pre>';
                            // print_r($category);
                            if ($category != null) {
                                echo '<form method="post">';
                                for ($i=0; $i < count($category); $i++) {
                                    echo '
                                            <button type="submit" name="'.$types[$j].'" style="width: 100%; height:30px; margin: 0px; padding: 0px;" value="'.$category[$i][2].'">'.$category[$i][2].'
                                            </button> 
                                        ';
                                }
                                echo '</form>';
                            }
                            echo '
                                        <h3>
                                            <a href="'.$locations[$j].'">Add '.$types[$j].'</a>
                                        </h3>
                                    </div>
                                </div>
                                ';
                        }
                    ?>
                </div>
                <div style="height: 0px; margin-top: 10px;">
                    <h3 class="txt_field" id="category"></h3>
                </div>
                <div class="txt_field" style="display: flex;">
                    <div style="width: 40%; margin-right:15%; background-color: #f5f5f5;">
                        <input id="date" type="date" name="date" />
                    </div>
                    <div style="width: 40%; margin-left: 15%; background-color: #f5f5f5;">
                        <input id="time" type="time" name="time" />
                    </div>
                </div>
                
                <div class="txt_field">
                    <input id="amount" type="numb" name="amount" required />
                    <label>Amount</label>
                </div>
                <div class="txt_field">
                    <input id="note" type="text" name="note" />
                    <label>Note</label>
                </div>
                <input type="submit" name="submit" value="Add" style="margin-bottom: 10px;" />
                <center><h3><a href="dashboard.php">Cancel</a></h3></center>
            </div>
        </form>
    </div>
    <?php
        date_default_timezone_set("Asia/Kolkata");
        $dateTime = date('Y-m-d h:i:s');
        $date = date('Y-m-d');
        $time = date('h i s');
    ?>

    <script type="text/javascript">
        var date = new Date();
        var currentDate = date.toISOString().slice(0, 10);
        document.getElementById('time').value = '<?php echo $time; ?>';
        document.getElementById('date').value = '<?php echo $date; ?>';
        document.getElementById('category').innerHTML = '<?php echo $showCategory;?>';
    </script>

</body></html>