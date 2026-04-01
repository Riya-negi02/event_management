<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$event_id = $_GET['id'];

$conn->query("DELETE FROM registrations WHERE user_id=$user_id AND event_id=$event_id");

header('Location: My_registrations.php');
exit();
?>