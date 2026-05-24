<?php

include "../service/database.php";

session_start();

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
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
    <?php
    include "../includes/header.php";
    ?>

    <section id="backgrounds">
        <div id="wrapper">
            <div id="header-content-container">
                <h1 id="header-h1">Marketplace</h1>
                <p class="caption">Only the strongest survive. Choose your weapons enforce your
                    dominance</p>
            </div>
            <div id="search-container">
                <input type="search" name="search" id="search" placeholder="Search weapons..">

                <div class="divider divider-horizontal"></div>
            </div>
        </div>

        <div class="containercard"></div>

        <div class="filtercontainer">
            <h1>Filters</h1>

            <span id="important-msg">Price Range</span>
            <input type="range" name="range" id="range">
            <p class="caption">Weapon Type</p>

        </div>

    </section>

    <?php
    include "../includes/footer.php";
    ?>

    <script src="../assets/script.js"></script>
</body>



</html>