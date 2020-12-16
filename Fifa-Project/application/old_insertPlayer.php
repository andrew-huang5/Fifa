<?php

if (isset($_POST['submit'])) {

    require_once("conn_fifa.php");

    $player_extended_name = $_POST['player_extended_name'];

    $query = "CALL insertPlayer(:player_extended_name)"; //added this in
    
    $query1 = "SELECT * FROM mega_fifa WHERE player_extended_name = :player_extended_name";
    
    try {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR);
      $prepared_stmt->execute();
      $result = $prepared_stmt->fetchAll();

      $prepared_stmt1 = $dbo->prepare($query1);
      $prepared_stmt1->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR);
      $prepared_stmt1->execute();
      $result1 = $prepared_stmt1->fetchAll();
    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }

    try {
      $prepared_stmt1 = $dbo->prepare($query1);
      $prepared_stmt1->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR);
      $prepared_stmt1->execute();
      $result1 = $prepared_stmt1->fetchAll();
    }
    catch (PDOException $ex)
    { // Error in database processing.
      echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
    }
    
}

?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="project.css" />
  </head> 

  <body>
    <div id="navbar">
      <ul>
        <li><a href="index_fifa.html">Home</a></li>
        <li><a href="getPlayer01.php">Search Player</a></li>
        <li><a href="insertPlayer01.php">insert Player</a></li>
      </ul>
    </div>
    
    <h1> insert a Player </h1>

    <form method="post">

      <label for="player_extended_name">Name of player</label>
      <input type="text" name="player_extended_name" id="player_extended_name">
      
      <input type="submit" name="submit" value="Insert Player">
    </form>

    <?php
      if (isset($_POST['submit'])) {
        if ($result1 && $prepared_stmt1->rowCount() > 0) { ?>
          Sorry, <?php echo $_POST['player_extended_name'];?> is already in the database. Would you like to add a new overall score
          for <?php echo $_POST['player_extended_name'];?>? Here are his current stats:
            
            <h2>Results</h2>

              <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Player Name</th>
                    <th>Player's Overall Score</th>
                    <th>Player's Added Date</th>
                    <th>Player's Club</th>
                  </tr>
                </thead>
                <tbody>
            
                  <?php foreach ($result1 as $row) { ?>
                
                    <tr>
                      <td><?php echo $row["futbin_id"]; ?></td>
                      <td><?php echo $row["player_extended_name"]; ?></td>
                      <td><?php echo $row["overall"]; ?></td>
                      <td><?php echo $row["revision"]; ?></td>
                      <td><?php echo $row["club"]; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>

          <form method="post">

            <label for="overall"></label>
            <input type="text" name="overall" id="overall">
            
            <input type="submit" name="submit" value="Update Overall Score">
            <input type="submit" name="no_submit" value="Do not update">
          </form>

          <?php if (isset($_POST['submit'])) {


              $query2 = "CALL updatePlayer(:player_extended_name, :overall)"; //added this in

                try {
                  $prepared_stmt2 = $dbo->prepare($query2);
                  $prepared_stmt2->bindValue(':overall', $overall, PDO::PARAM_STR);
                  $prepared_stmt2->bindValue(':player_extended_name', $player_extended_name, PDO::PARAM_STR);
                  $prepared_stmt2->execute();
                  $result2 = $prepared_stmt2->fetchAll();
                }
                catch (PDOException $ex)
                { // Error in database processing.
                  echo $sql . "<br>" . $error->getMessage(); // HTTP 500 - Internal Server Error
                }

          }?>
  
        <?php } else { ?>
              <?php echo $_POST['player_extended_name'];?> was successfully added!
        <?php }
    } ?>


    
  </body>
</html>


