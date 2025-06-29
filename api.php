<?php
// Kegiatan Praktikum 11.4.1 Nomor 5
// $data = file_get_contents("https://reqres.in/api/users?page=2");
// var_dump($data);

// fallback if API fails
$data = file_get_contents("users.json");
// var_dump($data);

// Kegiatan Praktikum 11.4.1 Nomor 6
$parsed_data = json_decode($data, true);
// var_dump($parsed_data);

$user_data = $parsed_data["data"]; // list of user is in data property
// var_dump($user_data);

// Kegiatan Praktikum 11.4.1 Nomor 7
// $parsed_data = json_decode($data);
// var_dump($parsed_data); // parsed data is displayed as an object

// $user_data = $parsed_data->data; // list of user is in data property
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <title>php11A - Displaying Data from API</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Name</th>
            <th>Avatar</th>
        </tr>
        <?php foreach ($user_data as $user): ?>
            <tr>
                <td><?= $user['id'] ?? NULL ?></td>
                <td><?= $user['email'] ?? NULL ?></td>
                <td><?= $user['first_name'] ?? NULL ?> <?= $user['last_name'] ?? NULL ?></td>
                <td>
                    <img src="<?= $user['avatar'] ?? '' ?>" alt="avatar">
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>