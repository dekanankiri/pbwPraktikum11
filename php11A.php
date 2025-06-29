<?php
// Ambil data dari API
$data = file_get_contents("https://reqres.in/api/users?page=1");

// Ubah JSON menjadi object PHP
$parse_data = json_decode($data);

// Ambil array user
$users = $parse_data->data;

// Tampilkan dalam bentuk tabel
echo "<h2>Daftar Pengguna dari API Reqres</h2>";
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Avatar</th>
      </tr>";

// Loop data
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>{$user->id}</td>";
    echo "<td>{$user->first_name}</td>";
    echo "<td>{$user->last_name}</td>";
    echo "<td>{$user->email}</td>";
    echo "<td><img src='{$user->avatar}' width='50' height='50'></td>";
    echo "</tr>";
}

echo "</table>";
?>
