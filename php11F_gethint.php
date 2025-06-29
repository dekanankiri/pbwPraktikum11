<?php
// Konfigurasi database
$db_hostname = "localhost";        // Ganti dengan host database Anda
$db_database = "pbw_pertemuan9";        // Ganti dengan nama database Anda
$db_username = "root";           // Ganti dengan username Anda
$db_password = "";       // Ganti dengan password Anda
$db_charset  = "utf8mb4";          // Charset opsional

// DSN dan opsi PDO
$dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=$db_charset";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false
);

try {
    // Koneksi ke database
    $pdo = new PDO($dsn, $db_username, $db_password, $opt);

    // Ambil parameter dari permintaan
    $query = $_GET["keyword"] ?? "";

    // Siapkan statement SQL
    $stmt = $pdo->prepare("SELECT name FROM meetings WHERE name LIKE ?"); 
    $stmt->execute([$query . "%"]);

    // Inisialisasi hasil
    $hint = "";

    // lookup all hints if query result is not empty
    if ($stmt) {
    echo json_encode($stmt);
    }
    else{// Output "no suggestion" if no hint was found or output correct values
    $response[] = array(
    'name'=>'no suggestion'
    );
    echo json_encode($response);
    }

    // Tutup koneksi
    $pdo = null;
} catch (PDOException $e) {
    exit("PDO Error: " . $e->getMessage() . "<br>");
}
?>
