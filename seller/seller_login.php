<?php
include("../templates/database_conn.php");
include("../templates/functions.php");
$msg="";
if (isset($_POST['submit'])){
    $sellerusername=getsafe($con,$_POST['sellerusername']);
    $sellerpass=getsafe($con,$_POST['password']);

$sql="SELECT * FROM `sellers` WHERE seller_username ='$sellerusername' and seller_pass='$sellerpass'";
$res=mysqli_query($con,$sql);
$count=mysqli_num_rows($res);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
if($count==1){
    $_SESSION['SELLER_LOGIN']='yes';
    $_SESSION['SELLER_ID']=$row['seller_id'];
    header('location:sellerpage.php');
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
    <!-- <link rel="stylesheet" href="templates/stylesheet.css"> -->
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
    <nav class="black">
		<div class="container">
			<a href="../index.php" class="brand-logo brand-text hide-on-med-and-down ">Collectors Marketplace</a>
			<ul id="nav-mobile" class="right hide-on-small-and-down">
				<li><a href="seller_signup.php" class="btn">Create a new seller account</a></li>
				<!-- <li><a href="login.php" class="btn brand z-depth-0">sign out</a></li> -->
			</ul>
        </div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius=30px;">LOGIN AS SELLER</h4>

 <form class="white" method="POST">
     
     <label style="font-size:18px; color:black;">Seller_username</label>
     <input type="text" name="sellerusername" value='' required>
   

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
     <a href="seller_signup.php" class="btn">Create a new seller account</a>
    </div>
 </form>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
            
</body>
</html>