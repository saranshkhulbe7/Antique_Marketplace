<?php
include("../templates/database_conn.php");
include("../templates/functions.php");
    $s=$_SESSION['SELLER_ID'];
    $message="";
    $prod_name="";
    $prod_price="";
    $errpass="";
    $category="";
    $prod_desc="";
if ($_SESSION['SELLER_LOGIN']!='yes' or $_SESSION['SELLER_ID']=="")
    {
        header("location:seller_logout.php");
    }

    $sql3="SELECT * from category where cat_status=1";
    $res3=mysqli_query($con,$sql3);
    $sql1="SELECT * FROM `sellers` WHERE seller_id ='$s'";
    $res=mysqli_query($con,$sql1);
    $srow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    if(isset($_GET['product_id'])){
        $p=$_GET['product_id'];
        $sql="Select * from product where product_id='$p'";
        $res=mysqli_query($con,$sql);
        $prod=mysqli_fetch_array($res,MYSQLI_ASSOC);
        if($prod['seller_id']!=$s){
            header("location:seller_logout.php");
        }
        
        $prod_name=$prod['product_name'];
        $prod_price=$prod['product_price'];
        $category=$prod['cat_id'];
        $prod_desc=$prod['product_desc'];
        if(isset($_POST['submit'])){
            $password=getsafe($con,$_POST['password']);
            if($password != $srow['seller_pass']) $errpass="password incorrect";
            else{
                    $prod_name=getsafe($con,$_POST['product_name']);
                    $prod_price=getsafe($con,$_POST['product_price']);
                    $category=getsafe($con,$_POST['Category']);
                    $prod_desc=getsafe($con,$_POST['product_desc']);

                    if($errpass==""){
                        $sql2="UPDATE `product` SET `cat_id`='$category',`product_name`='$prod_name',`product_price`='$prod_price',`product_desc`='$prod_desc' WHERE product_id='$p'";
                        $res2=mysqli_query($con,$sql2);
                        header("location:sellerpage.php");
                    }
                }
        }
    }
    else{
        header("location:sellerpage.php");
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
    <title>Product | edit details</title>
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
     
     <label style="font-size:18px; color:black;">Name</label>
     <input type="text" name="product_name" value='<?php echo $prod_name?>' required>

     <label style="font-size:18px; color:black;">Price</label>
     <input type="number" name="product_price" value='<?php echo $prod_price?>' required>

     <label style="font-size:18px; color:black;">Category</label>
     <select name="Category" class="browser-default">
     <option selected value="<?php echo $category;?>">Current: <?php 
            $sql4="select * from `category` where cat_id='$category'";
            $res4=mysqli_query($con,$sql4);
            $cat_info=mysqli_fetch_array($res4,MYSQLI_ASSOC);
            echo $cat_info['cat_name'];
     ?></option>
        <?php while($f1 = mysqli_fetch_array($res3)):; ?>
        <option value="<?php echo $f1[0];?>">
            <?php echo $f1[1];?>
        </option>
        <?php endwhile; ?>
     </select>
     
     <label style="font-size:18px; color:black;">Description</label>
     <input type="text" name="product_desc" value='<?php echo $prod_desc?>' required>

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