<?php
session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}


require 'functions.php';
// get data from url
$id =$_GET["id"];
//var_dump($id);
//query data based on id
$ctc = query("SELECT * FROM contacts WHERE id = $id")[0];
//var_dump($ctc);

if (isset($_POST["submit"])) {
   // check data edited or not

if(edit($_POST) > 0) {
    // echo "Success, data added"; change it with javascript so can be directed into index
    echo "
        <script> 
            alert ('data edited');
            document.location.href = 'index.php' ;
        </script>
        
    ";

} else {

    echo "
        <script> 
            alert ('failed editing');
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
    <title>Edit Contact</title>
</head>
<body>
    <h1> Edit Contact</h1>

<!-- 02. create the form -->

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$ctc["id"]; ?>">
        <input type="hidden" name="oldPicture" value="<?=$ctc["picture"]; ?>">

        <ul> 
            <li> 
                <label for="name">Name : </label>
                <input type="text" name="name" id="name" required
                value="<?= $ctc["name"]; ?>">
            </li>

            <li> 
                <label for="name">Institution : </label>
                <input type="text" name="institution" id="institution" required 
                value="<?= $ctc["institution"]; ?>">
            </li>

            <li> 
                <label for="name">Email : </label>
                <input type="text" name="email" id="email" 
                value="<?= $ctc["email"]; ?>">
                
            </li>

            <li> 
                <label for="name">Phone : </label>
                <input type="text" name="phone" id="phone" 
                value="<?= $ctc["phone"]; ?>">
            </li>

            <li> 
                <label for="name">Role : </label>
                <input type="text" name="role" id="role" 
                value="<?= $ctc["role"]; ?>">
            </li>

            <li> 
                <label for="name">Notes : </label>
                <input type="text" name="notes" id="notes" 
                value="<?= $ctc["notes"]; ?>">
            </li>

            <li> 
                <label for="name">Picture : </label> <br>
                <img src="img/<?= $ctc['picture']; ?>" width="40"> <br>
                <input type="file" name="picture" id="picture" >
                
            </li>

<!-- 03. create button submit-->
            <li>
                <button type="submit" name="submit"> Edit</button>

            </li>
                
        
        </ul>

    </form>


    
</body>
</html>