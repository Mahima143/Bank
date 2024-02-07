<?php
session_start();
if(isset($_GET['log'])) {
    session_destroy();
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-image: url('pics/deposit.png'); background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <p class="h1 text-center mb-5 mt-3 text-dark">Deposit Form</p>
        <form method="post" class="p-3 rounded-4 w-50 text-dark" style="border:3px solid black; font-weight: 700; margin-left: 270px;">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="acn" class="col-form-label">Account Number :</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="acn" class="form-control" name="acn" value="<?php echo  $_SESSION['ac_num'];
    ?>">
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="date" class="col-form-label">Date:</label>
                </div>
                <div class="col-sm-8">
                  <input type="date" id="date" class="form-control" name="tdat" value="<?php echo date('Y-m-d'); ?>">
                  <!-- <input type="date" id="date" class="form-control" name="dat"> -->
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="amo" class="col-form-label">Amount :</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="amo" class="form-control" name="amo">
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-sm-6 text-center">
                    <a href="bank.php" class="text-decoration-none text-center" name="logout"> Go Back to Home Page</a>
                </div>
                <div class="col-sm-6 text-center">
                    <button type="submit" style="background-color: aqua;" class="btn btn-primary fw-bold fs-3 rounded-3" name="deposit">Deposit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

<?php
    $conn = mysqli_connect('localhost','root','','exam');
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $acnum=$_POST['acn'];
        $dat=$_POST['tdat'];
        // echo $dat;
        $depos=$_POST['amo'];
        $sql="select * from bank where ac_num='$acnum'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)==1) {
            $row = mysqli_fetch_assoc($res);
            // echo $row['ac_num'];
            if($acnum==isset($row['ac_num']))
            {
               function deposit($depos){
                   global $row,$acnum,$conn,$dat;
                //    echo $dat;
                   $balance=$row['amount'];
                   if($depos>0){
                       $balance=$balance+$depos;
                       echo "<script> window.alert('Deposited Successfully'); </script>";
                       //echo "<p style='color:white;'> Amount Deposited Successfully.. Total balance $balance/-.</p>";
                       $deposit="UPDATE bank SET amount='$balance' WHERE ac_num='$acnum'";
                       mysqli_query($conn,$deposit);
                       $trans="INSERT INTO `transactions`(`account_num`, `date_of_transaction`,`amount`, `transaction_type`) VALUES ('$acnum','$dat','$depos','Credited')";
                       mysqli_query($conn,$trans);
                       //header('location:bank.php');
                   }
                   else{
                       echo "<p style='color:white;'>Something fishy</p>";
                   }
                }
            }
        }
       deposit($depos);
   }
?>