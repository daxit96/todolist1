<?php
$insert = false;
$update = false;
$delete = false;
// connect to database 
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "inotes";
 

 $conn =mysqli_connect($servername,$username,$password,$database);

 if(!$conn)
 {
   die("Sorry we failed to connect: ". mysqli_connect_error());
 }
// echo $_POST['snoEdit'];
// echo $_GET['update'];
// exit;

if(isset($_GET['delete']))
{
  $sno = $_GET['delete'];
  $delete = true;
 $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = '$sno'";
 $result = mysqli_query($conn,$sql);
}




if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
   if(isset($_POST['snoEdit'])){
    //  echo "Yes";
     $title = $_POST["titleEdit"];
     $sno = $_POST["snoEdit"];
     $discription = $_POST["discriptionEdit"];
     
     $sql = "UPDATE `notes` SET `title` = '$title' , `discription` = '$discription' WHERE `notes`.`sno` = $sno";
     $result = mysqli_query($conn,$sql);
     if($result)
     {
       $update = true;
     }
     else{
       echo "not updated";
     }
   }
   else{

   
  $title = $_POST["title"];
  $discription = $_POST["discription"];

  $sql = "INSERT INTO `notes` (`title`, `discription`, `timestamp`) VALUES ('$title', '$discription', current_timestamp())";
  $result = mysqli_query($conn,$sql);
  if($result)
  {
    $insert = true;
  }
  else{
    echo "not inserted ";
  }}

 }


?>

     

 <!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  
  <title>INOTES - Makes notes taking easy</title>
  

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">



</head>

<body>


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/CRUD/index.php" method="POST">
      <input type="hidden" name ="snoEdit" id="snoEdit">
      <div class="mb-3 my-4">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
      </div>
      <div class="mb-3 my-4">

        <label class="desc">Note Description</label>
      </div>
      <div class="input-group">

        <textarea class="form-control" id="discriptionEdit" name="discriptionEdit" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-4">Update Note</button>
    </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">INOTES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>

        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

<?php
if($insert)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been inserted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

if($delete)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been deleted successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
if($update)
{
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Success!</strong> Your note has been updated successfully.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

?>


  <div class="container my-4">
    <h2>Add a note</h2>
    <form action="/CRUD/index.php" method="POST">
      <div class="mb-3 my-4">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="mb-3 my-4">

        <label class="desc">Note Description</label>
      </div>
      <div class="input-group">

        <textarea class="form-control" id="discription" name="discription" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-4">Add Note</button>
    </form>
    </div>
    <div class="container">
      
    <table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php

      $sql = "SELECT * FROM `notes`";
      $result = mysqli_query($conn,$sql);
      while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <th scope='row'>". $row['sno']. "</th>
        <td>". $row['title']. "</td>
        <td>". $row['discription'] ."</td>
        <td> <button class='edit btn btn-sm btn-primary' id =".$row['sno'].">Edit</button>   <button class=' btn btn-sm btn-primary delete'id =d".$row['sno'].">Delete</button> </td>
        </tr>";
        
      }

      ?>


      
    </tbody>
</table>
      
    </div>
  


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  
<script>

$(document).ready( function () {
    $('#table').DataTable();
} );

</script>
<script>
edits = document.getElementsByClassName('edit');
Array.from(edits).forEach((element)=> {
  element.addEventListener("click",(e)=>{
      console.log("edit",);
      tr = e.target.parentNode.parentNode;
      title = tr.getElementsByTagName("td")[0].innerText;
      description = tr.getElementsByTagName("td")[1].innerText;
      console.log(title,description);
      discriptionEdit.value = description;
      titleEdit.value = title;
      snoEdit.value= e.target.id;
      console.log(e.target.id);
      $('#editModal').modal('toggle');
        


  });
})

Delete = document.getElementsByClassName('delete');
Array.from(Delete).forEach((element)=> {
  element.addEventListener("click",(e)=>{
      console.log("edit",);
      sno = e.target.id.substr(1,);
      
     if(confirm("Do you want to delete the note?")){
       console.log("Yes");
       
       window.location = `/crud/index.php?delete=${sno}`;
      }
      else{
        console.log("No");
      }

  });
})



</script>



  <!-- Option 2: Separate Po  pper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
</body>

</html>