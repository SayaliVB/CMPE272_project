
    <?php include "header.html" ?>

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

          $sql = "SELECT id, img, name, price FROM products WHERE companyid = 1";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            echo '<div class = "carddiv">';
            echo '<div class = "card-container">';
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
          $conn->close();
        ?>
      </div>
    </div>

    <?php include "footer.html" ?>
