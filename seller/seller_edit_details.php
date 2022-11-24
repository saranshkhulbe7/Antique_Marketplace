<?php
    include("../templates/database_conn.php");
    include("../templates/functions.php");
    $sid=$_SESSION['SELLER_ID'];
    if ($_SESSION['SELLER_LOGIN']!='yes' or $_SESSION['SELLER_ID']=="")
    {
        header("location:seller_logout.php");
    }
    $sql1="SELECT * FROM `sellers` WHERE seller_id ='$sid'";
    $res=mysqli_query($con,$sql1);
    $srow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $errpass='';$errphone='';
    $seller_addr=$srow['seller_addr'];
    $phone=$srow['seller_phone'];
    $message="";
    if(isset($_POST['submit'])){
        $password=getsafe($con,$_POST['password']);
        if($password != $srow['seller_pass']) $errpass="password incorrect";
        else{
            $seller_addr=getsafe($con,$_POST['seller_addr']);
            $seller_phone=getsafe($con,$_POST['seller_phone']);
            if($seller_phone<100000000)$errphone="enter 10 digit mobile number";
    
            if($errphone=='')
            {
                $sql2="UPDATE `sellers` SET `seller_addr`='$seller_addr',`seller_phone`='$seller_phone' WHERE `seller_id`='$sid'";
                if(mysqli_query($con,$sql2)){
                    header("location:sellerpage.php");
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
    <title> seller | edit details</title>
</head>
<body>
<nav class="black z-depth-0">
		<div class ="container">
			<a href="sellerpage.php" class="brand-logo brand-text">Collectors Marketplace</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
				<!-- <li><a href="login.php" class="btn brand z-depth-0">Login here</a></li> -->
                <li><a href="seller_logout.php" class="btn brand z-depth-0">Logout</a></li>
			</ul>
		</div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius:30px; padding:10px;">
        Edit Details
        </h4>

<h1 class="center white-text"><?php echo $message;?></h1>
 <form class="white" method="POST" enctype="multipart/form-data">
     
     <label style="font-size:18px; color:black;">Phone</label>
     <input type="number" name="seller_phone" value='<?php echo $phone?>' required>
     <div class="centre red-text"><?php echo $errphone ?></div>

     <label style="font-size:18px; color:black;">Address</label>
     <input type="text" name="seller_addr" value='<?php echo $seller_addr?>' required>

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