<?php

if (isset($_POST['submit'])) {

    require_once("conn_fifa.php");

    $player_extended_name = $_POST['player_extended_name'];
    
    $query1 = "SELECT * FROM player_info WHERE player_extended_name = :player_extended_name LIMIT 1";

    $query = "CALL deletePlayer(:player_extended_name)"; 
    
    try {

      $prepared_stmt1 = $dbo->prepare($query1);
      $prepared_stmt1->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR);
      $prepared_stmt1->execute();
      $result1 = $prepared_stmt1->fetchAll();

      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR);
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

    <div class="wrapper">
      
      <form method="post">
          <input type="text" class= "input" name="player_extended_name" id="player_extended_name" placeholder=" Player's Full Name">

          <input type="submit" class="searchbtn" name="submit" value="Delete">
      </form>
    </div>

    <?php
      if (isset($_POST['submit'])) {
        if ($result1 && $prepared_stmt1->rowCount() > 0) { ?>
            <h2><?php echo $_POST['player_extended_name'];?> was successfully deleted!</h2>
        <?php } else { ?>

          <h2>Sorry, <?php echo $_POST['player_extended_name'];?> does not exist in the database</h2>
              
            
        <?php }
    } ?>


    
  </body>
</html>


