<?php
 $conn = mysqli_connect('localhost', 'root', '', 'exam');
    
    $name_Err="";
    $mobile_Err="";
    $pass_Err="";
    $aadhar_Err="";
    $amount_Err="";
    $acnum="";
    $name="";
    $aadhar="";
    $dob="";
    $pwd="";
    $mobile="";
    $amount="";
    $min = 10000000000000; // 10^13
    $max = 99999999999999; // 10^14 - 1
    $acnum = rand($min, $max);
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //Account number Validation
        
        //Accountant name validation
        if(empty($_POST['user'])){
            $name_Err="Accountant Name must and should fill";
        }
        else{
            $ac_name=$_POST['user'];
            if(!preg_match("/^[a-zA-Z]*$/", $ac_name)){
                $name_Err="Only alphabets and whitespaces are allowed";
            }
            else if(strlen($ac_name) <5){
                $name_Err="Accountant name must and should contain above 4 characters.";
            }else{
                $name=$ac_name;
            }
            
        }
        //Aadhar number Validation
        if(empty($_POST['aad'])){
            $aadhar_Err="Aadhar Number is required";
        }
        else{
            $aadh=$_POST['aad'];
            if(!preg_match("/^[0-9]*$/", $aadh)){
                $aadhar_Err="Only integer values are allowed";
            }
            else if(strlen($aadh) !=12){
                $aadhar_Err="Aadhar number must and should contain 12 digits.";
            }
            else{
                $aadhar=$aadh;
            }
        }
        //Mobilenumber Validation
         if(empty($_POST['mob'])){
            $mobile_Err="Mobile Number is required";
        }
        else{
            $mobilenum=$_POST['mob'];
            if(!preg_match("/^[0-9]*$/", $mobilenum)){
                $mobile_Err="Only integer values are allowed";
            }
            else if(strlen($mobilenum) !=10){
                $mobile_Err="Mobile number must and should contain 10 digits.";
            }
            else{
                $mobile=$mobilenum;
            }
        }
    
       //Password Validation
        if(empty($_POST['pass'])){
            $pass_Err="Accountant Name must and should fill";
        }
        else{
            $ac_pass=$_POST['pass'];
            if(!preg_match("/[A-Z]/", $ac_pass)){
                $pass_Err="Password must contain at least one uppercase letter.";
            }
            else if(!preg_match("/[a-z]/", $ac_pass)){
                $pass_Err="Password must contain at least one lowercase letter.";
            }
            else if (!preg_match('/[0-9]/', $ac_pass)) {
                $pass_Err="Password must contain at least one digit.";
            }
            else if (!preg_match('/[^A-Za-z0-9]/', $ac_pass)) {
                $pass_Err="Password must contain at least one special character.";
            }
            else if(strlen($ac_pass) <8 ){
                $pass_Err="Password must and should contain 8 characters.";
            }else{
                $pwd=$ac_pass;
            }
            
        }
        //Amount Validation
        if(empty($_POST['amo'])){
            $amount_Err="Amount is required";
        }
        else{
            $tot_amount=$_POST['amo'];
            if(!preg_match("/^[0-9]*$/", $tot_amount)){
                $amount_Err="Only integer values are allowed";
            }
            else{
                $amount=$tot_amount;
            }
        }
        $dob=$_POST['dob'];
        $pswd=md5($pwd);
        if(empty($pass_Err) && empty($name_Err) && empty($mobile_Err) && empty($aadhar_Err) && empty($amount_Err)){
           
            $sql="INSERT INTO `bank`(`ac_num`,`ac_name`, `aadhar`, `dob`, `mobile`,`password`, `amount`) VALUES ('$acnum','$name','$aadhar','$dob','$mobile','$pswd','$amount')";
            if(mysqli_query($conn, $sql)){
                echo "Records Inserted succesfully";
                header('location:login.php');
            }else{
                echo "Something fishy";
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body style="background-image: url('pics/log.jpg'); background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <p class="h1 text-center mb-5 mt-3" style="color:white; text-decoration: underline;">USER REGISTRATION FORM</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" class="p-3 rounded-4 w-50 text-white" style="margin-left: 600px; font-weight: 700;">
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="user" class="col-form-label">Accountant Name :</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="user" class="form-control" name="user">
                  <span class="error"><?php echo $name_Err; ?></span>
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="aad" class="col-form-label">Aadhar Number:</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="aad" class="form-control" name="aad">
                  <span class="error"><?php echo $aadhar_Err; ?></span>
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="dob" class="col-form-label">Date of Birth:</label>
                </div>
                <div class="col-sm-8">
                  <input type="date" id="dob" class="form-control" name="dob" required>
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="mob" class="col-form-label">Mobile Number:</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="mob" class="form-control" name="mob">
                  <span class="error"><?php echo $mobile_Err; ?></span>
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="pass" class="col-form-label">Password:</label>
                </div>
                <div class="col-sm-8">
                  <input type="password" id="pass" class="form-control" name="pass">
                  <span class="error"><?php echo $pass_Err; ?></span>
                </div>
            </div>
            <div class="row g-3 mb-3 align-items-center">
                <div class="col-sm-4">
                    <label for="amo" class="col-form-label">Credit Amount :</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" id="amo" class="form-control" name="amo">
                  <span class="error"><?php echo $amount_Err; ?></span>
                </div>
            </div>
            <div class="row g-3 align-items-center">
                <div class="col-6 text-center">
                    <button type="submit" style="font-weight: 500; font-size: 24px; margin-left: 150px; padding-left: 60px; padding-right: 60px; background-color: aqua;" class="btn btn-primary mt-4 rounded-3" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

