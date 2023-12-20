<?php include "header.html"; ?>

<div class = "otheruserlist-container">
    <a href = "createuser.php" style="text-decoration: none !important; color: black;">
      <div class="otheruserlist">
        <p> Create User </p>
      </div>
    </a>
    <a href = "searchuser.php" style="text-decoration: none !important; color: black;">
    <div class="otheruserlist">
      <p> Search User </p>
    </div>
    </a>
</div>


<form class = "userforms" id="searchuserform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
    <table border="0" cellpadding="10" cellspacing="10"> 
            <tr align="left"> 
                <td style="max-width: 400px;display: inline-block;">
                    <input type="text" name = "search" id = "search" placeholder="Search..">
                </td>
                <td><button type="submit">Submit</button></td>
            </tr>
    </table> 
    
</form>

<div class="userforms">
  <div>
    <h1>Blend Station User List</h1>
  </div>
  <table border="0" cellpadding="10" cellspacing="10">
    <tr>
        <td>Name</td>
        <td>Mobile</td>
        <td>Landline</td>
        <td>Email</td>
        <td>Username</td>
    </tr>
    <?php
      $message = "";
      $input = "";
      $cell = 0;
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = test_input($_POST["search"]);
        if (is_numeric($input)){
            $cell = $input;
        }
      }

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

      $sql = "SELECT * FROM users WHERE firstname LIKE '%".$input."%' OR lastname LIKE '%".$input."%' OR 
      email LIKE '%".$input."%'";
      if(is_numeric($input)){
        $sql = $sql . " OR cellphone = ".$cell." OR homephone = ".$cell."";
      }
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>'. $row["firstname"].' '.$row["lastname"] .'</td>';
          echo '<td>'. $row["cellphone"] .'</td>';
          if($row["homephone"] == 0){
            echo '<td> - </td>';
          }
          else{
            echo '<td>'. $row["homephone"] .'</td>';
          }
          echo '<td>'. $row["email"] .'</td>';
          echo '<td>'. $row["username"] .'</td>';
          echo '<i class="fa fa-angle-right"></i>';
          echo '</tr>';
        }
      }
      $conn->close();
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>
  </table>
  </div>

<?php include "footer.html" ?>