<?php
include "admin_auth.php";

$paymentTable = findTable($db, ["payment", "payments", "transactions"]);
$paymentRows = null;
$paymentColumns = [];

if ($paymentTable) {
    $paymentRows = fetchTableRows($db, $paymentTable, 200);
    if ($paymentRows) {
        $paymentColumns = array_map(function ($field) {
            return $field->name;
        }, $paymentRows->fetch_fields());
        $paymentRows->data_seek(0);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Payments</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <section class="admin-container">
        <?php include "admin_nav.php"; ?>
        <div class="admin-header">
            <h1>Payment Records</h1>
            <p>Review payment and transaction data captured by the system.</p>
        </div>

        <?php if ($paymentTable && $paymentRows && $paymentRows->num_rows > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <?php foreach ($paymentColumns as $column): ?>
                                <th><?php echo htmlspecialchars($column, ENT_QUOTES, 'UTF-8'); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $paymentRows->fetch_assoc()): ?>
                            <tr>
                                <?php foreach ($row as $value): ?>
                                    <td><?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="admin-panel">
                <p>No payment records found. Make sure the database table exists and contains data.</p>
            </div>
        <?php endif; ?>
    </section>
</body>

</html>