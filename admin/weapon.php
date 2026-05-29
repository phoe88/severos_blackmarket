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
$errors = [];
$success = '';

$weaponId = isset($_GET['edit']) ? (int) $_GET['edit'] : 0;
$editingWeapon = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $gun = trim($_POST['gun'] ?? '');
    $rarity = trim($_POST['rarity'] ?? 'Common');
    $type = trim($_POST['type'] ?? '');
    $price = (int) ($_POST['price'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $damage = trim($_POST['damage'] ?? '');
    $accuracy = trim($_POST['accuracy'] ?? '');
    $fireRate = trim($_POST['fire_rate'] ?? '');

    if ($action === 'delete') {
        $deleteId = (int) ($_POST['weapon_id'] ?? 0);
        if ($deleteId > 0) {
            $stmt = $db->prepare("DELETE FROM weapons WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param('i', $deleteId);
                $stmt->execute();
                if ($stmt->affected_rows >= 0) {
                    $success = 'Weapon removed successfully.';
                }
                $stmt->close();
            }
        }
    } else {
        if ($gun === '') {
            $errors[] = 'Weapon name is required.';
        }
        if ($type === '') {
            $errors[] = 'Weapon type is required.';
        }
        if ($price <= 0) {
            $errors[] = 'Price must be greater than 0.';
        }
        if ($description === '') {
            $errors[] = 'Description is required.';
        }
        if ($damage === '') {
            $errors[] = 'Damage is required.';
        }
        if ($accuracy === '') {
            $errors[] = 'Accuracy is required.';
        }
        if ($fireRate === '') {
            $errors[] = 'Fire rate is required.';
        }

        if (empty($errors)) {
            if ($action === 'add') {
                $stmt = $db->prepare("INSERT INTO weapons (gun, rarity, type, price, description, damage, accuracy, fire_rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param('sssisiss', $gun, $rarity, $type, $price, $description, $damage, $accuracy, $fireRate);
                    $stmt->execute();
                    if ($stmt->affected_rows > 0) {
                        $success = 'Weapon added successfully.';
                        $gun = $type = $description = $damage = $accuracy = $fireRate = '';
                        $price = 0;
                    }
                    $stmt->close();
                }
            } elseif ($action === 'update') {
                $updateId = (int) ($_POST['weapon_id'] ?? 0);
                if ($updateId > 0) {
                    $stmt = $db->prepare("UPDATE weapons SET gun = ?, rarity = ?, type = ?, price = ?, description = ?, damage = ?, accuracy = ?, fire_rate = ? WHERE id = ?");
                    if ($stmt) {
                        $stmt->bind_param('sssissssi', $gun, $rarity, $type, $price, $description, $damage, $accuracy, $fireRate, $updateId);
                        $stmt->execute();
                        if ($stmt->affected_rows >= 0) {
                            $success = 'Weapon updated successfully.';
                        }
                        $stmt->close();
                    }
                }
            }
        }
    }

    // Refresh editing state after changes
    if ($action !== 'delete' && isset($_POST['weapon_id'])) {
        $weaponId = (int) $_POST['weapon_id'];
    }
}

if ($weaponId > 0) {
    $stmt = $db->prepare("SELECT id, gun, rarity, type, price, description, damage, accuracy, fire_rate FROM weapons WHERE id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('i', $weaponId);
        $stmt->execute();
        $result = $stmt->get_result();
        $editingWeapon = $result->fetch_assoc();
        $stmt->close();
        if ($editingWeapon) {
            $gun = $editingWeapon['gun'];
            $rarity = $editingWeapon['rarity'];
            $type = $editingWeapon['type'];
            $price = $editingWeapon['price'];
            $description = $editingWeapon['description'];
            $damage = $editingWeapon['damage'];
            $accuracy = $editingWeapon['accuracy'];
            $fireRate = $editingWeapon['fire_rate'];
        }
    }
}

$weapons = [];
$result = $db->query("SELECT id, gun, rarity, type, price FROM weapons ORDER BY id DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $weapons[] = $row;
    }
    $result->free();
}

