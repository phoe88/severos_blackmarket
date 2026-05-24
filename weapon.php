<?php
include "admin_auth.php";

$weaponTable = findTable($db, ["weapon", "weapons", "msweapon"]);
$weaponRows = null;
$weaponColumns = [];

if ($weaponTable) {
    $weaponRows = fetchTableRows($db, $weaponTable, 200);
    if ($weaponRows) {
        $weaponColumns = array_map(function($field) { return $field->name; }, $weaponRows->fetch_fields());
        $weaponRows->data_seek(0);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Weapons</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <section class="admin-container">
        <?php include "admin_nav.php"; ?>
        <div class="admin-header">
            <h1>Weapon Inventory</h1>
            <p>View and manage the weapons available in the marketplace.</p>
        </div>

        <?php if ($weaponTable && $weaponRows && $weaponRows->num_rows > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <?php foreach ($weaponColumns as $column): ?>
                                <th><?php echo htmlspecialchars($column, ENT_QUOTES, 'UTF-8'); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $weaponRows->fetch_assoc()): ?>
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
                <p>No weapon records found. Make sure the weapons table exists in the database.</p>
            </div>
        <?php endif; ?>
    </section>
</body>

</html>
