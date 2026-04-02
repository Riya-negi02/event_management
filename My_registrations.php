<?php
session_start();
include 'db.php';

if($_SESSION['role'] != 'user'){
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$registrations = $conn->query("SELECT e.*, r.id as reg_id
                                FROM events e
                                INNER JOIN registrations r
                                ON e.id = r.event_id
                                WHERE r.user_id = $user_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Registrations - Event Management</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="topbar">
    <span>Event Management System</span>
    <div>
        <a href="user_dashboard.php" style="margin-right:15px;">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="container">
    <h2>My Registrations</h2>
    <p style="text-align:center; color:gray;">Events you have registered for.</p>

    <?php if($registrations->num_rows == 0){ ?>
        <p style="text-align:center; color:gray; margin-top:30px;">You have not registered for any events yet. <a href="user_dashboard.php">Browse events</a></p>
    <?php } else { ?>
    <table>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Organizer</th>
            <th>Action</th>
        </tr>
        <?php while($row = $registrations->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['event_date']; ?></td>
            <td><?php echo $row['venue']; ?></td>
            <td><?php echo $row['organizer']; ?></td>
            <td>
                <a href="Cancel_registrations.php?id=<?php echo $row['id']; ?>" 
                   onclick="return confirm('Are you sure you want to cancel this registration?')"
                   style="color:red;">Cancel</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php } ?>
</div>

</body>
</html>