<?php
require_once("conn_fifa.php"); //include the connection file, so the db connection is made at this line

$sql = "SHOW COLUMNS FROM player_position";

$conn=mysqli_connect("127.0.0.1","root","","fifa_db"); //might need to change based on localhost

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)){ 
    if (strtolower($_POST['selectedPage']) == $row['Field']) {
      $position = $_POST['selectedPage'];
      $position = strtolower($position);

      $query10 =  "CALL searchPosition(:position)";
    }
}

    try
    {
      $prepared_stmt = $dbo->prepare($query10);
      $prepared_stmt->bindValue(':position', $position, PDO::PARAM_STR); //replaces
      $prepared_stmt->execute(); //execute that statement above
      $result10 = $prepared_stmt->fetchAll(); //  whatever result occurs from execution, store in this vairbale

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
?>

<html>
  <head>
  <meta charset="UTF-8">
  <title>Search Box Design</title>
  <link rel="stylesheet" href="functionality.css">
  <link rel="stylesheet" href="project_fifa_new.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">

  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/grids-responsive-min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
</head>

  <body>

    <div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="index_fifa.html">FIFA 19 db</a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item pure-menu-selected"><a href="index_fifa.html" class="pure-menu-link">Home</a></li>
            <li class="pure-menu-item"><a href="getPlayer01.php" class="pure-menu-link">Search for a Player</a></li>
            <li class="pure-menu-item"><a href="insertPlayer01.php" class="pure-menu-link">Insert a Player</a></li>
            <li class="pure-menu-item"><a href="deletePlayer01.php" class="pure-menu-link">Delete a Player</a></li>
        </ul>
    </div>
  </div>

<table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Player's Name</th>
                    <th>Player's Quality</th>
                    <th>Player's Nationality</th>
                    <th>Player's Position</th>
                    <th>Player's Club</th>
                  </tr>
                </thead>
                <tbody>
            
                  <?php foreach ($result10 as $row) { ?>
                
                    <tr>
                      <td><?php echo $row["futbin_id"]; ?></td>
                      <td><?php echo $row["player_extended_name"]; ?></td>
                      <td><?php echo $row["quality"]; ?></td>
                      <td><?php echo $row["nationality"]; ?></td>
                      <td><?php echo $row["position"]; ?></td>
                      <td><?php echo $row["club"]; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>


    </body>
</html>