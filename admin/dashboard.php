<?php
include "../service/database.php";
session_start();

if ($_SESSION['email']) {
    $data = "SELECT * FROM msuser WHERE role = 'admin'";
    $results = $db->query($data);

    if ($results->num_rows > 0) {
        $rows = $results->fetch_assoc();

        echo '<br>' . $rows['username'];

    } else {

    }



}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin</title>
</head>

<body>
    <?php
    echo "Welcome and rise and shine" . "<br>" . "" . $_SESSION['email'];
    ;
    ?>
</body>

</html>