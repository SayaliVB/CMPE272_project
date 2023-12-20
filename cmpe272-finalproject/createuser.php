<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blend Station</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>

  <div class="bg-img">
    <div class="container">
      <a href="index.php">
      <img src = "letterT.png" style="width:180px;height:120px;"/>
     </a>
    </div>
    <div class="topnav">
          <a href="about.php">About</a>
          <a href="products.php">Products</a>
          <a href="cart.php">View Cart</a>
          <a href="orders.php">My Orders</a>
          <a href="contact.php">Contact</a>
          <a href="news.php">News</a>
      </div>
  </div>

<div class = "otheruserlist-container">
   
</div>

<form class="userforms" id="userform" method="post" style = "padding-left: 3%;"
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h1>Create User</h1>
        
    <table border="0" cellpadding="4" cellspacing="4"> 
            <tr align="left"> 
                <td><p> Firstname </p></td>
                <td><input type="text" id="firstname" name="firstname" required placeholder="Firstname"></td>
            </tr>
    
            <tr align="left"> 
                <td><p> Lastname </p></td>
                <td><input type="text" id="lastname" name="lastname" required placeholder="Lastname"> </td>
            </tr>
                
            <tr align="left"> 
                <td><p> Mobile </p></td>
                <td><input type="text" id="mobile" name="mobile" pattern="[0-9]{10}" maxlength="10" required placeholder="Mobile"> </td>
            </tr>
                
            <tr align="left"> 
                <td><p> Landline </p></td>
                <td><input type="text" id="phone_no" name="phone_no" pattern="[0-9]{10}" maxlength="10" placeholder="Phone Number"> </td>
            </tr>
                
            <tr align="left"> 
                <td><p> Email </p></td>
                <td><input type="email" id="email" name="email" required placeholder="Email"> </td>
            </tr>
                
            <tr align="left"> 
                <td><p> Username </p></td>
                <td><input type="text" id="username" name="username" placeholder="Username"> </td>
            </tr>

            <tr align="left"> 
                <td><p> Password </p></td>
                <td><input type="password" id="password" name="password" required placeholder="Password"> </td>
            </tr>
                    
            <tr align="left"> 
                <td><p> Address </p></td>
                <td><input id="address" name="address" placeholder="Address"></td>
            </tr>
    </table> 
    
    <button type="submit" id="addDetails">Create Account</button><br><br>
</form>




<?php
$message = "";
$fname = $lname = $mobile = $landline = $email = $usernameform = $passwordform = $address = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = test_input($_POST["firstname"]);
    $lname = test_input($_POST["lastname"]);
    $mobile = test_input($_POST["mobile"]);
    if (empty($_POST["phone_no"])) {
        $landline = "";
    } else {
        $landline = test_input($_POST["phone_no"]);
    }
    $email = test_input($_POST["email"]);
    if (empty($_POST["username"])) {
        $usernameform = $email;
    } else {
        $usernameform = test_input($_POST["username"]);
    }

    //password encryption
    $cipher_algo = "AES-128-CTR";
 
    // Use OpenSSl Encryption method
    $cipher_iv_len = openssl_cipher_iv_length($cipher_algo);
    
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '965478510121';
    
    // Encryption key
    $encryption_key = "Secret_Key647";
    
    // Use openssl_encrypt() function to encrypt the data
    $passwordform = openssl_encrypt(test_input($_POST["password"]), $cipher_algo, $encryption_key, 0, $encryption_iv);

    if (empty($_POST["address"])) {
        $address = "";
    } else {
        $address = test_input($_POST["address"]);
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

    $sql = "INSERT INTO users (firstname, lastname, email, address, homephone, cellphone, username, password)
    VALUES ('".$fname."', '".$lname."', '".$email."', '".$address."', '".$landline."', '".$mobile."', '".$usernameform."', '".$passwordform."')";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        $message = "New record created successfully!!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    echo '<script type="text/javascript">',
     'document.getElementById("userform").style.display = "none";',
     '</script>'
    ;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div id = "result" style="font-size: 25px;text-align: center;" class = "list">
    <?php echo '<p>'. $message .'</p>'; ?>
</div>

<?php
if($message == ""){
    echo '<script type="text/javascript">',
    'document.getElementById("result").style.display = "none";',
    '</script>'
   ;
}
?>

<footer>
         <p style="text-align:center; font-size:0.8em; color:aliceblue"> Copyright © 2023 | Marketplace</p>
      </footer>
   </body>
   </html>
   
