<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

    <form id="form-register" action="" method="POST">
        <h1>Register</h1>
        <div id="slogan">Sign Up. Load up. Stand out.</div>
        <div id="subtitle">Create your account by filling in the iformation below</div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Enter your username (min. 8 characters)">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password (min. 8 characters)">
        <button type="submit"> <a href="register.php">Register</a></button>
        <div id="option-login">Already have an account?<a href="login.php">Login here</a></div>
    </form>



</body>
</html>