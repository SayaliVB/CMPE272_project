<!-- product.php -->

<?php 
  $id = $_GET['id'];
  $frequency = 0;
  $count =0;
  $min = time();
  $unsetcookie =0;

  echo count($_COOKIE);
  foreach( $_COOKIE as $key=>$value){
    echo "key: ";
    echo $key . " || " . $value;
    $pieces = explode(",", $value);
    if($key == $id){
      $frequency = $pieces[0];
    }
    if($min>$pieces[1]){
        $min = $pieces[1];
        $unsetcookie = $key;
    }
    $count++;
  }
  echo "<br> count:";
  echo $count;
  echo "<br> frequency:";
  echo $frequency;
  if($frequency == 0){
    if($count == 5){
      echo "<br> unset:";
      echo $unsetcookie;
      unset($_COOKIE[$unsetcookie]); 
      setcookie($unsetcookie, '', -1, '/');
    }
    $data = "1,".time();
    echo $data;
    setcookie($id, $data, time()+3600, '/'); //(60*60*24)
  }
  else{
    $data = $frequency + 1 . "," . time();
    //frequency and createdtime
    setcookie($id, $data, time()+3600, '/');
  }

?>

<!-- index.php -->

<?php
  $lastvisited = array();
  $frequentyvisited = array();

  //echo count($_COOKIE);
  foreach( $_COOKIE as $key=>$value){
    //echo "key: ";
    //echo $key . " || " . $value;
    $pieces = explode(",", $value);
    $lastvisited[$key]=$pieces[1];
    $frequentyvisited[$key]=$pieces[0];
    //$count++;
  }
  arsort($lastvisited);
  arsort($frequentyvisited);
  $lastvisited = array_slice($lastvisited, 0, 5, true);
  $frequentyvisited = array_slice($frequentyvisited, 0, 5, true);
  foreach($lastvisited as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
  }
  $count =5;
  foreach($frequentyvisited as $x => $x_value) {
    echo "Key=" . $x . ", Frequency=" . $x_value;
    echo "<br>";
  }
?>