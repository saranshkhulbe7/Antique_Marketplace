<?php
    include("../templates/database_conn.php");
    include("../templates/functions.php");
    $errpass="";
    $aid=$_SESSION['ADMIN_ID'];
    if ($_SESSION['ADMIN_LOGIN']!='yes' or $_SESSION['ADMIN_ID']=="")
    {
        header("location:admin_logout.php");
    }
    $sql="SELECT * FROM `admin` where `admin_id`='$aid'";
    $res=mysqli_query($con,$sql);
    $arow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    if(isset($_GET['cat_id'])){
        $c=$_GET['cat_id'];
        $sql= "SELECT * FROM `category` WHERE `cat_id`='$c'";
        $res=mysqli_query($con,$sql); 
        $category=mysqli_fetch_array($res,MYSQLI_ASSOC);
        $count=mysqli_num_rows($res);
        if($count<1){
            header("location:adminpage.php");
        }
        $catname=$category['cat_name'];
        $catdesc=$category['cat_description'];
    }
    if(isset($_POST['submit'])){
        $password=getsafe($con,$_POST['password']);
        if($password != $arow['admin_pass']) $errpass="password incorrect";
        else{
            $catdesc=$_POST['cat_description'];
            $catname=$_POST['categoryname'];
                $sql2="UPDATE `category` SET `cat_description`='$catdesc',`cat_name`='$catname' WHERE `cat_id`='$c'";
                if(mysqli_query($con,$sql2)){
                    header("location:adminpage.php");
                }
                else{
                    echo mysqli_error($con);
                }
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
    <title>EDIT CATEGORY</title>
</head>
<body>
<nav class="black z-depth-0">
		<div class ="container">
			<a href="admin_categories.php" class="brand-logo brand-text">Collectors Marketplace</a>
            
		</div>
</nav>
<section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius:30px; padding:10px;">
        Edit Details
        </h4>

    <form class="white" method="POST" enctype="multipart/form-data">
     
     <label style="font-size:18px; color:black;">CATEGORY NAME</label>
     <input type="text" name="categoryname" value='<?php echo $catname?>' required>

     <label style="font-size:18px; color:black;">CATEGORY DESCRIPTION</label>
     <input type="text" name="cat_description" value='<?php echo $catdesc?>' required>

     <label style="font-size:18px; color:black;">Enter Password to verify</label>
     <input type="password" name="password" value='' required>
     <div class="centre red-text"><?php echo $errpass ?></div>
     <br>

     <div class="center">
         <input type="submit" name="submit" value="Update values" class="btn brand z-depth-0" style="background-color:black;"></input>
     </div>
     
    </form>
    </section>
</body>
</html>