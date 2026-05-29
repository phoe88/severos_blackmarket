<?php
include "../service/database.php";
include __DIR__ . '/../includes/session.php';

if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true || $_SESSION["role"] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$displayName = htmlspecialchars($_SESSION['username'] ?? 'Administrator');
$summaryCards = [
    ['title' => 'Payments', 'description' => 'Review recent transactions and resolve payment issues.'],
    ['title' => 'Weapons', 'description' => 'Manage weapon inventory, pricing, and availability.'],
    ['title' => 'Weapon Types', 'description' => 'Update categories and classification labels.'],
    ['title' => 'Users', 'description' => 'Monitor user accounts and access levels.'],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="admin-body">
    <?php include "../includes/header.php"; ?>

    <main class="admin-dashboard">
        <section class="admin-hero">
            <div class="admin-hero-copy">
                <p class="admin-badge">Administrator Panel</p>
                <h1>Welcome back, <?php echo $displayName; ?></h1>
                <p class="admin-lead">Manage the marketplace, payments, weapon listings, and site users from a single control center.</p>
            </div>
            <div class="admin-hero-actions">
                <a href="payment.php" class="btn-admin">View Payments</a>
                <a href="weapon.php" class="btn-admin btn-secondary">Manage Weapons</a>
            </div>
        </section>

        <?php include "admin_nav.php"; ?>

        <section class="admin-summary">
            <?php foreach ($summaryCards as $card): ?>
                <article class="dashboard-card">
                    <h2><?php echo htmlspecialchars($card['title']); ?></h2>
                    <p><?php echo htmlspecialchars($card['description']); ?></p>
                </article>
            <?php endforeach; ?>
        </section>

        
        
    </main>
</body>

</html>