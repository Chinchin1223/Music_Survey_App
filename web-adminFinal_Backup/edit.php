<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <title>Survey Admin</title>
</head>

<?php 
  $hostname="localhost";
  $username="root";
  $password="";
  $dbname="db_survey";
  $openconnection=mysqli_connect($hostname, $username, $password, $dbname);
  if (!$openconnection)
  {
    die("Failed to establish connection".mysqli_connect_error());
  }

  // This will be used to grab all the variables needed. Get will always be set when on this page.
  if(isset($_GET['edit'])){
    // Since the GET is the ID of it anyway. We can just do it like this.
    $ID = $_GET['edit'];
    // Getting stuff from database.
    $edit = mysqli_query($openconnection, "SELECT * FROM tbl_survey WHERE ID = " . $_GET['edit']);
    // Storing content in database.
    $row = mysqli_fetch_assoc($edit);
  } else {
    header('location: index.php');
  }

  // Update Query
  if(isset($_POST['update_button'])){
    $FavoriteArtist = $_POST['FavoriteArtist'];
    $OnlinePlatforms = $_POST['OnlinePlatforms'];
    $Mood = $_POST['Mood'];
    $Genre = $_POST['Genre'];

    mysqli_query($openconnection, "UPDATE tbl_survey
     SET FavoriteArtist = '$FavoriteArtist' , OnlinePlatforms = '$OnlinePlatforms' , Mood = '$Mood' , Genre = '$Genre' WHERE ID='$ID'") or die();
 
  } else {
    header("location: edit.php");
}
?>
<body>
<h2>Edit Survey Form</h2>
<form action="edit" method="POST">
  <div class="col-sm-6">
  
  <label for="FavoriteArtist">Favorite artist:</label><br>
  <input type="text" id="floatingInput" name="FavoriteArtist" value="<?php echo $row['FavoriteArtist'];?>"><br><br>

  <label for="OnlinePlatforms">Online Platform:</label><br>
  <input type="text" id="floatingInput" value="<?php echo $row['FavoriteArtist'];?>" name="OnlinePlatforms"><br><br>

  <label for="Mood">Mood:</label><br>
  <input type="text" id="floatingInput" value="<?php echo $row['Mood'];?>" name="Mood"><br><br>

  <label for="Genre">Genre:</label><br>
  <input type="text"id="floatingInput"  value="<?php echo $row['Genre'];?>" name="Genre"><br><br>
  
  <input type="submit" name="update_button" value="Update"></button>
  <a href="index.php"> <input value = "Back" name="back_button" type="button"/></a>
</form>
</body>
</html>