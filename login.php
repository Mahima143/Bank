<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'exam');

if($_SERVER['REQUEST_METHOD']=="POST"){
  $mobilenum=$_POST['mob'];
  $acpassword=md5($_POST['pass']);
  echo $acpassword;
//   $hashpass=md5($acpassword);

   $sql=" select * from bank where mobile='$mobilenum' and password='$acpassword'";
   $result= mysqli_query($conn, $sql);
   if (!$result) {
    die("Error in SQL query: " . mysqli_error($conn));
}
   echo "Hello";
    if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_array($result);
        $_SESSION['mobile'] = $mobilenum;
        $_SESSION['password'] = $acpassword;
        $_SESSION['ac_num']=$row['ac_num'];
        $_SESSION['ac_name']=$row['ac_name'];
        echo $_SESSION['ac_name'];
        echo $_SESSION['ac_name'];
        header('location:bank.php');
    }else{
        echo "Enter correct credentials";
    }
    
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
        <p class="h1 text-center mb-5 mt-3 text-dark">Login Form</p>
        <form method="post" class="p-3 rounded-4 w-50 text-white" style="border:3px solid black; font-weight: 700; margin-left: 270px;">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="mob" class="col-form-label">Mobile Number :</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="mob" class="form-control" name="mob">
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="pass" class="col-form-label">Password :</label>
                </div>
                <div class="col-sm-8">
                  <input type="password" id="pass" class="form-control" name="pass">
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-6 text-center">
                    <button type="submit" style="font-weight: 500;  margin-left: 40px; padding-left: 160px; padding-right: 160px; background-color: black;" class="btn text-light mt-4 rounded-3" name="deposit">Login</button>
                </div>
            </div>
            <p class="text-white mt-4">New ? <a href="users.php" style="font-weight: 500; color: red;">Create Account</a></p>

        </form>
    </div>

    
</body>
</html>


