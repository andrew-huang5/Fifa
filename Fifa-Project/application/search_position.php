<?php

if (isset($_POST['submit'])) { 

    require_once("conn_fifa.php"); //include the connection file, so the db connection is made at this line

    $player_extended_name = $_POST['player_extended_name']; //this gets the player name (captures that text) and puts it into that submit

    $query =  "SELECT * FROM Player_position WHERE position ______";  //secure way to sanitize the value stored in the player_extended_name

try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR); //replaces
      $prepared_stmt->execute(); //execute that statement above
      $result = $prepared_stmt->fetchAll(); //whatever result occurs from execution, store in this vairbale

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


    <div class="wrapperPrice">
      
      <form action="action_page.php" method="POST">
        <label for="cars">Select a Position:</label>
        <select name="selectedPage">
          <option value="CB">CB</option>
          <option value="RB">RB</option>
          <option value="LB">LB</option>
          <option value="RWB">RWB</option>
          <option value="LWB">LWB</option>
          <option value="CDM">CDM</option>
          <option value="CM">CM</option>
          <option value="RM">RM</option>
          <option value="LM">LM</option>
          <option value="CAM">CAM</option>
          <option value="CF">CF</option>
          <option value="RF">RF</option>
          <option value="LF">LF</option>
          <option value="RW">RW</option>
          <option value="LW">LW</option>
          <option value="ST">ST</option>
        </select>

        <input type="submit" class="searchbtn" name="submit" value="Search">

      </form>
    </div>

    <?php
      if (isset($_POST['submit'])) {
        if ($result && $prepared_stmt->rowCount() > 0) { ?>
    
              <h2><?php echo $_POST['player_extended_name'];?>'s Stats (multiple rows means player was updated many times)</h2>

              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Player's Pace</th>
                    <th>Player's Dribbling</th>
                    <th>Player's Shooting</th>
                    <th>Player's Passing</th>
                    <th>Player's Defending</th>
                  </tr>
                </thead>
                <tbody>
            
                  <?php foreach ($result as $row) { ?>
                
                    <tr>
                      <td><?php echo $row["futbin_id"]; ?></td>
                      <td><?php echo $row["pace"]; ?></td>
                      <td><?php echo $row["dribbling"]; ?></td>
                      <td><?php echo $row["shooting"]; ?></td>
                      <td><?php echo $row["passing"]; ?></td>
                      <td><?php echo $row["defending"]; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
  
        <?php } else { ?>
          <h2>Sorry, <?php echo $_POST['player_extended_name'];?> is not in the database </h2>
        <?php }
    } ?>


    
  </body>
</html>






