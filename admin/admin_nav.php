<?php
$navItems = [
    'dashboard.php' => 'Dashboard',
    'payment.php' => 'Payments',
    'weapon.php' => 'Weapons',
    'weapontype.php' => 'Weapon Types',
];
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav class="admin-nav" aria-label="Admin page navigation">
    <ul>
        <?php foreach ($navItems as $file => $label): ?>
            <li>
                <a href="<?php echo $file; ?>" class="admin-nav-link <?php echo $currentPage === $file ? 'active' : ''; ?>">
                    <?php echo htmlspecialchars($label); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
