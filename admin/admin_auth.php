<?php
include_once "../service/database.php";
session_start();

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}

if (empty($_SESSION["is_admin"]) || $_SESSION["is_admin"] !== true) {
    header("Location: ../login.php");
    exit();
}

$adminEmail = $_SESSION["email"] ?? "";
$adminUsername = "Administrator";

if ($adminEmail) {
    $stmt = $db->prepare("SELECT username FROM msuser WHERE email = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("s", $adminEmail);
        $stmt->execute();
        $stmt->bind_result($usernameResult);
        if ($stmt->fetch()) {
            $adminUsername = htmlspecialchars($usernameResult, ENT_QUOTES, "UTF-8");
        }
        $stmt->close();
    }
}

function findTable($db, array $candidates)
{
    foreach ($candidates as $name) {
        $safeName = mysqli_real_escape_string($db, $name);
        $result = $db->query("SHOW TABLES LIKE '$safeName'");
        if ($result && $result->num_rows > 0) {
            return $name;
        }
    }
    return null;
}

function fetchTableRows($db, string $tableName, int $limit = 100)
{
    $safeName = mysqli_real_escape_string($db, $tableName);
    $result = $db->query("SELECT * FROM `$safeName` LIMIT $limit");
    if ($result) {
        return $result;
    }
    return null;
}
