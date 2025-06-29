<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: php11D.php");
    exit();
}
require_once 'koneksi.php';

$slot = isset($_GET['slot']) ? (int)$_GET['slot'] : 0;
$error = '';
$meeting = null;

try {
    $stmt = $conn->prepare("SELECT * FROM meetings WHERE slot = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("i", $slot);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $meeting = $result->fetch_assoc();
    } else {
        $error = "Meeting not found";
    }
} catch (Exception $e) {
    error_log("Error loading meeting: " . $e->getMessage());
    $error = "An error occurred while loading the meeting";
}
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Meeting</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php include('php11F_header.php'); ?>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="max-w-md mx-auto">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            <?= $error ? 'Error' : 'Edit Meeting' ?>
                        </h2>
                    </div>

                    <?php if ($error): ?>
                        <div class="rounded-md bg-red-50 p-4 mb-6">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Error</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p><?= htmlspecialchars($error) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="php11F.php" 
                               class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Back to Meetings
                            </a>
                        </div>
                    <?php else: ?>
                        <form action="php11G_action.php" method="post" class="space-y-6">
                            <input type="hidden" name="slot" value="<?= htmlspecialchars($meeting['slot']) ?>">
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <div class="mt-1">
                                    <input type="text" name="name" id="name" required
                                           value="<?= htmlspecialchars($meeting['name']) ?>"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <div class="mt-1">
                                    <input type="email" name="email" id="email" required
                                           value="<?= htmlspecialchars($meeting['email']) ?>"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="flex items-center justify-between space-x-4">
                                <a href="php11F.php" 
                                   class="flex-1 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-center">
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="flex-1 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update Meeting
                                </button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
