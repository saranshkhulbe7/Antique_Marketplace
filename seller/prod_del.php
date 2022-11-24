<?php
include("../templates/database_conn.php");
include("../templates/functions.php");
    $s=$_SESSION['SELLER_ID'];
if ($_SESSION['SELLER_LOGIN']!='yes' or $_SESSION['SELLER_ID']=="")
    {
        header("location:seller_logout.php");
    }
    if(isset($_GET['product_id'])){
        $p=$_GET['product_id'];
        $sql="Select * from product where product_id='$p'";
        $res=mysqli_query($con,$sql);
        $prod=mysqli_fetch_array($res,MYSQLI_ASSOC);
        if($prod['seller_id']!=$s){
            header("location:seller_logout.php");
        }
        else{
            $sqldel=" Update `product` set `status`=0 where `product_id`='$p'";
            mysqli_query($con,$sqldel);
            header("location:sellerpage.php");
        }
    }

?>