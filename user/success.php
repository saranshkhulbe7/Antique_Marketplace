<?php 
    include("../templates/database_conn.php");
    include("../templates/functions.php");
    $uid=$_SESSION['USER_ID'];
    $errpass='';$mes="";
    if ($_SESSION['USER_LOGIN']!='yes' or $_SESSION['USER_ID']=="")
    {
        header("location:user_logout.php");
    }
    $sql1="SELECT * FROM `customers` WHERE cust_id ='$uid'";
    $res=mysqli_query($con,$sql1);
    $urow = mysqli_fetch_array($res, MYSQLI_ASSOC);
    if(isset($_GET['product_id'])){
        $c=$_GET['product_id'];
        $sql= "SELECT * FROM `product` WHERE `product_id`='$c' and `status`=2";
        $res=mysqli_query($con,$sql); 
        $prods=mysqli_fetch_all($res,MYSQLI_ASSOC);
        $count=mysqli_num_rows($res);
        if($count<1){
            header("location:All_products.php");
        }
        else{
            $mes="Success Your order has been placed";
            //sleep(5);
        }
        // print_r($prods);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucess</title>
</head>
<body>
    <h2><?php echo $mes;?></h2>
</body>
</html>
<?php
header("location:user_orders.php");
?>