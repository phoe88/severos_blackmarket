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

<?php 


    $errors = [];
    

    $email = trim(htmlspecialchars($_POST['email']));
    if(empty($email)){
        $errors[] = "Data perlu diisi supaya valid";
    }else if(!preg_match("/^\?+@gmail.com/", $email)){
        $errors[] = "Data harus diisi dengan email yang valid";
    };



    $password = trim(htmlspecialchars($_POST['password']));
    if(empty($password)){
        $errors[] = "Data perlu diisi supaya valid";
    }else if(!preg_match("/^\?+[10-30]/", $password)){
        $errors[] = "Data perlu diisi setidaknya 10-30 karakter";
    };

?>



<form id="form-registration" action="register.php" method="POST">
   <label for="email">Email</label>
  <input type="email" name="email" id="email">
  <label for="password">Password</label>
  <input type="password" name="email" id="password">
  <button type="submit">Submit</button>


</form>




<script src="script.js"></script>
</body>

</html>