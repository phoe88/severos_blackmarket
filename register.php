<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first    = htmlspecialchars(trim($_POST['first_name']));
    $last     = htmlspecialchars(trim($_POST['last_name']));
    $email    = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $role     = htmlspecialchars($_POST['role']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];
    $terms    = isset($_POST['terms']);

    $errors = [];
    if (!$first || !$last)         $errors[] = 'Name is required.';
    if (!$email)                   $errors[] = 'Valid email required.';
    if (!$role)                    $errors[] = 'Role is required.';
    if (strlen($password) < 8)    $errors[] = 'Password must be 8+ characters.';
    if ($password !== $confirm)    $errors[] = 'Passwords do not match.';
    if (!$terms)                   $errors[] = 'You must accept the terms.';

    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        
       header('Location: welcome.php'); 
        exit;
    }
}

?>
</body>
</html>