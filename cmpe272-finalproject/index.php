

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cross Domain Enterprise Online Market Place</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <style>
        .company-container{
            width: 100%;
            height:100%;
            margin: 0 auto;
            background-color: white;
            display: flex;
            flex-direction: column;

        }
        iframe{
            width: 100%;
            height: 100vh;
        }
    </style>
</head>

<body background="online_shopping.jpeg" background-repeat="no-repeat" background-size="cover" background-opacity="0.5">

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- <div class="navbar-header">
                <a class="navbar-brand">Cross Domain Enterprise Online Market Place</a>
            </div> -->
            <?php require_once "navbar.php"?>
        </div>
    </nav>

    <div style="margin-top:10px;">        
      <div class="bg" style="margin-top:60px">
        <h1 style="text-align:center;color:white;">Welcome to Cross Domain Enterprise Online Market Place.</h1>
      </div>
    </div>
    <div style="margin-top:100px;">   
    

    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        echo '<div class = "carddiv">';
        echo '<div class = "card-container">';

        echo '<a href = "BlendStation.php"><div class="card">';
        echo '<img src="letterT.png" style="width:350px; height:350px"/>';
        echo '<h3>Blend Station</h3>';
        echo '</div></a>';

        echo '<a href = "StuffCo.php"><div class="card">';
        echo '<img src="https://cmpe272hw.pietrasik.top//images/Age.png" style="width:350px; height:350px"/>';
        echo '<h3>StuffCo</h3>';
        echo '</div></a>';

        echo '<a href = "Subramanya.php"><div class="card">';
        echo '<img src="https://subramanyajagadeesh-0a2895b9a580.herokuapp.com/assets/images/student_desk.jpeg" style="width:350px; height:350px"/>';
        echo '<h3>STUDENT FURNITURE SPOT</h3>';
        echo '</div></a>';

        echo '<a href = "Rajath.php"><div class="card">';
        echo '<img src="https://cmpe272.rnrnattoji.click/project/images/phones/iphone11promax.jpg" style="width:350px; height:350px"/>';
        echo '<h3>RNR Elektronics</h3>';
        echo '</div></a>';

        echo '</div>';
        echo '</div>';
    }

        ?>

        <?php
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                $lastvisited = array();
                $enumeration = array();

                foreach( $_COOKIE as $key=>$value){
                    if ($key== "BlendStation_php")
                        $lastvisited["Blend Station"]=$value;
                    if ($key== "Rajath_php")
                        $lastvisited["RNR Electronics"]=$value;
                    if($key== "StuffCo_php")
                        $lastvisited["StuffCo"]=$value;
                    if($key== "Subramanya_php")
                        $lastvisited["STUDENT FURNITURE SPOT"]=$value;
                }
                $lastvisited = array_slice($lastvisited, 0, 5, true);
                arsort($lastvisited);
                foreach( $lastvisited as $key=>$value){
                    if ($key== "Blend Station")
                        $enumeration[$key]="BlendStation.php";
                    if ($key== "RNR Electronics")
                        $enumeration[$key]="Rajath.php";
                    if($key== "StuffCo")
                        $enumeration[$key]="StuffCo.php";
                    if($key== "STUDENT FURNITURE SPOT")
                        $enumeration[$key]="Subramanya.php";
                }
                echo '<p  class="inpageheading"> Previously visited pages</p>';
                echo count($lastvisited);
                echo '<div class = "carddiv">';
                echo '<div class = "card-container">';

                foreach ($lastvisited as  $name => $market) {

                    echo '<a href = "'.$enumeration[$name].'"><div class="card">';
                    echo '<h3>'.$name.'</h3>';
                    echo '</div></a>';

                }

                echo '</div>';
                echo '</div>';
            }
            ?>    

    </div>
</body>

</html>