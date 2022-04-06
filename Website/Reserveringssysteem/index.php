<?php


require_once ("includes/database.php");


?>

<!doctype html>
<html>
<head>
    <title> Snackbar 't Centrum</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/overzichtstyle.css"/>
    <script src="https://kit.fontawesome.com/dcb2a70d47.js" crossorigin="anonymous"></script>
</head>
<header>
    <nav>
        <a
                href="index.php"><img src="css/img/logo.png" width="300" height="75" class="logo">
        </a>
        <ul>
            <li><a class="active" href="index.php">Home Page</a></li>
            <li><a href="menu.php">Menukaart</a></li>
            <li><a href="reservering.php">Reserveren</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
</header>
<body>
<div class="center">
    <h1> Snackbar 't </h1>
    <h1> Centrum</h1>
    <p class="blue-color">Kom snel en lekker een hapje eten bij ons!</p>
    <p class="blue-color">U kunt ons ook gelijk bellen voor een reservering: 0591 351 281</p>

    <a
            href="reservering.php">
    <input type="submit" class="btn" value="reserveren" >
        </a>
</div>

</body>
</html>
