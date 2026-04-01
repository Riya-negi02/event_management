<?php
session_start();
include 'db.php';

if($_SESSION['role'] != 'admin'){
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$conn->query("DELETE FROM events WHERE id=$id");
header('Location: admin_dashboard.php');
exit();
?>