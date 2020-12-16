<?php

if (isset($_POST['submit'])) {

    require_once("conn_fifa.php");

    $player_extended_name = $_POST['player_extended_name'];

    $overall = $_POST['overall']; //this gets the player name (captures that text) and puts it into that submit
    
    $query1 = "SELECT * FROM player_info WHERE player_extended_name = :player_extended_name LIMIT 1";

    $query = "CALL insertPlayer(:player_extended_name,:overall)";  //secure way to sanitize the value stored in the player_extended_name
    
    try {

      $prepared_stmt1 = $dbo->prepare($query1);
      $prepared_stmt1->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR);
      $prepared_stmt1->execute();
      $result1 = $prepared_stmt1->fetchAll();

      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR);
      $prepared_stmt->bindValue(':overall', $overall, PDO::PARAM_STR);
      $prepared_stmt->execute();
      $result = $prepared_stmt->fetchAll();

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }

    try {

    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
    
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

    <div class="wrapperInsert">
      
      <form method="post">
          <label>Name</label>
          <input type="text" class= "input" name="player_extended_name" id="player_extended_name" placeholder="Name">
          <label>Overall</label>
          <input type="text" class= "input" name="overall" id="overall" placeholder="Score">

       <input type="submit" class="searchbtnIN" name="submit" value="Insert">
      </form>
    </div>

    <?php
      if (isset($_POST['submit'])) {
        if ($result1 && $prepared_stmt1->rowCount() > 0) { ?>
          <h3 class="insert"> Sorry, <?php echo $_POST['player_extended_name'];?> is already in the database. Here are his most current stats: </h3>
          

              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Player's Overall Score</th>
                    <th>Player's Nationality</th>
                    <th>Player's Position</th>
                    <th>Player's Club</th>
                  </tr>
                </thead>
                <tbody>
            
                  <?php foreach ($result1 as $row) { ?>
                
                    <tr>
                      <td><?php echo $row["futbin_id"]; ?></td>
                      <td><?php echo $row["overall"]; ?></td>
                      <td><?php echo $row["nationality"]; ?></td>
                      <td><?php echo $row["position"]; ?></td>
                      <td><?php echo $row["club"]; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
  
        <?php } else { ?>
              <h2 class="in"><?php echo $_POST['player_extended_name'];?> was successfully added!</h2>
        <?php }
    } ?>


    
  </body>
</html>


