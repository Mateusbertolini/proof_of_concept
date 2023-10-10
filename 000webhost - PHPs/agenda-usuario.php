<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once('config.php');

// Initialize an array to store the data
$data = array();

// Check if 'id' key exists in the URL parameters
if (isset($_GET['id'])) {
    // Get the value of 'id' from the URL
    $id = $_GET['id'];

    // Use prepared statement to avoid SQL injection
    $stmt = $connection->prepare("SELECT * FROM `agenda-clinicas` WHERE `agendado_por` = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        while ($linha = $result->fetch_assoc()) {
            $data[] = $linha;
        }

        // Output the data as JSON
        echo json_encode($data);
    } else {
        // Handle the error gracefully and return an error JSON response
        $error = array("error" => "Database query error: " . $connection->error);
        echo json_encode($error);
    }

    // Close the prepared statement and the database connection
    $stmt->close();
} else {
    // Return an error JSON response if 'id' key is not present
    $error = array("error" => "Invalid or missing 'id' parameter in the URL");
    echo json_encode($error);
}

$connection->close();
?>
