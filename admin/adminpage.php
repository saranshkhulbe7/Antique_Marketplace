<?php
    include("../templates/database_conn.php");
    include("../templates/functions.php");
    $aid=$_SESSION['ADMIN_ID'];
    if ($_SESSION['ADMIN_LOGIN']!='yes' or $_SESSION['ADMIN_ID']=="")
    {
        header("location:admin_logout.php");
    }
    $sql="SELECT * FROM `admin` where `admin_id`='$aid'";
    $res=mysqli_query($con,$sql);
    $arow = mysqli_fetch_array($res, MYSQLI_ASSOC);

    $sql1="SELECT * FROM `customers`";
    $res1=mysqli_query($con,$sql1);
    $rows1 = mysqli_fetch_all($res1, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Home</title>
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
                <li class="active"><a href="adminpage.php">Home</a></li>
                <li><a href="admin_categories.php">Categories</a></li>
                <li><a href="all_transactions.php">All transactions</a></li>
                <li><a href="All_sellers.php">All sellers</a></li>
				<li><a href="admin_logout.php" class="btn brand z-depth-0">Logout</a></li>
		    </ul>

		</div>
        <br>
        <div style="padding-top: 50px;
                    padding-right: 30px;
                    padding-bottom: 50px;">
        <img class="dp" src="<?php echo $arow['admin_image'];?>" height=100px>
        </div>
</nav>
<div class="container">
        <h1 class="white-text center">Welcome <?php print_r($arow["admin_name"]);?></h1>
        <div class="container ">
        <h6 class="white-text"><i>Personal Details</i></h6>
        <h7 class="white-text">Admin email: <?php print_r($arow["admin_email"]);?></h7><br>
        <h7 class="white-text">Admin phone: <?php print_r($arow["admin_phone"]);?></h7><br>
        <h7 class="white-text">Admin Address: <?php print_r($arow["admin_addr"]);?></h7><br>
        </div>
</div>
<div class="blackbgbg">
    <div class="container">
    <section>
    <div class="row">
        <h1 class="white-text center">All customers</h1>
        
            <?php foreach($rows1 as $c){ ?>
                <div class="col s12 md6">
  				    <div class="card grey lighten-3">
                        <div class="card-content">
                            <h4>ID: <?php echo htmlspecialchars($c['cust_id']); ?></h4>
                            <img src="<?php echo htmlspecialchars($c['cust_image']);?>" class="right" height=100px>
                            <h4>Name: <?php echo htmlspecialchars($c['cust_name']); ?></h4>
                            <h6>Email: <?php echo htmlspecialchars($c['cust_email']);?></h6>
                            <h6>Address: <?php echo htmlspecialchars($c['cust_addr']);?></h6>
                            <h6>Phone: <?php echo htmlspecialchars($c['cust_phone']);?></h6>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>