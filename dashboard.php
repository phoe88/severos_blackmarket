<?php
include "admin_auth.php";

$userCount = 0;
$weaponCount = 0;
$typeCount = 0;
$paymentCount = 0;

$userResult = $db->query("SELECT COUNT(*) AS total FROM msuser");
if ($userResult) {
    $userCount = (int) $userResult->fetch_assoc()["total"];
}

$weaponTable = findTable($db, ["weapon", "weapons", "msweapon"]);
if ($weaponTable) {
    $weaponResult = $db->query("SELECT COUNT(*) AS total FROM `$weaponTable`");
    if ($weaponResult) {
        $weaponCount = (int) $weaponResult->fetch_assoc()["total"];
    }
}

$typeTable = findTable($db, ["weapontype", "weapon_type", "types"]);
if ($typeTable) {
    $typeResult = $db->query("SELECT COUNT(*) AS total FROM `$typeTable`");
    if ($typeResult) {
        $typeCount = (int) $typeResult->fetch_assoc()["total"];
    }
}

$paymentTable = findTable($db, ["payment", "payments", "transactions"]);
if ($paymentTable) {
    $paymentResult = $db->query("SELECT COUNT(*) AS total FROM `$paymentTable`");
    if ($paymentResult) {
        $paymentCount = (int) $paymentResult->fetch_assoc()["total"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <section class="admin-container">
        <?php include "admin_nav.php"; ?>
        <div class="admin-header">
            <h1>Admin Dashboard</h1>
            <p>Welcome back, <?php echo $adminUsername; ?>. Manage weapons, payment records, and weapon types from here.</p>
        </div>

        <div class="admin-stats">
            <div class="admin-card">
                <h2>Total Users</h2>
                <p><?php echo $userCount; ?></p>
            </div>
            <div class="admin-card">
                <h2>Total Weapons</h2>
                <p><?php echo $weaponCount; ?></p>
            </div>
            <div class="admin-card">
                <h2>Weapon Types</h2>
                <p><?php echo $typeCount; ?></p>
            </div>
            <div class="admin-card">
                <h2>Payment Records</h2>
                <p><?php echo $paymentCount; ?></p>
            </div>
        </div>

        <div class="admin-panel">
            <h3>Quick actions</h3>
            <ul>
                <li><strong>Weapons:</strong> add, edit or remove entries in the weapons table.</li>
                <li><strong>Weapon types:</strong> maintain available type categories for the marketplace.</li>
                <li><strong>Payments:</strong> review payments or transactions captured in the database.</li>
            </ul>
        </div>
    </section>
</body>

</html>
