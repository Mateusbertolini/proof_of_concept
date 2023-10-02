<?php

// Allow cross-origin requests from any origin (replace '*' with the specific origin if needed)
header("Access-Control-Allow-Origin: *");

// Allow specific HTTP methods (e.g., GET, POST) - adjust as needed
header("Access-Control-Allow-Methods: GET, POST");

// Allow specific headers in the request - adjust as needed
header("Access-Control-Allow-Headers: Content-Type");

// Set the response content type to JSON
header("Content-Type: application/json");

// Include your database configuration file
include_once('config.php');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if JSON data is received
$data = json_decode(file_get_contents('php://input'));

if (isset($data->selectedIds) && is_array($data->selectedIds)) {
    $selectedIds = implode(",", $data->selectedIds);
    
    $deleteQuery = "DELETE FROM materiais WHERE ID IN ($selectedIds)";
    
    if (mysqli_query($connection, $deleteQuery)) {
        echo "Records with IDs ($selectedIds) deleted successfully";
    } else {
        echo "Error deleting records: " . mysqli_error($connection);
    }
} else {
    echo "No valid data received.";
}

mysqli_close($connection);
?>