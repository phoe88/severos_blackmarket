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
        <form action="marketplace.php" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
        <div id="header-content">
            <h1 id="header-h1">Marketplace</h1>
            <p class="tagline">Only the strongest survive. Choose your weapons enforce your dominance</p>
        </div>
        <div id="search-container">
            <input type="search" name="search" id="search" placeholder="Search weapons..">

            <div class="divider divider-horizontal"></div>
        </div>

        <div id="container"></div>
        <div class="filter-container">
            <h1>Filters</h1>
            <p class="tagline">Weapon Type</p>
            <input type="range" name="range" id="range">
        </div>








        <script src="../assets/script.js"></script>
    </section>

    <?php
    include "../includes/footer.php";
    ?>
</body>



</html>