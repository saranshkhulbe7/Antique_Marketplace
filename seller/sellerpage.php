<?php
    include("../templates/database_conn.php");
    include("../templates/functions.php");
    $sid=$_SESSION['SELLER_ID'];
    if ($_SESSION['SELLER_LOGIN']!='yes' or $_SESSION['SELLER_ID']=="")
    {
        header("location:seller_logout.php");
    }
    $sql1="SELECT * FROM `product` WHERE seller_id ='$sid' and `status`!=2";
    $res=mysqli_query($con,$sql1);
    $row = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $sql2="SELECT * FROM `sellers` WHERE `seller_id` ='$sid'";
    $res2=mysqli_query($con,$sql2);
    $row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC); 
    
    

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller | Home</title>
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
<body style="background-color:#2b2e4a;">
<nav class="red z-depth-0" style="padding-right: 30px;padding-left: 80px;">
		<div>
			<a href="#" class="brand-logo brand-text hide-on-med-and-down">Collectors Marketplace</a>
			<ul id="nav-mobile" class="right hide-on-small-and-down">
				<li><a href="seller_logout.php" class="btn brand z-depth-0">Logout</a></li>
				<li><a href="seller_addprod.php" class="btn brand z-depth-0">Add Product</a></li>
                <li><a href="view_all_sales.php" class="btn brand z-depth-0">View all sales</a></li>
			</ul>
		</div>
        <br>
        <div style="padding-top: 50px;
                    padding-right: 30px;
                    padding-bottom: 50px;">
        <img class ="dp" src="<?php echo htmlspecialchars($row2['seller_img']); ?>" height=100px>
        </div>
</nav>
<div class="container">
        <h1 class="white-text center">Welcome <?php print_r($row2["seller_name"]);?></h1>
        <div class="container ">
        <h6 class="white-text"><i>Personal Details</i></h6>
        <h7 class="white-text">Seller email: <?php print_r($row2["seller_email"]);?></h7><br>
        <h7 class="white-text">Seller phone: <?php print_r($row2["seller_phone"]);?></h7><br>
        <h7 class="white-text">Seller Address: <?php print_r($row2["seller_addr"]);?></h7><br>
        </div>
        <br>
        <div class="center">
            <a href="seller_edit_details.php" class="btn orange darken-4 black-text">Edit profile</a>
        </div>
</div>

<div class="blackbgbg">
    <div class="container">
    <section>
    <div class="row">
        <h1 class="white-text center">All Products</h1>
        
            <?php foreach($row as $pr){ ?>
                <div class="col s6 md3">
  				    <div class="card grey lighten-3">
                        <center>
                        <div class="card-content">
                            <img src="<?php echo htmlspecialchars($pr['product_img']);?>" height=150px>
                            <h4>Name: <?php echo htmlspecialchars($pr['product_name']); ?></h4>
                            <h6>Category: <?php 
                                            $cid=$pr['cat_id'];
                                            $sql3="Select * from category where `cat_id`='$cid' ";
                                            $res3=mysqli_query($con,$sql3);
                                            $resans=mysqli_fetch_array($res3,MYSQLI_ASSOC);
                                            echo $resans['cat_name'];
                                            ?></h6>
                            <h6>Description: <?php echo htmlspecialchars($pr['product_desc']);?></h6>
                            <h5>Price: <?php echo htmlspecialchars($pr['product_price']);?></h5>
                                <h5>Status: <?php
                                                if($pr['status']){
                                                    echo '<p class="green-text" >Active</p>';
                                                }
                                                else{
                                                    echo '<p class="red-text" >Inactive</p>';
                                                }?></h5>

                                <a href="prod_edit.php?product_id=<?php echo $pr['product_id']?>" class="btn black">Edit</a>
                                <?php if($pr['status']) : ?>
                                <a href="prod_del.php?product_id=<?php echo $pr['product_id'];?>" class="btn red darken-2 white-text">Delete</a>
                                <?php endif ?>
                                <?php if($pr['status']==0) : ?>
                                <a href="prod_activ.php?product_id=<?php echo $pr['product_id'];?>" class="btn green darken-2 white-text">Activate</a>
                                <?php endif ?>
                        </div>
                        </center>
                    
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</div>


<section class="footer white">
        <div class="container textcenter">
            <h5>© All rights reserved<br>
            <!-- Made by <a href="https://github.com/arshdeepdgreat" class="href">Arshdeep Singh</a></h5> -->
        </div>
    </section>

</body>
</html>