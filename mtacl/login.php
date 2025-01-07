<?php

session_start();

require 'functions.php';

// check cookie

if (isset ($_COOKIE['login'])) {

    // if ($_COOKIE['login'] == 'true') {
    //     $_SESSION['login'] = true;
    // }
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

    // get the username based on id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id= $id");

    $row = mysqli_fetch_assoc($result);

// check cookie and username

if ($key === hash('sha256', $row['$username'])) {
    $_SESSION['login'] = true;



}


}



if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit;

}






if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

    // check username
   
    if (mysqli_num_rows($result) ===1) {

        // check password
        $row=mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            // set session
            $_SESSION["login"] = true;

            // check Remember me
            if (isset($_POST['remember'])) {
                
                // buat cookie
                // setcookie('login', 'true', time() +60);
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60 );


            }
 var_dump(); die;

                        
            header("Location: index.php");

            exit;

        }

    }


    $error = true;
}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h1>Login Page</h1>

<?php if(isset($error)): ?>

    <p style="color:red; font-style: italic;"> wrong username or password </p>
    <?php endif; ?>





    <form action="" method="post">
        <li>
            <label for="username"> Username : </label>
            <input type="text" name= "username" id="username">
        </li>
        <li>
            <label for="password"> Password : </label>
            <input type="password" name= "password" id="password">
        </li>

        <li>
            <input type="checkbox" name= "remember" id="remember">
            <label for="remember"> Remember me : </label>

        </li>

        <li>
            <button type="submit" name="login"> Login </button>

        </li>





    </form>





</body>
</html>