<?php
include("../templates/database_conn.php");
include("../templates/functions.php");
if ($_SESSION['SELLER_LOGIN']!='yes' or $_SESSION['SELLER_ID']=="")
    {
        header("location:seller_logout.php");
    }
$errpass='';
    $product_pic='';
    $price='';
    $password='';
    $descript_prod='';
    $product_name='';
    $product_category='';
    $sql3="SELECT * from category where cat_status=1";
    $res3=mysqli_query($con,$sql3);

if(isset($_POST['submit'])){
    $password=getsafe($con,$_POST['password']);
    $price=getsafe($con,$_POST['price']);
    $descript_prod=getsafe($con,$_POST['description']);
    $product_name=getsafe($con,$_POST['product_name']);
    $product_category=getsafe($con,$_POST['Category']);
    $product_pic=$_FILES['product_pic'];
     //print_r($product_pic);
     $picname=$product_pic['name'];
     $pictemp=$product_pic['tmp_name'];
     $picer=$product_pic['error'];
     $k=explode('.',$picname);
     $ext= strtolower(end($k));
     $valids=array('png','jpg','jpeg');
     if (in_array($ext,$valids)){
         $finaldest='../templates/images/products/'.$picname;
         move_uploaded_file($pictemp,$finaldest);
     }
     $sid=$_SESSION['SELLER_ID'];
    
    $sqlpass="SELECT seller_pass from sellers where seller_id='$sid'";
    $result=mysqli_query($con,$sqlpass);
    $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $password2=$row2['seller_pass'];


    if($password!=$password2)
    {
        $errpass="passwords dont match";
        $password=$password2='';
    }
   
    if($errpass==""){
        $sql2="INSERT INTO `product`(`seller_id`,`cat_id`, `product_name`,`product_desc`, `product_price`, `product_img`) 
        VALUES ('$sid','$product_category','$product_name','$descript_prod','$price','$finaldest')";
        $res2=mysqli_query($con,$sql2);
        header('location:sellerpage.php');

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
    <title>Adding of a product</title>
</head>
<body>
<nav class="black z-depth-0">
		<div class ="container">
			<a href="sellerpage.php" class="brand-logo brand-text">Collectors Marketplace</a>
		</div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius:30px; padding:10px;">
        Add product
        </h4>

<h1 class="center white-text"></h1>
 <form class="white" method="POST" enctype="multipart/form-data">
     
     <!-- <label style="font-size:18px; color:black;">Category</label>
     <input type="text" name="sellerusername" value='<?php echo $sellerusername ?>' required>
     <div class="red-text"></div> -->
     <label style="font-size:18px; color:black;">Category</label>
     <select name="Category" class="browser-default">
        <?php while($f1 = mysqli_fetch_array($res3)):; ?>
        <option value="<?php echo $f1[0];?>">
            <?php echo $f1[1];?>
        </option>
        <?php endwhile; ?>
     </select>
   
     <label style="font-size:18px; color:black;">Password</label>
     <input type="password" name="password" value='' required id="mypass">
     <div class="red-text"><?php echo $errpass ;?></div>
      <p>
      <label>
        <input type="checkbox" onclick="myFunction();"/>
        <span>Show Password</span>
      </label>
      </p>
     <label style="font-size:18px; color:black;">Product name</label>
     <input type="text" name="product_name" value='<?php echo $product_name?>' required>
     
     <label style="font-size:18px; color:black;">Product Description</label>
     <input type="text" name="description" value='<?php echo $descript_prod?>' required>

     <label style="font-size:18px; color:black;">Price</label>
     <input type="number" name="price" value='<?php echo $price?>' required>

     <label style="font-size:18px; color:black;">Product Photo</label>
     <input type="file" name="product_pic" value='' required>
     <br>

     <div class="center">
         <input type="submit" name="submit" value="Add product to page" class="btn brand z-depth-0" style="background-color:black;"></input>
     </div>
     
 </form>
</section>
</body>
</html>
 