<?php 
    include("../templates/database_conn.php");
    include("../templates/functions.php");
    $uid=$_SESSION['USER_ID'];
    $errpass='';$mes="";
    if ($_SESSION['USER_LOGIN']!='yes' or $_SESSION['USER_ID']=="")
    {
        header("location:user_logout.php");
    }
    $sql1="SELECT * FROM `customers` WHERE cust_id ='$uid'";
    $res1=mysqli_query($con,$sql1);
    $urow1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
    if(isset($_GET['product_id'])){
        $p=$_GET['product_id'];
        $sql= "SELECT * FROM `product` WHERE `product_id`='$p' and `status`=1";
        $res=mysqli_query($con,$sql); 
        $prod=mysqli_fetch_array($res,MYSQLI_ASSOC);
        $pid=$prod['product_id'];
        $price=$prod['product_price'];
        $seller=$prod['seller_id'];
        $count=mysqli_num_rows($res);
            if($count<1){
              header("location:user_home.php");
            }
    }

    if (isset($_POST['confirm'])){
        $todo=$_POST['confirm'];
        $pass=$_POST['password'];
        if($pass != $urow1['cust_pass']){
            $errpass="Password incorrect";
            $pass="";
        }
        else{
            if($todo=="NO"){
                header("location:user_home.php");
            }
            else if ($todo=="YES")
            {
                $balance=$urow1['cust_balance'];
                $price=$prod['product_price'];
                if ($balance - $price < 1000){
                    $errpass="Insufficient funds";
                }
                else{
                    $new_bal=$balance - $price;
                    $sql5="UPDATE `product` SET `status`=2 WHERE `product_id`='$pid'";
                   $res5=mysqli_query($con,$sql5);
                   //$mes="Successful transaction";   
                   $sql6="INSERT INTO `transactions`(`cust_id`, `seller_id`, `product_id`, `Total`) 
                   VALUES ('$uid','$seller','$pid','$price')" ;    
                   $res6=mysqli_query($con,$sql6);
                    $sql7="UPDATE `customers` set `cust_balance`='$new_bal' where `cust_id`='$uid'";   
                   $res7=mysqli_query($con,$sql7); 

                   header("location:success.php?product_id=$pid");
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
    <link rel="stylesheet" href="../templates/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        form{
			max-width: 800px;
			margin: 10px 100px 10px 100px;
			padding: 20px;
		}
    </style>
    <title>Purchase | payment</title>
</head>
<body class="grey lighten-4" >
<nav class="red z-depth-0" style="padding-right: 30px;padding-left: 80px;">
		<div>
			<a href="user_home.php" class="brand-logo brand-text hide-on-med-and-down">Collectors Marketplace</a>
            <ul id="nav-mobile" class="right">
                <li ><a href="user_home.php">Home</a></li>
                <li ><a href="user_categories.php">Categories</a></li>
                <li ><a href="user_orders.php">Your Orders</a></li>
                <li><a href="All_products.php">Products</a></li>
				<li><a href="user_logout.php" class="btn brand z-depth-0">Logout</a></li>
		    </ul>

		</div>
</nav>
<div class="blackbgbg">
<div class="container">
<h2 class="white-text" style="text-align:center;">Transaction Form</h2>
    <div class="card">
    <div class="card-content">
    <center>
        <h3>Product Name: <?php echo $prod['product_name'];?></h3>
        <h3>Product Price: <?php echo $prod['product_price'];?></h3>
        <img src="<?php echo $prod['product_img'];?>" height=300px>
        <h3>Seller ID: <?php echo $prod['seller_id'];?></h3>
    </center>
        <h4><strong>Description: </h4></strong><h5><?php echo $prod['product_desc'];?></h5>    
    <hr>
    <h3>Your Balance: <?php echo $urow1['cust_balance']?></h3>
    <div class="container  indigo darken-4">
    <form action="" method="post">
        <label style="font-size:18px; color:white;">Password</label>
        <input type="password" name="password" class="white-text" value='' required>
        <div class="red-text"><?php echo $errpass ;?></div>

        <label style="font-size:18px; color:white;">Do you want to make this purchase?</label>
        <div><br></div>
        <div class="center">
        <input type="submit" name="confirm" value="YES" class="btn brand z-depth-0">
        <input type="submit" name="confirm" value="NO"  class="btn brand red z-depth-0">
        </div>
    </form>
    </div>
    </div>
    
    </div>
    
</div>
</div>

</body>
</html>