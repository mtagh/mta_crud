<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}



// get connected to function.php
require 'functions.php';

// pagination

// configuration

// -----
// $numberofDataperPage = 3; 
// $result = mysqli_query($conn, "SELECT * FROM contacts");
// $numberofContacts = mysqli_num_rows($result);
// var_dump($numberofContacts);
// -----it works to count the number of data
$numberofDataperPage = 4; 
$numberofData = count(query("SELECT * FROM contacts"));
$numberofPages = ceil($numberofData/$numberofDataperPage);

// this below, works but use other option
// if (isset($_GET["page"])) {

//     $activePage = $_GET("page");
// } else {

//     $activePage = 1;
// }

$activePage = ( isset($_GET["page"])) ? $_GET["page"] : 1;
$startingData = ($numberofDataperPage * $activePage) - $numberofDataperPage;



// create query
$contacts= query("SELECT * FROM contacts LIMIT $startingData, $numberofDataperPage");



//$contacts= query("SELECT * FROM contacts ORDER BY id DESC"); //Sorted! ASC or DESC

// search button pressed

if (isset($_POST["search"])) {
    $contacts=search($_POST["keyword"]);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTA Contacts</title>
</head>
<body>

    <a href="logout.php">Logout</a>

    <h1>MTA Contacts</h1>

    <a a href="add.php"> Add Contact</a>
    <br><br>

<!--form input for searching  -->

<form action="" method="post">

    <input type="text" name="keyword" autofocus 
    placeholder="Enter keyword" autocomplete="off"> <!--placeholder does not wrok -->
    <button type="submit" name="search"> Search <button>

</form>
<br><br>

<!--navigation  -->

<!-- << previous  -->

<?php if($activePage > 1) : ?>

    <!--<a href="?page= <?=$activePage-1; ?>">&lt; </a> -->
    <a href="?page= <?=$activePage-1; ?>">&laquo;</a>

<?php endif; ?>


<?php for ($i = 1; $i <= $numberofPages; $i++) : ?>

    <?php if($i == $activePage)  : ?>

    <a href= "?page=<?=$i;?>" style="font-weight: bold; color:red;" >   <?= $i; ?></a>

            <?php else :  ?>

        <a href= "?page=<?=$i;?>">   <?= $i; ?></a>

    <?php endif; ?>

<?php endfor; ?>

<!-- next >> -->

<?php if($activePage < $numberofPages) : ?>

<!-- <a href="?page= <?=$activePage+1; ?>">&gt;</a> -->
<a href="?page= <?=$activePage+1; ?>">&raquo;</a>

<?php endif; ?>


<br><br>

    <table border="1" cellpadding="10" cellspacing="0"> 

        <tr>

            <td> No</td>
            <td>Action</td>
            <td>Picture</td>
            <td>Name</td>
            <td>Instituion</td>
            <td>Email</td>
            <td>Cellphone</td>
            <td>Role</td>
            <td>Notes</td>

        </tr>

<!--data -->
<?php  $i=1 ?>
<?php foreach($contacts as $rct): ?> 
        <tr>

            <td><?=$i; ?></td>
            <td>
                <a href="edit.php?id=<?=$rct["id"];  ?>">Edit</a> |
                <a href="delete.php?id=<?=$rct["id"]; ?> " onclick="return confirm('Sure? want to delete?');" >Delete</a>  
                <!--id=..showing which row will be deleted` -->
            </td>


            
            <!--<td><img src="img/mta.jpeg" width="50";> </td> this is original-->
           
              

            <td><img src="img/<?=$rct["picture"];?>" width="40"></td>
            

            <td><?=$rct["name"];?></td>
            <td><?=$rct["institution"];?></td>
            <td><?=$rct["email"];?></td>
            <td><?=$rct["phone" ];?></td>
            <td><?=$rct["role"]; ?></td>
            <td><?=$rct["notes"]; ?></td>

        </tr>
        <?php $i++; ?>
<?php endforeach; ?>

    </table>

</body>
</html>