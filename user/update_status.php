<?php
session_start();
include 'dbconnect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $refid = $_POST['refid'];

    // Only allow update if current status is unclaimed
    $update_stmt = $conn->prepare("UPDATE items SET Status = 'claimed' WHERE Ref id = ? AND email = ?");
    $update_stmt->bind_param("ss", $refid, $_SESSION['email']);
    $update_stmt->execute();
}
header("Location: userprofile.php");
exit();
?>