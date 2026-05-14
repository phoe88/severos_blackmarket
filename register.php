<?php

include "service/database.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($username) || empty($email) || empty($password)) {
        $errors[] = 'Semua field wajib diisi.';
    } else {
        if (strlen($username) < 8) {
            $errors[] = 'Username minimal 8 karakter.';
        }
        if (strlen($password) < 8) {
            $errors[] = 'Password minimal 8 karakter.';
        }
        if (!preg_match('/^[^@]+@gmail\.com$/', $email)) {
            $errors[] = 'Email harus menggunakan @gmail.com.';
        }
    }

    $sql = "INSERT INTO msuser (username, password, email) VALUES ('$username, $password, $email')";
    if($db->query($sql)) {
       echo "Alright youre in";
    }

    if (empty($errors)) {
        echo 'Registrasi berhasil!';
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

<body>

    <section id="background">

        <div class="card">
            <h1>Register</h1>
            <p class="tagline">Sign up. Load up. Stand out.</p>
            <br>
            
                <?php foreach ($errors as $error): ?>
                    <p style="color:red;">
                        <?= htmlspecialchars($error) ?>
                    </p>
                <?php endforeach; ?>

            
            <br>
            <form action="register.php" method="POST">
                <p class="highlighter">
                    Create your account by filling in the information below.
                </p>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                        placeholder="Enter your username(min. 8 characters)" />
                        <?php if (!empty($errors)) ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email(...@gmail.com)" />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        placeholder="Enter your password(min. 8 characters)" />
                </div>

                <button type="submit" class="btn-register">Register</button>
            </form>

            <p class="register-link">Already have an account? <a href="login.php">Login here.</a></p>
        </div>
    </section>

</body>

</html>