<?php

include "../service/database.php";

session_start();

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");

}

?>


<!DOCTYPE html>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>



<body>
    <section id="background">
        <div id="welcome">

        </div>
        <form action="marketplace.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
        <div id="header">
            <h1>Marketplace</h1>
            <p class="tagline">Only the strongest survive. Choose your weapons enforce your dominance</p>
        </div>
        <input type="search" name="search" id="search">
        <div id="divider"></div>
        <div class="container"></div>
        <div class="filter-container">
            <h1>Filters</h1>
            <p class="tagline">Weapon Type</p>
            <input type="range" name="range" id="range">
        </div>
</body>
</section>


</html>