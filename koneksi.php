<?php
$host = "localhost";
$user = "root";
$pass = ""; 
$db   = "pbw_pertemuan9";

try {
    $conn = new mysqli($host, $user, $pass, $db);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to ensure proper encoding
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    // Log error (in production, you'd want to log to a file)
    error_log("Database connection error: " . $e->getMessage());
    die("Sorry, there was a problem connecting to the database. Please try again later.");
}
?>
