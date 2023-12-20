<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cross Domain Enterprise Online Market Place</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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

<body background="online_shopping.jpeg" background-repeat="no-repeat" background-size="cover" background-opacity="0.2">

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- <div class="navbar-header">
                <a class="navbar-brand">Cross Domain Enterprise Online Market Place</a>
            </div> -->
            <?php require_once "navbar.php"?>
        </div>
    </nav>

    <div class="bg" style="margin-top:60px">
        <h1 style="text-align:center;color:white;">Welcome to Cross Domain Enterprise Online Market Place.</h1>
        <?php
            $data = time();
            setcookie('Subramanya.php', $data, time()+3600, '/'); //(60*60*24)
        ?>
        <?php 
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
               echo "
                    <div class='company-container'>
                    <iframe src='https://subramanyajagadeesh-0a2895b9a580.herokuapp.com'></iframe>
                    </div>
                ";
            }
        ?>
    </div>
    
</body>

</html>