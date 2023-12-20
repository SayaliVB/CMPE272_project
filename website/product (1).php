<?php 
  $id = $_GET['id'];
  $frequency = 0;

  foreach( $_COOKIE as $key=>$value){
    $pieces = explode(",", $value);
    if($key == $id){
      $frequency = $pieces[0];
    }
  }
  if($frequency == 0){
    $data = "1,".time();
    setcookie($id, $data, time()+3600, '/'); //(60*60*24)
  }
  else{
    $data = $frequency + 1 . "," . time();
    setcookie($id, $data, time()+3600, '/');
  }

  
  //setcookie('user_id', 22, time()+3600, '/'); //(60*60*24)
  $userid = 0;
  if(isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
  }
?>
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
            echo "error";
            die("Connection failed: " . $conn->connect_error);
          }


          function display($id, $conn, $userid)
          {
            $ratin =0;
            if($_POST['star']=="star1"){
              $ratin = 1;
            }
            else if($_POST['star']=="star2"){
              $ratin = 2;
            }
            else if($_POST['star']=="star3"){
              $ratin = 3;
            }
            else if($_POST['star']=="star4"){
              $ratin = 4;
            }
            else if($_POST['star']=="star5"){
              $ratin = 5;
            }
            try {
            $sql = "INSERT INTO ratings(rating,	productid, userid, review) VALUES(".$ratin.", ".$id.", ".$userid.", '".$_POST['review']."')";
            
            $result = $conn->query($sql);
				$sql = "UPDATE product_details SET num_ratings = num_ratings+1 WHERE productid= ".$id;
            
              $result = $conn->query($sql);
              
              $sql = "UPDATE product_details SET rating = ((rating * (num_ratings-1))+".$ratin.")/num_ratings WHERE productid= ".$id;
              
              $result = $conn->query($sql);
			}
			 catch(Exception $e) {
				 $sql = "SELECT rating FROM ratings WHERE userid = ".$userid." AND productid= ".$id;
            
              $result = $conn->query($sql);
				 if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$old_rating = $row['rating'];
						
					}
				 }
				 $sql = "UPDATE product_details SET rating = (((rating-".$old_rating.") * (num_ratings-1))+".$ratin.")/num_ratings WHERE productid= ".$id;
              $result = $conn->query($sql);

              $sql = "UPDATE ratings SET rating = ".$ratin.", review='".$_POST['review']."' WHERE userid = ".$userid." AND productid= ".$id;
            
              $result = $conn->query($sql);
            }
              
            
          }
          function updatehits($id, $conn)
          {
            $sql = "UPDATE products SET hits = hits+1 WHERE id = ".$id;
            $result = $conn->query($sql);
          }
          if($_SERVER["REQUEST_METHOD"] == "POST")
          {
            if(isset($_POST["star"])){
              display($id, $conn, $userid);
            }
            else{
              echo "<p> Please select rating!</p>";
            }
          }
          else{
            updatehits($id, $conn);
          }

          $sql = "SELECT * FROM products INNER JOIN product_details ON products.id = product_details.productid WHERE id = ".$id."";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="display-product">';
                echo '<img src="images/'.$row["img"].'" style="width:100%"/>';
                echo '<div>';
                echo '<p class ="heading">'.$row["name"].'</p>';
                //get total ratings
                
                $global_one = "";
                $global_two = "";
                $global_three = "";
                $global_four = "";
                $global_five = "";
                if($row['rating']>1){
                  $global_one = "checked";
                }
                if($row['rating']>2){
                  $global_two = "checked";
                }
                if($row['rating']>3){
                  $global_three = "checked";
                }
                if($row['rating']>4){
                    $global_four = "checked";
                }
                if($row['rating']>4.5){
                  $global_five = "checked";
                }

                echo '<div class = "rating">';
                echo '<label>('.$row['num_ratings'].')</label>&ensp;';
                echo '<input type="radio" '.$global_five.' class="fa fa-star global_star" disabled></input>';
                echo '<input type="radio" '.$global_four.' class="fa fa-star global_star" disabled></input>';
                echo '<input type="radio" '.$global_three.' class="fa fa-star global_star" disabled></input>';
                echo '<input type="radio" '.$global_two.' class="fa fa-star global_star" disabled></input>';
                echo '<input type="radio" '.$global_one.' class="fa fa-star global_star" disabled></input>';
                echo '</div>';

                echo '<p class = "decription">'.$row["description"].'</p>';
                echo '<p class = "tastenote"> Aroma: '.$row["tastingnotesaroma"].'</p>';
                echo '<p class = "tastenote"> Flavor: '.$row["tastingnotesflavor"].'</p>';
                echo '<p class = "tastenote"> Infusion: '.$row["tastingnotesinfusion"].'</p>';
                echo '<p class = "price"> $'.$row["price"].' for 1.5 oz</p><br><br>';
                echo '<p>Rate product?</p>';
                echo '<form action= "product.php?id='.$row['id'].'"  method="post" >';
                echo '<div class = "rating">';
                
                //CHECK IF USER ALREADY wrote a review
                $one = "";
                $two = "";
                $three = "";
                $four = "";
                $five = "";
                if($userid!=0) {
                  $sql = "SELECT rating, review FROM ratings WHERE productid = ".$id." AND userid = ".$userid."";
                  
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    
                    
                    switch($row['rating']){

                      case 1:
                        $one = "checked";
                        break;
                      case 2:
                        $two = "checked";
                        break;
                      case 3:
                        $three = "checked";
                        break;
                      case 4:
                        $four = "checked";
                        break;
                      case 5:
                        $five = "checked";
                        break;
                    }
                    $reviewtext = $row['review'];
                  }
                }
                //flex-direction = opposite
                echo '<input type="radio" '.$five.' class="fa fa-star star_background" value="star5" name = "star" onclick="getCookie()"></input>';
                echo '<input type="radio" '.$four.' class="fa fa-star star_background" value="star4" name = "star" onclick="getCookie()"></input>';
                echo '<input type="radio" '.$three.' class="fa fa-star star_background" value="star3" name = "star" onclick="getCookie()"></input>';
                echo '<input type="radio" '.$two.' class="fa fa-star star_background" value="star2" name = "star" onclick="getCookie()"></input>';
                echo '<input type="radio" '.$one.' class="fa fa-star star_background" value="star1" name = "star" onclick="getCookie()"></input>';
                echo '</div>';
                echo '<textarea id="review" name="review" rows="3" cols="50" onclick="getCookie()">'.$reviewtext.'</textarea>';
                //echo '<button type="button" value="reset" onclick="resetButton()">Reset review</button>';
                echo '<button type="submit" value="submit">Submit review</button>';

                echo '</form>';
                echo '</div>';
                echo '</div>';
            }
          }
          
              
          $conn->close();

        ?>
      </div>
    </div>

    <?php include "footer.html" ?>

