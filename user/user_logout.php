<?php
include("../templates/database_conn.php");
include("../templates/functions.php");

    unset ($_SESSION['USER_LOGIN']);
    unset ($_SESSION['USER_ID']);
    
    header("location:login.php");
    die();
?>