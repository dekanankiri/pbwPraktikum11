<?php
session_start();
require_once 'koneksi.php'; // Buat koneksi ke database

$username = $_POST['username'];
$password = $_POST['password'];

// Cek ke database
$sql = "SELECT * FROM user WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $_SESSION['username'] = $username;
    header("Location: php11F.php");
    exit();
} else {
    echo "<p style='color:red;'>Login gagal. Username atau password salah.</p>";
    echo "<a href='php11.php'>Coba lagi</a>";
}
?>
