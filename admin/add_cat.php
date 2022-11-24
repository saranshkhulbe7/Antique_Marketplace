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

    $errpass='';
    $category_pic='';
    $password='';
    $descript_category='';
    $category_name='';
    $sql3="SELECT * from category";
    $res3=mysqli_query($con,$sql3);

if(isset($_POST['submit'])){
    $password=getsafe($con,$_POST['password']);
    $descript_category=getsafe($con,$_POST['description']);
    $category_name=getsafe($con,$_POST['category_name']);
    $category_pic=$_FILES['category_pic'];
     //print_r($product_pic);
     $picname=$category_pic['name'];
     $pictemp=$category_pic['tmp_name'];
     $picer=$category_pic['error'];
     $k=explode('.',$picname);
     $ext= strtolower(end($k));
     $valids=array('png','jpg','jpeg');
     if (in_array($ext,$valids)){
         $finaldest='../templates/images/categories/'.$picname;
         move_uploaded_file($pictemp,$finaldest);
     }
    if($password!=$arow['admin_pass'])$errpass="Wrong password";
    if($errpass==""){
        echo $sql2="INSERT INTO `category`(`cat_name`,`cat_description`, `cat_image`) 
        VALUES ('$category_name','$descript_category','$finaldest')";
        $res2=mysqli_query($con,$sql2);
        header('location:admin_categories.php');
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
    <title>Adding of a Category</title>
</head>
<body>
<nav class="black z-depth-0">
		<div class ="container">
			<a href="adminpage.php" class="brand-logo brand-text">Collectors Marketplace</a>
		</div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius:30px; padding:10px;">
        Add category
        </h4>

<h1 class="center white-text"></h1>
 <form class="white" method="POST" enctype="multipart/form-data">
   
     <label style="font-size:18px; color:black;">Password</label>
     <input type="password" name="password" value='' required>
     <div class="red-text"><?php echo $errpass ;?></div>

     <label style="font-size:18px; color:black;">Category name</label>
     <input type="text" name="category_name" value='<?php echo $category_name?>' required>
     
     <label style="font-size:18px; color:black;">Category Description</label>
     <input type="text" name="description" value='<?php echo $descript_category?>' required>

     <label style="font-size:18px; color:black;">Category Photo</label>
     <input type="file" name="category_pic" value='' required>
     <br>

     <div class="center">
         <input type="submit" name="submit" value="Add category" class="btn brand z-depth-0" style="background-color:black;"></input>
     </div> 
 </form>
</section>
</body>
</html>
 