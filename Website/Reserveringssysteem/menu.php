<?php


require_once ("includes/database.php");


?>
<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            box-sizing: border-box;
        }

        .column {
            float: left;
            width: 33.33%;
            padding: 5px;
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        </style>

    <title>Reserveringen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/menu.css"/>
</head>

<header>
    <nav>
        <a
            href="index.php"><img src="css/img/logo.png" width="300" height="75" class="logo">
        </a>
        <ul>
            <li><a href="index.php">Home Page</a></li>
            <li><a class="active" href="menu.php">Menukaart</a></li>
            <li><a href="reservering.php">Reserveren</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    <div class="row">
        <div class="column">
            <img src="css/menu2.png" style="width:100%">
        </div>
        <div class="column">
            <img src="css/menu.png"  style="width:100%">
        </div>
        <div class="column">
            <img src="css/menu1.png" style="width:100%">
        </div>
    </div>
</header>
<body>



