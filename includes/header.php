<?php

include "../service/database.php";



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <header>

        <img src="assets/logo.png" id="logo" alt="logo.png" width="40px" height="40px">

        <!-- <ul aria-label="Main Navigation" id="navigation">
            <li id="home">Home</li>
            <div class="divider"></div>
            <li id="marketplace">Marketplace</li>
            <div class="divider"></div>
            <li id="arsenal">Arsenal</li>
            <div class="divider"></div>
            <li id="transaction">Transaction</li>
        </ul> -->

        <ul aria-label="Auth Navigation" id="authen">
            <li id="login-page"><a href="login.php">Login</a></li>
            <div class="divider"></div>
            <li id="register-page"><a href="register.php">Register</a></li>
        </ul>




    </header>


    <script src="script.js"></script>
</body>

</html>