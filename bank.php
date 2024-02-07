<?php
session_start();
// $ac_name = isset($_SESSION['ac_name']) ? $_SESSION['ac_name'] : 'Guest';
// $ac_num = isset($_SESSION['ac_num']) ? $_SESSION['ac_num'] : 'N/A';

if(isset($_GET['log'])) {
    session_destroy();
    // unset($_SESSION['']);
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        .well a{
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body style="background-image: url('pics/bank.jpg'); background-repeat: no-repeat; background-size: cover;">
    <h1 class="text-white my-4 text-center">Welcome to HDFC bank <?php echo $_SESSION['ac_name']; ?></h1> 
    <h2 class="text-white mb-5 text-center">Your Account number is <?php echo  $_SESSION['ac_num'];
    ?> </h2>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 well">
                <img src="pics/with.jpg" class="img img-responsive">
                <p><a class="btn btn-link bg-white rounded-0" style="padding-left: 69px; padding-right: 70px;" href="withdrawl.php" target="_blank">Cash Withdrawl</a></p>
            </div>
            <div class="col-sm-4 well">
                <img src="pics/depo.jpg" height="250px" class="img img-responsive">
                <p><a class="btn btn-link bg-white rounded-0" style="padding-left: 79px; padding-right: 79px;" href="deposit.php" target="_blank">Cash Deposit</a></p>
            </div>
            <div class="col-sm-4 well">
                <img src="pics/others.jpg" height="250px" width="250" class="img img-responsive" style="opacity: 0.7;">
                <p><a class="btn btn-link bg-white rounded-0" style="padding-left: 101px; padding-right: 100px; opacity: 0.7;" href="others.php" target="_blank">Others</a></p>
            </div>
        </div>
    </div>
    <a href="bank.php?log='1'" style="text-decoration:none;" name="logout"> Logout Here...</a>
</body>
</html>