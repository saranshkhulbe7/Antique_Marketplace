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

    $sql2="SELECT * FROM `transactions` where `cust_id`='$uid' order by `timestamp` desc";
    $res2=mysqli_query($con,$sql2);
    $row2 =mysqli_fetch_all($res2, MYSQLI_ASSOC);
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer | Orders</title>
    <link rel="stylesheet" href="../templates/stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        form{
			max-width: 800px;
			margin: 100px;
			padding: 20px;
		}
    </style>
</head>
<body class="grey lighten-4" >
<nav class="red z-depth-0" style="padding-right: 30px;padding-left: 80px;">
		<div>
			<a href="user_home.php" class="brand-logo brand-text hide-on-med-and-down">Collectors Marketplace</a>
            <ul id="nav-mobile" class="right">
                <li ><a href="user_home.php">Home</a></li>
                <li ><a href="user_categories.php">Categories</a></li>
                <li class="active"><a href="user_orders.php">Your Orders</a></li>
                <li><a href="All_products.php">Products</a></li>
				<li><a href="user_logout.php" class="btn brand z-depth-0">Logout</a></li>
		    </ul>

		</div>
</nav>
<div class="blackbgbg">
<div class="container">
    <section>
    <div class="row">
    <h2 class="white-text" style="text-align:center;">Your Orders</h2>
    <h4 class="white-text center">Balance: <?php echo $urow['cust_balance'];?></h4>
<?php foreach($row2 as $p){ ?>
            <div class="col s12 md6">
  				    <div class="card">
                        <div class="card-content">
                            <?php
                            $k=$p['product_id'];
                                $sql3="Select * from product where product_id='$k'";
                                $res3=mysqli_query($con,$sql3);
                                $row3=mysqli_fetch_array($res3,MYSQLI_ASSOC);
                            ?>
                          <h3><?php print_r($row3['product_name']); ?></h3>
                          <img class="right" src="<?php print_r($row3['product_img']); ?>" height="100px">
                        <div>
                          <h5>Price: <?php echo $p['Total'];?></h5>
                          <h7>Seller ID: <?php echo $p['seller_id'];?></h7>
                          <h6> Timestamp: <?php echo $p['timestamp'];?></h6>
                          <br>
                          </div>
                        </div>
                    </div>
            </div>
        <?php } ?> 
    </div>
</div>

</div>
<section class="footer">
        <div class="container textcenter">
            <h5>© All rights reserved<br>
            <!-- Made by <a href="https://github.com/arshdeepdgreat" class="href">Arshdeep Singh</a></h5> -->
        </div>
</section>