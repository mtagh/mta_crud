<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}





require 'functions.php';

// take the id
$id = $_GET["id"];
// create a function
if (delete($id) >0 ){

    echo "
        <script> 
            alert ('data deleted');
            document.location.href = 'index.php' ;
        </script>
        
    ";

} else {

    echo "
        <script> 
            alert ('failed deleting');
            document.location.href = 'index.php'; 
        </script>

    ";   
}






?>
