<?php
session_start();
include 'db.php';

if($_SESSION['role'] != 'admin'){
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$success = "";
$error = "";

// fetch existing event
$result = $conn->query("SELECT * FROM events WHERE id=$id");
$event = $result->fetch_assoc();

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $desc  = $_POST['description'];
    $date  = $_POST['event_date'];
    $venue = $_POST['venue'];
    $org   = $_POST['organizer'];

    $sql = "UPDATE events SET title='$title', description='$desc', event_date='$date', venue='$venue', organizer='$org' WHERE id=$id";
    if($conn->query($sql)){
        $success = "Event updated successfully!";
        // refresh event data
        $result = $conn->query("SELECT * FROM events WHERE id=$id");
        $event = $result->fetch_assoc();
    } else {
        $error = "Something went wrong. Try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event - Event Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="topbar">
    <span>Event Management System - Admin</span>
    <div>
        <a href="admin_dashboard.php" style="margin-right:15px;">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Edit Event</h2>

    <?php if($success != ""){ ?>
        <p class="success"><?php echo $success; ?></p>
    <?php } ?>
    <?php if($error != ""){ ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post">
        <input type="text" name="title" value="<?php echo $event['title']; ?>" required>
        <input type="text" name="description" value="<?php echo $event['description']; ?>" required>
        <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required>
        <input type="text" name="venue" value="<?php echo $event['venue']; ?>" required>
        <input type="text" name="organizer" value="<?php echo $event['organizer']; ?>" required>
        <button type="submit" name="update">Update Event</button>
    </form>
    <br>
    <p style="text-align:center;"><a href="admin_dashboard.php">← Back to Dashboard</a></p>
</div>

</body>
</html>