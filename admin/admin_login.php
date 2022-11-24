<?php 
include("../templates/database_conn.php");
include("../templates/functions.php");
$adminpassword='';
$errmsg='';
$adminusername='';
    if (isset($_POST['submit']))
    {
        $adminusername=getsafe($con,$_POST['adminusername']);
        $adminpassword=getsafe($con,$_POST['adminpassword']);

        $sql="select * from admin where `admin_username`='$adminusername' and `admin_pass`='$adminpassword'";
        $res=mysqli_query($con,$sql);
        $resarray=mysqli_fetch_array($res,MYSQLI_ASSOC);
        $count=mysqli_num_rows($res);
        if($count==1){
            $_SESSION['ADMIN_LOGIN']='yes';
            $_SESSION['ADMIN_ID']=$resarray['admin_id'];
            header('location:adminpage.php');
            die();
        }
        else{
            $errmsg="Invalid credentials";
        }


    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | login</title>
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
</head>
<body class="grey lighten-4" >
    <nav class="black">
		<div class="container">
			<a href="../index.php" class="brand-logo brand-text hide-on-med-and-down ">Collectors Marketplace</a>
			<ul id="nav-mobile" class="right hide-on-small-and-down">
				<!-- <li><a href="login.php" class="btn brand z-depth-0">sign out</a></li> -->
			</ul>
        </div>
	</nav>
    <section class="container grey-text" >
        <h4 class="center white-text" style="background-color:black; border-radius=30px;">LOGIN AS ADMIN</h4>

    <form method="POST" class="white">
    
    <label style="font-size:18px; color:black;">Admin username</label>
    <input type="text" name="adminusername" value='<?php echo $adminusername;?>' required>

    <label style="font-size:18px; color:black;">Password</label>
    <input type="password" name="adminpassword" value='<?php echo $adminpassword;?>' id="mypass" required>
    <div class="red-text"><p><?php echo $errmsg ; ?></p></div>
    <p>
      <label>
        <input type="checkbox" onclick="myFunction();"/>
        <span>Show Password</span>
      </label>
    </p>

    <div class="center">
         <input type="submit" name="submit" value="Sign in" class="btn brand z-depth-0"></input>
     </div>
    </form>
</body>
</html>