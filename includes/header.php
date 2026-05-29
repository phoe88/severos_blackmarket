<?php
include __DIR__ . '/session.php';

$loggedIn = isset($_SESSION["is_login"]) && $_SESSION["is_login"] === true;
$username = htmlspecialchars($_SESSION["username"] ?? '');
$role = $_SESSION["role"] ?? '';

$scriptDir = dirname(str_replace('\\', '/', $_SERVER['SCRIPT_NAME']));
$basePath = preg_replace('#/(admin|member)$#', '', $scriptDir);
$basePath = rtrim($basePath, '/');
if ($basePath === '/') {
    $basePath = '';
}

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? '';
$baseUrl = ($host !== '') ? $scheme . '://' . $host . $basePath : $basePath;

$homeLink = $baseUrl . '/index.php';
$marketplaceLink = $baseUrl . '/member/marketplace.php';
$arsenalLink = $baseUrl . '/member/arsenal.php';
$transactionLink = $baseUrl . '/member/transaction.php';
$dashboardLink = $baseUrl . '/admin/dashboard.php';
$weaponLink = $baseUrl . '/admin/weapon.php';
$loginLink = $baseUrl . '/login.php';
$registerLink = $baseUrl . '/register.php';
$logoutLink = $baseUrl . '/logout.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ' . $homeLink);
    exit();
}
?>

<header class="site-header">
    <div class="site-brand">
        <a href="<?php echo htmlspecialchars($homeLink); ?>">Severos</a>
    </div>

    <nav class="site-navigation" aria-label="Main navigation">
        <?php if ($loggedIn && $role === 'guest'): ?>
            <a href="<?php echo htmlspecialchars($homeLink); ?>">Home</a>
            <a href="<?php echo htmlspecialchars($marketplaceLink); ?>">Marketplace</a>
            <a href="<?php echo htmlspecialchars($arsenalLink); ?>">Arsenal</a>
            <a href="<?php echo htmlspecialchars($transactionLink); ?>">Transaction</a>
        <?php elseif ($loggedIn && $role === 'admin'): ?>
            <a href="<?php echo htmlspecialchars($dashboardLink); ?>">Dashboard</a>
            <a href="<?php echo htmlspecialchars($weaponLink); ?>">Weapon</a>
        <?php endif; ?>
    </nav>

    <div class="site-actions">
        <?php if ($loggedIn): ?>
            <span class="user-label"><?php echo $username; ?></span>
            <form action="" method="post" class="logout-form">
                <button type="submit" name="logout">Logout</button>
            </form>
        <?php else: ?>
            <a href="<?php echo htmlspecialchars($loginLink); ?>">Login</a>
            <a href="<?php echo htmlspecialchars($registerLink); ?>">Register</a>
        <?php endif; ?>
    </div>
</header>

<?php if ($loggedIn): ?>
<script>
    const severosActive = sessionStorage.getItem('severos_active');
    const urlParams = new URLSearchParams(window.location.search);
    const initSession = urlParams.get('init') === '1';

    if (!severosActive && initSession) {
        sessionStorage.setItem('severos_active', '1');
        urlParams.delete('init');
        const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
        window.history.replaceState({}, '', newUrl);
    } else if (!severosActive) {
        fetch("<?= htmlspecialchars($logoutLink); ?>", { method: 'POST', credentials: 'same-origin' })
            .then(() => {
                window.location.href = "<?= htmlspecialchars($loginLink); ?>";
            })
            .catch(() => {
                window.location.href = "<?= htmlspecialchars($loginLink); ?>";
            });
    } else {
        sessionStorage.setItem('severos_active', '1');
    }
</script>
<?php endif; ?>