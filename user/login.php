<?php
include("../templates/database_conn.php");
include("../templates/functions.php");
$msg="";

if (isset($_POST['submit'])){
    $username=getsafe($con,$_POST['username']);
    $cust_pass=getsafe($con,$_POST['password']);

$sql="SELECT * FROM `customers` WHERE cust_username ='$username' and cust_pass='$cust_pass'";
$res=mysqli_query($con,$sql);
$count=mysqli_num_rows($res);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
if($count==1){
    $_SESSION['USER_LOGIN']='yes';
    $_SESSION['USER_ID']=$row['cust_id'];
    header('location:user_home.php');
    die();
}
else{
    $msg="Please renter the details correctly";
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="templates/stylesheet.css">
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
</head>
<body class="grey lighten-4" >
    <nav class="black z-depth-0">
		<div class ="container">
			<a href="../index.php" class="brand-logo brand-text hide-on-med-and-down ">Collectors Marketplace</a>
			<ul id="nav-mobile" class="right hide-on-small-and-down">
				<li><a href="user_signup.php" class="btn">Create a new account</a></li>
				<!-- <li><a href="login.php" class="btn brand z-depth-0">sign out</a></li> -->
			</ul>
		</div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius=30px;">USER LOGIN</h4>

 <form class="white" method="POST">
     
     <label style="font-size:18px; color:black;">Username</label>
     <input type="text" name="username" value='' required>
   

     <label style="font-size:18px; color:black;">Password</label>
     <input type="password" name="password" value='' id="mypass" required>
     <div class="centre red-text"><?php echo $msg ?></div>
     <p>
      <label>
        <input type="checkbox" onclick="myFunction();"/>
        <span>Show Password</span>
      </label>
    </p>

     <div class="center">
         <input type="submit" name="submit" value="Sign in" class="btn brand z-depth-0"></input>
     </div>
     <div class="center">
        <br>
     <a href="user_signup.php" class="btn">Create a new account</a>
    </div>
 </form>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            
</body>
</html>