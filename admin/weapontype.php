<?php
include "../service/database.php";
include __DIR__ . '/../includes/session.php';

if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true || $_SESSION["role"] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}

$displayName = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weapon Type Management</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="admin-body">
    <main class="admin-shell">
        <header class="admin-header">
            <div>
                <p class="admin-welcome">Admin: <strong><?php echo $displayName; ?></strong></p>
                <p class="admin-subtitle">Manage weapon classes and category labels.</p>
            </div>
            <form action="weapontype.php" method="POST">
                <button type="submit" name="logout" class="admin-button">Logout</button>
            </form>
        </header>

        <?php include "admin_nav.php"; ?>

        <section class="admin-content">
            <div class="admin-page-header">
                <h1>Weapon Type Management</h1>
                <p>Organize weapons by type so users can browse by category.</p>
            </div>

            <div class="admin-summary-grid">
                <article class="admin-card">
                    <h2>Weapon Categories</h2>
                    <p>Maintain and rename weapon type labels for the marketplace.</p>
                </article>
                <article class="admin-card">
                    <h2>Type Attributes</h2>
                    <p>Define how each weapon type behaves and displays in listings.</p>
                </article>
            </div>
        </section>
    </main>
</body>

</html>
