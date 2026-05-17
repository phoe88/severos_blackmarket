<?php
include "../service/database.php";
session_start();

if ($_SESSION['email']) {
    $data = "SELECT * FROM msuser WHERE role = 'admin'";
    $results = $db->query($data);

    if ($results->num_rows > 0) {
        $rows = $results->fetch_assoc();
        echo $rows['username'];
    } else {
        echo "no data";
    }



}


if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../register.php");
    exit();

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

    <section id="background">
        <?php
        echo "Welcome and rise and shine" . "<br>" . "" . $rows['username'];

        ?>

        <form action="dashboard.php" method="post">
            <button type="submit" name="logout">Logout</button>

        </form>
    </section>




</body>

</html>