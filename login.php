<?php
include "service/database.php";
session_start();

$errors = [];


if (isset($_SESSION["is_admin"])) {
    header("Location: admin/dashboard.php");
    exit();
}

if (isset($_SESSION["is_login"])) {
    header("Location: member/marketplace.php");
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
        $sql = "SELECT * FROM msuser WHERE email='$email'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION["email"] = $row["email"];

                if ($row['role'] === 'admin') {
                    $_SESSION["is_admin"] = true;
                    header("Location: admin/dashboard.php");
                } else {
                    $_SESSION["is_login"] = true;
                    header("Location: member/marketplace.php");
                }
                exit();
            } else {
                $errors[] = 'Email atau password salah.';
            }
        } else {
            $errors[] = 'Email atau password salah.';
        }

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
                <p class="highlighter">
                    Please enter your credentials to begin.
                </p>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" />
                    <?php if (!empty($errors["email"])): ?>
                        <strong
                            style="margin-top: 12px; color: red; font-size: 12px; font-style: italic"><?php echo htmlspecialchars($errors["email"]); ?></strong>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        placeholder="Enter your password(min. 8 characters)" />
                    <?php if (!empty($errors["password"])): ?>
                        <strong style="margin-top: 12px; color: red; font-size: 12px; font-style: italic">
                            <?php echo htmlspecialchars($errors["password"]); ?>
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