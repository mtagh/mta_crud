<?php
//connection CONNECTION
// $conn = mysqli_connect("localhost", "mtanggor_mta_00", "Pamulang1", "mtanggor_mta_00");
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
    // add **htmlspecialchars** >> preventing from hacked
    $name=htmlspecialchars($data["name"]);
    $institution=htmlspecialchars($data["institution"]);
    $email=htmlspecialchars($data["email"]);
    $phone=htmlspecialchars($data["phone"]);
    $role=htmlspecialchars($data["role"]);
    $notes=htmlspecialchars($data["notes"]);
    //$picture=htmlspecialchars($data["picture"]);

    // upload picture

    $picture = upload();
    if ( !$picture) {

        return false;
    }$conn = mysqli_connect("localhost", "mtanggor_mta_00", "Pamulang1", "mtanggor_mta_00");


$query="INSERT INTO contacts 
            VALUES
            (NULL, '$name', '$institution', '$email', '$phone', '$role', '$notes', '$picture');
";

    mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function upload() {

    $fileName = $_FILES ['picture']['name']; 
    $fileSize = $_FILES ['picture']['size'];
    $error = $_FILES ['picture']['error'];
    $tmpName = $_FILES ['picture']['tmp_name'];
    
    
    //check whether picture uploaded

    if ( $error === 4 ) {
        echo "<script>
            alert('Choose the picture first');
            </script>";
        return false;

    }
  
    // chek whether the upload file is picture - check extension

    $extensionPictureValid =['jpg', 'jpeg', 'png'];
    $extensionPicture = explode('.',$fileName);
    $extensionPicture = strtolower(end($extensionPicture));

    if (!in_array($extensionPicture, $extensionPictureValid)) {
        echo "<script>
                alert( 'you do not upload picture');
             </script>";
        return false;

    }

    // chek if the filesize is too big

    if ($fileSize > 1000000) {
        echo "<script>
                alert( 'your file is too big');
             </script>";
        return false;

    }

  // passed the checking, picture ready to upload

  // generate new file name for the picture
    
    $newfileName = uniqid();
    $newfileName .='.';
    $newfileName .=$extensionPicture;

    //var_dump($newfileName); die;

    move_uploaded_file($tmpName, 'img/' . $newfileName);

    return $newfileName;
        
}


function delete($id) {

    global $conn;
    mysqli_query($conn, "DELETE FROM contacts WHERE id = $id");
    return mysqli_affected_rows($conn);

}

function edit($data) {

    global $conn;
    // fill in like the code in add.php
    // add **htmlspecialchars** >> preventing from hacked

    $id = $data["id"];

    $name=htmlspecialchars($data["name"]);
    $institution=htmlspecialchars($data["institution"]);
    $email=htmlspecialchars($data["email"]);
    $phone=htmlspecialchars($data["phone"]);
    $role=htmlspecialchars($data["role"]);
    $notes=htmlspecialchars($data["notes"]);
    $oldPicture=htmlspecialchars($data["oldPicture"]);

    // check whether user choose new picture or not
    if ( $_FILES['picture']['error'] === 4) {
        $picture = $oldPicture;
    } else {
    //$picture = htmlspecialchars($data["picture"]);
    $picture = upload();
    }
    
    
    $query="UPDATE contacts SET
    
        name= '$name',
        institution= '$institution',
        email= '$email',
        phone= '$phone',
        role = '$role',
        notes= '$notes',
        picture= '$picture'

           WHERE id = $id;  
        
        ";
               
    
        mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);

}

function search ($keyword) {
    $query = "SELECT * FROM contacts
        WHERE 
        name LIKE '%$keyword%' OR 
        institution LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        phone LIKE '%$keyword%' OR
        role LIKE '%$keyword%' OR
        notes LIKE '%$keyword%' 
       
        ";

    return query($query);

// %keyword%, % functions a wildcard on front of back of the keyword entered

}


function registration($data) {
    global $conn;
    $username = strtolower(stripcslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]); 
    $password2= mysqli_real_escape_string($conn, $data["password2"]);

// chek whether there is a user with the same name

$result = mysqli_query($conn, "SELECT username FROM users WHERE username='$username'") ;

if (mysqli_fetch_assoc($result)) {
    echo "<script>
    
        alert ('username is already registered')
    
    </script>";

    return false;
}






// chek password confirmation

if ( $password !==$password2) {

    echo "<script>
        alert ('password confirmation, failed');
    
        </script>";
    return false;
}

// encrypt the password

$password = password_hash($password, PASSWORD_DEFAULT);

// add the new user into database
mysqli_query($conn,"INSERT INTO users VALUES(NULL, '$username', '$password' )");
// * in unpas #pertemuan 14 minute 24:52 the Values for id is ' ', it does not work here and it works for NULL. the table is users, not user

return mysqli_affected_rows($conn);


}

?>
