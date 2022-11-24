<?php
include("../templates/database_conn.php");
include("../templates/functions.php");

    unset ($_SESSION['SELLER_LOGIN']);
    unset ($_SESSION['SELLER_ID']);
    header("location:seller_login.php");
    die();
?>