<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: php11D.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "pbw_pertemuan9");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$slot = $_GET['slot'];

if (empty($slot)) {
    echo "Invalid slot.";
    exit;
}

$stmt = $conn->prepare("DELETE FROM meetings WHERE slot = ?");
$stmt->bind_param("i", $slot);

if ($stmt->execute()) {
    header("Location: php10F.php");
    exit();
} else {
    echo "Delete failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
