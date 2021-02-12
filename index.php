<?php
// INSERT INTO `entry` (`sno`, `Fname`, `Lname`, `mobile`, `tstamp`) VALUES (NULL, 'sachin', 'yadav', '7788524568', current_timestamp());
$insert = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "entry";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `entry` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Fname = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $mobile = $_POST["mobile"];

    $sql = "INSERT INTO `entry` (`Fname`,`Lname`,`mobile`) VALUE('$Fname','$Lname','$mobile')";
    $result = mysqli_query($conn,$sql);

    if($result){
        $insert = true;
    }
     else{
         echo "failed";
     }   
 
}
?>
<?php
if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Data has been inserted successfully
    <button type='button' class='btn-close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
?>
<?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your Data has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  
    <title>CRUD by Lokesh</title>
    
</head>

<body>

    <div class="container">
        <h2>Enter Your details</h2>
        <form action="index.php" method="post">
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" name="Fname" class="form-control" id="firstname" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" name="Lname" class="form-control" id="lastname">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile no.</label>
                <input type="number" name="mobile" class="form-control" id="mobile">
            </div>
            <button type="submit" class="btn btn-primary">Insert</button>
        </form><br>
    </div>
    <div class="container" >
       
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">First </th>
                    <th scope="col">Last</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
 
 $sql="SELECT * FROM `entry`";
 $result = mysqli_query($conn, $sql);
 $sno = 0;
 while($row = mysqli_fetch_assoc($result)){
    $sno = $sno + 1; 
    echo "   <tr>
     <th scope='row'>".$sno."</th>
     <td>".$row['Fname']."</td>
     <td>".$row['Lname']."</td>
     <td>".$row['mobile']."</td>
    
    <td> <a href=\"update.php?id=$row[sno]\"><input type='submit' value='edit'</a>  </td>
     
     
     <td><button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> </td>
 </tr>";
} 

        
 ?>
            </tbody>
        </table>
    </div>

    <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

   <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
       
       <!-- Edit -->
      
  
</body>

</html>