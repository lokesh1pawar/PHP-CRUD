<?php
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "entry";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if(isset($_POST['update']))
{
    $sno = $_POST['snoEdit'];
    $Fname = $_POST['Fnameedit'];
    $Lname = $_POST['Lnameedit'];
    $mobile = $_POST['mobileedit'];

$sql = " UPDATE `entry` SET `Fname` ='$Fname',`Lname` ='$Lname',`mobile` ='$mobile' WHERE `entry`.`sno` = '$sno'";

    $result = mysqli_query($conn,$sql);


    if($result)
    {
        echo "Data update succsesfully";
    }
    else
    {
        echo "Failed";
    }
}
// }

// SET `Fname`=[Fname],`Lname`=[Lname], `mobile`=[mobile] 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<style>
    body{
        background-color: aliceblue;
        text-align: center;

    }
    form{
        justify-content: center;
        text-align: center;
        margin: 50px;
        padding: 50px;
        font-size: large;
        
    }
    input{
        font-size: larger;
        margin: 5px; 
        
    }
</style>
<body>
    <div class="container">
        
            <h2>Update of data</h2>

        <form action="update.php" method="POST">

            <input type="text" name="snoEdit" placeholder="Sno"><br>
            <input type="text" name="Fnameedit" placeholder="First name"><br>
            <input type="text" name="Lnameedit" placeholder="Last name"><br>
            <input type="number" name="mobileedit" placeholder="mobile"><br>
            <input type="submit" name="update" value="update">

        </form>    
        
</body>
    </div>
</html>