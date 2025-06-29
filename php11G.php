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
$result = $conn->query("SELECT * FROM meetings WHERE slot = $slot");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
  <title>Edit Data Meeting</title>
</head>
<body>
  <h2>Form Edit Data Meeting</h2>
  <form action="php10G_action.php" method="post">
    <input type="hidden" name="slot" value="<?= $row['slot'] ?>">
    <label>Name: <input type="text" name="name" value="<?= $row['name'] ?>" required></label><br><br>
    <label>Email: <input type="email" name="email" value="<?= $row['email'] ?>" required></label><br><br>
    <input type="submit" value="Update">
  </form>
</body>
</html>
