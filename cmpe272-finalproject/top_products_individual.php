<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cross Domain Enterprise Online Market Place</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Online Market Place</a>
            </div>
            <?php require_once "navbar.php"?>
        </div>
    </nav>

    <div class="bg container" style="margin-top:60px">
        <h1 style="text-align:center;color:white;">Top products by individual company</h1>
      <?php
        require_once "./top_products/embed/by_company_rating.php";
        require_once "./top_products/embed/by_company_views.php";
       ?>  
    </div>
    
</body>

</html>