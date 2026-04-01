<?php
session_start();
include 'db.php';

if($_SESSION['role'] != 'user'){
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$events = $conn->query("SELECT e.*, r.id as reg_id
                        FROM events e
                        LEFT JOIN registrations r
                        ON e.id = r.event_id AND r.user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard - Event Management</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>

<div class="topbar">
    <span><b>Event Management System</b></span>
    <div>
        <a href="my_registrations.php" style="margin-right:15px;">My Registrations</a>
        
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>Welcome, <?php echo $_SESSION['name']; ?>! 👋</h2>
    <p style="text-align:center; color:gray; margin-bottom:10px;">Browse and register for upcoming events below.</p>

    <?php if($events->num_rows == 0){ ?>
        <p style="text-align:center; color:gray; margin-top:30px;">No events available right now.</p>
    <?php } else { ?>

    <div class="cards-grid">
        <?php while($row = $events->fetch_assoc()){ ?>
        <div class="event-card">
            <h3><?php echo $row['title']; ?></h3>
            <div class="detail"><span>📅</span><?php echo date('M d, Y', strtotime($row['event_date'])); ?></div>
            <div class="detail"><span>📍</span><?php echo $row['venue']; ?></div>
            <div class="detail"><span>👤</span><?php echo $row['organizer']; ?></div>
            <?php if(!empty($row['description'])){ ?>
            <div class="detail" style="margin-top:10px; color:#777; font-size:0.85rem;">
                <?php echo $row['description']; ?>
            </div><br>
            <?php } ?>
            <div class="card-footer">
                <?php if($row['reg_id']){ ?>
                    <div class="btn-registered">✔ Registered</div>
                <?php } else { ?>
                    <a href="register_event.php?id=<?php echo $row['id']; ?>" class="btn-register">Register Now</a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php } ?>
</div>

</body>
</html>