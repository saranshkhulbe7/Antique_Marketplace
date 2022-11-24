<?php
include("../templates/database_conn.php");
include("../templates/functions.php");
$errpass="";
$errorname="";
$erradhar="";
$message="";
$errphone="";
    $seller_profile_pic='';
    $sellerusername='';
    $password='';
    $password2='';
    $seller_addr='';
    $seller_name='';
    $phone=0;
    $seller_aadhar=0;
    $seller_email='';
if(isset($_POST['submit'])){
    $sellerusername=getsafe($con,$_POST['sellerusername']);
    $password=getsafe($con,$_POST['password']);
    $password2=getsafe($con,$_POST['password2']);
    $seller_addr=getsafe($con,$_POST['seller_addr']);
    $seller_name=getsafe($con,$_POST['seller_name']);
    $phone=getsafe($con,$_POST['seller_phone']);
    $seller_aadhar=getsafe($con,$_POST['seller_aadhar']);
    $seller_email=getsafe($con,$_POST['seller_email']);
     $seller_profile_pic=$_FILES['seller_profile_pic'];
     //print_r($seller_profile_pic);
     $picname=$seller_profile_pic['name'];
     $pictemp=$seller_profile_pic['tmp_name'];
     $picer=$seller_profile_pic['error'];
     $k=explode('.',$picname);
     $ext= strtolower(end($k));
     $valids=array('png','jpg','jpeg');
     if (in_array($ext,$valids)){
         $finaldest='../templates/images/seller_dps/'.$picname;
         move_uploaded_file($pictemp,$finaldest);
     }


    $sql1="SELECT * FROM `sellers` WHERE seller_username = '$sellerusername' ";
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

    if ($seller_aadhar<=100000000000){
        $erradhar="Enter valid 12 Digit Aadhar number";
    }
    if ($phone<=1000000000){
        $errphone="Enter valid 10 Digit Phone number";
    }
   
    if($errorname=="" && $errpass=="" && $erradhar=="" && $errphone==""){
        $sql2="INSERT INTO `sellers`(`seller_username`, `seller_name`, `seller_pass`, `seller_img`, `seller_email`, `seller_phone`, `seller_addr`, `seller_aadhar`) 
        VALUES ('$sellerusername','$seller_name','$password','$finaldest','$seller_email','$phone','$seller_addr','$seller_aadhar')";
        $res2=mysqli_query($con,$sql2);
        $message=" Your username is '$sellerusername' and you can now login";

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
    <title>Seller onboarding</title>
</head>
<body>
<nav class="black z-depth-0">
		<div class ="container">
			<a href="seller_login.php" class="brand-logo brand-text">Collectors Marketplace</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
				<li><a href="seller_login.php" class="btn brand z-depth-0">Login here</a></li>
			</ul>
		</div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius:30px; padding:10px;">
        Sign up
        </h4>

<h1 class="center white-text"><?php echo $message;?></h1>
 <form class="white" method="POST" enctype="multipart/form-data">
     
     <label style="font-size:18px; color:black;">Seller_username</label>
     <input type="text" name="sellerusername" value='<?php echo $sellerusername ?>' required>
     <div class="red-text"><?php echo $errorname ;?></div>
   
     <label style="font-size:18px; color:black;">Password</label>
     <input type="password" name="password" value='' required>

     <label style="font-size:18px; color:black;">Renter Password</label>
     <input type="password" name="password2" value='' required>
     <div class="red-text"><?php echo $errpass ;?></div>

     <label style="font-size:18px; color:black;">Name</label>
     <input type="text" name="seller_name" value='<?php echo $seller_name?>' required>

     <label style="font-size:18px; color:black;">Email Address</label>
     <input type="email" name="seller_email" value='<?php echo $seller_email?>' required>

     <label style="font-size:18px; color:black;">AADHAR NUMBER</label>
     <input type="number" name="seller_aadhar" value='<?php echo $seller_aadhar?>' required>
     <div class="red-text"><?php echo $erradhar ;?></div>

     <label style="font-size:18px; color:black;">Phone</label>
     <input type="number" name="seller_phone" value='<?php echo $phone?>' required>
     <div class="red-text"><?php echo $errphone ;?></div>

     <label style="font-size:18px; color:black;">Address</label>
     <input type="text" name="seller_addr" value='<?php echo $seller_addr?>' required>

     <label style="font-size:18px; color:black;">Profile Photo</label>
     <input type="file" name="seller_profile_pic" value='' required>
     <br>

     <div class="center">
         <input type="submit" name="submit" value="Sign in as new seller" class="btn brand z-depth-0" style="background-color:black;"></input>
     </div>
     
 </form>
</section>
</body>
</html>