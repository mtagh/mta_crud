<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}




require 'functions.php';
// 04 check whether submit button already pressed or notes

if (isset($_POST["submit"])) {
   
    //var_dump($_POST);
    //var_dump($_FILES); die;

if(add($_POST) > 0) {
    // echo "Success, data added"; change it with javascript so can be directed into index
    echo "
        <script> 
            alert ('data added');
            document.location.href = 'index.php' ;
        </script>
        
    ";

} else {

    echo "
        <script> 
            alert ('failed adding');
            document.location.href = 'index.php'; 
        </script>
      
    
    ";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
</head>
<body>
    <h1> Add Contact</h1>

<!-- 02. create the form -->

    <form action="" method="post" enctype="multipart/form-data">
        <ul> 
            <li> 
                <label for="name">Name : </label>
                <input type="text" name="name" id="name" required>
            </li>

            <li> 
                <label for="institution">Institution : </label>
                <input type="text" name="institution" id="institution" required>
            </li>

            <li> 
                <label for="email">Email : </label>
                <input type="text" name="email" id="email">
            </li>

            <li> 
                <label for="phone">Phone : </label>
                <input type="text" name="phone" id="phone">
            </li>

            <li> 
                <label for="role">Role : </label>
                <input type="text" name="role" id="role">
            </li>

            <li> 
                <label for="notes">Notes : </label>
                <input type="text" name="notes" id="notes">
            </li>

            <li> 
                <label for="picture">Picture : </label>
                <input type="file" name="picture" id="picture">




            </li>

<!-- 03. create button submit-->
            <li>
                <button type="submit" name="submit"> Add</button>

            </li>
                
        
        </ul>

    </form>


    
</body>
</html>