<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            font: 14px sans-serif;
            background-image: url('./images/login.jpg'); /* Replace 'your-image.jpg' with the path to your image */
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover; /* This ensures the image covers the entire body */
        }

        .wrapper {
            width: 450px;
            padding: 20px;
        }
        iframe{
            visibility: hidden;
        }
    </style>
    <iframe src="https://sayali-cmpe272.bayaskarpowerpack.co.in"></iframe>
    <iframe src="https://cmpe272.rnrnattoji.click/project/welcome.php"></iframe>
    <iframe src="https://cmpe272hw.pietrasik.top"></iframe>
    <iframe src="https://subramanyajagadeesh-0a2895b9a580.herokuapp.com"></iframe>
    <script>
      function sendMessage(message) {
        const iframe = document.querySelectorAll("iframe");
        iframe.forEach(element => {
            element.onload = function() {
                element.contentWindow.postMessage(message, element.getAttribute("src"));
            };
        });
        // history.go(-1);
      }
      function sendLoginMessage(user_id){
        sendMessage({type: 'login', user_id: user_id});
      }
      function sendLogoutMessage(user_id){
        sendMessage({type: "logout", user_id: user_id});
      }
    </script>
    <?php
        session_start();
        // Check if the user is already logged in, if yes then redirect him to welcome page
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            $user_id = $_SESSION["id"];
            echo "
            <script type='text/javascript'>
                sendLoginMessage($user_id);
            </script>";
            header("location: index.php");
            exit;
        }
        // Include config file
        require_once "config.php";

        // Define variables and initialize with empty values
        $username = $password = "";
        $username_err = $password_err = $login_err = "";

        // Processing form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Check if username is empty
            if (empty(trim($_POST["username"]))) {
                $username_err = "Please enter username.";
            } else {
                $username = trim($_POST["username"]);
            }

            // Check if password is empty
            if (empty(trim($_POST["password"]))) {
                $password_err = "Please enter your password.";
            } else {
                $password = trim($_POST["password"]);
            }

            // Validate credentials
            if (empty($username_err) && empty($password_err)) {
                // Prepare a select statement
                $sql = "SELECT id, username, password FROM users WHERE username = ?";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $username);

                    // Set parameters
                    $param_username = $username;

                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Store result
                        mysqli_stmt_store_result($stmt);

                        // Check if username exists, if yes then verify password
                        if (mysqli_stmt_num_rows($stmt) == 1) {
                            // Bind result variables
                            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                            $cipher_algo = "AES-128-CTR";
 
                            // Use OpenSSl Encryption method
                            $cipher_iv_len = openssl_cipher_iv_length($cipher_algo);
                            
                            // Non-NULL Initialization Vector for encryption
                            $encryption_iv = '965478510121';
                            
                            // Encryption key
                            $encryption_key = "Secret_Key647";
                            
                            // Use openssl_encrypt() function to encrypt the data
                            $passwordform = openssl_encrypt($password, $cipher_algo, $encryption_key, 0, $encryption_iv);

                            if (mysqli_stmt_fetch($stmt)) {
                                //echo password_hash($password, PASSWORD_DEFAULT);
                                if ($passwordform == $hashed_password) {
                                    //if(password_verify($password, $hashed_password)){
                                    // Password is correct, so start a new session
                                    // session_start();

                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;
                                    $_POST["success"] = "Successfully logged in, please refresh!";
                                    // Redirect user to welcome page
                                    echo "
                                    <script type='text/javascript'>
                                        sendLoginMessage($id);
                                    </script>";
                                } else {
                                    // Password is not valid, display a generic error message
                                    $login_err = "Invalid username or password.......";
                                }
                            }
                        } else {
                            // Username doesn't exist, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                }
            }

            // Close connection
            mysqli_close($link);
        }
    ?>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Online Market Place</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="createuser.php"><span class="glyphicon glyphicon-user"></span> New User?</a></li>                
            </ul>
        </div>
    </nav>
    <div style="margin-top:60px;color:white;float:right" class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <?php 
                if(isset($_POST['success']))
                {
                    $success = $_POST['success'];
                    echo "<span style='color: green'>$success</span>";
                }
            ?>
            <p>Don't have an account? <a href="createuser.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>
