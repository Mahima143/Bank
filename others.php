
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
    <title>Balance Enquiry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-image: url('pics/bal.jpg'); background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <p class="h1 text-center mb-5 mt-3 text-dark">Check Balance</p>
        <form method="post" class="p-3 rounded-4 w-50 text-white" style="border:3px solid black; font-weight: 700; margin-left: 270px;">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="acn" class="col-form-label">Account Number :</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="acn" class="form-control" name="acn"  value="<?php echo  $_SESSION['ac_num'];
    ?>">
                </div>
            </div>
            <div class="row g-3 align-items-center">
            <div class="col-sm-6 text-center">
                    <a href="bank.php" class="text-decoration-none text-center" name="logout"> Go Back to Home Page</a>
                </div>
                <div class="col-sm-6 text-center">
                    <button type="submit" style="background-color: aqua;" class="btn btn-primary fw-bold fs-4 rounded-3" name="check">Check_Your_Balance</button>
                </div>
            </div>
        </form>
    </div>

    
</body>
</html>
<?php
    $conn = mysqli_connect('localhost', 'root', '', 'exam');
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $acnum=$_POST['acn'];
        $sql="select * from bank where ac_num='$acnum'";
        $res=mysqli_query($conn,$sql);
        if(mysqli_num_rows($res)==1) {
            $row = mysqli_fetch_assoc($res);
            if($acnum==isset($row['ac_num']))
            {
                $balance=$row['amount'];
                
                echo "<p style='color:black; font-weight:500;'> Your Account balance is $balance/-.</p>";
            }
            else{
                echo "Something fishy";
            }
                
        }
   }
?>