$rarityOptions = ['Common', 'Rare', 'Epic', 'Legendary'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weapon Management</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="admin-body">
    <main class="admin-shell">
        <header class="admin-header">
            <div>
                <p class="admin-welcome">Admin: <strong><?php echo $displayName; ?></strong></p>
                <p class="admin-subtitle">Manage weapon inventory and store listings.</p>
            </div>
            <form action="weapon.php" method="POST">
                <button type="submit" name="logout" class="admin-button">Logout</button>
            </form>
        </header>

        <?php include "admin_nav.php"; ?>

        <section class="admin-content">
            <div class="admin-page-header">
                <h1>Weapon Management</h1>
                <p>Add, edit, or remove weapons available in the marketplace.</p>
            </div>

            <?php if (!empty($success)): ?>
                <div class="success-banner"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <?php if (!empty($errors)): ?>
                <div class="error-banner">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="weapon-management-grid">
                <div class="weapon-form-card">
                    <h2><?php echo $editingWeapon ? 'Edit Weapon' : 'Add Weapon'; ?></h2>
                    <form action="weapon.php<?php echo $editingWeapon ? '?edit=' . $editingWeapon['id'] : ''; ?>" method="POST">
                        <input type="hidden" name="weapon_id" value="<?php echo htmlspecialchars($editingWeapon['id'] ?? 0); ?>">
                        <div class="field-row">
                            <label for="gun">Weapon name</label>
                            <input id="gun" name="gun" type="text" value="<?php echo htmlspecialchars($gun ?? ''); ?>">
                        </div>
                        <div class="field-row">
                            <label for="rarity">Rarity</label>
                            <select id="rarity" name="rarity">
                                <?php foreach ($rarityOptions as $option): ?>
                                    <option value="<?php echo $option; ?>" <?php echo (isset($rarity) && $rarity === $option) ? 'selected' : ''; ?>><?php echo $option; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field-row">
                            <label for="type">Type</label>
                            <input id="type" name="type" type="text" value="<?php echo htmlspecialchars($type ?? ''); ?>">
                        </div>
                        <div class="field-row">
                            <label for="price">Price</label>
                            <input id="price" name="price" type="number" min="1" value="<?php echo htmlspecialchars($price ?? 0); ?>">
                        </div>
                        <div class="field-row">
                            <label for="description">Description</label>
                            <textarea id="description" name="description"><?php echo htmlspecialchars($description ?? ''); ?></textarea>
                        </div>
                        <div class="field-row">
                            <label for="damage">Damage</label>
                            <input id="damage" name="damage" type="text" value="<?php echo htmlspecialchars($damage ?? ''); ?>">
                        </div>
                        <div class="field-row">
                            <label for="accuracy">Accuracy</label>
                            <input id="accuracy" name="accuracy" type="text" value="<?php echo htmlspecialchars($accuracy ?? ''); ?>">
                        </div>
                        <div class="field-row">
                            <label for="fire_rate">Fire rate</label>
                            <input id="fire_rate" name="fire_rate" type="text" value="<?php echo htmlspecialchars($fireRate ?? ''); ?>">
                        </div>
                        <div class="button-row">
                            <button type="submit" name="action" value="<?php echo $editingWeapon ? 'update' : 'add'; ?>" class="btn-primary"><?php echo $editingWeapon ? 'Save changes' : 'Add weapon'; ?></button>
                            <?php if ($editingWeapon): ?>
                                <a class="btn-secondary" href="weapon.php">Cancel edit</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

                <div class="weapon-table-card">
                    <h2>Weapon catalog</h2>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Weapon</th>
                                <th>Type</th>
                                <th>Rarity</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($weapons)): ?>
                                <tr>
                                    <td colspan="6">No weapons found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($weapons as $weapon): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($weapon['id']); ?></td>
                                        <td><?php echo htmlspecialchars($weapon['gun']); ?></td>
                                        <td><?php echo htmlspecialchars($weapon['type']); ?></td>
                                        <td><?php echo htmlspecialchars($weapon['rarity']); ?></td>
                                        <td>$<?php echo number_format($weapon['price']); ?></td>
                                        <td class="table-actions">
                                            <a class="btn-secondary" href="weapon.php?edit=<?php echo $weapon['id']; ?>">Edit</a>
                                            <form action="weapon.php" method="POST" onsubmit="return confirm('Delete this weapon?');" class="inline-form">
                                                <input type="hidden" name="weapon_id" value="<?php echo $weapon['id']; ?>">
                                                <button type="submit" name="action" value="delete" class="btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
