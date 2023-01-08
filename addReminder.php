<?php
// session_start();
// error_reporting(0);
include('include/dbconn.php');
$id = $_SESSION['id'];
if (strlen($_SESSION['id']) == 0) {
    header('location:logout.php');
} 
else {
    if (isset($_POST['addReminder'])) {
        $userid = $id;
        $time = $_POST['date'];
        $amount = $_POST['amount'];
        $item = $_POST['item'];
        $note = $_POST['note'];
        // $time=$_POST['time'];
        $query = mysqli_query($conn, "insert into reminders (UserId,Time,Amount,Item,Note) values ('$userid','$time','$amount','$item','$note')");
   
        if ($query) {
            // $_SESSION['reminderid'] = $id;
            //header('location:dashboard.php');
        }
    }
    
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/googleFonts.css" rel="stylesheet">


    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- Bootstrap by VIVEK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--style.css  by VISHAL -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/style2.css"> -->
    <!------   ASHOK KUMAR   ----------------------------------------------------------------->
    <style type="text/css">
        body {
            margin: 0px;
        }

        .container {
            width: 400px;
            /*border: 1px solid black;*/
            padding: 10px;
        }

        select {
            font-size: 20px;
            text-align: center;
            color: blue;
        }

        .main {
            text-align: -webkit-center;
        }

        .row-1 {
            width: 380px;
            display: flex;
            margin: 0px;
        }

        .col-11 {
            text-align: left;
            width: 25%;
            border-radius: 10px;
        }

        .col-22 {
            text-align: left;
            width: 50%;
            margin: 10px;
        }

        .col-33 {
            text-align: left;
            width: 75%;
            margin: 10px;
        }

        .col-44 {
            text-align: left;
            width: 100%;
            margin: 10px;
        }

        .form-control-1 {
            width: 100%;
            border: 0px;
            height: 40px;
            border-radius: 5px;
        }

        #expanse {
            border-radius: 0px;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        #income {
            border-radius: 0px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .form-control:focus {}

        .paymentMode {
            text-decoration: none;
            margin: 5px;
            padding: 0px 10px;
            font-size: 18px;
            border-radius: 20px;
            border: 1px solid black;
            color: black;
        }

        .paymentMode:hover {
            /*color: #0056b3;*/
            color: black;
            background-color: lightgray;
            text-decoration: none;
        }
    </style>
    <!-- <script type="text/javascript" src="JS/type.js"></script> -->
    <!---------------------------------------------------------------------------------------->
</head>

<body>
    <form method="post">
        <div class="modal fade" id="reminderModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 450px;">
                <div class="modal-content">
                    <div class="modal-header"><h5 class="modal-title" id="transactionModalLabel">Add Reminder</h5></div>
                    <!--------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="main">
                        <div id="header" class="container" style="background-color: lightskyblue; padding-bottom: 25px;">
                            <div class="row-1">
                                <div class="col-44">
                                    <input id="date" class="form-control-1" type="datetime-local" name="date" required />
                                </div>
                            </div>
                            <div class="row-1">
                                <div class="col-44">
                                    <input id="amount" class="form-control-1" type="numb" name="amount" placeholder="Amount" required />
                                </div>
                            </div>
                        </div>
                        <div class="container" style="background-color:lightcyan ;">

                            <div class="row-1">
                                <div class="col-44">
                                    <input type="text" name="item" class="form-control-1" placeholder="Item">
                                </div>
                            </div>
                            <div class="row-1">
                                <div class="col-44">
                                    <input type="text" name="note" class="form-control-1" placeholder="Note">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--------------------------------------------------------------------------------------------------------------------------------------->
                    <div class="modal-footer">
                        <button type="reset" name="reset" value="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="addReminder" value="submit" class="btn btn-primary">Save </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
        <?php
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d h:i:s');
    ?>

<script type="text/javascript">
        var date = new Date();
        var currentDate = date.toISOString().slice(0, 10);
        document.getElementById('date').value = '<?php echo $date; ?>';
        document.getElementById('category').innerHTML = '<?php echo $showCategory;?>';
    </script>
</body>
</html>