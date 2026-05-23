<?php
include "admin_auth.php";

$typeTable = findTable($db, ["weapontype", "weapon_type", "types"]);
$typeRows = null;
$typeColumns = [];

if ($typeTable) {
    $typeRows = fetchTableRows($db, $typeTable, 200);
    if ($typeRows) {
        $typeColumns = array_map(function($field) { return $field->name; }, $typeRows->fetch_fields());
        $typeRows->data_seek(0);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Weapon Types</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <section class="admin-container">
        <?php include "admin_nav.php"; ?>
        <div class="admin-header">
            <h1>Weapon Types</h1>
            <p>Manage the available weapon type categories in the marketplace.</p>
        </div>

        <?php if ($typeTable && $typeRows && $typeRows->num_rows > 0): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <?php foreach ($typeColumns as $column): ?>
                                <th><?php echo htmlspecialchars($column, ENT_QUOTES, 'UTF-8'); ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $typeRows->fetch_assoc()): ?>
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
                <p>No weapon type records found. Make sure the type table exists in the database.</p>
            </div>
        <?php endif; ?>
    </section>
</body>

</html>
