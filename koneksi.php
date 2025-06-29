<?php
$host = "localhost";
$user = "root";
$pass = ""; // atau isi sesuai servermu
$db   = "pbw_pertemuan9";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
