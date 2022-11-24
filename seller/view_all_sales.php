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

    $sql2="SELECT * FROM `transactions` where `seller_id`='$sid' order by `timestamp` desc";
    $res2=mysqli_query($con,$sql2);
    $row2 =mysqli_fetch_all($res2, MYSQLI_ASSOC);
    $totalsales=0;
    foreach($row2 as $p){
        $totalsales+=$p['Total'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller | Sales </title>
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
			<a href="sellerpage.php" class="brand-logo brand-text hide-on-med-and-down">Click to go home</a>
        </div>
</nav>
<div class="blackbgbg">
<div class="container">
    <section>
    <div class="row">
    <h2 class="white-text" style="text-align:center;">Your Sales</h2>
    <h3 class="white-text" style="text-align:center;">Total : <?php echo $totalsales;?></h3>
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
                          <h7>Customer ID: <?php echo $p['cust_id'];?></h7>
                          <h6>Timestamp: <?php echo $p['timestamp'];?></h6>
                          <br>
                          </div>
                        </div>
                    </div>
            </div>
        <?php 
    } ?> 
    </div>
</div>

</div>
<section class="footer">
        <div class="container textcenter">
            <h5>© All rights reserved<br>
            <!-- Made by <a href="https://github.com/arshdeepdgreat" class="href">Arshdeep Singh</a></h5> -->
        </div>
</section>