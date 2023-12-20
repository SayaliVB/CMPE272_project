<ul class="nav navbar-nav navbar-right">
  <?php 
      session_start();

      // Check if the user is already logged in, if yes then redirect him to welcome page
      if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
          $user_id = $_SESSION["id"];
          echo "
          <script type='text/javascript'>
              sendLoginMessage($user_id);
          </script>";
          $username = $_SESSION["username"];
          echo "
            <li><a href='#'><span class='glyphicon glyphicon-user'>$username</span></a></li>
          ";
      }
      else{
          echo "
            <li><a href='createuser.php'><span class='glyphicon glyphicon-user'>New User?</span></a></li>
            <li><a href='login.php'><span class='glyphicon glyphicon-log-in'></span> Existing User?</a></li>
          ";
      }
  ?>
  <li><a href='top_products_marketplace.php'><span class='glyphicon glyphicon-log-in'></span> Top Products Marketplace</a></li>
  <li><a href='top_products_individual.php'><span class='glyphicon glyphicon-log-in'></span> Top Products Individual</a></li>
</ul>