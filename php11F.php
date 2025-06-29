<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: php11D.php");
    exit();
}
?>
<?php include('php11F_header.php'); ?>

<!DOCTYPE html>
<html lang="en-GB">
<head>
  <title>Data Meeting</title>
</head>
<body>
  <h2>Data Meeting</h2>

  <form action="">
  Name: <input type="text" id="txt1"
  onkeyup="showHint(this.value)">
  </form>


  <p>Suggestions: <span id="txtHint"></span></p>
  <table border="1" cellpadding="10">
    <tr>
      <th>Slot</th>
      <th>Name</th>
      <th>Email</th>
      <th>Action</th>
    </tr>
    <?php
    $conn = new mysqli("localhost", "root", "", "pbw_pertemuan9");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query("SELECT * FROM meetings");
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
      <td><?= $row['slot'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['email'] ?></td>
      <td>
        <a href='php10G.php?slot=<?= $row["slot"] ?>'>
          <img src='edit.png' style='width:30px;height:30px;'>
        </a>
        <a href='php10H.php?slot=<?= $row["slot"] ?>' onclick="return confirm('Are you sure?');">
          <img src='remove.png' style='width:30px;height:30px;'>
        </a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
  <br>
  <a href="php11E.php"><button>Tambah</button></a>
  <script src="php11F_suggestion.js"></script>
</body>
</html>
