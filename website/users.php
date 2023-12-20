<div class="list">
  <div class="head">
    <h1>Blend Station User List</h1>
    <hr>
  </div>
  <ul>
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

      $sql = "SELECT firstname, lastname FROM users";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<li>';
          echo '<span>'. $row["firstname"].' '.$row["lastname"] .'</span>';
          echo '<i class="fa fa-angle-right"></i>';
          echo '</li>';
        }
      }
      $conn->close();
    ?>
  </ul>
  </div>  
