<?php
include "service/database.php";

$errors = [];

if (isset($_POST["register"])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $email = htmlspecialchars(trim($_POST['email']));


    if (empty($username) || empty($email) || empty($password)) {
        $errors[] = 'Semua field wajib diisi.';
    } else {
        if (strlen($username) < 8) {
            $errors['username'] = 'Username minimal 8 karakter.';
        }
        if (strlen($password) < 8) {
            $errors['password'] = 'Password minimal 8 karakter.';
        }
        if (!preg_match('/^[^@]+@gmail\.com$/', $email)) {
            $errors['email'] = 'Email harus menggunakan @gmail.com.';
        }
    }


    if (empty($errors)) {
        $hpassword = password_hash("fudge267", $password);
        $credit = 200;
        $role = "guest";



        $sql = "INSERT INTO msuser (username, password, email, credit, role) VALUES ('$username', '$hpassword', '$email', '$credit', '$role')";
        if ($db->query($sql)) {
            header("Location: login.php");
            exit();
        }
    }
    $db->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php
    include "includes/header.php";
    ?>
    <section id="background">

        <div class="card">
            <h1>Register</h1>
            <p class="tagline">Sign up. Load up. Stand out.</p>
            <form action="register.php" method="POST">
                <p class="highlighter">
                    Create your account by filling in the information below.
                </p>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                        placeholder="Enter your username(min. 8 characters)" />

                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email( ..@gmail.com)" />

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                        placeholder="Enter your password(min. 8 characters)" />
                </div>

                <button type="submit" class="btn-register" name="register">Register</button>
            </form>

            <p class="register-link">Already have an account? <a href="login.php">Login here.</a></p>
        </div>
    </section>

</body>

</html>


<?php
include "includes/footer.php";
?>