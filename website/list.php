<?php include "header.html" ?>
  <div class = "otheruserlist-container">
    <a href = "list.php" style="text-decoration: none !important; color: black;">
      <div id = "blendstation" class="otheruserlist">
        <p> Blend Station </p>
      </div>
    </a>
    <a href = "list.php?fn=StuffCo" style="text-decoration: none !important; color: black;">
    <div id = "stuffco" class="otheruserlist">
      <p> StuffCo </p>
    </div>
    </a>
    <a href = "list.php?fn=RNRElektronics" style="text-decoration: none !important; color: black;">
    <div  id = "rnre" class="otheruserlist">
      <p> RNR Elektronics </p>
    </div>
    </a>
    <a href = "list.php?fn=Student Furniture Spot" style="text-decoration: none !important; color: black;" >
    <div  id = "sfs" class="otheruserlist">
      <p> Student Furniture Spot </p>
    </div>
    </a>
  </div>

  <?php
    if($_GET["fn"]){
      //$firstname= first_name;
      //$lastname= last_name;
      if ($_GET["fn"]=="RNRElektronics"){
          $ch = curl_init("http://cmpe272.rnrnattoji.click/assignment-4/exposecontacts.php");
          //$firstname= firstname;
          //$lastname= lastname;
        }
      else if ($_GET["fn"]=="StuffCo"){
          $ch = curl_init("https://cmpe272hw.pietrasik.top/user_list.php");
      }
      else if ($_GET["fn"]=="Student Furniture Spot"){
        $ch = curl_init("https://subramanyajagadeesh-0a2895b9a580.herokuapp.com/exposed_users.php");
      }
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  if (curl_exec($ch) === FALSE) {
   		  echo "Curl Failed: " . curl_error($ch);
		  die();
	  } else {
		  $contents = curl_exec ($ch);
		  $obj = json_decode($contents);

		  echo '<div class="list">';
		  echo '<div class="head">';
		  echo '<h1>'.$_GET["fn"].' User List</h1>';
		  echo '<hr>';
		  echo '</div>';
		  echo '<section style = "padding: 5px 15px 15px 15px;">';
		  if (count($obj) > 0) {
			$i=0;
			echo '<ul>';
			while($i<count($obj)) {
			  echo '<li>';
        //echo '<span>'. $obj[$i]->$firstname.' '.$obj[$i]->$lastname .'</span>';
			  print_r($obj[$i]);
			  echo '<i class="fa fa-angle-right"></i>';
			  echo '</li>';
			  $i++;
			}
			echo '</ul>';
		  }
		  echo '</section>';
		  echo '</div>';
	  }
      curl_close($ch);
    }
    else{
      include "users.php";
    }
  ?>

<?php include "footer.html" ?>