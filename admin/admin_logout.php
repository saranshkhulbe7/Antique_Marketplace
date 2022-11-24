<?php
include("../templates/database_conn.php");
include("../templates/functions.php");

    unset ($_SESSION['ADMIN_LOGIN']);
    unset ($_SESSION['ADMIN_ID']);
    header("location:admin_login.php");
    die();
?>