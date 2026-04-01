<?php
session_start();
include 'db.php';

if($_SESSION['role'] != 'admin'){
    header('Location: login.php');
    exit();
}

$success = "";

if(isset($_POST['add'])){
    $title = $_POST['title'];
    $desc  = $_POST['description'];
    $date  = $_POST['event_date'];
    $venue = $_POST['venue'];
    $org   = $_POST['organizer'];

    $sql = "INSERT INTO events(title,description,event_date,venue,organizer) VALUES('$title','$desc','$date','$venue','$org')";
    if($conn->query($sql)){
        $success = "Event added successfully!";
    }
}

$events = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Event Management</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>

<div class="topbar">
    <span><b>Event Management System</b> - Admin Panel</span>
    <div>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Admin Dashboard</h2>

    <?php if($success != ""){ ?>
        <p class="success"><?php echo $success; ?></p>
    <?php } ?>

    <!-- ADD EVENT CARD -->
    <div class="event-card" style="margin-bottom:30px;">
        <h3>Add New Event</h3>
        <form method="post">
            <input type="text" name="title" placeholder="Event Title" required>
            <input type="text" name="description" placeholder="Description" required>
            <input type="date" name="event_date" required>
            <input type="text" name="venue" placeholder="Venue" required>
            <input type="text" name="organizer" placeholder="Organizer Name" required>
            <button type="submit" name="add">Add Event</button>
        </form>
    </div>

    <h3>All Events</h3>

    <div class="cards-grid">
        <?php while($row = $events->fetch_assoc()){
            $count = $conn->query("SELECT COUNT(*) as total 
                                   FROM registrations 
                                   WHERE event_id={$row['id']}")
                           ->fetch_assoc()['total'];
        ?>
        <div class="event-card">
            <h3><?php echo $row['title']; ?></h3>

            <div class="detail">📅 <?php echo date('M d, Y', strtotime($row['event_date'])); ?></div>
            <div class="detail">📍 <?php echo $row['venue']; ?></div>
            <div class="detail">👤 <?php echo $row['organizer']; ?></div>
            <div class="detail">👥 Registrations: <?php echo $count; ?></div>

            <div class="detail" style="margin-top:10px; color:#777;">
                <?php echo $row['description']; ?>
            </div>
            <br>
            <div class="card-footer">
                <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="btn-register" style="margin-right:10px;">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirmDelete()" 
                   class="btn-register" 
                   style="background:linear-gradient(90deg,#f87171,#fb7185);">
                   Delete
                </a>
            </div>
        </div>
        <?php } ?>
    </div>

</div>

</body>
</html>