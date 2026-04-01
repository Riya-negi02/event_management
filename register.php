<?php
include 'db.php';

$error = "";

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(strlen($password) < 6){
        $error = "Password must be atleast 6 characters!";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(name,email,password,role) VALUES('$name','$email','$password','user')";
        if($conn->query($sql)){
            header('Location: login.php?registered=1');
            exit();
        } else {
            $error = "Something went wrong. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Event Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-box">
    <h2>Register</h2>

    <?php if($error != ""){ ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post">
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" id="password" placeholder="Enter password (min 6 chars)" required>
        <button type="submit" name="register">Register</button>
    </form>
    <br>
    <p style="text-align:center;">Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>