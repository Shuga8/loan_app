<?php 

session_start();

    function isLoggedIn(){
        if(isset($_SESSION['customer_id'])){
            return true;
        }else{
            return false;
        }
    }

?>