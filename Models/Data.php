<?php  
if (isset($_SESSION['rol'])) {
       session_start(); 
       session_destroy();
}

        session_start();
        $host = 'localhost';
        if(!isset($_SESSION['squema'])){$dbname ='snu';}else{$dbname =$_SESSION['squema'];}
        $username = 'root';
        $password = '';

        
