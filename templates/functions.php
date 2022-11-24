<?php 
    function pr($arr){
        echo '<pre>';
        print_r($arr);
    }
    
    function prx($arr){
        echo '<pre>';
        print_r($arr);
        die();
    }
    function getsafe($conn,$str)
    {
        if($str!=""){
            return mysqli_real_escape_string($conn,$str);
        }
    }
?>