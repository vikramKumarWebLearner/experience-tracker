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
        $qurry = 'DELETE FROM `borrow` WHERE `id` = '.$_POST['delete'];
        mysqli_query($conn, $qurry);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/googleFonts.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/allItems.css">
</head>

<body>   
<center>
    <div class="col-lg-6 dashboard-card-container">
        <div class="dashboard-card">
            <a href="addTransaction.php">Back</a>
            <h5>Borrow Category</h5>
            <div id="recent">
                <?php 
                    include 'myFunctions.php';
                    $category = getCategory('borrow');
                    if ($category != null) {
                        for ($i=0; $i < count($category); $i++) {
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
                ?>
            </div>

             <div class="transaction-row" style="margin-top: 30px;">
                <a href="addBorrow.php" class="add-transaction-btn">+</a>    
            </div>
        </div>
    </div>
</center>
</body>

</html>