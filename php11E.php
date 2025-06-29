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
    <title>Tambah Meeting - Meeting Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg overflow-hidden mt-8">
        <div class="p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Form Tambah Data Meeting</h2>
            <form action="php11E_action.php" method="post" class="space-y-5">
                <div>
                    <label class="block text-gray-700">Slot:</label>
                    <input type="number" name="slot" required class="mt-1 block w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700">Name:</label>
                    <input type="text" name="name" required class="mt-1 block w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700">Email:</label>
                    <input type="email" name="email" required class="mt-1 block w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-blue-500">
                </div>
                <input type="submit" value="Tambah" class="w-full py-2 px-4 bg-blue-600 text-white rounded hover:bg-blue-700 cursor-pointer">
            </form>
        </div>
    </div>
</body>
</html>
