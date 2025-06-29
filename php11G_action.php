<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: php10D.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "pbw_pertemuan9");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$slot  = $_POST['slot'];
$name  = $_POST['name'];
$email = $_POST['email'];

if (empty($slot) || empty($name) || empty($email)) {
    echo "All fields are required.";
    exit;
}

$stmt = $conn->prepare("UPDATE meetings SET name = ?, email = ? WHERE slot = ?");
$stmt->bind_param("ssi", $name, $email, $slot);

if ($stmt->execute()) {
    header("Location: php10F.php");
    exit();
} else {
    echo "Update failed: " . $stmt->error;
}

$stmt->close();
$conn->close();
