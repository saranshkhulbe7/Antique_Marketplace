<?php
include("../templates/database_conn.php");
include("../templates/functions.php");
$uid=$_SESSION['USER_ID'];
if ($_SESSION['USER_LOGIN']!='yes' or $_SESSION['USER_ID']=="")
{
   header("location:user_logout.php");
}
$sql1="SELECT * FROM `customers` WHERE cust_id ='$uid'";
$res=mysqli_query($con,$sql1);
$urow = mysqli_fetch_array($res, MYSQLI_ASSOC);
$errpass='';$errphone='';$errbal="";
$user_balance=$urow['cust_balance'];
$user_addr=$urow['cust_addr'];
$phone=$urow['cust_phone'];

if(isset($_POST['submit'])){
    $password=getsafe($con,$_POST['password']);
    if($password != $urow['cust_pass']) $errpass="password incorrect";
    else{
        $user_addr=getsafe($con,$_POST['user_addr']);
        $user_balance=getsafe($con,$_POST['user_balance']);
        if($user_balance<100)$errbal="Balance is minimum 100";
        $user_phone=getsafe($con,$_POST['user_phone']);
        if($user_phone<1000000000)$errphone="enter 10 digit mobile number";

        if($errbal=='' && $errphone=='')
        {
            echo $sql2="UPDATE `customers` SET `cust_addr`='$user_addr',`cust_phone`='$user_phone',`cust_balance`='$user_balance' WHERE `cust_id`='$uid'";
            if(mysqli_query($con,$sql2)){
                header("location:user_home.php");
            }
            else{
                echo mysqli_error($con);
            }


        }
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
    <script type="text/javascript">
        function myFunction() {
        var x = document.getElementById("mypass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
    <title> User onboarding</title>
</head>
<body>
<nav class="black z-depth-0">
		<div class ="container">
			<a href="user_home.php" class="brand-logo brand-text">Collectors Marketplace</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
				<!-- <li><a href="login.php" class="btn brand z-depth-0">Login here</a></li> -->
                <li><a href="user_logout.php" class="btn brand z-depth-0">Logout</a></li>
			</ul>
		</div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius:30px; padding:10px;">
        Edit Details
        </h4>

<!-- <h1 class="center white-text"><?php echo $message;?></h1> -->
 <form class="white" method="POST" enctype="multipart/form-data">
     
     <label style="font-size:18px; color:black;">Set new Balance(demo purpose ideally we would link to a bank account)</label>
     <input type="number" name="user_balance" value='<?php echo $user_balance?>' required min=10000>
     <div class="centre red-text"><?php echo $errbal; ?></div>

     <label style="font-size:18px; color:black;">Phone</label>
     <input type="number" name="user_phone" value='<?php echo $phone?>' required>
     <div class="centre red-text"><?php echo $errphone ?></div>

     <label style="font-size:18px; color:black;">Address</label>
     <input type="text" name="user_addr" value='<?php echo $user_addr?>' required>

     <label style="font-size:18px; color:black;">Enter Password to verify</label>
     <input type="password" name="password" value='' required id="mypass">
     <div class="centre red-text"><?php echo $errpass ?></div>
     <p>
      <label>
        <input type="checkbox" onclick="myFunction();"/>
        <span>Show Password</span>
      </label>
    </p>

     <br>

     <div class="center">
         <input type="submit" name="submit" value="Update values" class="btn brand z-depth-0" style="background-color:black;"></input>
     </div>
     
 </form>
</section>
</body>
</html>