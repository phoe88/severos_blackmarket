<?php

include "service/database.php";



$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $errors[] = 'Semua field wajib diisi.';
    } else {

        if (strlen($password) < 8) {
            $errors[] = 'Password minimal 8 karakter.';
        }
        if (!preg_match('/^[^@]+@gmail\.com$/', $email)) {
            $errors[] = 'Email harus menggunakan @gmail.com.';
        }
    }

    $sql = "SELECT * FROM msuser WHERE 'password' = $password AND 'email' = $email";
    if ($db->query($sql)) {
        echo "Alright youre in";
    }

    if (empty($errors)) {
        echo 'Login berhasil!';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<?php include "includes/header.php"; ?>

<body>

    <section id="background">
        <div class="card">
            <h1>Login</h1>
            <p class="tagline">The market's hot. Your next weapon awaits.</p>
            <br>
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <p style="color:red;">
                        <?= htmlspecialchars($error) ?>
                    </p>
                <?php endforeach; ?>
            <?php endif; ?>
            <br>
            <form action="login.php" method="POST">
                <p class="highlighter">
                    Please enter your credentials to begin.
                </p>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        placeholder="Enter your password(min. 8 characters)" />
                </div>


                <button type="submit" class="btn-login">Login</button>
            </form>

            <p class="login-link">Don't have an account? <a href="register.php">Register here.</a></p>
        </div>
    </section>




    <?php include "includes/footer.php"; ?>
</body>

</html>