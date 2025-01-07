<?php
//connection CONNECTION
$conn = mysqli_connect("localhost", "root", "", "mta_00");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows =[];
    while ( $row=mysqli_fetch_assoc($result)) {

        $rows[] = $row;
    }
return $rows;

}

// add anohter function here
//06. take the data from each element in the form

function add($data) {
global $conn;
// fill in like the code in add.php
$name=$data["name"];
$institution=$data["institution"];
$email=$data["email"];
$phone=$data["phone"];
$role=$data["role"];
$notes=$data["notes"];
$picture=$data["picture"];


$query="INSERT INTO contacts 
            VALUES
            (NULL, '$name', '$institution', '$email', '$phone', '$role', '$notes', '$picture');
";

    mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

?>