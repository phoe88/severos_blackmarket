<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
   <form action="register.php" method="POST">
  <input type="text"     name="first_name" />
  <input type="text"     name="last_name" />
  <input type="email"    name="email" />
  <input type="tel"      name="phone" />
  <select               name="role">…</select>
  <input type="password" name="password" />
  <input type="password" name="confirm_password" />
  <input type="checkbox" name="terms" value="1" />
  <input type="checkbox" name="newsletter" value="1" />
  <button type="submit">Create account</button>
</form>

</body>

</html>