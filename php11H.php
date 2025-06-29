<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: php11D.php");
    exit();
}

require_once 'koneksi.php';

try {
    // Validate input
    $slot = isset($_GET['slot']) ? (int)$_GET['slot'] : 0;
    
    if (empty($slot)) {
        throw new Exception("Invalid meeting slot specified.");
    }

    // Prepare and execute delete
    $stmt = $conn->prepare("DELETE FROM meetings WHERE slot = ?");
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $slot);
    
    if (!$stmt->execute()) {
        throw new Exception("Delete failed: " . $stmt->error);
    }

    if ($stmt->affected_rows === 0) {
        throw new Exception("No meeting was deleted. The meeting may not exist.");
    }

    // Success - redirect back to meetings list
    header("Location: php11F.php");
    exit();

} catch (Exception $e) {
    // Log the error
    error_log("Meeting deletion error: " . $e->getMessage());
    
    // Show error page
    ?>
    <!DOCTYPE html>
    <html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error - Delete Meeting</title>
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
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Error</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p><?= htmlspecialchars($e->getMessage()) ?></p>
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
                    </div>
                </div>
            </div>
        </main>
    </body>
    </html>
    <?php
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
}
?>
