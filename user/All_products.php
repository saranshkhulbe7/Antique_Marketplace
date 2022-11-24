<?php 
    include("../templates/database_conn.php");
    include("../templates/functions.php");
    $uid=$_SESSION['USER_ID'];
    $he='';
    if ($_SESSION['USER_LOGIN']!='yes' or $_SESSION['USER_ID']=="")
    {
        header("location:user_logout.php");
    }
    $sql1="SELECT * FROM `customers` WHERE cust_id ='$uid'";
    $res=mysqli_query($con,$sql1);
    $urow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    if(isset($_GET['cat_id'])){
        $c=$_GET['cat_id'];
        $sql= "SELECT * FROM `product` WHERE `cat_id`='$c' and `status`=1 ORDER BY `product_name` asc ";
        $res=mysqli_query($con,$sql); 
        $prods=mysqli_fetch_all($res,MYSQLI_ASSOC);
        $sql1="SELECT `cat_name` from `category` where `cat_id`='$c' and `cat_status`=1";
        $res1=mysqli_query($con,$sql1);
        $prods1=mysqli_fetch_array($res1,MYSQLI_ASSOC);
        $count=mysqli_num_rows($res1);
        if($count<1){
            header("location:user_categories.php");
        }
        else{
            $he ="in ".$prods1['cat_name']." category";
        }
        // print_r($prods);
    }
    else{
        $sql= "SELECT * FROM `product` WHERE `status`=1 ORDER BY `product_name` asc ";
        $res=mysqli_query($con,$sql);
        $prods=mysqli_fetch_all($res,MYSQLI_ASSOC);
    }


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer | Home</title>
    <link rel="stylesheet" href="../templates/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- <style>
        form{
			max-width: 800px;
			margin: 100px;
			padding: 20px;
		}
    </style> -->
</head>
<body class="grey lighten-4" >
<nav class="red z-depth-0" style="padding-right: 30px;padding-left: 80px;">
		<div>
			<a href="user_home.php" class="brand-logo brand-text hide-on-med-and-down">Collectors Marketplace</a>
            <ul id="nav-mobile" class="right">
                <li ><a href="user_home.php">Home</a></li>
                <li ><a href="user_categories.php">Categories</a></li>
                <li ><a href="user_orders.php">Your Orders</a></li>
                <li class="active"><a href="All_products.php">Products</a></li>
				<li><a href="user_logout.php" class="btn brand z-depth-0">Logout</a></li>
		    </ul>

		</div>
</nav>

<div class="blackbgbg">
<div class="container">
    <section>
    <div class="row">
    <h2 class="white-text" style="text-align:center;">Products <?php echo $he ;?></h2>
    <h4 class="white-text center">Balance: <?php echo $urow['cust_balance'];?></h4>
        <?php foreach($prods as $p){ ?>
            <div class="col s6 md3">
  				    <div class="card">
                      <center>
                        <div class="card-content">
                          <h3><?php print_r($p['product_name']); ?></h3>
                          <div>
                          <img src="<?php echo $p['product_img'];?>" height=200px>
                          <br>
                          <h5>Price: <?php echo $p['product_price'];?></h5>
                          <h7>Seller ID: <?php echo $p['seller_id'];?></h7>
                          <br>
                          <a href="purchase.php?product_id=<?php echo $p['product_id']; ?>" class="btn brand z-depth-0">Purchase Now</a>
                          </div>
                        </div>
                        </center>
                    </div>
            </div>
        <?php } ?>  
        <!-- <div class="center"><a href="user_categories.php" class="black-text btn-large orange">View all</a></div> -->
    </div>
    </section>
</div>
</div>
<section class="footer">
        <div class="container textcenter">
            <h5>© All rights reserved<br>
            <!-- Made by <a href="https://github.com/arshdeepdgreat" class="href">Arshdeep Singh</a></h5> -->
        </div>
</section>