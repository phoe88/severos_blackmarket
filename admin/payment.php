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
    <title>Payment Management</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="admin-body">
    <main class="admin-shell">
        <header class="admin-header">
            <div>
                <p class="admin-welcome">Admin: <strong><?php echo $displayName; ?></strong></p>
                <p class="admin-subtitle">Manage payment records and transaction statuses.</p>
            </div>
            <form action="payment.php" method="POST">
                <button type="submit" name="logout" class="admin-button">Logout</button>
            </form>
        </header>

        <?php include "admin_nav.php"; ?>

        <section class="admin-content">
            <div class="admin-page-header">
                <h1>Payment Management</h1>
                <p>Monitor payments, verify transactions, and update payment status from this panel.</p>
            </div>

            <div class="admin-summary-grid">
                <article class="admin-card">
                    <h2>Transactions</h2>
                    <p>View recent payment activity and approve or investigate payment issues.</p>
                </article>
                <article class="admin-card">
                    <h2>Payment Methods</h2>
                    <p>Configure accepted payment types and available channels for users.</p>
                </article>
            </div>
        </section>
    </main>
</body>

</html>
