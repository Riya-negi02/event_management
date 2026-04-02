<?php
session_start();
include 'db.php';

$error = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($res->num_rows > 0){
        $row = $res->fetch_assoc();
        if(password_verify($_POST['password'], $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['name'] = $row['name'];

            if($row['role'] == 'admin'){
                header('Location: admin_dashboard.php');
            } else {
                header('Location: user_dashboard.php');
            }
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Event Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <?php if($error != ""){ ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <?php if(isset($_GET['registered'])){ ?>
        <p class="success">Registration successful! Please login.</p>
    <?php } ?>

    <form method="post">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <br>
    <p style="text-align:center;">Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>