<?php

if (isset($_POST['submit'])) { 

    require_once("conn_fifa.php"); //include the connection file, so the db connection is made at this line

    $range1 = $_POST['range1'];
    $range2 = $_POST['range2']; //this gets the player name (captures that text) and puts it into that submit

    $query = "CALL searchPlayerPrices(:range1,:range2)";  //secure way to sanitize the value stored in the player_extended_name

try
    {
      $prepared_stmt = $dbo->prepare($query);
      $prepared_stmt->bindValue(':range1', $range1, PDO::PARAM_STR); //replaces
      $prepared_stmt->bindValue(':range2', $range2, PDO::PARAM_STR); //replaces
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
      
      <form method="post">

          <input type="text" class= "input" name="range1" id="range1" placeholder="Low Range">
          <label>to</label>
          <input type="text" class= "input" name="range2" id="range2" placeholder="High Range">

       <input type="submit" class="searchbtn" name="submit" value="Search">
      </form>
    </div>

    <?php
      if (isset($_POST['submit'])) {
        if ($result && $prepared_stmt->rowCount() > 0) { ?>
    
              <h2>This is the count of all players prices falling between <?php echo $_POST['range1'];?> and <?php echo $_POST['range2'];?></h2>

              <table>
                <thead>
                  <tr>
                    <th>Counsel Type</th>
                    <th>PS4</th>
                    <th>Xbox</th>
                    <th>PC</th>
                  </tr>
                </thead>
                <tbody>
            
                  <?php foreach ($result as $row) { ?>
                
                    <tr>
                      <td>Total Count</td>
                      <td><?php echo $row["ps4"]; ?></td>
                      <td><?php echo $row["xbox"]; ?></td>
                      <td><?php echo $row["pc"]; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
  
        <?php } else { ?>
          <h2>Sorry, no player prices fall within that range </h2>
        <?php }
    } ?>


    
  </body>
</html>






