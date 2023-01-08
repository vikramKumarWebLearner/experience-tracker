<?php 
    session_start();
    error_reporting(0);
    $userId = $_SESSION['id'];
    if (strlen($userId) == 0) {
        header('location:logout.php');
    }
    include 'include/dbconn.php';
    if (isset($_POST['delete'])) {
        // echo 'deleted'.$_POST['delete'];
        $qurry = 'DELETE FROM `expense` WHERE `id` = '.$_POST['delete'];
        mysqli_query($conn, $qurry);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Charis+SIL:wght@700&family=Merriweather&family=Open+Sans&family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/allItems.css">
</head>

<body>   
<center>
    <div class="col-lg-6 dashboard-card-container">
        <div class="dashboard-card">
            <a href="addTransaction.php">Back</a>
            <h5>Expense Category</h5>
            <div id="recent">
                <?php 
                    include 'myFunctions.php';
                    $category = getCategory('expense');
                    if ($category != null) {
                        for ($i=0; $i < count($category); $i++) {
                            if ($i < 13 ) {
                                echo '
                                    <div class="transaction-row transaction-row-odd"> 
                                        <h4>'.$category[$i][2].'</h4>
                                    </div>
                                    ';
                            }
                            else{
                                echo '
                                    <div class="transaction-row transaction-row-odd"> 
                                        <h4>'.$category[$i][2].'</h4>
                                        <div class="transaction-wallet" > 
                                            <form method="post"> 
                                                <button type="submit" name="delete" style="border:0; background:none;" value="'.$category[$i][0].'"> 
                                                    <img height="15px" width="15px" src="images/icons/delete.png">
                                                </button> 
                                            </form>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                    }
                ?>
            </div>


             <div class="transaction-row" style="margin-top: 30px;">
                <a href="addExpense.php" class="add-transaction-btn">+</a>    
            </div>
        </div>
    </div>
</center>
</body>

</html>