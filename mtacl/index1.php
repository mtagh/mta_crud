<?php

//connection CONNECTION
$conn = mysqli_connect("localhost", "root", "", "mta_00");

// GETT DATA or query from table
$result= mysqli_query($conn,"SELECT * FROM contacts");
//var_dump
//if (!$result){
//    echo mysqli_error($conn);
//}

// fetch data from object result
// mysqli_fetch_row()
// mysqli_fetch_assoc()
// mysqli_fetch_array()
// mysqli_fetch_object()

// ------row > array numeric
// $c1=mysqli_fetch_row($result);
// var_dump($c1[1]);
// var_dump($c1();
// ------- assoc> array associative
// $ct = mysqli_fetch_assoc($result);
// //var_dump($ct);
// var_dump($ct["name"]);
// --------array > array both numeric and associative 
// $ct = mysqli_fetch_array($result);
// //var_dump($ct);
// var_dump($ct["name"]);
// /// --------object > use  "->" otherwise does not work
// $ct = mysqli_fetch_object($result);
// //var_dump($ct);
// var_dump($ct -> name);
// ------------

//LOOPING

// while ($ct=mysqli_fetch_assoc($result)) {
//     var_dump($ct);
//     // var_dump($ct["name"]);
// }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTA Contacts</title>
</head>
<body>
    <h1>MTA Contacts</h1>

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
<?php while ($rct = mysqli_fetch_assoc($result) ): ?> 
        <tr>

            <td><?=$i; ?></td>
            <td>
                <a href=">">Edit</a> 
                <a href=">">Delete</a> ||
            </td>
<!--gambar-->
            <!--<td><img src="img/mta.jpg" width="50"</td> -->
            <!--<td>Mohamad Toha</td>-->
            <!--<td>Universitas Terbuka</td>-->
            <!--<td>toha@ecampus.ut.ac.id</td>-->
            <!--<td>0877743272727</td>-->
            <!--<td>Role</td>-->
            <!--<td>Clean</td>-->

            <!--<td><img src="img/<?php echo $rct["picture"]; ?>" width="50"</td> -->
            <td><img src="img/<?=$rct["picture"]; ?>" width="50" </td>
            <td><?=$rct["name"];?></td>
            <td><?=$rct["institution"];?></td>
            <td><?=$rct["email"];?></td>
            <td><?=$rct["phone" ];?></td>
            <td><?=$rct["role"]; ?></td>
            <td><?=$rct["notes"]; ?></td>

        </tr>
        <?php $i++; ?>
<?php endwhile; ?>

    </table>





</body>
</html>