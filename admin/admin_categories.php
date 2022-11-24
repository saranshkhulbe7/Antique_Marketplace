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

    $sql1="SELECT * FROM `category`";
    $res2=mysqli_query($con,$sql1);
    $row2 = mysqli_fetch_all($res2, MYSQLI_ASSOC);
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
                <li><a href="adminpage.php">Home</a></li>
                <li class="active"><a href="admin_categories.php">Categories</a></li>
                <li><a href="all_transactions.php">All transactions</a></li>
                <li><a href="All_sellers.php">All sellers</a></li>
				<li><a href="admin_logout.php" class="btn brand z-depth-0">Logout</a></li>
		    </ul>
        </div>
</nav>

<div class="center">
    <h2 class="white-text" style="text-align:center;">All Categories</h2>
    <a href="add_cat.php" class="btn orange darken-4 black-text">ADD CATEGORY</a>
    <br>
    <br>
</div>
<div class="blackbgbg">
<div class="container">
    <section>
    <div class="row">
    
        <?php foreach($row2 as $cat){ ?>
            <div class="col s12 md6">
  				    <div class="card">
                        <div class="card-content">
                         
                          <img src="<?php echo $cat['cat_image'];?>" class="right" height=100px>
                          <h3><?php print_r($cat['cat_name']); ?></h3>
                          <h5><?php print_r($cat['cat_description']);?></h5>
                          <a href="cat_edit.php?cat_id=<?php echo $cat['cat_id']?>" class="btn black">Edit</a>                          
                        </div>
                    </div>
            </div>
        <?php } ?>  
        <!-- <div class="center"><a href="user_categories.php" class="black-text btn-large orange">View all</a></div> -->
    </div>
    </section>
</div>
</div>