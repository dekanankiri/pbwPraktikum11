<?php
session_start();
require_once 'koneksi.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo "<p style='color:red;'>Username and password are required.</p>";
    echo "<a href='php11D.php'>Try again</a>";
    exit();
}

try {
    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: php11F.php");
        exit();
    } else {
        echo "<p style='color:red;'>Login failed. Incorrect username or password.</p>";
        echo "<a href='php11D.php'>Try again</a>";
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    echo "<p style='color:red;'>An error occurred. Please try again later.</p>";
    echo "<a href='php11D.php'>Try again</a>";
} finally {
    $conn->close();
}
?>
