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
    // Update Query
  if(isset($_POST['update_button']))
  {
        $ID = $_POST['edit'];
        $FavoriteArtist = $_POST['FavoriteArtist'];
        $OnlinePlatforms = $_POST['OnlinePlatforms'];
        $Mood = $_POST['Mood'];
        $Genre = $_POST['Genre'];
  
        mysqli_query($openconnection, "UPDATE tbl_survey 
        SET FavoriteArtist = '$FavoriteArtist' , OnlinePlatforms = '$OnlinePlatforms', Mood = '$Mood', Genre = '$Genre' WHERE ID='$ID' ")
        or die(mysqli_error($openconnection));

        header("Location:./edit.php");
  }
      // Update Query
  
      // Deletion Query
    if(isset($_POST['delete_button']))
      {
            $ID = $_POST['ID'];
  
            mysqli_query($openconnection, "DELETE FROM tbl_survey WHERE ID = '$ID' ") or die(mysqli_error());
          
        
      }

?>

<body>

   <h1 style="color:white">Survey Responses</h1>
    <div class="col-sm-6">
        <table style="width: 100%">
          <tr>
            <th style="color:white">ID</th>
            <th style="color:white">Favorite Artist</th>
            <th style="color:white">Online Platform</th>
            <th style="color:white">Mood</th>
            <th style="color:white">Genre</th>
            <th style="color:white">Action</th>
          </tr>
      <?php
      $view_records=mysqli_query($openconnection,"SELECT * FROM tbl_survey");
      while($row=mysqli_fetch_assoc($view_records))
      {
        
      ?>
          <tr>
            <td style="color:white"><?php echo $row['ID'];?></td>
            <td style="color:white"><?php echo $row['FavoriteArtist'];?></td>
            <td style="color:white"><?php echo $row['OnlinePlatforms'];?></td>
            <td style="color:white"><?php echo $row['Mood'];?></td>
            <td style="color:white"><?php echo $row['Genre'];?></td>
            <td>
              <form method="POST">
                <input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
      
                <button type ="submit"  name="update_button" role ="button" href="edit.php?edit=<?php echo $row['ID'];?>">Edit</button>
                <input type="submit" name="delete_button" value="Delete" class="btn btn-link">
              </form>
            </td>
          </tr>
      <?php
      }
      ?>
      
        </table>
      <div>
      
      </div>

</body>
</html>