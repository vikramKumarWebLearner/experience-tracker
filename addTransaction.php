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
            $wallet = $_POST["wallet"];
            $date = $_POST["date"];
            $amount = $_POST["amount"];
            $type = $_SESSION['type'];
            $category = $_SESSION['category'];
            $note = $_POST["note"];
            $Msg = insertTransaction($uid,$date,$amount,$type,$category,$wallet,$note);
            $_SESSION['type'] = 'expense';
            $_SESSION['category'] = 'Food And Dining';
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/googleFonts.css" rel="stylesheet">

  <link rel="stylesheet" href="css/addCategory.css">
</head>

<body>
    <div class="center" style="width: 500px;">
        <h2 class="form-head">Add Transaction</h2> 
        <form method="post">
            <div>
                <div style="display: flex;">
                    <form></form>
                <?php 
                    $types = ['expense','income','borrow','lend'];
                    $locations = ['allExpenseCategorys.php','allIncomeCategorys.php','allBorrowCategorys.php','allLendCategorys.php'];
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
                            for ($i=0; $i < count($category); $i++) {
                                echo '
                                    <form method="post">
                                        <button type="submit" name="'.$types[$j].'" style="width: 100%; height:30px; margin: 0px; padding: 0px;" value="'.$category[$i][2].'">'.$category[$i][2].'
                                        </button> 
                                    </form>
                                    ';
                            }
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
                <div style="height: 40px;">
                    <h3 id="category" style="float: left;"></h3>
                    <select name="wallet" style="float: right; margin-top: 20px; border: 0;">
                        <option id="Case">Cash</option>
                        <option id="Paytm">PAYTM</option>
                        <option id="AmazonPay">Amazon Pay</option>
                        <option id="GooglePay">Google Pay</option>
                    </select>
                </div>
                <div class="txt_field">
                    <input id="date" type="date" name="date" required />
                </div>
                <div class="txt_field">
                    <input id="amount" type="numb" name="amount" required />
                    <label>Amount</label>
                </div><p id="transactionError" style="color:red;"></p>
                <div class="txt_field">
                    <input type="text" name="note" />
                    <label>Note</label>
                </div>
                <input type="submit" name="submit" value="Add" style="margin-bottom: 10px;" />
                <center><h3><a href="dashboard.php">Cancel</a></h3></center>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        var date = new Date();
        var currentDate = date.toISOString().slice(0, 10);
        document.getElementById('date').value = currentDate;
        document.getElementById('category').innerHTML = '<?php echo $showCategory;?>';
        <?php 
            if ($Msg == 1) {
                echo '
                        document.getElementById("transactionError").style.color = "green";
                    ';
                $Msg = 'Data  Successfully  Insert  !';
            }
        ?>
        document.getElementById('transactionError').innerHTML = "<?php echo $Msg; ?>";
    </script>

</body></html>