<?php
include "service/database.php";
session_start();

$errors = [];


if (isset($_SESSION["is_login"])) {
    if ($_SESSION["role"] === "admin") {
        header("Location: admin/dashboard.php");
    } elseif ($_SESSION["role"] === "guest") {
        header("Location: member/marketplace.php");
    }
    exit();
}

if (isset($_POST["login"])) {
    $email = trim($_POST['email']);

    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $errors[] = 'Semua field wajib diisi.';
    } else {
        if (!preg_match('/^[^@]+@gmail\.com$/', $email)) {
            $errors['email'] = 'Email harus menggunakan @gmail.com.';
        }
        if (strlen($password) < 8) {
            $errors['password'] = 'Password minimal 8 karakter.';
        }
    }
    if (empty($errors)) {

        $sql = "SELECT * FROM msuser WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (!password_verify($password, $row['password'])) {
                $errors['password'] = 'Password salah.';
            } else {

                if ($row['role'] === 'admin') {
                    $_SESSION["is_login"] = true;
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["role"] = 'admin';
                    $stmt->close();
                    $db->close();
                    header("Location: admin/dashboard.php");
                    exit();

                } elseif ($row['role'] === 'guest') {
                    $_SESSION["is_login"] = true;
                    $_SESSION["email"] = $row['email'];
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["role"] = 'guest';
                    $stmt->close();
                    $db->close();
                    header("Location: member/marketplace.php");
                    exit();

                } else {
                    $errors['general'] = 'Role tidak dikenali. Hubungi administrator.';
                }
            }
        } else {

            $errors['email'] = 'Email tidak ditemukan.';
        }


        $stmt->close();
        $db->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php include "includes/header.php"; ?>
    <section id="background">
        <div class="card">
            <h1>Login</h1>
            <p class="tagline">The market's hot. Your next weapon awaits.</p>

            <form action="login.php" method="POST">
                <p class="highlighter highlighter-login">
                    Please enter your credentials to begin.
                </p>

                <?php if (!empty($errors[0]) || !empty($errors['general'])): ?>
                    <div style="background:#ffe0e0; border:1px solid red; border-radius:6px;
                                padding:10px 14px; margin-bottom:14px;">
                        <strong style="color:red; font-size:13px;">
                            <?php echo htmlspecialchars($errors[0] ?? $errors['general']); ?>
                        </strong>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"
                        value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" />
                    <?php if (!empty($errors['email'])): ?>
                        <strong style="margin-top:6px; color:red; font-size:12px; font-style:italic; display:block;">
                            <?php echo htmlspecialchars($errors['email']); ?>
                        </strong>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        placeholder="Enter your password (min. 8 characters)" />
                    <?php if (!empty($errors['password'])): ?>
                        <strong style="margin-top:6px; color:red; font-size:12px; font-style:italic; display:block;">
                            <?php echo htmlspecialchars($errors['password']); ?>
                        </strong>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-login" name="login">Login</button>
            </form>

            <p class="login-link">Don't have an account? <a href="register.php">Register here.</a></p>
        </div>
    </section>

    <?php include "includes/footer.php"; ?>
</body>

</html>