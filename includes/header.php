<?php





if (isset($_POST["index"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}


$username = "";
if (isset($_SESSION["is_login"]) == true) {
    $data = "SELECT * FROM msuser WHERE email='" . $_SESSION["email"] . "'";
    if ($db->query($data)->num_rows > 0) {
        $row = $db->query($data)->fetch_assoc();
        $username = $row["username"];
        echo $username;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <header>

        <img value="Severos" src="assets/logo.png" id="logo" alt="logo.png" width="40px" height="40px">

        <ul aria-label="Auth Navigation" id="authen">
            <?php
            if (isset($_SESSION["is_login"])) {
                echo '
                <ul style="margin-right: 370px;" aria-label="Main Navigation" id="navigation">
                <li name="home" id="home.php"><a href="home.php">Home</a></li>
                <div class="divider"></div>
             <li name="marketplace" id="marketplace.php"><a href="marketplace.php">Marketplace</a></li>
                <div class="divider"></div>
                <li name="arsenal" id="arsenal.php"><a href="arsenal.php">Arsenal</a></li>
             <div class="divider"></div>
                <li name="transaction" id="transaction.php"><a href="transaction.php">Transaction</a></li>
             </ul>';
                echo $username;
                echo ' <div class="divider"></div>';
                echo '<form action="../index.php" method="post">
    <button id="logout-btn" style="background: none; color: #434343; border: none; padding: none; cursor: pointer ;" type="submit" name="index">Logout</button>
</form>';
            } else {
                echo '<li name="login" id="login-page"><a href="login.php">Login</a></li>';
                echo '<div class="divider"></div>';
                echo '<li name="register" id="register-page"><a href="register.php">Register</a></li>';

            }

            ?>
        </ul>




    </header>


    <script src="script.js"></script>
</body>

</html>