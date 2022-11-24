<?php
include("../templates/database_conn.php");
include("../templates/functions.php");
$errpass="";
$errorname="";
$message="";
$err_phone="";
$err_adhar="";
    $user_profile_pic='';
    $user_username='';
    $password='';
    $password2='';
    $user_addr='';
    $user_name='';
    $phone=0;
    $user_balance=0;
    $user_email='';
if(isset($_POST['submit'])){
    $user_username=getsafe($con,$_POST['user_username']);
    $password=getsafe($con,$_POST['password']);
    $password2=getsafe($con,$_POST['password2']);
    $user_addr=getsafe($con,$_POST['user_addr']);
    $user_name=getsafe($con,$_POST['user_name']);
    $phone=getsafe($con,$_POST['user_phone']);
    $user_balance=getsafe($con,$_POST['user_balance']);
    $user_email=getsafe($con,$_POST['user_email']);
    $user_profile_pic=$_FILES['user_profile_pic'];
     //print_r($seller_profile_pic);
     $picname=$user_profile_pic['name'];
     $pictemp=$user_profile_pic['tmp_name'];
     $picer=$user_profile_pic['error'];
     $k=explode('.',$picname);
     $ext= strtolower(end($k));
     $valids=array('png','jpg','jpeg');
     if (in_array($ext,$valids)){
         $finaldest='../templates/images/cust_dp/'.$picname;
         move_uploaded_file($pictemp,$finaldest);
     }


    $sql1="SELECT * FROM `customers` WHERE cust_username = '$user_username' ";
    $res1=mysqli_query($con,$sql1);
    $count=mysqli_num_rows($res1);
    if($count>0){
        $errorname="USERNAME IS TAKEN USE ANOTHER USER";
        // $sellerusername='';
    }

    
    if($password!=$password2)
    {
        $errpass="passwords dont match";
        $password=$password2='';
    }
    
    if ($phone<=1000000000){
        $err_phone="Enter valid 10 Digit Phone number";
    }
    if($errorname=="" && $errpass=="" && $err_phone==""){
        $sql2="INSERT INTO `customers`(`cust_username`,`cust_name`, `cust_pass`,`cust_image`,`cust_addr`, `cust_email`,`cust_phone`, `cust_balance`)
        VALUES ('$user_username','$user_name','$password','$finaldest','$user_addr','$user_email','$phone','$user_balance')";
        $res2=mysqli_query($con,$sql2);
        $message=" Your username is '$user_username' and you can now ";

    }
    
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        form{
			max-width: 800px;
			margin: 100px;
			padding: 20px;
		}
        body {
            background-image: url('../templates/images/bg_theme.jpg');
        }

    </style>
    <title> User onboarding</title>
</head>
<body>
<nav class="black z-depth-0">
		<div class ="container">
			<a href="#" class="brand-logo brand-text">Collectors Marketplace</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
				<li><a href="login.php" class="btn brand z-depth-0">Login here</a></li>
			</ul>
		</div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius:30px; padding:10px;">
        Sign up
        </h4>

<h1 class="center white-text"><?php echo $message;?><a href="login.php">login here</a></h1>
 <form class="white" method="POST" enctype="multipart/form-data">
     
     <label style="font-size:18px; color:black;">Username</label>
     <input type="text" name="user_username" value='<?php echo $user_username ?>' required>
     <div class="red-text"><?php echo $errorname ;?></div>
   
     <label style="font-size:18px; color:black;">Password</label>
     <input type="password" name="password" value='' required>

     <label style="font-size:18px; color:black;">Renter Password</label>
     <input type="password" name="password2" value='' required>
     <div class="red-text"><?php echo $errpass ;?></div>

     <label style="font-size:18px; color:black;">Name</label>
     <input type="text" name="user_name" value='<?php echo $user_name?>' required>

     <label style="font-size:18px; color:black;">Email Address</label>
     <input type="email" name="user_email" value='<?php echo $user_email?>' required>

     <label style="font-size:18px; color:black;">Starting Balance</label>
     <input type="number" name="user_balance" value='<?php echo $user_balance?>' min=10000 required>

     <label style="font-size:18px; color:black;">Phone</label>
     <input type="number" name="user_phone" value='<?php echo $phone?>' required>
     <DIV class="red-text"><?php echo $err_phone;?></DIV>

     <label style="font-size:18px; color:black;">Address</label>
     <input type="text" name="user_addr" value='<?php echo $user_addr?>' required>

     <label style="font-size:18px; color:black;">Profile Photo</label>
     <input type="file" name="user_profile_pic" value='' required>
     <br>

     <div class="center">
         <input type="submit" name="submit" value="Sign in as new user" class="btn brand z-depth-0" style="background-color:black;"></input>
     </div>
     
 </form>
</section>
</body>
</html>