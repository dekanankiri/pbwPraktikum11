<?php
require_once 'koneksi.php';

header('Content-Type: application/json');

try {
    // Get search keyword from request
    $query = $_GET["keyword"] ?? "";
    
    if (empty($query)) {
        echo json_encode([]);
        exit;
    }

    // Prepare and execute the search query
    $stmt = $conn->prepare("SELECT DISTINCT name FROM meetings WHERE name LIKE ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $searchTerm = $query . "%";
    $stmt->bind_param("s", $searchTerm);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute query: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $suggestions = [];

    // Fetch all matching names
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = ['name' => $row['name']];
    }

    // Return results
    echo json_encode($suggestions);

} catch (Exception $e) {
    error_log("Search error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'An error occurred while searching']);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
}
?>
