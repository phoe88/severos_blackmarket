<?php

include "../service/database.php";

session_start();

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

if (isset($_GET["search"])) {
    $search = htmlspecialchars($_GET['search'] ?? '');
}

$array = [
    ["gun" => "Desert Eagle 'Saint Edge'", "rarity" => "Epic", "type" => "Handgun", "price" => 6500],
    ["gun" => "White Fang-465 'Artic Howl'", "rarity" => "Epic", "type" => "Assault Rifle", "price" => 142000],
    ["gun" => "AR-73/223 'Urban Spectre'", "rarity" => "Rare", "type" => "Assault Rifle", "price" => 7900],
    ["gun" => "L85A 'Divine Spectre'", "rarity" => "Epic", "type" => "Handgun", "price" => 6500],
    ["gun" => "G11 'Caseless Edge'", "rarity" => "Epic", "type" => "Handgun", "price" => 6500],
    ["gun" => "AK-15 'Guardian'", "rarity" => "Epic", "type" => "Assault Rifle", "price" => 100000],
    ["gun" => "MG42 'Destroyer Mark II'", "rarity" => "Legendary", "type" => "Machine Gun", "price" => 1168000],
    ["gun" => "VX-Raptor 'Sky Hunter'", "rarity" => "Epic", "type" => "Assault Rifle", "price" => 4500],
];

$rarityColors = [
    "Common" => "#b0b0b0",
    "Rare" => "#4a90d9",
    "Epic" => "#9b59b6",
    "Legendary" => "#f0a500",
];

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
    <?php include "../includes/header.php"; ?>

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

        <div class="containercard">
            <?php foreach ($array as $item):
                $color = $rarityColors[$item['rarity']] ?? '#fff';
                ?>
                <div class="carditem" data-gun="<?= htmlspecialchars($item['gun']) ?>"
                    data-rarity="<?= htmlspecialchars($item['rarity']) ?>"
                    data-type="<?= htmlspecialchars($item['type']) ?>" data-price="<?= $item['price'] ?>"
                    data-color="<?= $color ?>">
                    <div>
                        <h1 style="color: <?= $color ?>"><?= htmlspecialchars($item['gun']) ?></h1>
                        <p style="color: <?= $color ?>"><?= htmlspecialchars($item['rarity']) ?></p>
                        <p>Type: <?= htmlspecialchars($item['type']) ?></p>
                        <p>Price: $<?= number_format($item['price']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="filtercontainer">
            <h1>Filters</h1>

            <span id="important-msg">Price Range</span>
            <input type="range" name="range" id="range">
            <p class="caption">Weapon Type</p>

            <?php foreach ($array as $item): ?>
                <div>
                    <input type="checkbox" class="checkbox-filter"> <?= htmlspecialchars($item['gun']) ?>
                </div>
            <?php endforeach; ?>
        </div>

    </section>

    <?php include "../includes/footer.php"; ?>

    <script src="../assets/script.js"></script>
</body>

</html>