<?php
    include("../templates/database_conn.php");
    include("../templates/functions.php");
    $uid=$_SESSION['USER_ID'];
    if ($_SESSION['USER_LOGIN']!='yes' or $_SESSION['USER_ID']=="")
    {
        // echo $_SESSION['USER_LOGIN'];
        
        header("location:user_logout.php");
    }
    $sql1="SELECT * FROM `customers` WHERE cust_id ='$uid'";
    $res=mysqli_query($con,$sql1);
    $urow = mysqli_fetch_array($res, MYSQLI_ASSOC);

    $sql2="SELECT * FROM `category` where `cat_status`=1 limit 4";
    $res2=mysqli_query($con,$sql2);
    $row2 = mysqli_fetch_all($res2, MYSQLI_ASSOC);
    
    
    // $row3 = mysqli_fetch_array($res3, MYSQLI_ASSOC);

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer | Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../templates/stylesheet.css">
    <style>
        form{
			max-width: 800px;
			margin: 100px;
			padding: 20px;
		}
        .dp{
            border-radius: 50%;
        }
    </style>
</head>
<body style="background-color:#2b2e4a;" >
<nav class="red z-depth-0" style="padding-right: 30px;padding-left: 80px;">
		<div>
			<a href="#" class="brand-logo brand-text hide-on-med-and-down">Collectors Marketplace</a>
            <ul id="nav-mobile" class="right">
                <li class="active"><a href="user_home.php">Home</a></li>
                <li><a href="user_categories.php">Categories</a></li>
                <li><a href="user_orders.php">Your Orders</a></li>
                <li><a href="All_products.php">Products</a></li>
				<li><a href="user_logout.php" class="btn brand z-depth-0">Logout</a></li>
		    </ul>

		</div>
        <br>
        <div style="padding-top: 50px;
                    padding-right: 30px;
                    padding-bottom: 50px;">
        <img class="dp" src="<?php echo $urow['cust_image'];?>" height=100px>
        </div>
</nav>
    <div class="container">
        <h1 class="white-text center">Welcome <?php print_r($urow["cust_name"]);?></h1>
        <div class="center">
            <h4 class="white-text center">Balance: <?php echo $urow['cust_balance'];?></h4>
            <a href="edit_info.php" class="btn orange darken-4 black-text">Edit profile</a>
        </div>
    </div>

<div class="blackbgbg">
<div class="container">
    <section>
    <div class="row">
    <h2 class="white-text" style="text-align:center;">Popular Categories</h2>
        <?php foreach($row2 as $cat){ ?>
            <div class="col s6 md3">
  				    <div class="card">
                      <center>
                        <div class="card-content">
                          <h3><?php print_r($cat['cat_name']); ?></h3>
                          <div>
                          <img src="<?php echo $cat['cat_image'];?>" height=200px>
                          <br>
                          <a href="All_products.php?cat_id=<?php echo $cat['cat_id'];?>" class="btn brand z-depth-0">View more...</a>
                          </div>
                        </div>
                        </center>
                    </div>
            </div>
        <?php } ?>  
        <div class="center"><a href="user_categories.php" class="black-text btn-large orange">View all</a></div>
    </div>
    </section>
</div>
</div>
    <section class="pre-products">

    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


    <section class="footer white">
        <div class="container textcenter">
            <h5>© All rights reserved<br>
            <!-- Made by <a href="https://github.com/arshdeepdgreat" class="href">Arshdeep Singh</a></h5> -->
        </div>
    </section>

</body>
</html>