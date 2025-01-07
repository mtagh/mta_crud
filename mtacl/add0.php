<?php
// 01 create form with its elements

// 05. connect to dbms

$conn= mysqli_connect("localhost", "root", "", "mta_00");

// 04 check whether submit button already pressed or notes

if (isset($_POST["submit"])) {
   // var_dump($_POST); // check if after being filled in the data already captured or not



// 06. take the data from each element in the form

    $name=$_POST["name"];
    $institution=$_POST["institution"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $role=$_POST["role"];
    $notes=$_POST["notes"];
    $picture=$_POST["picture"];

// 07. do query insert 

// 08. create $query

$query="INSERT INTO contacts 
            VALUES
            (NULL, '$name', '$institution', '$email', '$phone', '$role', '$notes', '$picture');
";

    mysqli_query($conn, $query); 
    // can be like this : mysqli_query($conn, "$query") , 
    //but it will be too long so that is why better create an variable $query

   
// 09. check success or failed?  //var_dump(mysqli_affected_rows($conn));  --> success =+1 / failed=-1

if (mysqli_affected_rows($conn) > 0) {
    echo "Success, added"; //this works but..
} else {
    echo "Failed to add"; //wondering this message does not show up if alredy made an error
    //echo "<br>";
    echo mysqli_error($conn);
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

    <form action="" method="post">
        <ul> 
            <li> 
                <label for="name">Name : </label>
                <input type="text" name="name" id="name"
            </li>

            <li> 
                <label for="name">Institution : </label>
                <input type="text" name="institution" id="institution"
            </li>

            <li> 
                <label for="name">Email : </label>
                <input type="text" name="email" id="email"
            </li>

            <li> 
                <label for="name">Phone : </label>
                <input type="text" name="phone" id="phone"
            </li>

            <li> 
                <label for="name">Role : </label>
                <input type="text" name="role" id="role"
            </li>

            <li> 
                <label for="name">Notes : </label>
                <input type="text" name="notes" id="notes"
            </li>

            <li> 
                <label for="name">Picture : </label>
                <input type="text" name="picture" id="picture"
            </li>

<!-- 03. create button submit-->
            <li>
                <button type="submit" name="submit"> Add</button>

            </li>
                
        
        </ul>

    </form>


    
</body>
</html>