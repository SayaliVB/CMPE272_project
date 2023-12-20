<?php
  $lastvisited = array();
  $frequentyvisited = array();

  foreach( $_COOKIE as $key=>$value){
    $pieces = explode(",", $value);
    $lastvisited[$key]=$pieces[1];
    $frequentyvisited[$key]=$pieces[0];
  }
  arsort($lastvisited);
  arsort($frequentyvisited);
  $lastvisited = array_slice($lastvisited, 0, 5, true);
  $frequentyvisited = array_slice($frequentyvisited, 0, 5, true);
?>
  <?php include "header.html" ?>
    <div class="display-about">
    <img src="images/leafTea.jpg" style="width:100%"/>
    <div class="dialog">
    <p class = "decription">Best Quality Products</p>
    <p class ="heading">Join The Tea Movement!</p>
    <p class = "tastenote">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
    </div>
    </div>

  <div style="margin-top:10px;">
      <div>
        <?php
          require_once('db_login.php');
          define("DB_SERVER", $servername);
          define("DB_USER", $username);
          define("DB_PASS", $password);
          define("DB_NAME", $dbname);
          
          // Create connection
          $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          echo '<div>';
          echo '<p class="inpageheading"> Previously visited products</p>';
          $id_array = implode(',', array_map('intval', array_keys($lastvisited)));
          $sql = 'SELECT * FROM products WHERE id IN (' . $id_array . ')  order by FIELD(id,' . $id_array . ')';
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            echo '<div class = "carddiv">';
            echo '<div class = "card-container-index">';
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo '<a href = "product.php?id='.$row['id'].'"><div class="card">';
              echo '<img src="images/'.$row["img"].'" style="width:100%"/>';
              echo '<h3>'.$row["name"].'</h3>';
              echo '<p class = "price">'.$row["price"].'</p>';
              echo '</div></a>';
            }
            echo '</div>';
            echo '</div>';
          }
          echo '</div>';

          echo '<div>';
          echo '<p  class="inpageheading"> Frequently visited products</p>';
          $id_array = implode(',', array_map('intval', array_keys($frequentyvisited)));
          $sql = 'SELECT * FROM products WHERE id IN (' . $id_array . ') ORDER BY FIELD (id,' . $id_array . ')';
          $result = $conn->query($sql); 

          if ($result->num_rows > 0) {
            echo '<div class = "carddiv">';
            echo '<div class = "card-container-index">';
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo '<a href = "product.php?id='.$row['id'].'"><div class="card">';
              echo '<img src="images/'.$row["img"].'" style="width:100%"/>';
              echo '<h3>'.$row["name"].'</h3>';
              echo '<p class = "price">'.$row["price"].'</p>';
              echo '</div></a>';
            }
            echo '</div>';
            echo '</div>';
          }
          echo '</div>';

          $conn->close();
          ?>

  
    </div>
  </div>
  <?php include "footer.html" ?>
