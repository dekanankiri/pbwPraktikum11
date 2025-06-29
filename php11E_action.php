<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: php11D.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Tambah Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-8">
<?php
require_once 'koneksi.php';

$slot = $_POST['slot'] ?? null;
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');

if (empty($slot) || empty($name) || empty($email)) {
    echo '<div class="max-w-md mx-auto mt-10 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <p>All fields are required.</p>
            <a href="php11E.php" class="underline">Go Back</a>
          </div>';
    exit();
}

try {
    $stmt = $conn->prepare("INSERT INTO meetings (slot, name, email) VALUES (?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("iss", $slot, $name, $email);
    
    if ($stmt->execute()) {
        header("Location: php11F.php");
        exit();
    } else {
        throw new Exception("Execute error: " . $stmt->error);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    error_log("Meeting insert error: " . $e->getMessage());
    echo '<div class="max-w-md mx-auto mt-10 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <p>An error occurred. Please try again later.</p>
            <a href="php11E.php" class="underline">Back to Add Meeting</a>
          </div>';
} finally {
    $conn->close();
}
?>
</body>
</html>
